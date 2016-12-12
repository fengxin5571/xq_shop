<?php
if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

/**
 * 获得视频分类下的视频列表
 *
 * @access  public
 * @param   integer     $cat_id
 * @param   integer     $page
 * @param   integer     $size
 *
 * @return  array
 */
function get_cat_video($cat_id, $page = 1, $size = 20 ,$requirement='')
{
    //取出所有非0的文章
    if ($cat_id == '-1')
    {
        $cat_str = 'cat_id > 0';
    }
    else
    {
        $cat_str = get_video_children($cat_id);
    }
    //增加搜索条件，如果有搜索内容就进行搜索    
    if ($requirement != '')
    {
        $sql = 'SELECT video_id, title, author, add_time, file_url, open_type, video_img, description' .
               ' FROM ' .$GLOBALS['ecs']->table('video') .
               ' WHERE is_open = 1 AND title like \'%' . $requirement . '%\' ' .
               ' ORDER BY video_type DESC, video_id DESC';
    }
    else 
    {
        
        $sql = 'SELECT video_id, title, author, add_time, file_url, open_type,  video_img, description' .
               ' FROM ' .$GLOBALS['ecs']->table('video') .
               ' WHERE is_open = 1 AND ' . $cat_str .
               ' ORDER BY video_type DESC, video_id DESC';
    }

    $res = $GLOBALS['db']->selectLimit($sql, $size, ($page-1) * $size);

    $arr = array();
    if ($res)
    {
        while ($row = $GLOBALS['db']->fetchRow($res))
        {
            $video_id = $row['video_id'];

            $arr[$video_id]['id']          = $video_id;
            $arr[$video_id]['title']       = $row['title'];
            $arr[$video_id]['description'] = $row['description'];
            $arr[$video_id]['video_img']   = $row['video_img'];
            $arr[$video_id]['short_title'] = $GLOBALS['_CFG']['article_title_length'] > 0 ? sub_str($row['title'], $GLOBALS['_CFG']['article_title_length']) : $row['title'];
            $arr[$video_id]['author']      = empty($row['author']) || $row['author'] == '_SHOPHELP' ? $GLOBALS['_CFG']['shop_name'] : $row['author'];
            $arr[$video_id]['url']         = build_uri('video', array('vid'=>$video_id));
            $arr[$video_id]['add_time']    = date($GLOBALS['_CFG']['date_format'], $row['add_time']);
        }
    }
    return $arr;
}

function get_main_cat_video() {
    $sql = 'SELECT v.video_id, v.title, v.description, v.video_img, vc.cat_id, vc.cat_name ' .
                'FROM ' . $GLOBALS['ecs']->table('video') . ' AS v ' . 
                'LEFT JOIN ' . $GLOBALS['ecs']->table('video_cat') . ' AS vc ON(v.cat_id = vc.cat_id) ' .
                "WHERE v.is_open = 1  ORDER BY vc.cat_id ASC, v.add_time DESC";


    $res = $GLOBALS['db']->getAll($sql);
    $cat_videos = array();
    foreach ($res as $row) {
        $cat_videos[$row['cat_id']]['video_id'] = $row['video_id'];
        $cat_videos[$row['cat_id']]['cat_name'] = $row['cat_name'];
        $cat_videos[$row['cat_id']]['cat_url']  = build_uri('video_cat', array('vcid'=>$row['cat_id']));
        $row['url'] = build_uri('video', array('vid'=>$row['video_id']));
        $cat_videos[$row['cat_id']]['products'][] = $row;

    }
    return $cat_videos;
}

function get_cats() {
    $sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('video_cat') . 
                " ORDER BY sort_order ASC, cat_id DESC limit 5";

    $res = $GLOBALS['db']->getAll($sql);
    $cats = array();
    foreach ($res as $row) {
        $row['url'] = build_uri('video_cat', array('vcid'=>$row['cat_id']));
        $cats[] = $row;

    }
    return $cats;
}

/**
 * 获得指定分类下的视频总数
 *
 * @param   integer     $cat_id
 *
 * @return  integer
 */
function get_video_count($cat_id ,$requirement='')
{
    global $db, $ecs;
    if ($requirement != '')
    {
        $count = $db->getOne('SELECT COUNT(*) FROM ' . $ecs->table('video') . ' WHERE ' . get_video_children($cat_id) . ' AND  title like \'%' . $requirement . '%\'  AND is_open = 1');
    }
    else
    {
        $count = $db->getOne("SELECT COUNT(*) FROM " . $ecs->table('video') . " WHERE " . get_video_children($cat_id) . " AND is_open = 1");
    }
    return $count;
}

?>