<?php

/**
 * ECSHOP 短消息文件


 * ============================================================================
 * $Author: liuhui $
 * $Id: pm.php 17063 2010-03-25 06:35:46Z liuhui $
*/

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');

if (empty($_SESSION['user_id']))
{
    ecs_header('Location:./');
}

uc_call("uc_pm_location", array($_SESSION['user_id']));
//$ucnewpm = uc_pm_checknew($_SESSION['user_id']);
//setcookie('checkpm', '');

?>