<?php

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require_once(ROOT_PATH . "includes/fckeditor/fckeditor.php");
require_once(ROOT_PATH . 'includes/cls_image.php');

/*初始化数据交换对象 */
$exc   = new exchange($ecs->table("video"), $db, 'video_id', 'title');
//$image = new cls_image();

/* 允许上传的文件类型 */
$allow_file_types = '|flv|swf|';
$allow_img_types = '|jpg|png|gif|';

/*------------------------------------------------------ */
//-- 视频列表
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list')
{
    /* 取得过滤条件 */
    $filter = array();
    $smarty->assign('cat_select',  video_cat_list(0));
    $smarty->assign('ur_here',      $_LANG['video_list']);
    $smarty->assign('action_link',  array('text' => $_LANG['video_add'], 'href' => 'video.php?act=add'));
    $smarty->assign('full_page',    1);
    $smarty->assign('filter',       $filter);

    $video_list = get_video_list();

    $smarty->assign('video_list',      $video_list['arr']);
    $smarty->assign('filter',          $video_list['filter']);
    $smarty->assign('record_count',    $video_list['record_count']);
    $smarty->assign('page_count',      $video_list['page_count']);

    $sort_flag  = sort_flag($video_list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    assign_query_info();
    $smarty->display('video_list.htm');
}

/*------------------------------------------------------ */
//-- 翻页，排序
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'query')
{
    check_authz_json('video_manage');

    $video_list = get_video_list();

    $smarty->assign('video_list',      $video_list['arr']);
    $smarty->assign('filter',          $video_list['filter']);
    $smarty->assign('record_count',    $video_list['record_count']);
    $smarty->assign('page_count',      $video_list['page_count']);

    $sort_flag  = sort_flag($video_list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    make_json_result($smarty->fetch('video_list.htm'), '',
        array('filter' => $video_list['filter'], 'page_count' => $video_list['page_count']));
}

/*------------------------------------------------------ */
//-- 添加视频
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'add')
{
    /* 权限判断 */
    admin_priv('video_manage');

    /* 创建 html editor */
    create_html_editor('FCKeditor1');

    /*初始化*/
    $video = array();
    $video['is_open'] = 1;

    /* 取得分类、品牌 */
    $smarty->assign('goods_cat_list', cat_list());
    $smarty->assign('brand_list',     get_brand_list());

    /* 清理关联商品 */
    $sql = "DELETE FROM " . $ecs->table('goods_video') . " WHERE video_id = 0";
    $db->query($sql);

    if (isset($_GET['id']))
    {
        $smarty->assign('cur_id',  $_GET['id']);
    }
    $smarty->assign('video',     $video);
    $smarty->assign('cat_select',  video_cat_list(0));
    $smarty->assign('ur_here',     $_LANG['video_add']);
    $smarty->assign('action_link', array('text' => $_LANG['video_list'], 'href' => 'video.php?act=list'));
    $smarty->assign('form_action', 'insert');

    $timestamp = time();
    $smarty->assign('timestamp', $timestamp);
    $smarty->assign('token', md5('laiyun'.$timestamp));

    assign_query_info();
    $smarty->display('video_info.htm');
}

/*------------------------------------------------------ */
//-- 添加视频
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'insert')
{
    /* 权限判断 */
    admin_priv('video_manage');

    /*检查是否重复*/
    $is_only = $exc->is_only('title', $_POST['title'],0, " cat_id ='$_POST[video_cat]'");

    if (!$is_only)
    {
        sys_msg(sprintf($_LANG['title_exist'], stripslashes($_POST['title'])), 1);
    }

    /* 取得图片地址 */
    $video_img = '';
    if ((isset($_FILES['video_img']['error']) && $_FILES['video_img']['error'] == 0) || (!isset($_FILES['video_img']['error']) && isset($_FILES['video_img']['tmp_name']) && $_FILES['video_img']['tmp_name'] != 'none'))
    {
        // 检查文件格式
        if (!check_file_type($_FILES['video_img']['tmp_name'], $_FILES['video_img']['name'], $allow_img_types))
        {
            sys_msg($_LANG['invalid_file']);
        }

        // 复制文件
        $res = upload_video_file($_FILES['video_img']);
        if ($res != false)
        {
            $video_img = $res;
        }
    }


    /* 取得文件地址 */
    $file_url = '';
    $file_url = $_POST['file_url'];

    /* 计算文章打开方式 */
    if ($file_url == '')
    {
        $open_type = 0;
    }
    else
    {
        $open_type = $_POST['FCKeditor1'] == '' ? 1 : 2;
    }

    /*插入数据*/
    $add_time = gmtime();
    if (empty($_POST['cat_id']))
    {
        $_POST['cat_id'] = 0;
    }
    $sql = "INSERT INTO ".$ecs->table('video')."(title, cat_id, video_type, is_open, author, ".
                "author_email, keywords, content, add_time, file_url, open_type, link, description, video_img) ".
            "VALUES ('$_POST[title]', '$_POST[video_cat]', '$_POST[video_type]', '$_POST[is_open]', ".
                "'$_POST[author]', '$_POST[author_email]', '$_POST[keywords]', '$_POST[FCKeditor1]', ".
                "'$add_time', '$file_url', '$open_type', '$_POST[link_url]', '$_POST[description]', '$video_img')";
    $db->query($sql);

    /* 处理关联商品 */
    $video_id = $db->insert_id();
    $sql = "UPDATE " . $ecs->table('goods_video') . " SET video_id = '$video_id' WHERE video_id = 0";
    $db->query($sql);

    $link[0]['text'] = $_LANG['continue_add'];
    $link[0]['href'] = 'video.php?act=add';

    $link[1]['text'] = $_LANG['back_list'];
    $link[1]['href'] = 'video.php?act=list';

    admin_log($_POST['title'],'add','video');

    clear_cache_files(); // 清除相关的缓存文件

    sys_msg($_LANG['articleadd_succeed'],0, $link);
}

