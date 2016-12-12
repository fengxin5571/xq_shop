<?php
define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
/* 权限判断 */
admin_priv('talent');
/*初始化数据交换对象 */
$exc = new exchange($ecs->table("talent_request"), $db, 'msg_id', 'user_name');



if ($_REQUEST['act'] == 'remove_msg')
{
    $msg_id = empty($_GET['msg_id']) ? 0 : intval($_GET['msg_id']);
    $user_id = empty($_GET['user_id']) ? 0 : intval($_GET['user_id']);
    $sql = "SELECT * FROM " . $ecs->table('talent_request') . " WHERE msg_id='$msg_id'";
    $row = $db->getRow($sql);
    if ($row)
    {
        if ($row['user_id'] == $user_id)
        {
            $sql = "DELETE FROM " . $ecs->table('talent_request') . " WHERE msg_id=$msg_id LIMIT 1";
            $db->query($sql);
        }
    }
    ecs_header("Location: talent_request.php?act=list_all\n");
    exit;
}
/*------------------------------------------------------ */
//-- 更新留言的状态为显示或者禁止
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'check')
{
    if ($_REQUEST['check'] == 'allow')
    {
        /* 允许留言显示 */
        $sql = "UPDATE " .$ecs->table('talent_request'). " SET msg_status = 1 WHERE msg_id = '$_REQUEST[id]'";
        $db->query($sql);

        /* 清除缓存 */
        clear_cache_files();

        ecs_header("Location: talent_request.php?act=view&id=$_REQUEST[id]\n");
        exit;
    }
    else
    {
        /* 禁止留言显示 */
        $sql = "UPDATE " .$ecs->table('talent_request'). " SET msg_status = 0 WHERE msg_id = '$_REQUEST[id]'";
        $db->query($sql);

        /* 清除缓存 */
        clear_cache_files();

        ecs_header("Location: talent_request.php?act=view&id=$_REQUEST[id]\n");
        exit;
    }
}
/*------------------------------------------------------ */
//-- 列出所有留言
/*------------------------------------------------------ */
if ($_REQUEST['act']=='list_all')
{

    assign_query_info();
    $msg_list = msg_list();

    $smarty->assign('msg_list',     $msg_list['msg_list']);
    $smarty->assign('filter',       $msg_list['filter']);
    $smarty->assign('record_count', $msg_list['record_count']);
    $smarty->assign('page_count',   $msg_list['page_count']);
    $smarty->assign('full_page',    1);
    $smarty->assign('sort_msg_id', '<img src="images/sort_desc.gif">');

    $smarty->assign('ur_here',      '输送申请列表');
    $smarty->assign('full_page',    1);
    $smarty->display('talent_request.htm');
}

