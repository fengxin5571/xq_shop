<?php

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require_once(ROOT_PATH . 'includes/lib_talent.php');
require_once(ROOT_PATH . "includes/fckeditor/fckeditor.php");
require_once(ROOT_PATH . 'includes/cls_image.php');

/*初始化数据交换对象 */
$exc   = new exchange($ecs->table("talent"), $db, 'talent_id', 'name');
//$image = new cls_image();

/* 允许上传的文件类型 */
$allow_file_types = '|GIF|JPG|PNG|BMP|SWF|DOC|XLS|PPT|MID|WAV|ZIP|RAR|PDF|CHM|RM|TXT|';

/*------------------------------------------------------ */
//-- 人才列表
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list')
{
    /* 取得过滤条件 */
    $filter = array();
    $smarty->assign('cat_select',  talent_cat_list(0));
    $smarty->assign('ur_here',      $_LANG['talent']);
    $smarty->assign('action_link',  array('text' => $_LANG['talent_add'], 'href' => 'talent.php?act=add'));
    $smarty->assign('full_page',    1);
    $smarty->assign('filter',       $filter);

    $talent_list = get_talentlist();


    $smarty->assign('talent_list',     $talent_list['arr']);
    $smarty->assign('filter',          $talent_list['filter']);
    $smarty->assign('record_count',    $talent_list['record_count']);
    $smarty->assign('page_count',      $talent_list['page_count']);

    $sort_flag  = sort_flag($talent_list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    assign_query_info();
    $smarty->display('talent_list.htm');
}

/*------------------------------------------------------ */
//-- 翻页，排序
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'query')
{
    check_authz_json('talent_manage');

    $talent_list = get_talentlist();

    $smarty->assign('talent_list',     $talent_list['arr']);
    $smarty->assign('filter',          $talent_list['filter']);
    $smarty->assign('record_count',    $talent_list['record_count']);
    $smarty->assign('page_count',      $talent_list['page_count']);

    $sort_flag  = sort_flag($talent_list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    make_json_result($smarty->fetch('talent_list.htm'), '',
        array('filter' => $talent_list['filter'], 'page_count' => $talent_list['page_count']));
}

/*------------------------------------------------------ */
//-- 添加人才
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'add')
{
    /* 权限判断 */
    admin_priv('talent_manage');

    /* 创建 html editor */
    create_html_editor('FCKeditor1');

    /*初始化*/
    $talent = array();
    $talent['is_open'] = 1;


    if (isset($_GET['id']))
    {
        $smarty->assign('cur_id',  $_GET['id']);
    }
    $smarty->assign('ranks',      getUserRank(2));
    $smarty->assign('talent',     $talent);
    $smarty->assign('cat_select',  talent_cat_list(0));
    $smarty->assign('ur_here',     $_LANG['talent_add']);
    $smarty->assign('action_link', array('text' => $_LANG['talent'], 'href' => 'talent.php?act=list'));
    $smarty->assign('form_action', 'insert');

    assign_query_info();
    $smarty->display('talent_info.htm');
}

