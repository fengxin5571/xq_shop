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
//--无理由退换货支付记录列表
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list')
{
    /* 权限判断 */
    admin_priv('noreason_payment');

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
    $smarty->assign('ur_here',       '无理由退换货支付列表');
    $smarty->assign('id',            $user_id);
    $smarty->assign('payment_list',  $payment);

    $list = update_list();
    $smarty->assign('list',         $list['list']);
    $smarty->assign('filter',       $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
    $smarty->assign('full_page',    1);

    assign_query_info();
    $smarty->display('noreason_payment_list.htm');
}
/*------------------------------------------------------ */
//-- 审核无理由退换货支付
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'check')
{
    /* 检查权限 */
    admin_priv('noreason_payment');

    /* 初始化 */
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    /* 如果参数不合法，返回 */
    if ($id == 0)
    {
        ecs_header("Location: noreason_payment.php?act=list\n");
        exit;
    }

    $user_update = array();

    $user_update = $db->getRow("SELECT uu.*, od.order_sn,se.cat_name FROM " .$ecs->table('noreason_payment') . " AS uu
                                LEFT JOIN " .$ecs->table('order_info') . "  AS od ON (od.order_id = uu.order_id) 
                                LEFT JOIN " .$ecs->table('service') . "  AS se ON (se.cat_id = uu.cat_id)
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
    $smarty->assign('action_link',  array('text' => '无理由退换货支付列表',
        'href'=>'noreason_payment.php?act=list&' . list_link_postfix()));

    /* 页面显示 */
    assign_query_info();
    $smarty->display('noreason_payment_check.htm');
}
/*------------------------------------------------------ */
//-- 更新申请无理由退换货申请
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'action')
{
    /* 检查权限 */
    admin_priv('noreason_payment');

    /* 初始化 */
    $id         = isset($_POST['id'])         ? intval($_POST['id'])             : 0;
    $is_paid    = isset($_POST['is_paid'])    ? intval($_POST['is_paid'])        : 0;
    $admin_note = isset($_POST['admin_note']) ? trim($_POST['admin_note'])       : '';

    /* 如果参数不合法，返回 */
    if ($id == 0 || empty($admin_note))
    {
        ecs_header("Location: noreason_payment.php?act=list\n");
        exit;
    }

    $user_update = array();
    $user_update = $db->getRow("SELECT * FROM " .$ecs->table('noreason_payment'). " WHERE id = '$id'");
    $amount  = $user_update['amount'];

    $sql = "UPDATE " .$ecs->table('noreason_payment'). " AS n ,".$ecs->table('service_repair').
        " AS s ".
        "SET n.admin_user    = '$_SESSION[admin_name]', ".
        "n.admin_note    = '$admin_note', ".
        "s.is_payment    ='1',".
        "n.is_paid       = '$is_paid' WHERE n.pay_id=s.pay_id and n.id = '$id'";
    $db->query($sql);

    /* 提示信息 */
    $link[0]['text'] = $_LANG['back_list'];
    $link[0]['href'] = 'noreason_payment.php?act=list&' . list_link_postfix();

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

    make_json_result($smarty->fetch('noreason_payment_list.htm'), '', array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}
/*------------------------------------------------------ */
//-- ajax删除一条信息
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'remove')
{
    /* 检查权限 */
    check_authz_json('noreason_payment');
    $id = @intval($_REQUEST['id']);

    $sql = "DELETE FROM " . $ecs->table('noreason_payment') . " WHERE id = '$id'";
    if ($db->query($sql, 'SILENT'))
    {
        $url = 'noreason_payment.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);
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
            $sql = "SELECT COUNT(*) FROM " .$GLOBALS['ecs']->table('noreason_payment'). " AS ua, ".
                $GLOBALS['ecs']->table('users') . " AS u " . $where;
        }
        /*　时间过滤　*/
        if (!empty($filter['start_date']) && !empty($filter['end_date']))
        {
            $where .= "AND paid_time >= " . $filter['start_date']. " AND paid_time < '" . $filter['end_date'] . "'";
        }

        $sql = "SELECT COUNT(*) FROM " .$GLOBALS['ecs']->table('noreason_payment'). " AS ua, ".
            $GLOBALS['ecs']->table('users') . " AS u " . $where;
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);

        /* 分页大小 */
        $filter = page_and_size($filter);

        /* 查询数据 */
        $sql  = 'SELECT ua.*, u.user_name ,od.order_sn,se.cat_name FROM ' .
            $GLOBALS['ecs']->table('noreason_payment'). ' AS ua LEFT JOIN ' .
            $GLOBALS['ecs']->table('users'). ' AS u ON ua.user_id = u.user_id LEFT JOIN '.
            $GLOBALS['ecs']->table('order_info'). ' AS od ON od.order_id = ua.order_id LEFT JOIN '.
            $GLOBALS['ecs']->table('service'). ' AS se ON ua.cat_id = se.cat_id  '.
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