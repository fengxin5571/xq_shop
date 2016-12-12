<?php

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require_once(ROOT_PATH . 'includes/cls_image.php');
$exc = new exchange($ecs->table("video_cat"), $db, 'cat_id', 'cat_name');

$allow_img_types = '|jpg|png|gif|';
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
    $videocat = video_cat_list(0, 0, false);
    $smarty->assign('ur_here',     $_LANG['video_cat']);
    $smarty->assign('action_link', array('text' => $_LANG['video_cat_add'], 'href' => 'video_cat.php?act=add'));
    $smarty->assign('full_page',   1);
    $smarty->assign('videocat',        $videocat);

    assign_query_info();
    $smarty->display('video_cat_list.htm');
}

/*------------------------------------------------------ */
//-- 查询
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'query')
{
    $videocat = video_cat_list(0, 0, false);
    $smarty->assign('videocat', $videocat);
    make_json_result($smarty->fetch('video_cat_list.htm'));
}

/*------------------------------------------------------ */
//-- 添加分类
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'add')
{
    /* 权限判断 */
    admin_priv('video_cat');

    $smarty->assign('cat_select',  video_cat_list(0));
    $smarty->assign('ur_here',     $_LANG['video_cat_add']);
    $smarty->assign('action_link', array('text' => $_LANG['video_cat'], 'href' => 'video_cat.php?act=list'));
    $smarty->assign('form_action', 'insert');

    assign_query_info();
    $smarty->display('video_cat_info.htm');
}
elseif ($_REQUEST['act'] == 'insert')
{
    /* 权限判断 */
    admin_priv('video_cat');

    /*检查分类名是否重复*/
    $is_only = $exc->is_only('cat_name', $_POST['cat_name']);

    if (!$is_only)
    {
        sys_msg(sprintf($_LANG['catname_exist'], stripslashes($_POST['cat_name'])), 1);
    }

    /* 取得图片地址 */
    $cat_img = '';
    if ((isset($_FILES['cat_img']['error']) && $_FILES['cat_img']['error'] == 0) || (!isset($_FILES['cat_img']['error']) && isset($_FILES['cat_img']['tmp_name']) && $_FILES['cat_img']['tmp_name'] != 'none'))
    {
        // 检查文件格式
        if (!check_file_type($_FILES['cat_img']['tmp_name'], $_FILES['cat_img']['name'], $allow_img_types))
        {
            sys_msg($_LANG['invalid_file']);
        }

        // 复制文件
        $res = upload_cat_file($_FILES['cat_img']);
        if ($res != false)
        {
            $cat_img = $res;
        }
    }


    $sql = "INSERT INTO ".$ecs->table('video_cat')."(cat_name, cat_desc,keywords, parent_id, sort_order, cat_img)
           VALUES ('$_POST[cat_name]', '$_POST[cat_desc]','$_POST[keywords]', '$_POST[parent_id]', '$_POST[sort_order]', '$cat_img')";
    $db->query($sql);


    admin_log($_POST['cat_name'],'add','video_cat');

    $link[0]['text'] = $_LANG['continue_add'];
    $link[0]['href'] = 'video_cat.php?act=add';

    $link[1]['text'] = $_LANG['back_list'];
    $link[1]['href'] = 'video_cat.php?act=list';
    clear_cache_files();
    sys_msg($_POST['cat_name'].$_LANG['catadd_succed'],0, $link);
}

