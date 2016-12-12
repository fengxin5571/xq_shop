<?php


define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');

$exc = new exchange($ecs->table("user_rank"), $db, 'rank_id', 'rank_name');
$exc_user = new exchange($ecs->table("users"), $db, 'user_rank', 'user_rank');

/*------------------------------------------------------ */
//-- 会员等级列表
/*------------------------------------------------------ */

if ($_REQUEST['act'] == 'list')
{
    $ranks = array();
    $ranks = $db->getAll("SELECT * FROM " .$ecs->table('user_rank') . 
                        " AS a LEFT JOIN " . $ecs->table('user_type') . " AS b ON (a.type_id = b.type_id) ");

    $smarty->assign('ur_here',      $_LANG['05_user_rank_list']);
    $smarty->assign('action_link',  array('text' => $_LANG['add_user_rank'], 'href'=>'user_rank.php?act=add'));
    $smarty->assign('full_page',    1);

    $smarty->assign('user_ranks',   $ranks);

    assign_query_info();
    $smarty->display('user_rank.htm');
}

/*------------------------------------------------------ */
//-- 翻页，排序
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'query')
{
    $ranks = array();
    $ranks = $db->getAll("SELECT * FROM " .$ecs->table('user_rank') . 
                        " AS a LEFT JOIN " . $ecs->table('user_type') . " AS b ON (a.type_id = b.type_id) ");

    $smarty->assign('user_ranks',   $ranks);
    make_json_result($smarty->fetch('user_rank.htm'));
}

/*------------------------------------------------------ */
//-- 添加会员等级
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'add')
{
    admin_priv('user_rank');

    $rank['rank_id']      = 0;
    $rank['show_price']   = 1;
    $rank['discount']     = 100;

    $form_action          = 'insert';

    $smarty->assign('user_type',   getUserType());

    $smarty->assign('rank',        $rank);
    $smarty->assign('ur_here',     $_LANG['add_user_rank']);
    $smarty->assign('action_link', array('text' => $_LANG['05_user_rank_list'], 'href'=>'user_rank.php?act=list'));
    $smarty->assign('ur_here',     $_LANG['add_user_rank']);
    $smarty->assign('form_action', $form_action);

    assign_query_info();
    $smarty->display('user_rank_info.htm');
}

/*------------------------------------------------------ */
//-- 增加会员等级到数据库
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'insert')
{
    admin_priv('user_rank');

    $special_rank =  1;

    if (empty($_POST['type_id'])) {
        sys_msg('请选择会员类型', 1);
    }

    if (empty($_POST['rank_name'])) {
        sys_msg('请填写会员等级名称', 1);
    }

    if (empty($_POST['price'])) {
        sys_msg('请填写会员升级价格', 1);
    }

    /* 检查是否存在重名的会员等级 */
/*    if (!$exc->is_only('rank_name', trim($_POST['rank_name'])))
    {
        sys_msg(sprintf($_LANG['rank_name_exists'], trim($_POST['rank_name'])), 1);
    }*/


    $sql = "INSERT INTO " .$ecs->table('user_rank') ."( ".
                "rank_name, min_points, max_points, discount, special_rank, show_price, price, type_id".
            ") VALUES (".
                "'$_POST[rank_name]', 0, 0, ".
                "'$_POST[discount]', '$special_rank', 1, '$_POST[price]', '$_POST[type_id]')";
    $db->query($sql);

    /* 管理员日志 */
    admin_log(trim($_POST['rank_name']), 'add', 'user_rank');
    clear_cache_files();

    $lnk[] = array('text' => $_LANG['back_list'],    'href'=>'user_rank.php?act=list');
    $lnk[] = array('text' => $_LANG['add_continue'], 'href'=>'user_rank.php?act=add');
    sys_msg($_LANG['add_rank_success'], 0, $lnk);
}

