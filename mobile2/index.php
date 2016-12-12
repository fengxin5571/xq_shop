<?php

/**
 * ECSHOP mobile首页


 * ============================================================================
 * $Author: liuhui $
 * $Id: index.php 15013 2010-03-25 09:31:42Z liuhui $
*/

define('IN_ECS', true);
define('ECS_ADMIN', true);

require(dirname(__FILE__) . '/includes/init.php');

$best_goods = get_recommend_goods('best');
$best_num = count($best_goods);
$smarty->assign('best_num' , $best_num);
if ($best_num > 0)
{
    $i = 0;
    foreach  ($best_goods as $key => $best_data)
    {
        $best_goods[$key]['shop_price'] = encode_output($best_data['shop_price']);
        $best_goods[$key]['name'] = encode_output($best_data['name']);
        /*if ($i > 2)
        {
            break;
        }*/
        $i++;
    }
    $smarty->assign('best_goods' , $best_goods);
}

/* 热门商品 */
$hot_goods = get_recommend_goods('hot');
$hot_num = count($hot_goods);
$smarty->assign('hot_num' , $hot_num);
if ($hot_num > 0)
{
    $i = 0;
    foreach  ($hot_goods as $key => $hot_data)
    {
        $hot_goods[$key]['shop_price'] = encode_output($hot_data['shop_price']);
        $hot_goods[$key]['name'] = encode_output($hot_data['name']);
        /*if ($i > 2)
        {
            break;
        }*/
        $i++;
    }
    $smarty->assign('hot_goods' , $hot_goods);
}


$promote_goods = get_promote_goods();
$promote_num = count($promote_goods);
$smarty->assign('promote_num' , $promote_num);
if ($promote_num > 0)
{
    $i = 0;
    foreach ($promote_goods as $key => $promote_data)
    {
        $promote_goods[$key]['shop_price'] = encode_output($promote_data['shop_price']);
        $promote_goods[$key]['name'] = encode_output($promote_data['name']);
        /*if ($i > 2)
        {
            break;
        }*/
        $i++;
    }
    $smarty->assign('promote_goods' , $promote_goods);
}

$pcat_array = get_categories_tree();
foreach ($pcat_array as $key => $pcat_data)
{
    $pcat_array[$key]['name'] = encode_output($pcat_data['name']);
    if ($pcat_data['cat_id'])
    {
        if (count($pcat_data['cat_id']) > 3)
        {
            $pcat_array[$key]['cat_id'] = array_slice($pcat_data['cat_id'], 0, 3);
        }
        foreach ($pcat_array[$key]['cat_id'] as $k => $v)
        {
            $pcat_array[$key]['cat_id'][$k]['name'] = encode_output($v['name']);
        }
    }
}
$smarty->assign('pcat_array' , $pcat_array);
$brands_array = get_brands();
if (!empty($brands_array))
{
    if (count($brands_array) > 3)
    {
        $brands_array = array_slice($brands_array, 0, 10);
    }
    foreach ($brands_array as $key => $brands_data)
    {
        $brands_array[$key]['brand_name'] = encode_output($brands_data['brand_name']);
    }
    $smarty->assign('brand_array', $brands_array);
}


if ($_SESSION['user_id'] > 0)
{
    $smarty->assign('user_name', $_SESSION['user_name']);
}

if (!empty($GLOBALS['_CFG']['search_keywords']))
{
    $searchkeywords = explode(',', trim($GLOBALS['_CFG']['search_keywords']));
}
else
{
    $searchkeywords = array();
}

