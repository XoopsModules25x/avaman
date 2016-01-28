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
 * @copyright    XOOPS Project (http://xoops.org)
 * @license   {@link http://www.gnu.org/licenses/gpl-2.0.html GNU Public License}
 * @package    Avaman
 * @since      2.5.0
 * @author     GIJOE
 * @version    $Id $
 */

$xoopsPath = dirname(dirname(dirname(__DIR__)));
include_once $xoopsPath . '/mainfile.php';
include_once $xoopsPath . '/include/cp_functions.php';
require_once $xoopsPath . '/include/cp_header.php';

global $xoopsModule;

$moduleDirName = $GLOBALS['xoopsModule']->getVar('dirname');

// Load language files
xoops_loadLanguage('admin', $moduleDirName);
xoops_loadLanguage('modinfo', $moduleDirName);
xoops_loadLanguage('main', $moduleDirName);
xoops_loadLanguage('main', $moduleDirName);

$pathIcon16 = '../'.$xoopsModule->getInfo('icons16');
$pathIcon32 = '../'.$xoopsModule->getInfo('icons32');
$pathModuleAdmin = $xoopsModule->getInfo('dirmoduleadmin');

include_once $GLOBALS['xoops']->path($pathModuleAdmin.'/moduleadmin.php');