/*------------------------------------------------------ */
//-- 添加人才
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'insert')
{
    /* 权限判断 */
    admin_priv('talent_manage');

    if (empty($_POST['level'])) {
        sys_msg('请选择查看等级!');
    }
    $level  = $_POST['level'];

    /* 取得文件地址 */
    $file_url = '';
    if ((isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0) || (!isset($_FILES['file']['error']) && isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] != 'none'))
    {
        // 检查文件格式
        if (!check_file_type($_FILES['file']['tmp_name'], $_FILES['file']['name'], $allow_file_types))
        {
            sys_msg($_LANG['invalid_file']);
        }

        // 复制文件
        $res = upload_talent_file($_FILES['file']);
        if ($res != false)
        {
            $file_url = $res;
        }
    }

        /* 取得文件地址 */
    $img_url = '';
    if ((isset($_FILES['photo']['error']) && $_FILES['photo']['error'] == 0) || (!isset($_FILES['photo']['error']) && isset($_FILES['photo']['tmp_name']) && $_FILES['photo']['tmp_name'] != 'none'))
    {
        // 检查文件格式
        if (!check_file_type($_FILES['photo']['tmp_name'], $_FILES['photo']['name'], $allow_file_types))
        {
            sys_msg($_LANG['invalid_file']);
        }

        // 复制文件
        $res = upload_talent_file($_FILES['photo']);
        if ($res != false)
        {
            $img_url = $res;
        }
    }

    if ($img_url == '')
    {
        $img_url = $_POST['img_url'];
    }
    $birthday    = local_strtotime($_POST['birthday']);
    /*插入数据*/
    $add_time = gmtime();
    if (empty($_POST['cat_id']))
    {
        $_POST['cat_id'] = 0;
    }

    

    $sql = "INSERT INTO ".$ecs->table('talent')."(cat_id, name, sex, birthday, mariage, address, education, ".
                "school, major, experience, purpose, phone, email, content, is_open, add_time, file_url, img_url, is_home, level) ".
            "VALUES ('$_POST[cat_id]', '$_POST[name]', '$_POST[sex]', '$birthday', ".
                "'$_POST[mariage]', '$_POST[address]', '$_POST[education]', '$_POST[school]', '$_POST[major]', ".
                "'$_POST[experience]','$_POST[purpose]','$_POST[phone]','$_POST[email]','$_POST[FCKeditor1]', '$_POST[is_open]', '$add_time', '$file_url', '$img_url', '$_POST[is_home]', '$level')";
    $db->query($sql);

    

    $link[0]['text'] = $_LANG['continue_add'];
    $link[0]['href'] = 'talent.php?act=add';

    $link[1]['text'] = $_LANG['back_list'];
    $link[1]['href'] = 'talent.php?act=list';

    clear_cache_files(); // 清除相关的缓存文件

    sys_msg($_LANG['articleadd_succeed'],0, $link);
}

/*------------------------------------------------------ */
//-- 编辑
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'edit')
{
    /* 权限判断 */
    admin_priv('talent_manage');

    /* 取人才数据 */
    $sql = "SELECT * FROM " .$ecs->table('talent'). " WHERE talent_id='$_REQUEST[id]'";
    $talent = $db->GetRow($sql);

    /* 创建 html editor */
    create_html_editor('FCKeditor1',$talent['content']);

    $talent['birthday']  = local_date('Y-m-d', $talent['birthday']);
    //$talent['level']  = explode(',', $talent['level']);

    $smarty->assign('ranks',      getUserRank(2));
    $smarty->assign('talent',     $talent);
    $smarty->assign('cat_select',  talent_cat_list(0, $talent['cat_id']));
    $smarty->assign('ur_here',     $_LANG['talent_edit']);
    $smarty->assign('action_link', array('text' => $_LANG['talent'], 'href' => 'talent.php?act=list&' . list_link_postfix()));
    $smarty->assign('form_action', 'update');

    assign_query_info();
    $smarty->display('talent_info.htm');
}

