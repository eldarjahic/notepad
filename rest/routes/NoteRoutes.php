<?php

Flight::route('GET /notes', function(){
  Flight::json(Flight::noteService()->get_all());

});

Flight::route('GET /notes/@id', function($id){
  Flight::json(Flight::noteService() -> get_by_id($id));
});

Flight::route('POST /notes', function(){
  $data = Flight::request()->data->getData();

  Flight::json (Flight::noteService()->add($data));
});

Flight::route('PUT /notes/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::noteService()->update($id, $data));


});

Flight::route('DELETE /notes/@id', function($id){
  Flight::noteService()->delete($id);
  Flight::json(["massage" => "deleted"]);
});


?>