/*------------------------------------------------------ */
//-- 编辑视频分类
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit')
{
    /* 权限判断 */
    admin_priv('video_cat');

    $sql = "SELECT cat_id, cat_name, cat_desc, keywords, parent_id,sort_order, cat_img FROM ".
           $ecs->table('video_cat'). " WHERE cat_id='$_REQUEST[id]'";
    $cat = $db->GetRow($sql);


    $options    =   video_cat_list(0, $cat['parent_id'], false);
    $select     =   '';
    $selected   =   $cat['parent_id'];
    foreach ($options as $var)
    {
        if ($var['cat_id'] == $_REQUEST['id'])
        {
            continue;
        }
        $select .= '<option value="' . $var['cat_id'] . '" ';
        $select .= ($selected == $var['cat_id']) ? "selected='ture'" : '';
        $select .= '>';
        if ($var['level'] > 0)
        {
            $select .= str_repeat('&nbsp;', $var['level'] * 4);
        }
        $select .= htmlspecialchars($var['cat_name']) . '</option>';
    }
    unset($options);
    $smarty->assign('cat',         $cat);
    $smarty->assign('cat_select',  $select);
    $smarty->assign('ur_here',     $_LANG['video_cat_add']);
    $smarty->assign('action_link', array('text' => $_LANG['video_cat'], 'href' => 'video_cat.php?act=list'));
    $smarty->assign('form_action', 'update');

    assign_query_info();
    $smarty->display('video_cat_info.htm');
}
elseif ($_REQUEST['act'] == 'update')
{
    /* 权限判断 */
    admin_priv('video_cat');

    /*检查重名*/
    if ($_POST['cat_name'] != $_POST['old_catname'])
    {
        $is_only = $exc->is_only('cat_name', $_POST['cat_name'], $_POST['id']);

        if (!$is_only)
        {
            sys_msg(sprintf($_LANG['catname_exist'], stripslashes($_POST['cat_name'])), 1);
        }
    }

    if(!isset($_POST['parent_id']))
    {
        $_POST['parent_id'] = 0;
    }


    /* 检查设定的分类的父分类是否合法 */
    $child_cat = video_cat_list($_POST['id'], 0, false);
    if (!empty($child_cat))
    {
        foreach ($child_cat as $child_data)
        {
            $catid_array[] = $child_data['cat_id'];
        }
    }
    if (in_array($_POST['parent_id'], $catid_array))
    {
        sys_msg(sprintf($_LANG['parent_id_err'], stripslashes($_POST['cat_name'])), 1);
    }


    /* 取得图片地址 */
    $sql = "SELECT cat_img FROM " . $ecs->table('video_cat') . " WHERE cat_id = '$_POST[id]'";
    $old_img = $db->getOne($sql);
    $cat_img = $old_img;
    if (empty($_FILES['cat_img']['error']) || (!isset($_FILES['cat_img']['error']) && isset($_FILES['cat_img']['tmp_name']) && $_FILES['cat_img']['tmp_name'] != 'none'))
    {
        // 检查文件格式
        if (!check_file_type($_FILES['cat_img']['tmp_name'], $_FILES['cat_img']['name'], $allow_img_types))
        {
            sys_msg($_LANG['invalid_file']);
        }

        // 复制文件
        $res = upload_cat_file($_FILES['cat_img']);
        if ($res != false)
        {
            $cat_img = $res;
            /* 如果 cat_img 跟以前不一样，且原来的文件是本地文件，删除原来的文件 */
           
            @unlink(ROOT_PATH . $old_img);
        }
    }




    $dat = $db->getOne("SELECT cat_name FROM ". $ecs->table('video_cat') . " WHERE cat_id = '" . $_POST['id'] . "'");
    if ($exc->edit("cat_name = '$_POST[cat_name]', cat_desc ='$_POST[cat_desc]', keywords='$_POST[keywords]',parent_id = '$_POST[parent_id]',  sort_order='$_POST[sort_order]',  cat_img='$cat_img'",  $_POST['id']))
    {

        $link[0]['text'] = $_LANG['back_list'];
        $link[0]['href'] = 'video_cat.php?act=list';
        $note = sprintf($_LANG['catedit_succed'], $_POST['cat_name']);
        admin_log($_POST['cat_name'], 'edit', 'video_cat');
        clear_cache_files();
        sys_msg($note, 0, $link);

    }
    else
    {
        die($db->error());
    }
}



/*------------------------------------------------------ */
//-- 编辑视频分类的排序
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit_sort_order')
{
    check_authz_json('video_cat');

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
//-- 删除视频分类
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'remove')
{
    check_authz_json('video_cat');

    $id = intval($_GET['id']);



    $sql = "SELECT COUNT(*) FROM " . $ecs->table('video_cat') . " WHERE parent_id = '$id'";
    if ($db->getOne($sql) > 0)
    {
        /* 还有子分类，不能删除 */
        make_json_error($_LANG['is_fullcat']);
    }

    /* 非空的分类不允许删除 */
    $sql = "SELECT COUNT(*) FROM ".$ecs->table('video')." WHERE cat_id = '$id'";
    if ($db->getOne($sql) > 0)
    {
        make_json_error(sprintf($_LANG['not_emptycat']));
    }
    else
    {
        $exc->drop($id);
        clear_cache_files();
        admin_log($cat_name, 'remove', 'category');
    }

    $url = 'video_cat.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);

    ecs_header("Location: $url\n");
    exit;
}

/* 上传文件 */
function upload_cat_file($upload)
{
    if (!make_dir("../" . DATA_DIR . "/videocat"))
    {
        /* 创建目录失败 */
        return false;
    }

    $filename = cls_image::random_filename() . substr($upload['name'], strpos($upload['name'], '.'));
    $path     = ROOT_PATH. DATA_DIR . "/videocat/" . $filename;
    if (move_upload_file($upload['tmp_name'], $path))
    {
        return DATA_DIR . "/videocat/" . $filename;
    }
    else
    {
        return false;
    }
}

?>
