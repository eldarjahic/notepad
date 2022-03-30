<?php
require_once("rest/dao/NotepadDao.class.php");
$description = $_REQUEST ['description'];
$created = $_REQUEST ['created'];
$dao = new NotepadDao ();
$results = $dao->add($description, $created);
print_r($results);


?>
