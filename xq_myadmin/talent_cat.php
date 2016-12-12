<?php

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');

$exc = new exchange($ecs->table('talent_cat'), $db, 'cat_id', 'cat_name');


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
    $catist = talent_cat_list(0, 0, false);
    $smarty->assign('ur_here',     $_LANG['talent_cat']);
    $smarty->assign('action_link', array('text' => $_LANG['talent_cat_add'], 'href' => 'talent_cat.php?act=add'));
    $smarty->assign('full_page',   1);
    $smarty->assign('catist',        $catist);
    assign_query_info();
    $smarty->display('talent_cat.htm');
}

/*------------------------------------------------------ */
//-- 查询
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'query')
{
    $catist = talent_cat_list(0, 0, false);
    $smarty->assign('catist',        $catist);
    make_json_result($smarty->fetch('talent_cat.htm'));
}

/*------------------------------------------------------ */
//-- 添加分类
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'add')
{
    /* 权限判断 */
    admin_priv('talent_cat');

    $smarty->assign('ur_here',     $_LANG['talent_cat_add']);
    $smarty->assign('action_link', array('text' => $_LANG['talent_cat'], 'href' => 'talent_cat.php?act=list'));
    $smarty->assign('form_action', 'insert');
    assign_query_info();
    $smarty->display('talent_cat_info.htm');
}
elseif ($_REQUEST['act'] == 'insert')
{
    /* 权限判断 */
    admin_priv('talent_cat');

    /*检查分类名是否重复*/
    $is_only = $exc->is_only('cat_name', $_POST['cat_name']);

    if (!$is_only)
    {
        sys_msg(sprintf($_LANG['catname_exist'], stripslashes($_POST['cat_name'])), 1);
    }

    $sql = "INSERT INTO ".$ecs->table('talent_cat')."(cat_name, cat_desc, keywords, sort_order)
           VALUES ('$_POST[cat_name]', '$_POST[cat_desc]','$_POST[keywords]', '$_POST[sort_order]')";
    
    $db->query($sql);

    $link[0]['text'] = $_LANG['continue_add'];
    $link[0]['href'] = 'talent_cat.php?act=add';

    $link[1]['text'] = $_LANG['back_list'];
    $link[1]['href'] =  'talent_cat.php?act=list';
    clear_cache_files();
    sys_msg($_POST['cat_name'].$_LANG['catadd_succed'],0, $link);
}

/*------------------------------------------------------ */
//-- 编辑分类
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit')
{
    /* 权限判断 */
    admin_priv('talent_cat');

    $sql = "SELECT * FROM ".
           $ecs->table('talent_cat'). " WHERE cat_id='$_REQUEST[id]'";
    $cat = $db->GetRow($sql);

    $smarty->assign('cat',         $cat);
    $smarty->assign('ur_here',     $_LANG['talent_cat_add']);
    $smarty->assign('action_link', array('text' => $_LANG['talent_cat'], 'href' => 'talent_cat.php?act=list'));
    $smarty->assign('form_action', 'update');

    assign_query_info();
    $smarty->display('talent_cat_info.htm');
}
elseif ($_REQUEST['act'] == 'update')
{
    /* 权限判断 */
    admin_priv('talent_cat');

    /*检查重名*/
    if ($_POST['cat_name'] != $_POST['old_catname'])
    {
        $is_only = $exc->is_only('cat_name', $_POST['cat_name'], $_POST['id']);

        if (!$is_only)
        {
            sys_msg(sprintf($_LANG['catname_exist'], stripslashes($_POST['cat_name'])), 1);
        }
    }

    if ($exc->edit("cat_name = '$_POST[cat_name]', cat_desc ='$_POST[cat_desc]', keywords='$_POST[keywords]',sort_order='$_POST[sort_order]'",  $_POST['id']))
    {
        $link[0]['text'] = $_LANG['back_list'];
        $link[0]['href'] = 'talent_cat.php?act=list';
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
    check_authz_json('talent_cat');

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
    check_authz_json('talent_cat');

    $id = intval($_GET['id']);

    $exc->drop($id);
    clear_cache_files();

    $url = 'talent_cat.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);

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
 * @return  mix
 */
function talent_cat_list($cat_id = 0, $selected = 0, $re_type = true)
{
    static $res = NULL;

    if ($res === NULL)
    {
        $data = read_static_cache('talent_cat_pid_releate_'.$type);
        if ($data === false)
        {
            $sql = "SELECT * ".
               ' FROM ' . $GLOBALS['ecs']->table('talent_cat') .
               " ORDER BY sort_order ASC";
            $res = $GLOBALS['db']->getAll($sql);
            write_static_cache('talent_cat_pid_releate_'.$type, $res);
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
