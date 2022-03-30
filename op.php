<?php
require_once("rest/dao/NotepadDao.class.php");

$dao = new NotepadDao();

$op = $_REQUEST['op'];

switch ($op) {
  case 'insert':
    $description = $_REQUEST['description'];
    $created = $_REQUEST['created'];
    $dao->add($description, $created);
    break;

  case 'delete':
    $id = $_REQUEST['id'];
    $dao->delete($id);
    echo "DELETED $id";
    break;

  case 'update':
    $id = $_REQUEST['id'];
    $description = $_REQUEST['description'];
    $created = $_REQUEST['created'];
    $dao->update($id, $description, $created);
    echo "UPDATED $id";
    break;

  case 'get':
    $results = $dao->getAll();
    print_r($results);
    break;

  default:
    $results = $dao->getAll();
    print_r($results);
    break;
}
?>
