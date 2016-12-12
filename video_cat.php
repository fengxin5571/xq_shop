<?php

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
include_once(ROOT_PATH . '/includes/lib_video.php');

if ((DEBUG_MODE & 2) != 2)
{
    $smarty->caching = true;
}

/* 清除缓存 */
clear_cache_files();

/*------------------------------------------------------ */
//-- INPUT
/*------------------------------------------------------ */

$cat_id = 0;
/* 获得指定的分类ID */
if (!empty($_GET['id']))
{
    $cat_id = intval($_GET['id']);
}
elseif (!empty($_GET['category']))
{
    $cat_id = intval($_GET['category']);
}

$smarty->assign('helps',            get_shop_help());

if ($cat_id) {
    /* 获得当前页码 */
    $page = !empty($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    /* 获得页面的缓存ID */
    $cache_id = sprintf('%X', crc32($cat_id . '-' . $page . '-' . $_CFG['lang']));

    if (!$smarty->is_cached('video_cat.dwt', $cache_id))
    {
        /* 如果页面没有被缓存则重新获得页面的内容 */

        assign_template('a', array($cat_id));
        $position = assign_ur_here($cat_id);
        $smarty->assign('page_title',           $position['title']);     // 页面标题
        $smarty->assign('ur_here',              $position['ur_here']);   // 当前位置

        $smarty->assign('categories',           get_categories_tree(0)); // 分类树

        /* Meta */
        $meta = $db->getRow("SELECT keywords, cat_desc, cat_name FROM " . $ecs->table('video_cat') . " WHERE cat_id = '$cat_id'");

        if ($meta === false || empty($meta))
        {
            /* 如果没有找到任何记录则返回首页 */
            ecs_header("Location: ./\n");
            exit;
        }

        $smarty->assign('keywords',    htmlspecialchars($meta['keywords']));
        $smarty->assign('description', htmlspecialchars($meta['cat_desc']));
        $smarty->assign('name', $meta['cat_name']);
        /* 获得视频总数 */
        $size   = isset($_CFG['video_page_size']) && intval($_CFG['video_page_size']) > 0 ? intval($_CFG['video_page_size']) : 20;
        $count  = get_video_count($cat_id);
        $pages  = ($count > 0) ? ceil($count / $size) : 1;

        if ($page > $pages)
        {
            $page = $pages;
        }
        $pager['search']['id'] = $cat_id;
        $keywords = '';
        $goon_keywords = ''; //继续传递的搜索关键词

        /* 获得文章列表 */
        if (isset($_POST['keywords']))
        {
            $keywords = addslashes(urldecode(trim($_POST['keywords'])));
            $pager['search']['keywords'] = $keywords;
            $search_url = substr(strrchr($_POST['cur_url'], '/'), 1);

            $smarty->assign('search_value',     $keywords);
            $smarty->assign('search_url',       $search_url);
            $count  = get_video_count($cat_id, $keywords);
            $pages  = ($count > 0) ? ceil($count / $size) : 1;
            if ($page > $pages)
            {
                $page = $pages;
            }

            $goon_keywords = urlencode($_POST['keywords']);
        }
        $smarty->assign('video_list',    get_cat_video($cat_id, $page, $size ,$keywords));
        $smarty->assign('cat_id',    $cat_id);

        $smarty->assign('video_cats',  get_cats()); 
        /* 分页 */
        assign_pager('video_cat', $cat_id, $count, $size, '', '', $page, $goon_keywords);
        assign_dynamic('video_cat');
    }

    $smarty->display('video_cat.dwt', $cache_id);
} else {
    /* 模板赋值 */
    assign_template();
    $position = assign_ur_here();
    $smarty->assign('page_title', $position['title']);    // 页面标题
    $smarty->assign('ur_here',    $position['ur_here']);  // 当前位置
    $smarty->assign('categories', get_categories_tree()); // 分类树
    $smarty->assign('video_data',  get_main_cat_video());
    $smarty->assign('top_video',  get_videos(1, 1)); // 置顶
    $smarty->assign('rom_video',  get_videos(2, 6)); // 推荐
    $smarty->display('video_main.dwt');
}

?>