/*------------------------------------------------------ */
//-- 编辑
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit')
{
    /* 权限判断 */
    admin_priv('user_rank');

    /* 取文章数据 */
    $sql = "SELECT * FROM " .$ecs->table('user_rank'). " WHERE rank_id='$_REQUEST[id]'";
    $rank = $db->GetRow($sql);

    $smarty->assign('user_type',   getUserType());

    $smarty->assign('rank',        $rank);
    $smarty->assign('ur_here',     $_LANG['add_user_rank']);
    $smarty->assign('action_link', array('text' => $_LANG['05_user_rank_list'], 'href'=>'user_rank.php?act=list'));
    $smarty->assign('ur_here',     $_LANG['edit_user_rank']);
    $smarty->assign('form_action', 'update');

    assign_query_info();
    $smarty->display('user_rank_info.htm');
}


elseif ($_REQUEST['act'] == 'update')
{
    admin_priv('user_rank');

    if (empty($_POST['type_id'])) {
        sys_msg('请选择会员类型', 1);
    }

    if (empty($_POST['rank_name'])) {
        sys_msg('请填写会员等级名称', 1);
    }

    if (empty($_POST['price'])) {
        sys_msg('请填写会员升级价格', 1);
    }

    $exc->edit("rank_name='$_POST[rank_name]', type_id='$_POST[type_id]', discount='$_POST[discount]', price='$_POST[price]'", $_POST[id]);

    /* 管理员日志 */
    admin_log(trim($_POST['rank_name']), 'edit', 'user_rank');
    clear_cache_files();

    $lnk[] = array('text' => $_LANG['back_list'],    'href'=>'user_rank.php?act=list');
    sys_msg($_LANG['edit_rank_success'], 0, $lnk);
}

/*------------------------------------------------------ */
//-- 删除会员等级
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'remove')
{
    check_authz_json('user_rank');

    $rank_id = intval($_GET['id']);

    if ($exc->drop($rank_id))
    {
        /* 更新会员表的等级字段 */
        $exc_user->edit("user_rank = 0", $rank_id);

        $rank_name = $exc->get_name($rank_id);
        admin_log(addslashes($rank_name), 'remove', 'user_rank');
        clear_cache_files();
    }

    $url = 'user_rank.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);

    ecs_header("Location: $url\n");
    exit;

}
/*
 *  编辑会员等级名称
 */
elseif ($_REQUEST['act'] == 'edit_name')
{
    $id = intval($_REQUEST['id']);
    $val = empty($_REQUEST['val']) ? '' : json_str_iconv(trim($_REQUEST['val']));
    check_authz_json('user_rank');
    if ($exc->is_only('rank_name', $val, $id))
    {
        if ($exc->edit("rank_name = '$val'", $id))
        {
            /* 管理员日志 */
            admin_log($val, 'edit', 'user_rank');
            clear_cache_files();
            make_json_result(stripcslashes($val));
        }
        else
        {
            make_json_error($db->error());
        }
    }
    else
    {
        make_json_error(sprintf($_LANG['rank_name_exists'], htmlspecialchars($val)));
    }
}

/*
 *  ajax编辑积分下限
 */
elseif ($_REQUEST['act'] == 'edit_min_points')
{
    check_authz_json('user_rank');

    $rank_id = empty($_REQUEST['id']) ? 0 : intval($_REQUEST['id']);
    $val = empty($_REQUEST['val']) ? 0 : intval($_REQUEST['val']);

    $rank = $db->getRow("SELECT max_points, special_rank FROM " . $ecs->table('user_rank') . " WHERE rank_id = '$rank_id'");
    if ($val >= $rank['max_points'] && $rank['special_rank'] == 0)
    {
        make_json_error($_LANG['js_languages']['integral_max_small']);
    }

    if ($rank['special_rank'] ==0 && !$exc->is_only('min_points', $val, $rank_id))
    {
        make_json_error(sprintf($_LANG['integral_min_exists'], $val));
    }

    if ($exc->edit("min_points = '$val'", $rank_id))
    {
        $rank_name = $exc->get_name($rank_id);
        admin_log(addslashes($rank_name), 'edit', 'user_rank');
        make_json_result($val);
    }
    else
    {
        make_json_error($db->error());
    }
}

