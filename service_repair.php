<?php
define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
$action  = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'default';
$type  = isset($_REQUEST['type']) ? trim($_REQUEST['type']) : 'once';
 
if ($action == 'default') {
	assign_template('a', array($cat_id));
	$position = assign_ur_here($cat_id, '', 2);
	$smarty->assign('page_title',           $position['title']);     // 页面标题
	$smarty->assign('ur_here',              $position['ur_here']);   // 当前位置

	$smarty->assign('keywords',        htmlspecialchars($_CFG['shop_keywords']));
	$smarty->assign('description',     htmlspecialchars($_CFG['shop_desc']));



	$user_info   = get_user_info($_SESSION['user_id']);

	$smarty->assign('user_info',           $user_info);  

	$smarty->assign('guzhang',              get_cats());
    $smarty->assign('goods_cat_list',       cat_list());
    $smarty->assign('cat',         article_cat_list(14, 0, false, 0));
    $type_name = ($type == 'once' ? '单次维修' : '会员维修');
    $msg_type = ($type == 'once' ? 1 : 2);

    if ($msg_type == 2) {
        if (!$_SESSION['user_id']) {
            show_message('您还没有登录，请先登录！', '立即登录', 'user.php?act=login','info');
        } else {
            $current_rank = getUserRankInfo(3, $_SESSION['user_id']);
            if (empty($current_rank)) {
                show_message('您还没有此模块权限，请先升级', '立即升级', 'user_update.php?type=3', 'info');
            }
            if (time() > $current_rank['end_time']) {
                show_message('您的会员权限已经过期，请先续费！', '会员续费', 'user_update.php?type=3', 'info');
            }
            $smarty->assign('current_rank',            $current_rank);
        }
    }

    $smarty->assign('type_name',            $type_name);
    $smarty->assign('msg_type',            $msg_type);

	$smarty->display('service_repair.dwt');

} elseif ($action == 'add_msg') {
    $message = array(
        'user_id'     => $_SESSION['user_id'],
        'guzhang'     => $_POST['guzhang'],
        'goods_id'    => $_POST['goods_id'],
        'user_name'   => $_POST['user_name'],
        'user_email'  => $_POST['user_email'],
        'user_phone'  => $_POST['user_phone'],
        'msg_title'   => $_POST['msg_title'],
        'msg_type'    => isset($_POST['msg_type']) ? intval($_POST['msg_type'])     : 1,
        'user_company'=> isset($_POST['user_company']) ? trim($_POST['user_company'])     : '',
        'msg_content' => isset($_POST['msg_content']) ? trim($_POST['msg_content']) : ''
     );

    if (add_message($message))
    {
        show_message('维修申请提交成功, 我们会尽快处理！', '继续提交', 'service_repair.php','info');
    }
    else
    {
        $err->show($_LANG['message_list_lnk'], 'service_repair.php');
    }
} elseif ($action == 'get_goods_list') {
    include_once(ROOT_PATH . 'includes/cls_json.php');
    include_once(ROOT_PATH . 'admin/includes/lib_main.php');
    $json = new JSON;

    $filters = $json->decode($_GET['JSON']);
    $arr = get_goods_list($filters);
    $opt = array();

    foreach ($arr AS $key => $val)
    {
        $opt[] = array('value'  => $val['goods_id'],
                        'text'  => $val['goods_name'],
                        'data'  => $val['shop_price']);
    }

    make_json_result($opt);
}


function get_cats()
{
    $sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('service') . ' WHERE cat_type = 1 ORDER BY sort_order ASC';
    $res = $GLOBALS['db']->getAll($sql);

    return $res;
}


function add_message($message) {

    $status = 1 - $GLOBALS['_CFG']['message_check'];

    $sql = "INSERT INTO " . $GLOBALS['ecs']->table('service_repair') .
            " (msg_id, user_id, guzhang, goods_id, user_name, user_email, user_phone, user_company, msg_title, msg_type, msg_status,  msg_content, msg_time)".
            " VALUES (NULL, '$message[user_id]', '$message[guzhang]', '$message[goods_id]', '$message[user_name]', '$message[user_email]', ".
            " '$message[user_phone]',  '$message[user_company]', '$message[msg_title]', '$message[msg_type]', '$status', '$message[msg_content]', '".gmtime()."')";
    $GLOBALS['db']->query($sql);

    return true;
}

?>