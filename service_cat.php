<?php
define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');

if ((DEBUG_MODE & 2) != 2)
{
    $smarty->caching = true;
}

/* 清除缓存 */
clear_cache_files();

/*------------------------------------------------------ */
//-- INPUT
/*------------------------------------------------------ */

/* 获得指定的分类ID */
if (!empty($_GET['id']))
{
    $cat_id = intval($_GET['id']);
}
else
{
    ecs_header("Location: ./\n");

    exit;
}

/* 获得当前页码 */
$page = !empty($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

/*------------------------------------------------------ */
//-- PROCESSOR
/*------------------------------------------------------ */

/* 获得页面的缓存ID */
$cache_id = sprintf('%X', crc32($cat_id . '-' . $page . '-' . $_CFG['lang']));

if (!$smarty->is_cached('service_cat.dwt', $cache_id))
{
    /* 如果页面没有被缓存则重新获得页面的内容 */

    assign_template('a', array($cat_id));
    $position = assign_ur_here($cat_id,"",2);
    $smarty->assign('page_title',           $position['title']);     // 页面标题
    $smarty->assign('ur_here',              $position['ur_here']);   // 当前位置

    /* Meta */
    $meta = $db->getRow("SELECT keywords, cat_desc, cat_name FROM " . $ecs->table('article_cat') . " WHERE cat_id = '$cat_id'");

    if ($meta === false || empty($meta))
    {
        /* 如果没有找到任何记录则返回首页 */
        ecs_header("Location: ./\n");
        exit;
    }

    $smarty->assign('keywords',    htmlspecialchars($meta['keywords']));
    $smarty->assign('description', htmlspecialchars($meta['cat_desc']));
    $smarty->assign('name', $meta['cat_name']);


    if ($_SESSION['user_id'] > 0)
    {
        $smarty->assign('user_info', get_user_info());
    }

    /* 获得文章总数 */
    $size   = isset($_CFG['article_page_size']) && intval($_CFG['article_page_size']) > 0 ? intval($_CFG['article_page_size']) : 20;
    $count  = get_article_count($cat_id);
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
        $count  = get_article_count($cat_id, $keywords);
        $pages  = ($count > 0) ? ceil($count / $size) : 1;
        if ($page > $pages)
        {
            $page = $pages;
        }

        $goon_keywords = urlencode($_POST['keywords']);
    }
    $smarty->assign('artciles_list',    get_cat_articles($cat_id, $page, $size ,$keywords, 'service_show'));
    $smarty->assign('cat_id',    $cat_id);
    /* 分页 */
    assign_pager('service_cat', $cat_id, $count, $size, '', '', $page, $goon_keywords);

    $cat = article_cat_list(14, 0, false, 0);
    $smarty->assign('cat',   $cat );
    $subcat = article_cat_list($cat_id, 0, false, 0);
    if (sizeof($subcat)==1) {
        $subcat = $cat;
    }
    $smarty->assign('subcat', $subcat);

}

$smarty->display('service_cat.dwt', $cache_id);

?>