/*
 *  ajax修改积分上限
 */
elseif ($_REQUEST['act'] == 'edit_max_points')
{
     check_authz_json('user_rank');

    $rank_id = empty($_REQUEST['id']) ? 0 : intval($_REQUEST['id']);
    $val = empty($_REQUEST['val']) ? 0 : intval($_REQUEST['val']);

    $rank = $db->getRow("SELECT min_points, special_rank FROM " . $ecs->table('user_rank') . " WHERE rank_id = '$rank_id'");

    if ($val <= $rank['min_points'] && $rank['special_rank'] == 0)
    {
        make_json_error($_LANG['js_languages']['integral_max_small']);
    }

    if ($rank['special_rank'] ==0 && !$exc->is_only('max_points', $val, $rank_id))
    {
        make_json_error(sprintf($_LANG['integral_max_exists'], $val));
    }
    if ($exc->edit("max_points = '$val'", $rank_id))
    {
        $rank_name = $exc->get_name($rank_id);
        admin_log(addslashes($rank_name), 'edit', 'user_rank');
        make_json_result($val);
    }
    else
    {
        make_json_error($db->error());
    }
}

/*
 *  修改折扣率
 */
elseif ($_REQUEST['act'] == 'edit_discount')
{
    check_authz_json('user_rank');

    $rank_id = empty($_REQUEST['id']) ? 0 : intval($_REQUEST['id']);
    $val = empty($_REQUEST['val']) ? 0 : intval($_REQUEST['val']);

    if ($val < 1 || $val > 100)
    {
        make_json_error($_LANG['js_languages']['discount_invalid']);
    }

    if ($exc->edit("discount = '$val'", $rank_id))
    {
        $rank_name = $exc->get_name($rank_id);
         admin_log(addslashes($rank_name), 'edit', 'user_rank');
         clear_cache_files();
         make_json_result($val);
    }
    else
    {
        make_json_error($val);
    }
}


/*
 *  修改升级费用
 */
elseif ($_REQUEST['act'] == 'edit_price')
{
    check_authz_json('user_rank');

    $rank_id = empty($_REQUEST['id']) ? 0 : intval($_REQUEST['id']);
    $val = empty($_REQUEST['val']) ? 0 : intval($_REQUEST['val']);

    if ($val < 0)
    {
        make_json_error('升级价格不能为负数');
    }

    if ($exc->edit("price = '$val'", $rank_id))
    {
        $rank_name = $exc->get_name($rank_id);
         admin_log(addslashes($rank_name), 'edit', 'user_rank');
         clear_cache_files();
         make_json_result($val);
    }
    else
    {
        make_json_error($val);
    }
}



/*------------------------------------------------------ */
//-- 切换是否是特殊会员组
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'toggle_special')
{
    check_authz_json('user_rank');

    $rank_id       = intval($_POST['id']);
    $is_special    = intval($_POST['val']);

    if ($exc->edit("special_rank = '$is_special'", $rank_id))
    {
        $rank_name = $exc->get_name($rank_id);
        admin_log(addslashes($rank_name), 'edit', 'user_rank');
        make_json_result($is_special);
    }
    else
    {
        make_json_error($db->error());
    }
}
/*------------------------------------------------------ */
//-- 切换是否显示价格
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'toggle_showprice')
{
    check_authz_json('user_rank');

    $rank_id       = intval($_POST['id']);
    $is_show    = intval($_POST['val']);

    if ($exc->edit("show_price = '$is_show'", $rank_id))
    {
        $rank_name = $exc->get_name($rank_id);
        admin_log(addslashes($rank_name), 'edit', 'user_rank');
        clear_cache_files();
        make_json_result($is_show);
    }
    else
    {
        make_json_error($db->error());
    }
}

function getUserType() {
    global $db, $ecs;
    $types = $db->getAll("SELECT * FROM " .$ecs->table('user_type'));
    return $types;
}

?>