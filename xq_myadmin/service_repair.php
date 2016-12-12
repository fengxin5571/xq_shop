<?php
define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
/* 权限判断 */
admin_priv('service_repair');
/*初始化数据交换对象 */
$exc = new exchange($ecs->table("service_repair"), $db, 'msg_id', 'user_name');



if ($_REQUEST['act'] == 'remove_msg')
{
    $msg_id = empty($_GET['msg_id']) ? 0 : intval($_GET['msg_id']);
    $user_id = empty($_GET['user_id']) ? 0 : intval($_GET['user_id']);
    $sql = "SELECT * FROM " . $ecs->table('service_repair') . " WHERE msg_id='$msg_id'";
    $row = $db->getRow($sql);
    if ($row)
    {
        if ($row['user_id'] == $user_id)
        {
            $sql = "DELETE FROM " . $ecs->table('service_repair') . " WHERE msg_id=$msg_id LIMIT 1";
            $db->query($sql);
        }
    }
    ecs_header("Location: service_repair.php?act=list_all\n");
    exit;
}
/*------------------------------------------------------ */
//-- 更新申请的状态为确认或者禁止
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'check')
{
    if ($_REQUEST['check'] == 'allow')
    {
        /* 确认申请 */
        $sql = "UPDATE " .$ecs->table('service_repair'). " SET msg_status = 1,admin_id='$_SESSION[admin_id]' WHERE msg_id = '$_REQUEST[id]'";
        $db->query($sql);
        /* 清除缓存 */
        clear_cache_files();

        ecs_header("Location: service_repair.php?act=view&id=$_REQUEST[id]\n");
        exit;
    }
    else
    {
        /* 拒绝申请 */
        $sql = "UPDATE " .$ecs->table('service_repair'). " SET msg_status = 0 ,admin_id= 0 WHERE msg_id = '$_REQUEST[id]'";
        $db->query($sql);

        /* 清除缓存 */
        clear_cache_files();

        ecs_header("Location: service_repair.php?act=view&id=$_REQUEST[id]\n");
        exit;
    }
}
/*------------------------------------------------------ */
//-- 确认维修完毕
/*------------------------------------------------------ */
if($_REQUEST['act']== 'confirm_service'){
    $msg_id = empty($_GET['id']) ? 0 : intval($_GET['id']);
    if(empty($msg_id))
    {
        sys_msg("无此申请",1);
        exit;
    }
    $msg_info=get_feedback_detail($msg_id);
    $confirm_time=local_strtotime($msg_info['reply_time']);
    $headway_time=ceil((gmtime()-$confirm_time)/86400);
    if($headway_time<31)
    {
        sys_msg("确认申请后还不足一个月时间！",1);
        exit;
    }
    $sql = "UPDATE " .$ecs->table('service_repair'). " SET msg_status = 3 ,admin_id= 0 WHERE msg_id = '$msg_id'";
    $db->query($sql);
    /* 清除缓存 */
    clear_cache_files();
    ecs_header("Location: service_repair.php?act=view&id=$_REQUEST[id]\n");
    exit;
}
/*------------------------------------------------------ */
//-- 列出所有申请
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

    $smarty->assign('ur_here',      '售后申请列表');
    $smarty->assign('full_page',    1);
    $smarty->display('service_repair.htm');
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

    make_json_result($smarty->fetch('service_repair.htm'), '', array('filter' => $msg_list['filter'], 'page_count' => $msg_list['page_count']));
}
/*------------------------------------------------------ */
//-- ajax 删除申请
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'remove')
{
    $msg_id = intval($_REQUEST['id']);

    /* 检查权限 */
    check_authz_json('service_repair');

    $msg_title = $exc->get_name($msg_id);
    if ($exc->drop($msg_id))
    {
        $sql = "DELETE FROM " . $ecs->table('service_repair') . " WHERE msg_id = '$msg_id' LIMIT 1";
        $db->query($sql, 'SILENT');

        $url = 'service_repair.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);
        ecs_header("Location: $url\n");
        exit;
    }
    else
    {
        make_json_error($GLOBALS['db']->error());
    }
}
/*------------------------------------------------------ */
//-- 确认维修时间
/*------------------------------------------------------ */
elseif ($_REQUEST['act']=='view')
{
    $smarty->assign('send_fail',   !empty($_REQUEST['send_ok']));
    $smarty->assign('msg',         get_feedback_detail(intval($_REQUEST['id'])));
    $smarty->assign('ur_here',     "确认申请");
    $smarty->assign('action_link', array('text' => '售后申请列表', 'href'=>'service_repair.php?act=list_all'));
    
    assign_query_info();
    $smarty->display('service_repair_info.htm');
}
elseif ($_REQUEST['act']=='action')
{
    
    $start_time=$_POST['start_time']? trim($_POST['start_time']):0;
    $end_time=$_POST['end_time']? trim($_POST['end_time']):0;
    $msg_type=$_POST['msg_type']?trim($_POST['msg_type']):1;
    var_dump($start_time);
    var_dump($end_time);
    if(empty($start_time)||empty($end_time))
    {
        sys_msg("开始时间或结束时间为空!",1);
        exit;
    }
    if($msg_type == 1)
    {
        $reply="已确认维修时间，预计在".date("Y年m月d日")."{$start_time}时——{$end_time}时之间等候维修人员上门维修";
    }elseif($msg_type==2){
        $reply="已确认换货时间，预计在".date("Y年m月d日")."{$start_time}时——{$end_time}时之间等候维修人员上门换货";
    }else{
        $reply="已确认退货时间，预计在".date("Y年m月d日")."{$start_time}时——{$end_time}时之间等候维修人员上门退货";
    }
   
    if(empty($reply)){
        sys_msg("确认维修信息为空!",1);
        exit;
    }
    $sql = "UPDATE ".$ecs->table('service_repair')." SET reply='".$reply."', reply_time = '".gmtime()."',msg_status=2 WHERE msg_id = '".$_REQUEST['msg_id']."'";
    $db->query($sql);

        /* 邮件通知处理流程 */
    if (!empty($_POST['send_email_notice']) or isset($_POST['remail']))
    {
        //获取邮件中的必要内容
        $sql = 'SELECT * ' .
               'FROM ' .$ecs->table('service_repair') .
               " WHERE msg_id ='$_REQUEST[msg_id]'";
        $message_info = $db->getRow($sql);

        /* 设置留言回复模板所需要的内容信息 */
        $template    = get_mail_template('user_message');
        $message_content = $message_info['msg_title'] . "\r\n" . $message_info['msg_content'];

        $smarty->assign('user_name',   $message_info['user_name']);
        $smarty->assign('message_note', $reply);
        $smarty->assign('message_content', $message_content);
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

    ecs_header("Location: ?act=list_all\n");
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
        $where .= " AND f.msg_title LIKE '%" . mysql_like_quote($filter['keywords']) . "%' ";
    }
    

    $sql = "SELECT count(*) FROM " .$GLOBALS['ecs']->table('service_repair'). " AS f" .
           " WHERE 1=1 " . $where;
    $filter['record_count'] = $GLOBALS['db']->getOne($sql);

    /* 分页大小 */
    $filter = page_and_size($filter);

    $sql = "SELECT * " .
            "FROM " . $GLOBALS['ecs']->table('service_repair') . " AS f ,".$GLOBALS['ecs']->table('service_type')."as t ".
            "WHERE 1=1 and f.msg_type = t.id $where " .
            "ORDER by $filter[sort_by] $filter[sort_order] ".
            "LIMIT " . $filter['start'] . ', ' . $filter['page_size'];

    $msg_list = $GLOBALS['db']->getAll($sql);
    foreach ($msg_list AS $key => $value)
    {   
        $msg_list[$key]['msg_time'] = local_date($GLOBALS['_CFG']['time_format'], $value['msg_time']);
        $msg_list[$key]['msg_type'] = $value['service_type'];
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

    $sql = "SELECT t.*, s.cat_name as guz ,st.service_type".
            " FROM ".$ecs->table('service_repair'). ' AS t' .
            " LEFT JOIN ".$ecs->table('service'). ' AS s ON(s.cat_id = t.guzhang)' .
            " LEFT JOIN ".$ecs->table('service_type'). ' AS st ON(st.id = t.msg_type)' .
            "WHERE t.msg_id = '$id'";
    $msg = $db->GetRow($sql);

    if ($msg)
    {
        $sql="SELECT goods_id,goods_name FROM ".$GLOBALS['ecs']->table('goods')."WHERE goods_id in( $msg[goods_id])";
        $res=$GLOBALS['db']->GetAll($sql);
        $msg['msg_time']   = local_date($_CFG['time_format'], $msg['msg_time']);
        $msg['reply_time'] = local_date($_CFG['time_format'], $msg['reply_time']);
        $msg['service_img']=$msg['service_img']?DATA_DIR."/serviceimg/".$msg['service_img']:$msg['service_img'];
        foreach ($res  as $val){
            $msg['good_list'][]=array(
                'goods_id'=>$val['goods_id'],
                'goods_name'=>$val['goods_name'],
            );
        }
    }

    return $msg;
}

?>