if ($_REQUEST['act'] =='update')
{
    /* 权限判断 */
    admin_priv('talent_manage');

    if (empty($_POST['cat_id']))
    {
        $_POST['cat_id'] = 0;
    }

    if (empty($_POST['level'])) {
        sys_msg('请选择查看等级!');
    }
    $level  = $_POST['level'];

    /* 取得文件地址 */
    $file_url = '';
    if (empty($_FILES['file']['error']) || (!isset($_FILES['file']['error']) && isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] != 'none'))
    {
        // 检查文件格式
        if (!check_file_type($_FILES['file']['tmp_name'], $_FILES['file']['name'], $allow_file_types))
        {
            sys_msg($_LANG['invalid_file']);
        }

        // 复制文件
        $res = upload_talent_file($_FILES['file']);
        if ($res != false)
        {
            $file_url = $res;
        }
    }

    if ($file_url == '')
    {
        $file_url = $_POST['file_url'];
    }


    /* 取得文件地址 */
    $img_url = '';
    if (empty($_FILES['photo']['error']) || (!isset($_FILES['photo']['error']) && isset($_FILES['photo']['tmp_name']) && $_FILES['photo']['tmp_name'] != 'none'))
    {
        // 检查文件格式
        if (!check_file_type($_FILES['photo']['tmp_name'], $_FILES['photo']['name'], $allow_file_types))
        {
            sys_msg($_LANG['invalid_file']);
        }

        // 复制文件
        $res = upload_talent_file($_FILES['photo']);
        if ($res != false)
        {
            $img_url = $res;
        }
    }

    if ($img_url == '')
    {
        $img_url = $_POST['img_url'];
    }

    $birthday    = local_strtotime($_POST['birthday']);

    /* 如果 file_url 跟以前不一样，且原来的文件是本地文件，删除原来的文件 */
    $sql = "SELECT file_url FROM " . $ecs->table('talent') . " WHERE talent_id = '$_POST[id]'";
    $old_url = $db->getOne($sql);
    if ($old_url != '' && $old_url != $file_url && strpos($old_url, 'http://') === false && strpos($old_url, 'https://') === false)
    {
        @unlink(ROOT_PATH . $old_url);
    }

    $sql = "SELECT img_url FROM " . $ecs->table('talent') . " WHERE talent_id = '$_POST[id]'";
    $old_img_url = $db->getOne($sql);
    if ($old_img_url != '' && $old_img_url != $img_url && strpos($old_img_url, 'http://') === false && strpos($old_img_url, 'https://') === false)
    {
        @unlink(ROOT_PATH . $old_img_url);
    }

    if ($exc->edit("name='$_POST[name]', cat_id='$_POST[cat_id]',  is_open='$_POST[is_open]', is_home='$_POST[is_home]', sex='$_POST[sex]', birthday='$birthday', mariage ='$_POST[mariage]', address ='$_POST[address]', education ='$_POST[education]', school ='$_POST[school]', major ='$_POST[major]', experience ='$_POST[experience]', purpose ='$_POST[purpose]', phone ='$_POST[phone]', email ='$_POST[email]', file_url ='$file_url', img_url ='$img_url', level = '$level', content='$_POST[FCKeditor1]'", $_POST['id']))
    {
        $link[0]['text'] = $_LANG['back_list'];
        $link[0]['href'] = 'talent.php?act=list&' . list_link_postfix();

        $note = sprintf($_LANG['articleedit_succeed'], stripslashes($_POST['title']));
        clear_cache_files();

        sys_msg($note, 0, $link);
    }
    else
    {
        die($db->error());
    }
}


/*------------------------------------------------------ */
//-- 切换是否显示
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'toggle_show')
{
    check_authz_json('talent_manage');

    $id     = intval($_POST['id']);
    $val    = intval($_POST['val']);

    $exc->edit("is_home = '$val'", $id);
    clear_cache_files();

    make_json_result($val);
}




/*------------------------------------------------------ */
//-- 删除人才
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'remove')
{
    check_authz_json('talent_manage');

    $id = intval($_GET['id']);

    /* 删除原来的文件 */
    $sql = "SELECT file_url FROM " . $ecs->table('talent') . " WHERE talent_id = '$id'";
    $old_url = $db->getOne($sql);
    if ($old_url != '' && strpos($old_url, 'http://') === false && strpos($old_url, 'https://') === false)
    {
        @unlink(ROOT_PATH . $old_url);
    }

    $name = $exc->get_name($id);
    if ($exc->drop($id))
    {
        clear_cache_files();
    }

    $url = 'talent.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);

    ecs_header("Location: $url\n");
    exit;
}

/**
 * 获取会员等级列表
 * @param   int  1：商城，2：人才，3：售后
 * @return  array
 */

function getUserRank($type = 1)
{
    $sql = "SELECT * ".
           ' FROM ' . $GLOBALS['ecs']->table('user_rank') .
           " WHERE type_id = $type ORDER BY rank_id desc";
    $res = $GLOBALS['db']->getAll($sql);
    return $res;
}


?>