<?php
define('DT_REWRITE', true);
require 'config.inc.php';
require '../common.inc.php';
if(!cityid) $cityid = 25;
require DT_ROOT.'/module/'.$module.'/list.inc.php';
?>
