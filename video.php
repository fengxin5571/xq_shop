<?php
define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
include_once(ROOT_PATH . '/includes/lib_video.php');

if ((DEBUG_MODE & 2) != 2)
{
    $smarty->caching = true;
}

/*------------------------------------------------------ */
//-- INPUT
/*------------------------------------------------------ */

$_REQUEST['id'] = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
$video_id     = $_REQUEST['id'];
if(isset($_REQUEST['cat_id']) && $_REQUEST['cat_id'] < 0)
{
    $video_id = $db->getOne("SELECT video_id FROM " . $ecs->table('video') . " WHERE cat_id = '".intval($_REQUEST['cat_id'])."' ");
}

/*------------------------------------------------------ */
//-- PROCESSOR
/*------------------------------------------------------ */

$cache_id = sprintf('%X', crc32($_REQUEST['id'] . '-' . $_CFG['lang']));

if (!$smarty->is_cached('video.dwt', $cache_id))
{
    /* 视频详情 */
    $video = get_video_info($video_id);

    if (empty($video))
    {
        ecs_header("Location: ./\n");
        exit;
    }

    $smarty->assign('categories',       get_categories_tree());  // 分类树
    $smarty->assign('id',               $video_id);
    $smarty->assign('username',         $_SESSION['user_name']);
    $smarty->assign('email',            $_SESSION['email']);
    $smarty->assign('type',            '1');

    /* 验证码相关设置 */
    if ((intval($_CFG['captcha']) & CAPTCHA_COMMENT) && gd_version() > 0)
    {
        $smarty->assign('enabled_captcha', 1);
        $smarty->assign('rand',            mt_rand());
    }

    $smarty->assign('video',      $video);
    $smarty->assign('keywords',     htmlspecialchars($video['keywords']));
    $smarty->assign('description', htmlspecialchars($video['description']));


    assign_template();
    $position = assign_ur_here($video['cat_id'], $video['title']);
    $smarty->assign('page_title',   $position['title']);    // 页面标题
    $smarty->assign('ur_here',      $position['ur_here']);  // 当前位置
    

    /* 相关商品 */
    $sql = "SELECT a.goods_id, g.goods_name " .
            "FROM " . $ecs->table('goods_video') . " AS a, " . $ecs->table('goods') . " AS g " .
            "WHERE a.goods_id = g.goods_id " .
            "AND a.video_id = '$_REQUEST[id]' ";
    $smarty->assign('goods_list', $db->getAll($sql));
    $smarty->assign('video_cats',  get_cats()); 
    $smarty->assign('helps',            get_shop_help());

    assign_dynamic('video');
}

$smarty->display('video.dwt', $cache_id);

/*------------------------------------------------------ */
//-- PRIVATE FUNCTION
/*------------------------------------------------------ */

/**
 * 获得指定的视频的详细信息
 *
 * @access  private
 * @param   integer     $video_id
 * @return  array
 */
function get_video_info($video_id)
{
    /* 获得文章的信息 */
    $sql = "SELECT a.* ".
            "FROM " .$GLOBALS['ecs']->table('video'). " AS a ".
            "WHERE a.is_open = 1 AND a.video_id = '$video_id' GROUP BY a.video_id";
    $row = $GLOBALS['db']->getRow($sql);

    if ($row !== false)
    {                         
        $row['add_time']     = local_date($GLOBALS['_CFG']['date_format'], $row['add_time']); // 修正添加时间显示

        /* 作者信息如果为空，则用网站名称替换 */
        if (empty($row['author']) || $row['author'] == '_SHOPHELP')
        {
            $row['author'] = $GLOBALS['_CFG']['shop_name'];
        }
    }

    return $row;
}



?>