/* 缓存编号 */
$cache_id = sprintf('%X', crc32($_SESSION['user_rank'] . '-' . $_CFG['lang']));
if (!$smarty->is_cached('index.dwt', $cache_id))
{
    $position = assign_ur_here();
    $smarty->assign('page_title',      $position['title']);    // 页面标题
    $smarty->assign('ur_here',         $position['ur_here']);  // 当前位置
    $smarty->assign('keywords',        htmlspecialchars($_CFG['shop_keywords']));
    $smarty->assign('description',     htmlspecialchars($_CFG['shop_desc']));
    $smarty->assign('categories',      get_categories_tree()); // 分类树
    $smarty->assign('new_articles',    index_get_new_articles());   // 最新文章
    $smarty->assign('promotion_goods', get_promote_goods()); // 特价商品
    $smarty->assign('new_goods',       get_category_recommend_goods('new', "", 0, 0, 0, '', 4));     // 最新商品
    $smarty->assign('best_goods',       get_category_recommend_goods('best', "", 0, 0, 0, '', 4));     // 精选商品
    $smarty->assign('get_guess_you_like',get_guess_you_like(6) );// 猜你喜欢的商品
    $smarty->assign('searchkeywords', $searchkeywords);
    $smarty->assign('wap_logo', $_CFG['wap_logo']);
    $smarty->assign('footer', get_footer());
    // 焦点图
    $playerdb = get_flash_xml();
    foreach ($playerdb as $key => $val)
    {
        if (strpos($val['src'], 'http') === false)
        {
            $playerdb[$key]['src'] =  $val['src'];
        }
    }
    $smarty->assign('playerdb', $playerdb);
}

$smarty->display('index.html', $cache_id);

/**
 * 解析xml文件返回数据数组
 *
 * @access  private
 * @return  array
 */
function get_flash_xml()
{
    $flashdb = array();
    if (file_exists(ROOT_PATH . DATA_DIR . '/flash_data.xml'))
    {

        // 兼容v2.7.0及以前版本
        if (!preg_match_all('/item_url="([^"]+)"\slink="([^"]+)"\stext="([^"]*)"\ssort="([^"]*)"/', file_get_contents(ROOT_PATH . DATA_DIR . '/flash_data.xml'), $t, PREG_SET_ORDER))
        {
            preg_match_all('/item_url="([^"]+)"\slink="([^"]+)"\stext="([^"]*)"/', file_get_contents(ROOT_PATH . DATA_DIR . '/flash_data.xml'), $t, PREG_SET_ORDER);
        }

        if (!empty($t))
        {
            foreach ($t as $key => $val)
            {
                $val[4] = isset($val[4]) ? $val[4] : 0;
                $flashdb[] = array('src'=>$val[1],'url'=>$val[2],'text'=>$val[3],'sort'=>$val[4]);
            }
        }
    }
    return $flashdb;
}
/**
 * 获得最新的文章列表。
 *
 * @access  private
 * @return  array
 */
function index_get_new_articles()
{
    $sql = 'SELECT a.article_id, a.title, ac.cat_name, a.add_time, a.file_url, a.open_type, ac.cat_id, ac.cat_name ' .
        ' FROM ' . $GLOBALS['ecs']->table('article') . ' AS a, ' .
        $GLOBALS['ecs']->table('article_cat') . ' AS ac' .
        ' WHERE a.is_open = 1 AND a.cat_id = ac.cat_id AND ac.cat_type = 1 AND ac.cat_id=12' .
        ' ORDER BY a.article_type DESC, a.add_time DESC LIMIT 3' ;
    $res = $GLOBALS['db']->getAll($sql);

    $arr = array();
    foreach ($res AS $idx => $row)
    {
        $arr[$idx]['id']          = $row['article_id'];
        $arr[$idx]['title']       = $row['title'];
        $arr[$idx]['short_title'] = $GLOBALS['_CFG']['article_title_length'] > 0 ?
        sub_str($row['title'], $GLOBALS['_CFG']['article_title_length']) : $row['title'];
        $arr[$idx]['cat_name']    = $row['cat_name'];
        $arr[$idx]['add_time']    = local_date($GLOBALS['_CFG']['date_format'], $row['add_time']);
        $arr[$idx]['url']         = 'article.php?act=detail&amp;a_id='.$row['article_id'];
    }

    return $arr;
}
?>