/*------------------------------------------------------ */
//-- ajax显示留言列表
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'query')
{
    $msg_list = msg_list();

    $smarty->assign('msg_list',     $msg_list['msg_list']);
    $smarty->assign('filter',       $msg_list['filter']);
    $smarty->assign('record_count', $msg_list['record_count']);
    $smarty->assign('page_count',   $msg_list['page_count']);

    $sort_flag  = sort_flag($msg_list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    make_json_result($smarty->fetch('talent_request.htm'), '', array('filter' => $msg_list['filter'], 'page_count' => $msg_list['page_count']));
}
/*------------------------------------------------------ */
//-- ajax 删除留言
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'remove')
{
    $msg_id = intval($_REQUEST['id']);

    /* 检查权限 */
    check_authz_json('talent');

    $msg_title = $exc->get_name($msg_id);
    if ($exc->drop($msg_id))
    {
        $sql = "DELETE FROM " . $ecs->table('talent_request') . " WHERE msg_id = '$msg_id' LIMIT 1";
        $db->query($sql, 'SILENT');

        $url = 'talent_request.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);
        ecs_header("Location: $url\n");
        exit;
    }
    else
    {
        make_json_error($GLOBALS['db']->error());
    }
}
/*------------------------------------------------------ */
//-- 回复留言
/*------------------------------------------------------ */
elseif ($_REQUEST['act']=='view')
{
    $smarty->assign('send_fail',   !empty($_REQUEST['send_ok']));
    $smarty->assign('msg',         get_feedback_detail(intval($_REQUEST['id'])));
    $smarty->assign('ur_here',     $_LANG['reply']);
    $smarty->assign('action_link', array('text' => '输送申请列表', 'href'=>'talent_request.php?act=list_all'));

    assign_query_info();
    $smarty->display('talent_request_info.htm');
}
elseif ($_REQUEST['act']=='action')
{

    $sql = "UPDATE ".$ecs->table('talent_request')." SET reply='".$_POST['reply']."', reply_time = '".gmtime()."' WHERE msg_id = '".$_REQUEST['msg_id']."'";
    $db->query($sql);

        /* 邮件通知处理流程 */
    if (!empty($_POST['send_email_notice']) or isset($_POST['remail']))
    {
        //获取邮件中的必要内容
        $sql = 'SELECT a.*, b.name ' .
               'FROM ' .$ecs->table('talent_request') . " AS a ".
               " LEFT JOIN " .$ecs->table('talent') . " AS b ON(a.talent_id = b.talent_id)".
               " WHERE a.msg_id ='$_REQUEST[msg_id]'";
        $message_info = $db->getRow($sql);

        /* 设置留言回复模板所需要的内容信息 */
        $template    = get_mail_template('talent_request');

        $smarty->assign('user_name',   $message_info['user_name']);
        $smarty->assign('message_note', $_POST['reply']);
        $smarty->assign('talent_name', $message_info['name'] );
        $smarty->assign('shop_name',   "<a href='".$ecs->url()."'>" . $_CFG['shop_name'] . '</a>');
        $smarty->assign('send_date',   date('Y-m-d'));

        $content = $smarty->fetch('str:' . $template['template_content']);

        /* 发送邮件 */
        if (send_mail($message_info['user_name'], $message_info['user_email'], $template['template_subject'], $content, $template['is_html']))
        {
            $send_ok = 0;
        }
        else
        {
            $send_ok = 1;
        }
    }

    ecs_header("Location: ?act=view&id=".$_REQUEST['msg_id']."&send_ok=$send_ok\n");
    exit;

}
/**
 *
 *
 * @access  public
 * @param
 *
 * @return void
 */
function msg_list()
{
    /* 过滤条件 */
    $filter['keywords']   = empty($_REQUEST['keywords']) ? '' : trim($_REQUEST['keywords']);
    if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
    {
        $filter['keywords'] = json_str_iconv($filter['keywords']);
    }
    $filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'f.msg_id' : trim($_REQUEST['sort_by']);
    $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);

    $where = '';
    if ($filter['keywords'])
    {
        $where .= " AND t.name LIKE '%" . mysql_like_quote($filter['keywords']) . "%' ";
    }
    

    $sql = "SELECT count(*) FROM " .$GLOBALS['ecs']->table('talent_request'). " AS f" .
           " LEFT JOIN " . $GLOBALS['ecs']->table('talent'). " AS t ON(f.talent_id = t.talent_id)" .
           " WHERE 1=1 " . $where;
    $filter['record_count'] = $GLOBALS['db']->getOne($sql);

    /* 分页大小 */
    $filter = page_and_size($filter);

    $sql = "SELECT * " .
            "FROM " . $GLOBALS['ecs']->table('talent_request') . " AS f ".
            " LEFT JOIN " . $GLOBALS['ecs']->table('talent'). " AS t ON(f.talent_id = t.talent_id)" .
            "WHERE 1=1 $where " .
            "ORDER by $filter[sort_by] $filter[sort_order] ".
            "LIMIT " . $filter['start'] . ', ' . $filter['page_size'];

    $msg_list = $GLOBALS['db']->getAll($sql);
    foreach ($msg_list AS $key => $value)
    {   
        $msg_list[$key]['msg_time'] = local_date($GLOBALS['_CFG']['time_format'], $value['msg_time']);
    }
    $filter['keywords'] = stripslashes($filter['keywords']);
    $arr = array('msg_list' => $msg_list, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);

    return $arr;
}

/**
 * 获得详细信息
 *
 * @param   integer $id
 *
 * @return  array
 */
function get_feedback_detail($id)
{
    global $ecs, $db, $_CFG;

    $sql = "SELECT tr.*, t.name ".
            " FROM ".$ecs->table('talent_request'). ' AS tr' .
            " LEFT JOIN ".$ecs->table('talent'). ' AS t ON(tr.talent_id = t.talent_id)' .
            "WHERE tr.msg_id = '$id'";
    $msg = $db->GetRow($sql);

    if ($msg)
    {
        $msg['msg_time']   = local_date($_CFG['time_format'], $msg['msg_time']);
        $msg['reply_time'] = local_date($_CFG['time_format'], $msg['reply_time']);
    }

    return $msg;
}

?>