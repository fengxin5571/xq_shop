<?php

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require_once(ROOT_PATH . 'includes/lib_talent.php');
include_once(ROOT_PATH . 'admin/includes/lib_main.php');
include_once(ROOT_PATH . 'includes/lib_clips.php');

$user_id = $_SESSION['user_id'];
$action  = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'default';
$rank_id  = isset($_REQUEST['rank']) ? intval($_REQUEST['rank']) : 0;
$type_id  = isset($_REQUEST['type']) ? intval($_REQUEST['type']) : 1;

$smarty->assign('action',     $action);

if (empty($user_id)) {
    ecs_header("Location: user.php?action=login\n");
    exit;
}
/* 升级表单 */

if ($action == 'default') {

    $ranks = getUserRank($type_id);

    if (empty($rank_id))
    {
      /*  ecs_header("Location: ./\n");
        exit;*/
        $firstRank = reset($ranks);
        $rank_id = $firstRank['rank_id'];
    }

    $rank = get_rank_detail($rank_id);

    $smarty->assign('rank_id',         $rank_id);
    $smarty->assign('rank',            $rank);
    $smarty->assign('keywords',        htmlspecialchars($_CFG['shop_keywords']));
    $smarty->assign('description',     htmlspecialchars($_CFG['shop_desc']));

    $smarty->assign('user_info', get_user_info());

    assign_template();
    $position = assign_ur_here(0, '会员升级', 0);
    $smarty->assign('page_title', $position['title']); // 页面标题
    $smarty->assign('ur_here',    $position['ur_here']);


    $smarty->assign('ranks',      $ranks);
    $smarty->assign('type_id',    $type_id);
    $smarty->assign('types',      getTypes());

    $smarty->assign('payment', get_online_payment_list(false));

    $smarty->display('user_update.dwt');
    
} elseif ($action == 'update') {
    include_once(ROOT_PATH . 'includes/lib_order.php');

    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
    if ($price <= 0) {
        show_message('升级价格不能小于或等于零');
    }

    if(empty($_POST['type_id'])) {
        show_message('请选择会员类型');
    }

    if(empty($_POST['update_rank_id'])) {
        show_message('请选择会员等级');
    }

    if(empty($_POST['payment_id'])) {
        show_message('请选择支付方式');
    }

    $current_rank = getUserRankInfo($_POST['type_id'], $user_id);

    if ($current_rank) {
        $allranks = getUserRank(1, true);
        if ($current_rank['price'] > $allranks[$_POST['update_rank_id']]['price']) {
            show_message('系统不支持降级操作!');
        }
    }

    /* 变量初始化 */
    $surplus = array(
            'user_id'      => $user_id,
            'process_type' => 0,
            'payment_id'   => isset($_POST['payment_id'])   ? intval($_POST['payment_id'])   : 0,
            'user_note'    => isset($_POST['user_note'])    ? trim($_POST['user_note'])      : '',
            'amount'       => isset($_POST['price'])   ? intval($_POST['price'])   : 0,
            'type_id'       => isset($_POST['type_id'])   ? intval($_POST['type_id'])   : 0,
            'update_rank_id'       => isset($_POST['update_rank_id'])   ? intval($_POST['update_rank_id'])   : 0,
    );

    include_once(ROOT_PATH .'includes/lib_payment.php');

    //获取支付方式名称
    $payment_info = array();
    $payment_info = payment_info($surplus['payment_id']);
    $surplus['payment'] = $payment_info['pay_name'];

    //插入会员账目明细
    $surplus['rec_id'] = insert_user_update($surplus, $price);

    //取得支付信息，生成支付代码
    $payment = unserialize_config($payment_info['pay_config']);

    //生成伪订单号, 不足的时候补0
    $order = array();
    $order['order_sn']       = 'up' . $surplus['rec_id'];
    $order['user_name']      = $_SESSION['user_name'];
    $order['surplus_amount'] = $price;

    //计算支付手续费用
    $payment_info['pay_fee'] = pay_fee($surplus['payment_id'], $order['surplus_amount'], 0);

    //计算此次预付款需要支付的总金额
    $order['order_amount']   = $price + $payment_info['pay_fee'];

    //记录支付log
    $order['log_id'] = $surplus['rec_id'];

    /* 调用相应的支付方式文件 */
    include_once(ROOT_PATH . 'includes/modules/payment/' . $payment_info['pay_code'] . '.php');

    /* 取得在线支付方式的支付按钮 */
    $pay_obj = new $payment_info['pay_code'];
    $payment_info['pay_button'] = $pay_obj->get_code($order, $payment);

    assign_template();
    $position = assign_ur_here(0, '会员升级', 0);
    $smarty->assign('page_title', $position['title']); // 页面标题
    $smarty->assign('ur_here',    $position['ur_here']);
    /* 模板赋值 */
    $smarty->assign('payment', $payment_info);
    $smarty->assign('pay_fee', price_format($payment_info['pay_fee'], false));
    $smarty->assign('amount',  price_format($price, false));
    $smarty->assign('order',   $order);
    $smarty->assign('rank',    get_rank_detail($surplus['update_rank_id']));
    
    $smarty->display('user_update.dwt');

}  elseif ($action == 'changeType') {
    include_once(ROOT_PATH . 'includes/cls_json.php');
    $json = new JSON;

    $filters = $json->decode($_GET['JSON']);
    $arr = getUserRank($filters->type_id);
    $opt[] = array('value' => '',
                 'text'  => '请选择会员等级',
                 'data'  => ''
           );

    foreach ($arr AS $key => $val)
    {
        $opt[] = array('value'  => $val['rank_id'],
                        'text'  => $val['rank_name'],
                        'data'  => $val['price']
                 );
    }

    make_json_result($opt);
}  elseif ($action == 'changeRank') {
    include('includes/cls_json.php');

    $json   = new JSON;
    $res    = array('err_msg' => '', 'result' => '', 'price' => 0);

   

    if ($rank_id == 0)
    {
        $res['err_msg'] = '错误的会员等级';
        $res['err_no']  = 1;
    }
    else
    {   
        $rank = get_rank_detail($rank_id);
        $res['price']  = $rank['price'];
    }

    die($json->encode($res));
}


/**
 * 获得会员等级的详细信息
 *
 * @access  private
 * @param   integer     $rank_id
 * @return  array
 */
function get_rank_detail($rank_id)
{
    $sql = "SELECT * ".
            " FROM " .$GLOBALS['ecs']->table('user_rank').
            " WHERE   rank_id = '$rank_id' ";
    $row = $GLOBALS['db']->getRow($sql);

    return $row;
}


function insert_user_update($surplus, $amount)
{
    $sql = 'INSERT INTO ' .$GLOBALS['ecs']->table('user_update').
           ' (user_id, update_rank_id, admin_user, amount, add_time, paid_time, admin_note, user_note, process_type, payment, is_paid, start_time, end_time)'.
            " VALUES ('$surplus[user_id]', '$surplus[update_rank_id]', '', '$amount', '".gmtime()."', 0, '', '$surplus[user_note]', '$surplus[process_type]', '$surplus[payment]', 0, '".gmtime()."', '".(gmtime()+3600*24*365)."')";
    $GLOBALS['db']->query($sql);

    return $GLOBALS['db']->insert_id();
}


function getTypes() {
    global $db, $ecs;
    $types = $db->getAll("SELECT * FROM " .$ecs->table('user_type'));
    return $types;
}


?>