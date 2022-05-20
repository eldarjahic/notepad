<?php
/**
 * @OA\Get(path="/notes", tags={"note"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all user notes from the API. ",
 *         @OA\Response( response=200, description="List of notes.")
 * )
 */

Flight::route('GET /notes', function(){
  Flight::json(Flight::noteService()->get_all());

});

/**
 * @OA\Get(path="/notes/{id}", tags={"notes"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="Id of note"),
 *     @OA\Response(response="200", description="Fetch individual note")
 * )
 */

Flight::route('GET /notes/@id', function($id){
  Flight::json(Flight::noteService() -> get_by_id($id));
});

/**
 * @OA\Get(path="/notes/{id}/notes", tags={"note"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="List notes"),
 *     @OA\Response(response="200", description="Fetch note's ")
 * )
 */

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
