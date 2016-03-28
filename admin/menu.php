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
$module_handler  = xoops_getHandler('module');
$module          = $module_handler->getByDirname($dirname);
$pathIcon32      = $module->getInfo('icons32');
$pathModuleAdmin = $module->getInfo('dirmoduleadmin');
$pathLanguage    = $path . $pathModuleAdmin;

if (!file_exists($fileinc = $pathLanguage . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/' . 'main.php')) {
    $fileinc = $pathLanguage . '/language/english/main.php';
}

include_once $fileinc;


$adminmenu[] = array(
    'title' => _AM_MODULEADMIN_HOME,
    'link'  => 'admin/index.php',
    'icon'  => $pathIcon32.'/home.png'
);

$adminmenu[] = array(
    'title' => _MI_AVAMAN_AVATARMANAGER,
    'link'  => 'admin/avatars.php',
    'icon'  => $pathIcon32.'/penguin.png'
);

$adminmenu[] = array(
    'title' => _MI_AVAMAN_SMILIESMANAGER,
    'link'  => 'admin/smilies.php',
    'icon'  => $pathIcon32.'/face-smile.png'
);

$adminmenu[] = array(
    'title' => _AM_MODULEADMIN_ABOUT,
    'link'  => 'admin/about.php',
    'icon'  => $pathIcon32.'/about.png'
);
