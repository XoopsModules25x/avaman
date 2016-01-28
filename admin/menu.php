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

/*
 * Avaman module
 *
 * @copyright    XOOPS Project (http://xoops.org)
 * @license   {@link http://www.gnu.org/licenses/gpl-2.0.html GNU Public License}
 * @package    Avaman
 * @since      2.5.0
 * @author     GIJOE
 * @version    $Id $
 */

// defined('XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');

$path = dirname(dirname(dirname(__DIR__)));
include_once $path . '/mainfile.php';

$dirname         = basename(dirname(__DIR__));
$module_handler  = & xoops_gethandler('module');
$module          = $module_handler->getByDirname($dirname);
$pathIcon32      = $module->getInfo('icons32');
$pathModuleAdmin = $module->getInfo('dirmoduleadmin');
$pathLanguage    = $path . $pathModuleAdmin;

if (!file_exists($fileinc = $pathLanguage . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/' . 'main.php')) {
    $fileinc = $pathLanguage . '/language/english/main.php';
}

include_once $fileinc;

$adminmenu = array();

$i= 1;

$adminmenu[$i]["title"] = _AM_MODULEADMIN_HOME;
$adminmenu[$i]["link"]  = 'admin/index.php';
$adminmenu[$i]["icon"]  = $pathIcon32 . '/home.png';

++$i;
$adminmenu[$i]["title"] = _MI_AVAMAN_AVATARMANAGER;
$adminmenu[$i]["link"]  = 'admin/avatars.php';
$adminmenu[$i]["icon"]  = $pathIcon32.'/penguin.png';

++$i;
$adminmenu[$i]["title"] = _MI_AVAMAN_SMILIESMANAGER;
$adminmenu[$i]["link"]  = 'admin/smilies.php';
$adminmenu[$i]["icon"]  = $pathIcon32.'/face-smile.png';

++$i;
$adminmenu[$i]['title'] = _AM_MODULEADMIN_ABOUT;
$adminmenu[$i]["link"]  = 'admin/about.php';
$adminmenu[$i]["icon"]  = $pathIcon32 . '/about.png';
