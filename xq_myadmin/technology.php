<?php

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');

$type = trim($_REQUEST['type']);

$exc = null;
if ($type == 'gongneng' || $type == 'hangye') {
    $exc = new exchange($ecs->table($type), $db, 'cat_id', 'cat_name');
}

/* act操作项的初始化 */
$_REQUEST['act'] = trim($_REQUEST['act']);
if (empty($_REQUEST['act']))
{
    $_REQUEST['act'] = 'list';
}


/*------------------------------------------------------ */
//-- 分类列表
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list')
{
    $catist = technology_cat_list(0, 0, false, $type);
    $smarty->assign('ur_here',     $_LANG[$type]);
    $smarty->assign('action_link', array('text' => $_LANG[$type . '_add'], 'href' => 'technology.php?type='.$type.'&act=add'));
    $smarty->assign('full_page',   1);
    $smarty->assign('catist',        $catist);
    $smarty->assign('type',        $type);
    assign_query_info();
    $smarty->display('technology_list.htm');
}

/*------------------------------------------------------ */
//-- 查询
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'query')
{
    $catist = technology_cat_list(0, 0, false, $type);
    $smarty->assign('catist',        $catist);
    $smarty->assign('type',        $type);
    make_json_result($smarty->fetch('technology_list.htm'));
}

/*------------------------------------------------------ */
//-- 添加分类
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'add')
{
    /* 权限判断 */
    admin_priv('technology');

    $smarty->assign('ur_here',     $_LANG[$type . '_add']);
    $smarty->assign('action_link', array('text' => $_LANG[$type], 'href' => 'technology.php?type='.$type.'&act=list'));
    $smarty->assign('form_action', 'insert');
    $smarty->assign('type',        $type);
    assign_query_info();
    $smarty->display('technology_cat_info.htm');
}
elseif ($_REQUEST['act'] == 'insert')
{
    /* 权限判断 */
    admin_priv('technology');

    /*检查分类名是否重复*/
    $is_only = $exc->is_only('cat_name', $_POST['cat_name']);

    if (!$is_only)
    {
        sys_msg(sprintf($_LANG['catname_exist'], stripslashes($_POST['cat_name'])), 1);
    }

    $sql = "INSERT INTO ".$ecs->table($type)."(cat_name, cat_desc,keywords, sort_order)
           VALUES ('$_POST[cat_name]', '$_POST[cat_desc]','$_POST[keywords]', '$_POST[sort_order]')";
    $db->query($sql);

    $link[0]['text'] = $_LANG['continue_add'];
    $link[0]['href'] = 'technology.php?type='.$type.'&act=add';

    $link[1]['text'] = $_LANG['back_list'];
    $link[1]['href'] =  'technology.php?type='.$type.'&act=list';
    clear_cache_files();
    sys_msg($_POST['cat_name'].$_LANG['catadd_succed'],0, $link);
}

/*------------------------------------------------------ */
//-- 编辑分类
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit')
{
    /* 权限判断 */
    admin_priv('technology');

    $sql = "SELECT * FROM ".
           $ecs->table($type). " WHERE cat_id='$_REQUEST[id]'";
    $cat = $db->GetRow($sql);

    $smarty->assign('cat',         $cat);
    $smarty->assign('ur_here',     $_LANG[$type . '_add']);
    $smarty->assign('action_link', array('text' => $_LANG[$type], 'href' => 'technology.php?type='.$type.'&act=list'));
    $smarty->assign('form_action', 'update');

    assign_query_info();
    $smarty->display('technology_cat_info.htm');
}
elseif ($_REQUEST['act'] == 'update')
{
    /* 权限判断 */
    admin_priv('technology');

    /*检查重名*/
    if ($_POST['cat_name'] != $_POST['old_catname'])
    {
        $is_only = $exc->is_only('cat_name', $_POST['cat_name'], $_POST['id']);

        if (!$is_only)
        {
            sys_msg(sprintf($_LANG['catname_exist'], stripslashes($_POST['cat_name'])), 1);
        }
    }



    $dat = $db->getOne("SELECT cat_name FROM ". $ecs->table('video_cat') . " WHERE cat_id = '" . $_POST['id'] . "'");
    if ($exc->edit("cat_name = '$_POST[cat_name]', cat_desc ='$_POST[cat_desc]', keywords='$_POST[keywords]',sort_order='$_POST[sort_order]'",  $_POST['id']))
    {
        $link[0]['text'] = $_LANG['back_list'];
        $link[0]['href'] = 'technology.php?type='.$type.'&act=list';
        $note = sprintf($_LANG['catedit_succed'], $_POST['cat_name']);
        clear_cache_files();
        sys_msg($note, 0, $link);
    } else {
        die($db->error());
    }
}



/*------------------------------------------------------ */
//-- 编辑分类的排序
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit_sort_order')
{
    check_authz_json('technology');

    $id    = intval($_POST['id']);
    $order = json_str_iconv(trim($_POST['val']));

    /* 检查输入的值是否合法 */
    if (!preg_match("/^[0-9]+$/", $order))
    {
        make_json_error(sprintf($_LANG['enter_int'], $order));
    }
    else
    {
        if ($exc->edit("sort_order = '$order'", $id))
        {
            clear_cache_files();
            make_json_result(stripslashes($order));
        }
        else
        {
            make_json_error($db->error());
        }
    }
}

/*------------------------------------------------------ */
//-- 删除分类
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'remove')
{
    check_authz_json('technology');

    $id = intval($_GET['id']);

    $exc->drop($id);
    clear_cache_files();

    $url = 'technology.php?type='.$type.'&act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);

    ecs_header("Location: $url\n");
    exit;
}



/**
 * 获得分类列表
 *
 * @access  public
 * @param   int     $cat_id     分类的ID
 * @param   int     $selected   当前选中分类的ID
 * @param   boolean $re_type    返回的类型: 值为真时返回下拉列表,否则返回数组
 * @param   string  $type       查询不同的数据表
 * @return  mix
 */
function technology_cat_list($cat_id = 0, $selected = 0, $re_type = true, $type)
{
    static $res = NULL;

    if ($res === NULL)
    {
        $data = read_static_cache('technology_cat_pid_releate_'.$type);
        if ($data === false)
        {
            $sql = "SELECT * ".
               ' FROM ' . $GLOBALS['ecs']->table($type) .
               " ORDER BY sort_order ASC";
            $res = $GLOBALS['db']->getAll($sql);
            write_static_cache('technology_cat_pid_releate_'.$type, $res);
        }
        else
        {
            $res = $data;
        }
    }

    if (empty($res) == true)
    {
        return $re_type ? '' : array();
    }

    


    if ($re_type == true)
    {
        $select = '';
        foreach ($res AS $var)
        {
            $select .= '<option value="' . $var['cat_id'] . '" ';
            $select .= ($selected == $var['cat_id']) ? "selected='ture'" : '';
            $select .= '>';
            $select .= htmlspecialchars(addslashes($var['cat_name'])) . '</option>';
        }

        return $select;
    }
    else
    {
        return $res;
    }
}

?>