/*------------------------------------------------------ */
//-- 上传视频文件
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'uploadify')
{
    $verifyToken = md5('laiyun' . $_POST['timestamp']);
    if (!empty($_FILES) && $_POST['token'] == $verifyToken) {

        if ((isset($_FILES['Filedata']['error']) && $_FILES['Filedata']['error'] == 0) || (!isset($_FILES['Filedata']['error']) && isset($_FILES['Filedata']['tmp_name']) && $_FILES['Filedata']['tmp_name'] != 'none'))
        {
            // 检查文件格式
            if (!check_file_type($_FILES['Filedata']['tmp_name'], $_FILES['Filedata']['name'], $allow_file_types))
            {
                echo 0;
                exit;
            }
            // 复制文件
            $res = upload_video_file($_FILES['Filedata']);
            echo $res;
            exit;
        }
    }
}

/*------------------------------------------------------ */
//-- 删除视频文件
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'removevideo')
{
     $ret = array('statu'=>0);
     $id = intval($_POST['id']);
     $sql = "SELECT file_url FROM " . $ecs->table('video') . " WHERE video_id = '$id'";
     $old_url = $db->getOne($sql);
     $sql = "UPDATE " . $ecs->table('video') . " SET file_url = '' WHERE video_id = '$id'";
     $db->query($sql);
     if (@unlink(ROOT_PATH . $old_url)) {
        $ret['statu'] = 1;
     } 
     exit(json_encode($ret));
}

/*------------------------------------------------------ */
//-- 编辑
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'edit')
{
    /* 权限判断 */
    admin_priv('video_manage');

    /* 取视频数据 */
    $sql = "SELECT * FROM " .$ecs->table('video'). " WHERE video_id='$_REQUEST[id]'";
    $video = $db->GetRow($sql);

    /* 创建 html editor */
    create_html_editor('FCKeditor1',$video['content']);

    /* 取得分类、品牌 */
    $smarty->assign('goods_cat_list', cat_list());
    $smarty->assign('brand_list', get_brand_list());

    /* 取得关联商品 */
    $goods_list = get_video_goods($_REQUEST['id']);
    $smarty->assign('goods_list', $goods_list);

    $smarty->assign('video',     $video);
    $smarty->assign('cat_select',  video_cat_list(0, $video['cat_id']));
    $smarty->assign('ur_here',     $_LANG['video_edit']);
    $smarty->assign('action_link', array('text' => $_LANG['video_list'], 'href' => 'video.php?act=list&' . list_link_postfix()));
    $smarty->assign('form_action', 'update');

    $timestamp = time();
    $smarty->assign('timestamp', $timestamp);
    $smarty->assign('token', md5('laiyun'.$timestamp));

    assign_query_info();
    $smarty->display('video_info.htm');
}

