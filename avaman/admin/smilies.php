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

$avaman_allowed_exts = array(
    'gif' => 'image/gif' ,
    'jpg' => 'image/jpeg' ,
    'jpeg' => 'image/jpeg' ,
    'png' => 'image/png' ,
) ;
$realmyname = 'smilies.php' ;

include_once( '../../../include/cp_header.php' ) ;
include_once "../include/gtickets.php" ;
include_once 'admin_header.php';
$indexAdmin = new ModuleAdmin();

$db =& XoopsDatabaseFactory::getDatabaseConnection();
$myts =& MyTextSanitizer::getInstance() ;

//
// POST Stage
//

if( ! empty( $_POST['modify_smilies'] ) ) {

    // Ticket Check
    if ( ! $xoopsGTicket->check() ) {
        redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
    }

    // rename emotion
    $smiles_ids = array() ;
    if( is_array( @$_POST['emotions'] ) ) {
        foreach( $_POST['emotions'] as $smiles_id => $emotion ) {
            $smiles_id = intval( $smiles_id ) ;
            $db->query( "UPDATE ".$db->prefix("smiles")." SET emotion='".$myts->addSlashes($emotion)."' WHERE id=".intval($smiles_id) ) ;
            $smiles_ids[] = $smiles_id ;
        }
    }

    // code
    foreach( $smiles_ids as $smiles_id ) {
        $db->query( "UPDATE ".$db->prefix("smiles")." SET code='".$myts->addSlashes(@$_POST['codes'][$smiles_id])."' WHERE id=$smiles_id" ) ;
    }

    // display
    foreach( $smiles_ids as $smiles_id ) {
        if( empty( $_POST['displays'][$smiles_id] ) ) {
            $db->query( "UPDATE ".$db->prefix("smiles")." SET display=0 WHERE id=$smiles_id" ) ;
        } else {
            $db->query( "UPDATE ".$db->prefix("smiles")." SET display=1 WHERE id=$smiles_id" ) ;
        }
    }

    // delete
    foreach( $smiles_ids as $smiles_id ) {
        if( ! empty( $_POST['deletes'][$smiles_id] ) ) {
            $result = $db->query( "SELECT smile_url FROM ".$db->prefix("smiles")." WHERE id=$smiles_id" ) ;
            if( $result ) {
                list( $file ) = $db->fetchRow( $result ) ;
                if( strstr( $file , '..' ) ) die( '.. found.' ) ;
                @unlink( XOOPS_UPLOAD_PATH . '/' . $file ) ;
                $db->query( "DELETE FROM ".$db->prefix("smiles")." WHERE id=$smiles_id" ) ;
            }
        }
    }

    redirect_header( $realmyname , 2 , _AM_AVAMAN_DBUPDATED ) ;
    exit ;
}

// ARCHIVE UPLOAD
if( ! empty( $_FILES['upload_archive']['tmp_name'] ) && is_uploaded_file( $_FILES['upload_archive']['tmp_name'] ) ) {

    // extract stage
    $orig_filename4check = strtolower( $_FILES['upload_archive']['name'] ) ;
    $orig_ext4check = substr( $orig_filename4check , strrpos( $orig_filename4check , '.' ) + 1 ) ;
    if( $orig_ext4check == 'zip' ) {
    
        // zip
        include_once dirname(dirname(__FILE__)).'/include/Archive_Zip.php' ;
        $reader = new Archive_Zip( $_FILES['upload_archive']['tmp_name'] ) ;
        $files = $reader->extract( array( 'extract_as_string' => true ) ) ;
        if( ! is_array( @$files ) ) die( $reader->errorName() ) ;
    
    } else if( $orig_ext4check == 'tar' || $orig_ext4check == 'tgz' || $orig_ext4check == 'gz' ) {
    
        // tar or tgz or tar.gz
        include_once XOOPS_ROOT_PATH.'/class/class.tar.php' ;
        $tar = new tar() ;
        $tar->openTar( $_FILES['upload_archive']['tmp_name'] ) ;
        $files = array() ;
        foreach( $tar->files as $id => $info ) {
            $files[] = array(
                'filename' => $info['name'] ,
                'mtime' => $info['time'] ,
                'content' => $info['file'] ,
            ) ;
        }
        if( empty( $files ) ) die( _AM_AVAMAN_ERR_INVALIDARCHIVE ) ;

    } else if( ! empty( $avaman_allowed_exts[$orig_ext4check] ) ) {
    
        // a single image file
        $files = array() ;
        $files[] = array(
            'filename' => $_FILES['upload_archive']['name'] ,
            'mtime' => time() ,
            'content' => function_exists( 'file_get_contents' ) ? file_get_contents( $_FILES['upload_archive']['tmp_name'] ) : implode( file( $_FILES['upload_archive']['tmp_name'] ) ) ,
        ) ;
    } else {
        die( _AM_AVAMAN_INVALIDEXT ) ;
    }

    // import stage
    $imported = 0 ;
    foreach( $files as $file ) {
    
        if( ! empty( $file['folder'] ) ) continue ;
        $file_pos = strrpos( $file['filename'] , '/' ) ;
        $file_name = $file_pos === false ? $file['filename'] : substr( $file['filename'] , $file_pos + 1 ) ;
        $ext_pos = strrpos( $file_name , '.' ) ;
        if( $ext_pos === false ) continue ;
        $ext = strtolower( substr( $file_name , $ext_pos + 1 ) ) ;
        if( empty( $avaman_allowed_exts[$ext] ) ) continue ;
        $file_node = substr( $file_name , 0 , $ext_pos ) ;
        $save_file_name = uniqid( 'smil' ) . '.' . $ext ;
        $fw = fopen( XOOPS_UPLOAD_PATH.'/'.$save_file_name , "w" ) ;
        if( ! $fw ) continue ;
        @fwrite( $fw , $file['content'] ) ;
        @fclose( $fw ) ;
        $db->query( "INSERT INTO ".$db->prefix("smiles")." SET smile_url='".addslashes($save_file_name)."', code='".addslashes(rawurldecode($file_node))."', display=0, emotion=''" ) ;

        $imported ++ ;
    }
    
    redirect_header( $realmyname , 3 , sprintf( _AM_AVAMAN_FILEUPLOADED , $imported )  ) ;
    exit ;
}

