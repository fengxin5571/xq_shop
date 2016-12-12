<?php

/**
 * ECSHOP 商品页


 * ============================================================================
 * $Author: liuhui $
 * $Id: buy.php 17063 2010-03-25 06:35:46Z liuhui $
*/

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
$smarty->assign('footer', get_footer());
$smarty->display('buy.wml');

?>