if ($_REQUEST['act'] =='update')
{
    /* 权限判断 */
    admin_priv('video_manage');

    /*检查文章名是否相同*/
    $is_only = $exc->is_only('title', $_POST['title'], $_POST['id'], "cat_id = '$_POST[video_cat]'");

    if (!$is_only)
    {
        sys_msg(sprintf($_LANG['title_exist'], stripslashes($_POST['title'])), 1);
    }


    if (empty($_POST['cat_id']))
    {
        $_POST['cat_id'] = 0;
    }


    /* 取得图片地址 */
    $sql = "SELECT video_img FROM " . $ecs->table('video') . " WHERE video_id = '$_POST[id]'";
    $old_img = $db->getOne($sql);
    $video_img = $old_img;
    if (empty($_FILES['video_img']['error']) || (!isset($_FILES['video_img']['error']) && isset($_FILES['video_img']['tmp_name']) && $_FILES['video_img']['tmp_name'] != 'none'))
    {
        // 检查文件格式
        if (!check_file_type($_FILES['video_img']['tmp_name'], $_FILES['video_img']['name'], $allow_img_types))
        {
            sys_msg($_LANG['invalid_file']);
        }

        // 复制文件
        $res = upload_video_file($_FILES['video_img']);
        if ($res != false)
        {
            $video_img = $res;
            /* 如果 video_img 跟以前不一样，且原来的文件是本地文件，删除原来的文件 */
           
            @unlink(ROOT_PATH . $old_img);
        }
    }

    /* 取得文件地址 */
    $file_url = '';
    
    $file_url = $_POST['file_url'];

    /* 计算文章打开方式 */
    if ($file_url == '')
    {
        $open_type = 0;
    }
    else
    {
        $open_type = $_POST['FCKeditor1'] == '' ? 1 : 2;
    }



    if ($exc->edit("title='$_POST[title]', cat_id='$_POST[video_cat]', video_type='$_POST[video_type]', is_open='$_POST[is_open]', author='$_POST[author]', author_email='$_POST[author_email]', keywords ='$_POST[keywords]', file_url ='$file_url', open_type='$open_type', content='$_POST[FCKeditor1]', link='$_POST[link_url]', description = '$_POST[description]', video_img = '$video_img'", $_POST['id']))
    {
        $link[0]['text'] = $_LANG['back_list'];
        $link[0]['href'] = 'video.php?act=list&' . list_link_postfix();

        $note = sprintf($_LANG['articleedit_succeed'], stripslashes($_POST['title']));
        admin_log($_POST['title'], 'edit', 'video');

        clear_cache_files();

        sys_msg($note, 0, $link);
    }
    else
    {
        die($db->error());
    }
}

/*------------------------------------------------------ */
//-- 编辑视频主题
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit_title')
{
    check_authz_json('video_manage');

    $id    = intval($_POST['id']);
    $title = json_str_iconv(trim($_POST['val']));

    /* 检查文章标题是否重复 */
    if ($exc->num("title", $title, $id) != 0)
    {
        make_json_error(sprintf($_LANG['title_exist'], $title));
    }
    else
    {
        if ($exc->edit("title = '$title'", $id))
        {
            clear_cache_files();
            admin_log($title, 'edit', 'video');
            make_json_result(stripslashes($title));
        }
        else
        {
            make_json_error($db->error());
        }
    }
}

/*------------------------------------------------------ */
//-- 切换是否显示
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'toggle_show')
{
    check_authz_json('video_manage');

    $id     = intval($_POST['id']);
    $val    = intval($_POST['val']);

    $exc->edit("is_open = '$val'", $id);
    clear_cache_files();

    make_json_result($val);
}

/*------------------------------------------------------ */
//-- 切换视频重要性
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'toggle_type')
{
    check_authz_json('video_manage');

    $id     = intval($_POST['id']);
    $val    = intval($_POST['val']);

    $exc->edit("video_type = '$val'", $id);
    clear_cache_files();

    make_json_result($val);
}



/*------------------------------------------------------ */
//-- 删除文章主题
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'remove')
{
    check_authz_json('video_manage');

    $id = intval($_GET['id']);

    /* 删除原来的文件 */
    $sql = "SELECT file_url FROM " . $ecs->table('video') . " WHERE video_id = '$id'";
    $old_url = $db->getOne($sql);
    if ($old_url != '' && strpos($old_url, 'http://') === false && strpos($old_url, 'https://') === false)
    {
        @unlink(ROOT_PATH . $old_url);
    }

    $name = $exc->get_name($id);
    if ($exc->drop($id))
    {
        //$db->query("DELETE FROM " . $ecs->table('comment') . " WHERE " . "comment_type = 1 AND id_value = $id");
        
        admin_log(addslashes($name),'remove','video');
        clear_cache_files();
    }

    $url = 'video.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);

    ecs_header("Location: $url\n");
    exit;
}

