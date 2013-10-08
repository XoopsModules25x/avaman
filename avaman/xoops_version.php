<?php
/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Avaman module
 *
 * @copyright    The XOOPS Project (http://www.xoops.org)
 * @license   {@link http://www.gnu.org/licenses/gpl-2.0.html GNU Public License}
 * @package    Avaman
 * @since      2.5.0
 * @author     GIJOE
 * @version    $Id $
 */

$modversion['name'] = _MI_AVAMAN_MODULENAME ;
$modversion['version'] = '0.22' ;
$modversion['description'] = _MI_AVAMAN_MODULEDESC ;
$modversion['credits'] = "PEAK Corp.";
$modversion['author'] = "GIJ=CHECKMATE<br />PEAK Corp.(http://www.peak.ne.jp/)" ;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GNU GPL 2.0';
$modversion['license_url'] = "www.gnu.org/licenses/gpl-2.0.html/";
$modversion['official'] = 0;
$modversion['image'] = "images/avaman_slogo.png";
$modversion['dirname'] = "avaman";

$modversion['dirmoduleadmin'] = '/Frameworks/moduleclasses/moduleadmin';
$modversion['icons16'] = '../../Frameworks/moduleclasses/icons/16';
$modversion['icons32'] = '../../Frameworks/moduleclasses/icons/32';

//about
$modversion['demo_site_url'] = "";
$modversion['demo_site_name'] = "";
$modversion['module_website_url'] = "www.xoops.org";
$modversion['module_website_name'] = "XOOPS";
$modversion['release_date'] = "2012/05/22";
$modversion['module_status'] = "Final";
$modversion["author_website_url"] = "http://www.peak.ne.jp";
$modversion["author_website_name"] = "GIJOE";
$modversion['min_php']='5.2';
$modversion['min_xoops']="2.5.5";
$modversion['min_db']           = array('mysql'=>'5.0.7', 'mysqli'=>'5.0.7');
$modversion['min_admin']        = '1.1';

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";
$modversion['system_menu'] = 1;

// Menu
$modversion['hasMain'] = 0;

// Search
$modversion['hasSearch'] = 0;

// Comments
$modversion['hasComments'] = 0;

// Config Settings (only for modules that need config settings generated automatically)

// Notification

$modversion['hasNotification'] = 0;

?>