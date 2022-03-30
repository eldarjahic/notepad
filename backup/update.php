<?php
require_once("rest/dao/NotepadDao.class.php");
$id = $_REQUEST ['id'];
$description = $_REQUEST ['description'];
$created = $_REQUEST ['created'];
$dao = new NotepadDao ();
$dao->update($id, $description, $created);

echo "Updated $id"


?>
