<?php/*
if(!isset($update)){
$link = @mysql_connect(localhost, username, password);
if(!$link){
   echo('Error connecting to the database: ' . $mysql_error());
   exit();
}
$db = @mysql_selectdb('496');
if(!$db){
   echo('Error selecting database: ' . $mysql_error());
   exit();
}
$query = "SELECT empID, subject, title, text FROM announcement WHERE id = '$id'";
$result = @mysql_query($query);
if(!$result){
   echo('Error selecting news item: ' . $mysql_error());
   exit();
}
mysql_fetch_object($result);*/
require "includes/dbh.inc.php";
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
