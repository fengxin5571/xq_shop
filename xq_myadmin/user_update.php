<?php


define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');

/* act操作项的初始化 */
if (empty($_REQUEST['act']))
{
    $_REQUEST['act'] = 'list';
}
else
{
    $_REQUEST['act'] = trim($_REQUEST['act']);
}

/*------------------------------------------------------ */
//-- 会员余额记录列表
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list')
{
    /* 权限判断 */
    admin_priv('user_update');

    /* 指定会员的ID为查询条件 */
    $user_id = !empty($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

    /* 获得支付方式列表 */
    $payment = array();
    $sql = "SELECT pay_id, pay_name FROM ".$ecs->table('payment').
           " WHERE enabled = 1 AND pay_code != 'cod' ORDER BY pay_id";
    $res = $db->query($sql);

    while ($row = $db->fetchRow($res))
    {
        $payment[$row['pay_name']] = $row['pay_name'];
    }


    if (isset($_REQUEST['is_paid']))
    {
        $smarty->assign('is_paid_' . intval($_REQUEST['is_paid']), 'selected="selected"');
    }
    $smarty->assign('ur_here',       '会员升级申请');
    $smarty->assign('id',            $user_id);
    $smarty->assign('payment_list',  $payment);

    $list = update_list();
    $smarty->assign('list',         $list['list']);
    $smarty->assign('filter',       $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
    $smarty->assign('full_page',    1);

    assign_query_info();
    $smarty->display('user_update_list.htm');
}

/*------------------------------------------------------ */
//-- 编辑会员升级
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit')
{
    admin_priv('user_update'); //权限判断

    $ur_here  = '会员升级申请编辑';
    $form_act = 'update';
    $id       = isset($_GET['id']) ? intval($_GET['id']) : 0;

    /* 获得支付方式列表, 不包括“货到付款” */
    $user_update = array();
    $payment = array();
    $sql = "SELECT pay_id, pay_name FROM ".$ecs->table('payment').
           " WHERE enabled = 1 AND pay_code != 'cod' ORDER BY pay_id";
    $res = $db->query($sql);

    while ($row = $db->fetchRow($res))
    {
        $payment[$row['pay_name']] = $row['pay_name'];
    }


    $user_update = $db->getRow("SELECT uu.*, ur.rank_name FROM " .$ecs->table('user_update') . " AS uu 
                                LEFT JOIN " .$ecs->table('user_rank') . "  AS ur ON (ur.rank_id = uu.update_rank_id) 
                                WHERE uu.id = '$id'");

    /* 取得会员名称 */
    $sql = "SELECT user_name FROM " .$ecs->table('users'). " WHERE user_id = '$user_update[user_id]'";
    $user_name = $db->getOne($sql);


    /* 模板赋值 */
    $smarty->assign('ur_here',          $ur_here);
    $smarty->assign('form_act',         $form_act);
    $smarty->assign('payment_list',     $payment);
    $smarty->assign('action',           $_REQUEST['act']);
    $smarty->assign('user_surplus',     $user_update);
    $smarty->assign('user_name',        $user_name);

    $href = 'user_update.php?act=list&' . list_link_postfix();
    $smarty->assign('action_link', array('href' => $href, 'text' => '会员升级申请列表'));

    assign_query_info();
    $smarty->display('user_update_info.htm');
}

/*------------------------------------------------------ */
//-- 编辑会员升级的处理部分
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'update')
{
    /* 权限判断 */
    admin_priv('user_update');

    /* 初始化变量 */
    $id           = isset($_POST['id'])            ? intval($_POST['id'])             : 0;
    $is_paid      = !empty($_POST['is_paid'])      ? intval($_POST['is_paid'])        : 0;
    $amount       = !empty($_POST['amount'])       ? floatval($_POST['amount'])       : 0;
    $user_name    = !empty($_POST['user_id'])      ? trim($_POST['user_id'])          : '';
    $admin_note   = !empty($_POST['admin_note'])   ? trim($_POST['admin_note'])       : '';
    $user_note    = !empty($_POST['user_note'])    ? trim($_POST['user_note'])        : '';
    $payment      = !empty($_POST['payment'])      ? trim($_POST['payment'])          : '';

    $user_id = $db->getOne("SELECT user_id FROM " .$ecs->table('users'). " WHERE user_name = '$user_name'");

    /* 此会员是否存在 */
    if ($user_id == 0)
    {
        $link[] = array('text' => $_LANG['go_back'], 'href'=>'javascript:history.back(-1)');
        sys_msg('会员不存在', 0, $link);
    }


    /* 更新数据表 */
    $sql = "UPDATE " .$ecs->table('user_update'). " SET ".
           "admin_note   = '$admin_note', ".
           "user_note    = '$user_note', ".
           "payment      = '$payment' ".
          "WHERE id      = '$id'";
    $db->query($sql);

    $href = 'user_update.php?act=list&' . list_link_postfix();

    $link[0]['text'] = $_LANG['back_list'];
    $link[0]['href'] = $href;

    sys_msg('修改成功', 0, $link);
}

/*------------------------------------------------------ */
//-- 审核会员升级申请页面
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'check')
{
    /* 检查权限 */
    admin_priv('user_update');

    /* 初始化 */
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    /* 如果参数不合法，返回 */
    if ($id == 0)
    {
        ecs_header("Location: user_update.php?act=list\n");
        exit;
    }

    $user_update = array();

    $user_update = $db->getRow("SELECT uu.*, ur.rank_name FROM " .$ecs->table('user_update') . " AS uu 
                                LEFT JOIN " .$ecs->table('user_rank') . "  AS ur ON (ur.rank_id = uu.update_rank_id) 
                                WHERE uu.id = '$id'");
    $user_update['add_time'] = local_date($_CFG['time_format'], $user_update['add_time']);

    $user_update['start_time'] = local_date($_CFG['time_format'], $user_update['start_time']);
    $user_update['end_time'] = local_date($_CFG['time_format'], $user_update['end_time']);


    $sql = "SELECT user_name FROM " .$ecs->table('users'). " WHERE user_id = '$user_update[user_id]'";
    $user_name = $db->getOne($sql);

    /* 模板赋值 */
    $smarty->assign('ur_here',      $_LANG['check']);
    $account['user_note'] = htmlspecialchars($user_update['user_note']);
    $smarty->assign('surplus',      $user_update);
    $smarty->assign('user_name',    $user_name);
    $smarty->assign('id',           $id);
    $smarty->assign('action_link',  array('text' => '会员升级申请列表',
    'href'=>'user_update.php?act=list&' . list_link_postfix()));

    /* 页面显示 */
    assign_query_info();
    $smarty->display('user_update_check.htm');
}

/*------------------------------------------------------ */
//-- 更新会员升级申请
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'action')
{
    /* 检查权限 */
    admin_priv('user_update');

    /* 初始化 */
    $id         = isset($_POST['id'])         ? intval($_POST['id'])             : 0;
    $is_paid    = isset($_POST['is_paid'])    ? intval($_POST['is_paid'])        : 0;
    $admin_note = isset($_POST['admin_note']) ? trim($_POST['admin_note'])       : '';

    /* 如果参数不合法，返回 */
    if ($id == 0 || empty($admin_note))
    {
        ecs_header("Location: user_update.php?act=list\n");
        exit;
    }

    $user_update = array();
    $user_update = $db->getRow("SELECT * FROM " .$ecs->table('user_update'). " WHERE id = '$id'");
    $amount  = $user_update['amount'];

    $sql = "UPDATE " .$ecs->table('user_update'). " SET ".
               "admin_user    = '$_SESSION[admin_name]', ".
               "admin_note    = '$admin_note', ".
               "is_paid       = '$is_paid' WHERE id = '$id'";
    $db->query($sql);

    $user_rank = 0;
    if ($is_paid == '1' ){
        $user_rank = $user_update['update_rank_id'];
    }

    $sql = "UPDATE " .$ecs->table('users'). " SET ".
               " user_rank    = '$user_rank' ".
               " WHERE user_id = '$user_update[user_id]'";
    $db->query($sql);

    /* 提示信息 */
    $link[0]['text'] = $_LANG['back_list'];
    $link[0]['href'] = 'user_update.php?act=list&' . list_link_postfix();

    sys_msg($_LANG['attradd_succed'], 0, $link);
}

/*------------------------------------------------------ */
//-- ajax帐户信息列表
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'query')
{
    $list =  update_list();
    $smarty->assign('list',         $list['list']);
    $smarty->assign('filter',       $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);

    $sort_flag  = sort_flag($list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    make_json_result($smarty->fetch('user_update_list.htm'), '', array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}
/*------------------------------------------------------ */
//-- ajax删除一条信息
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'remove')
{
    /* 检查权限 */
    check_authz_json('user_update');
    $id = @intval($_REQUEST['id']);
    
    $sql = "DELETE FROM " . $ecs->table('user_update') . " WHERE id = '$id'";
    if ($db->query($sql, 'SILENT'))
    {
       $url = 'user_update.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);
       ecs_header("Location: $url\n");
       exit;
    }
    else
    {
        make_json_error($db->error());
    }
}


/**
 *
 *
 * @access  public
 * @param
 *
 * @return void
 */
function update_list()
{
    $result = get_filter();
    if ($result === false)
    {
        /* 过滤列表 */
        $filter['user_id'] = !empty($_REQUEST['user_id']) ? intval($_REQUEST['user_id']) : 0;
        $filter['keywords'] = empty($_REQUEST['keywords']) ? '' : trim($_REQUEST['keywords']);
        if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
        {
            $filter['keywords'] = json_str_iconv($filter['keywords']);
        }

        $filter['payment'] = empty($_REQUEST['payment']) ? '' : trim($_REQUEST['payment']);
        $filter['is_paid'] = isset($_REQUEST['is_paid']) ? intval($_REQUEST['is_paid']) : -1;
        $filter['sort_by'] = empty($_REQUEST['sort_by']) ? 'add_time' : trim($_REQUEST['sort_by']);
        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);
        $filter['start_date'] = empty($_REQUEST['start_date']) ? '' : local_strtotime($_REQUEST['start_date']);
        $filter['end_date'] = empty($_REQUEST['end_date']) ? '' : (local_strtotime($_REQUEST['end_date']) + 86400);

        $where = " WHERE 1 ";
        if ($filter['user_id'] > 0)
        {
            $where .= " AND ua.user_id = '$filter[user_id]' ";
        }


        if ($filter['payment'])
        {
            $where .= " AND ua.payment = '$filter[payment]' ";
        }
        if ($filter['is_paid'] != -1)
        {
            $where .= " AND ua.is_paid = '$filter[is_paid]' ";
        }

        if ($filter['keywords'])
        {
            $where .= " AND u.user_name LIKE '%" . mysql_like_quote($filter['keywords']) . "%'";
            $sql = "SELECT COUNT(*) FROM " .$GLOBALS['ecs']->table('user_update'). " AS ua, ".
                   $GLOBALS['ecs']->table('users') . " AS u " . $where;
        }
        /*　时间过滤　*/
        if (!empty($filter['start_date']) && !empty($filter['end_date']))
        {
            $where .= "AND paid_time >= " . $filter['start_date']. " AND paid_time < '" . $filter['end_date'] . "'";
        }

        $sql = "SELECT COUNT(*) FROM " .$GLOBALS['ecs']->table('user_update'). " AS ua, ".
                   $GLOBALS['ecs']->table('users') . " AS u " . $where;
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);

        /* 分页大小 */
        $filter = page_and_size($filter);

        /* 查询数据 */
        $sql  = 'SELECT ua.*, u.user_name, ur.rank_name FROM ' .
            $GLOBALS['ecs']->table('user_update'). ' AS ua LEFT JOIN ' .
            $GLOBALS['ecs']->table('users'). ' AS u ON ua.user_id = u.user_id LEFT JOIN '.
            $GLOBALS['ecs']->table('user_rank'). ' AS ur ON ur.rank_id = ua.update_rank_id  '.
            $where . "ORDER by " . $filter['sort_by'] . " " .$filter['sort_order']. " LIMIT ".$filter['start'].", ".$filter['page_size'];

        $filter['keywords'] = stripslashes($filter['keywords']);
        set_filter($filter, $sql);
    }
    else
    {
        $sql    = $result['sql'];
        $filter = $result['filter'];
    }

    $list = $GLOBALS['db']->getAll($sql);
    foreach ($list AS $key => $value)
    {
        $list[$key]['surplus_amount']       = price_format(abs($value['amount']), false);
        $list[$key]['add_date']             = local_date($GLOBALS['_CFG']['time_format'], $value['add_time']);
     }
    $arr = array('list' => $list, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);

    return $arr;
}

?>