// Form Stage
xoops_cp_header() ;
echo $indexAdmin->addNavigation('smilies.php');

//include(dirname(__FILE__).'/mymenu.php');

$sql = "SELECT id , code , smile_url , emotion , display FROM ".$db->prefix("smiles")." ORDER BY id" ;
$result = $db->query( $sql ) ;

echo "
<form action='$realmyname' id='avaman_upload' method='post' enctype='multipart/form-data' class='odd'>
	<label for='upload_archive'>"._AM_AVAMAN_UPLOAD."</label>
	<br />
	<input type='file' id='upload_archive' name='upload_archive' size='60' />
	<input type='submit' value='"._SUBMIT."' />
</form>
<form action='$realmyname' name='avaman_list' id='avaman_list' method='post'>
<table class='outer' id='avaman_main'>
	<tr>
		<th>"._AM_AVAMAN_TH_ID."</th>
		<th>"._AM_AVAMAN_TH_FILE."</th>
		<th>"._AM_AVAMAN_TH_CODE."</th>
		<th>"._AM_AVAMAN_TH_EMOTION."</th>
		<th>"._AM_AVAMAN_TH_SMILEDISPLAY."</th>
		<th>"._AM_AVAMAN_TH_DELETE."<input type='checkbox' name='selectall' onclick=\"with(document.avaman_list){for(i=0;i<length;i++){if(elements[i].type=='checkbox'&&elements[i].disabled==false&&elements[i].name.indexOf('deletes')>=0){elements[i].checked=this.checked;}}}\" title='"._AM_AVAMAN_CB_SELECTALL."' /></th>
	</tr>\n" ;

while( list( $smiles_id , $code , $file , $emotion , $display ) = $db->fetchRow( $result ) ) {
    $evenodd = @$evenodd == 'even' ? 'odd' : 'even' ;

    echo "
	<tr>
		<td class='$evenodd' align='center'>$smiles_id</td>
		<td class='$evenodd' align='center'><img src='".XOOPS_UPLOAD_URL.'/'.$file."' alt='' /></td>
		<td class='$evenodd' align='center'><input type='text' size='12' name='codes[$smiles_id]' value='".htmlspecialchars($code,ENT_QUOTES)."' /></td>
		<td class='$evenodd' align='center'><input type='text' size='24' name='emotions[$smiles_id]' value='".htmlspecialchars($emotion,ENT_QUOTES)."' /></td>
		<td class='$evenodd' align='center'><input type='checkbox' name='displays[$smiles_id]' ".($display?"checked='checked'":"")." /></td>
		<td class='$evenodd' align='center'><input type='checkbox' name='deletes[$smiles_id]' /></td>
	</tr>\n" ;
}
echo "
</table>
<input type='submit' name='modify_smilies' value='"._SUBMIT."' />
".$xoopsGTicket->getTicketHtml( __LINE__ )."
</form>
" ;

include "admin_footer.php";
