<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'dao/NotepadDao.class.php';
require_once '../vendor/autoload.php';
Flight::register('notepadDao', 'NotepadDao');

Flight::route('GET /notes', function(){
  Flight::json(Flight::notepadDao()->getAll());

});

Flight::route('GET /notes/@id', function($id){
  Flight::json(Flight::notepadDao() -> get_by_id($id));
});

Flight::route('POST /notes', function(){
  Flight::json (Flight::notepadDao()->add(Flight::request()->data->getData()));
});

Flight::route('PUT /notes/@id', function($id){
  $data = Flight::request()->data->getData();
  $data['id'] = $id;
  Flight::json(Flight::notepadDao()->update($data));


});

Flight::route('DELETE /notes/@id', function($id){
  Flight::notepadDao()->delete($id);
  Flight::json(["massage" => "deleted"]);
});



Flight::start();

?>
