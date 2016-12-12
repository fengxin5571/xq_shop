<?php //提交短信
/* $post_data = array();
$post_data['userid'] = '7605';//企业ID
$post_data['account'] ='a10667';//账号
$post_data['password'] = '110667';//密码
$post_data['content'] = '【xinqing】您的验证码是 4529'; 
$post_data['mobile'] = '18636984056';//手机号
$post_data['sendtime'] = ''; //不定时发送，值为0，定时发送，输入格式YYYYMMDDHHmmss的日期值
$url='http://xtx.telhk.cn:8080/sms.aspx?action=send';
$o='';

foreach ($post_data as $k=>$v)
{
   $o.="$k=".urlencode($v).'&';
}
$post_data=substr($o,0,-1);
var_dump($post_data);
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
$result = curl_exec($ch);
$res=xml_to_array($result);
var_dump($res);


function xml_to_array($xml){
    $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
    if(preg_match_all($reg, $xml, $matches)){
        $count = count($matches[0]);
        for($i = 0; $i < $count; $i++){
            $subxml= $matches[2][$i];
            $key = $matches[1][$i];
            if(preg_match( $reg, $subxml )){
                $arr[$key] = xml_to_array( $subxml );
            }else{
                $arr[$key] = $subxml;
            }
        }
    }
    return @$arr;
} */
if(strpos("http://gd4.alicdn.com/bao/uploaded/i4/1648889331/TB2jlKcpVXXXXc9XXXXXXXXXXXX_!!1648889331.jpg","http")===0){
var_dump(strpos("https://gd4.alicdn.com/bao/uploaded/i4/1648889331/TB2jlKcpVXXXXc9XXXXXXXXXXXX_!!1648889331.jpg","http"));
}
?>
