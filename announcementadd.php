<?php

require "includes/dbh.inc.php";
require 'header.php';
?>

<?php


 ?>




<form name="form1" method="post" action="announcementadd.php?a=edit&id=<?php$id?>&update=1">
  <table width="50%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="50%">Employee ID</td>
      <td><input name="empID" type="text" id="empID" value="<?=$row->empID?>"></td>
    </tr>
    <tr>
      <td>Subject</td>
      <td><input name="subject" type="text" id="subject" value="<?=$row->subject?>"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Title</td>
      <td><input name="title" type="text" id="title" value="<?=$row->title?>"></td>
    </tr>
    <tr>
      <td>Text</td>
      <td><textarea name="text" id="text" value="<?=$row->text?>"></textarea></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
          <input name="hiddenField" type="hidden" value="update">
          <input name="add" type="submit" id="add" value="Update">
        </div></td>
    </tr>
  </table>
  </form>
<?php
/*}*/
?>
