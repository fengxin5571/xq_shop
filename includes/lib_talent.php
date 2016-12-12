<?php

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}
$educations = array('1'=>'初中', '2'=>'高中', '3'=>'中技', '4'=>'中专', '5'=>'大专', '6'=>'本科', '7'=>'硕士', '8'=>'博士', '9'=>'其他');
$experience = array('1'=>'在读学生', '2'=>'应届毕业生', '3'=>'1年', '4'=>'2年', '5'=>'3-4年', '6'=>'5-7年', '7'=>'8-9年', '8'=>'10年以上');



/* 获得人才列表 */
function get_talentlist()
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
        $filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'a.talent_id' : trim($_REQUEST['sort_by']);
        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);

        $where = '';
        if (!empty($filter['keyword']))
        {
            $where = " AND a.name LIKE '%" . mysql_like_quote($filter['keyword']) . "%'";
        }
        if ($filter['cat_id'])
        {
            $where .= " AND a.cat_id = " . $filter['cat_id'];
        }

        /* 人才总数 */
        $sql = 'SELECT COUNT(*) FROM ' .$GLOBALS['ecs']->table('talent'). ' AS a '.
               'LEFT JOIN ' .$GLOBALS['ecs']->table('talent_cat'). ' AS ac ON ac.cat_id = a.cat_id '.
               'WHERE 1 ' .$where;
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);

        $filter = page_and_size($filter);

        /* 获取人才数据 */
        $sql = 'SELECT a.* , ac.cat_name '.
               'FROM ' .$GLOBALS['ecs']->table('talent'). ' AS a '.
               'LEFT JOIN ' .$GLOBALS['ecs']->table('talent_cat'). ' AS ac ON ac.cat_id = a.cat_id '.
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
function upload_talent_file($upload)
{
    if (!make_dir("../" . DATA_DIR . "/talent"))
    {
        /* 创建目录失败 */
        return false;
    }

    $filename = cls_image::random_filename() . substr($upload['name'], strpos($upload['name'], '.'));
    $path     = ROOT_PATH. DATA_DIR . "/talent/" . $filename;

    if (move_upload_file($upload['tmp_name'], $path))
    {
        return DATA_DIR . "/talent/" . $filename;
    }
    else
    {
        return false;
    }
}


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


function get_cat_talent($cat_id, $page = 1, $size = 10, $rank = 0)
{
    global $educations, $experience, $db, $ecs;
    //取出所有非0的文章
    $cat_str = '';
    if ($cat_id > 0)
    {
        $cat_str .= ' AND cat_id = ' . $cat_id;
    }

    if ($rank > 0) {
        
    }

    if ($rank) {
        $res = $db->getRow("SELECT * FROM " . $ecs->table('user_rank') . " WHERE rank_id = $rank" );
        $result = $db->getAll("SELECT rank_id FROM " . $ecs->table('user_rank') . " WHERE type_id = $res[type_id] and price <= '$res[price]'");
        $ranks = array();
        if ($result) {
            foreach ($result as $key => $value) {
                array_push($ranks, $value['rank_id']);
            }
        }

        $cat_str .= ' AND level IN('. implode(',', $ranks) . ')';
    }


    $sql = 'SELECT *' .
           ' FROM ' .$GLOBALS['ecs']->table('talent') .
           ' WHERE is_open = 1  ' . $cat_str .
           ' ORDER BY add_time DESC, talent_id DESC';

    $res = $GLOBALS['db']->selectLimit($sql, $size, ($page-1) * $size);

    $arr = array();
    if ($res)
    {
        while ($row = $GLOBALS['db']->fetchRow($res))
        {
            $talent_id = $row['talent_id'];

            $arr[$talent_id]['id']          = $talent_id;
            $arr[$talent_id]['name']        = $row['name'];
            $arr[$talent_id]['address']     = $row['address'];
            $arr[$talent_id]['purpose']     = $row['purpose'];
            $arr[$talent_id]['img_url']     = $row['img_url'];
            $arr[$talent_id]['experience']  = $experience[$row['experience']];
            $arr[$talent_id]['education']   = $educations[$row['education']];
            $arr[$talent_id]['age']         = getAge($row['birthday']);
            $arr[$talent_id]['url']         = build_uri('talent_show', array('aid'=>$talent_id), $row['name']);
            
        }
    }

    return $arr;
}

function  getAge($birthday) {
    $age = date('Y', time()) - date('Y', $birthday) - 1;  
    if (date('m', time()) == date('m', $birthday)){  
        if (date('d', time()) > date('d', $birthday)){  
            $age++;  
        }  
    } elseif (date('m', time()) > date('m', $birthday)){  
        $age++;  
    }  
    return $age;  
}


function get_talent_count($cat_id, $rank = 0)
{
    global $db, $ecs;
    $rankStr = '';
    if ($rank) {
        $res = $db->getRow("SELECT * FROM " . $ecs->table('user_rank') . " WHERE rank_id = $rank" );
        $result = $db->getAll("SELECT rank_id FROM " . $ecs->table('user_rank') . " WHERE type_id = $res[type_id] and price <= '$res[price]'");
        $ranks = array();
        if ($result) {
            foreach ($result as $key => $value) {
                array_push($ranks, $value['rank_id']);
            }
        }
        $rankStr =  implode(',', $ranks);
    }
    $count = $db->getOne("SELECT COUNT(*) FROM " . $ecs->table('talent') . " 
             WHERE 1=1 " . ($cat_id>0 ? " AND cat_id = $cat_id" : '') . " AND is_open = 1 
              " . ($rank>0 ? " AND level in ($rankStr) " : ''));
    return $count;
}


function str_split_php5_utf8($str) { 
    $split=1; 
    $array = array(); 
    for ( $i=0; $i < strlen( $str ); ){ 
        $value = ord($str[$i]); 
        if($value > 127){ 
            if($value >= 192 && $value <= 223) 
                $split=2; 
            elseif($value >= 224 && $value <= 239) 
                $split=3; 
            elseif($value >= 240 && $value <= 247) 
                $split=4; 
        }else{ 
            $split=1; 
        } 
            $key = NULL; 
        for ( $j = 0; $j < $split; $j++, $i++ ) { 
            $key .= $str[$i]; 
        } 
        array_push( $array, $key ); 
    } 
    return $array; 
}

?>