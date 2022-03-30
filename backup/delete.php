<?php
require_once("rest/dao/NotepadDao.class.php");
$id = $_REQUEST ['id'];
$dao = new NotepadDao ();
$dao->delete($id);

echo "Deleted $id"


?>
