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

echo "<div class='adminfooter'>\n"
    ."  <div style='text-align: center;'>\n"
    ."    <a href='http://xoops.org' rel='external'><img src='{$pathIcon32}/xoopsmicrobutton.gif' alt='XOOPS' title='XOOPS'></a>\n"
    ."  </div>\n"
    ."  " . _AM_MODULEADMIN_ADMIN_FOOTER . "\n"
    ."</div>";

xoops_cp_footer();