/*------------------------------------------------------ */
//-- 将商品加入关联
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'add_link_goods')
{
    include_once(ROOT_PATH . 'includes/cls_json.php');
    $json = new JSON;

    check_authz_json('video_manage');

    $add_ids = $json->decode($_GET['add_ids']);
    $args = $json->decode($_GET['JSON']);
    $video_id = $args[0];

    if ($video_id == 0)
    {
        $video_id = $db->getOne('SELECT MAX(video_id)+1 AS video_id FROM ' .$ecs->table('video'));
    }

    foreach ($add_ids AS $key => $val)
    {
        $sql = 'INSERT INTO ' . $ecs->table('goods_video') . ' (goods_id, video_id) '.
               "VALUES ('$val', '$video_id')";
        $db->query($sql, 'SILENT') or make_json_error($db->error());
    }


    /* 重新载入 */
    $arr = get_video_goods($video_id);
    $opt = array();

    foreach ($arr AS $key => $val)
    {
        $opt[] = array('value'  => $val['goods_id'],
                        'text'  => $val['goods_name'],
                        'data'  => '');
    }

    make_json_result($opt);
}

/*------------------------------------------------------ */
//-- 将商品删除关联
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'drop_link_goods')
{
    include_once(ROOT_PATH . 'includes/cls_json.php');
    $json = new JSON;

    check_authz_json('video_manage');

    $drop_goods     = $json->decode($_GET['drop_ids']);
    $arguments      = $json->decode($_GET['JSON']);
    $video_id     = $arguments[0];

    if ($video_id == 0)
    {
        $video_id = $db->getOne('SELECT MAX(video_id)+1 AS video_id FROM ' .$ecs->table('video'));
    }

    $sql = "DELETE FROM " . $ecs->table('goods_video').
            " WHERE video_id = '$video_id' AND goods_id " .db_create_in($drop_goods);
    $db->query($sql, 'SILENT') or make_json_error($db->error());

    /* 重新载入 */
    $arr = get_video_goods($video_id);
    $opt = array();

    foreach ($arr AS $key => $val)
    {
        $opt[] = array('value'  => $val['goods_id'],
                        'text'  => $val['goods_name'],
                        'data'  => '');
    }

    make_json_result($opt);
}

/*------------------------------------------------------ */
//-- 搜索商品
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'get_goods_list')
{
    include_once(ROOT_PATH . 'includes/cls_json.php');
    $json = new JSON;

    $filters = $json->decode($_GET['JSON']);
    $arr = get_goods_list($filters);
    $opt = array();

    foreach ($arr AS $key => $val)
    {
        $opt[] = array('value' => $val['goods_id'],
                        'text' => $val['goods_name'],
                        'data' => $val['shop_price']);
    }

    make_json_result($opt);
}
/*------------------------------------------------------ */
//-- 批量操作
/*------------------------------------------------------ */

elseif ($_REQUEST['act'] == 'batch')
{
    /* 批量删除 */
    if (isset($_POST['type']))
    {
        if ($_POST['type'] == 'button_remove')
        {
            admin_priv('video_manage');

            if (!isset($_POST['checkboxes']) || !is_array($_POST['checkboxes']))
            {
                sys_msg($_LANG['no_select_article'], 1);
            }

            /* 删除原来的文件 */
            $sql = "SELECT file_url FROM " . $ecs->table('video') .
                    " WHERE video_id " . db_create_in(join(',', $_POST['checkboxes'])) .
                    " AND file_url <> ''";

            $res = $db->query($sql);
            while ($row = $db->fetchRow($res))
            {
                $old_url = $row['file_url'];
                if (strpos($old_url, 'http://') === false && strpos($old_url, 'https://') === false)
                {
                    @unlink(ROOT_PATH . $old_url);
                }
            }

            foreach ($_POST['checkboxes'] AS $key => $id)
            {
                if ($exc->drop($id))
                {
                    $name = $exc->get_name($id);
                    admin_log(addslashes($name),'remove','video');
                }
            }

        }

        /* 批量隐藏 */
        if ($_POST['type'] == 'button_hide')
        {
            check_authz_json('video_manage');
            if (!isset($_POST['checkboxes']) || !is_array($_POST['checkboxes']))
            {
                sys_msg($_LANG['no_select_article'], 1);
            }

            foreach ($_POST['checkboxes'] AS $key => $id)
            {
              $exc->edit("is_open = '0'", $id);
            }
        }

        /* 批量显示 */
        if ($_POST['type'] == 'button_show')
        {
            check_authz_json('video_manage');
            if (!isset($_POST['checkboxes']) || !is_array($_POST['checkboxes']))
            {
                sys_msg($_LANG['no_select_article'], 1);
            }

            foreach ($_POST['checkboxes'] AS $key => $id)
            {
              $exc->edit("is_open = '1'", $id);
            }
        }

        /* 批量移动分类 */
        if ($_POST['type'] == 'move_to')
        {
            check_authz_json('video_manage');
            if (!isset($_POST['checkboxes']) || !is_array($_POST['checkboxes']) )
            {
                sys_msg($_LANG['no_select_article'], 1);
            }

            if(!$_POST['target_cat'])
            {
                sys_msg($_LANG['no_select_act'], 1);
            }
            
            foreach ($_POST['checkboxes'] AS $key => $id)
            {
              $exc->edit("cat_id = '".$_POST['target_cat']."'", $id);
            }
        }
    }

    /* 清除缓存 */
    clear_cache_files();
    $lnk[] = array('text' => $_LANG['back_list'], 'href' => 'video.php?act=list');
    sys_msg($_LANG['batch_handle_ok'], 0, $lnk);
}

