<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../vendor/autoload.php';
require_once 'dao/NoteDao.class.php';


require_once 'services/NoteService.php';

Flight::register('noteService', 'NoteService');


require_once 'routes/NoteRoutes.php';

Flight::start();

?>