/* 把商品删除关联 */
function drop_link_goods($goods_id, $video_id)
{
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('goods_video') .
            " WHERE goods_id = '$goods_id' AND video_id = '$video_id' LIMIT 1";
    $GLOBALS['db']->query($sql);
    create_result(true, '', $goods_id);
}

/* 取得视频关联商品 */
function get_video_goods($video_id)
{
    $list = array();
    $sql  = 'SELECT g.goods_id, g.goods_name'.
            ' FROM ' . $GLOBALS['ecs']->table('goods_video') . ' AS ga'.
            ' LEFT JOIN ' . $GLOBALS['ecs']->table('goods') . ' AS g ON g.goods_id = ga.goods_id'.
            " WHERE ga.video_id = '$video_id'";
    $list = $GLOBALS['db']->getAll($sql);

    return $list;
}

/* 获得视频列表 */
function get_video_list()
{
    $result = get_filter();
    if ($result === false)
    {
        $filter = array();
        $filter['keyword']    = empty($_REQUEST['keyword']) ? '' : trim($_REQUEST['keyword']);
        if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
        {
            $filter['keyword'] = json_str_iconv($filter['keyword']);
        }
        $filter['cat_id'] = empty($_REQUEST['cat_id']) ? 0 : intval($_REQUEST['cat_id']);
        $filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'a.video_id' : trim($_REQUEST['sort_by']);
        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);

        $where = '';
        if (!empty($filter['keyword']))
        {
            $where = " AND a.title LIKE '%" . mysql_like_quote($filter['keyword']) . "%'";
        }
        if ($filter['cat_id'])
        {
            $where .= " AND a." . get_video_children($filter['cat_id']);
        }

        /* 视频总数 */
        $sql = 'SELECT COUNT(*) FROM ' .$GLOBALS['ecs']->table('video'). ' AS a '.
               'LEFT JOIN ' .$GLOBALS['ecs']->table('video_cat'). ' AS ac ON ac.cat_id = a.cat_id '.
               'WHERE 1 ' .$where;
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);

        $filter = page_and_size($filter);

        /* 获取视频数据 */
        $sql = 'SELECT a.* , ac.cat_name '.
               'FROM ' .$GLOBALS['ecs']->table('video'). ' AS a '.
               'LEFT JOIN ' .$GLOBALS['ecs']->table('video_cat'). ' AS ac ON ac.cat_id = a.cat_id '.
               'WHERE 1 ' .$where. ' ORDER by '.$filter['sort_by'].' '.$filter['sort_order'];

        $filter['keyword'] = stripslashes($filter['keyword']);
        set_filter($filter, $sql);
    }
    else
    {
        $sql    = $result['sql'];
        $filter = $result['filter'];
    }
    $arr = array();
    $res = $GLOBALS['db']->selectLimit($sql, $filter['page_size'], $filter['start']);

    while ($rows = $GLOBALS['db']->fetchRow($res))
    {
        $rows['date'] = local_date($GLOBALS['_CFG']['time_format'], $rows['add_time']);

        $arr[] = $rows;
    }
    return array('arr' => $arr, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
}

/* 上传文件 */
function upload_video_file($upload)
{
    if (!make_dir("../" . DATA_DIR . "/video"))
    {
        /* 创建目录失败 */
        return false;
    }

    $filename = cls_image::random_filename() . substr($upload['name'], strpos($upload['name'], '.'));
    $path     = ROOT_PATH. DATA_DIR . "/video/" . $filename;

    if (move_upload_file($upload['tmp_name'], $path))
    {
        return DATA_DIR . "/video/" . $filename;
    }
    else
    {
        return false;
    }
}

?>