<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__ .'/dao/UserDao.class.php';
require_once __DIR__ .'/services/NoteService.php';

Flight::register('noteService', 'NoteService');
Flight::register('userDao', 'UserDao');

//MIDDLEWARE METHOD FOR LOGIN
Flight::route('/*', function(){
  $path = Flight::request()->url;
  if($path == '/login' || $path == "/docs.json") return TRUE;
  $headers = getallheaders();
  if(@!$headers['Authorization']){
    return FALSE;
  }else{
    try {
      $decoded = (array)JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
      Flight::set('user', $decoded);
      return TRUE;
    } catch (\Exception $e) {
      Flight::json(["message" => "Authorization token is not valid"], 403);
      return FALSE;

    }

  }


});
Flight::route('GET /docs.json', function(){
  $openapi = \OpenApi\scan('routes');
  header('Content-Type: application/json');
  echo $openapi->toJson();

});


require_once 'routes/NoteRoutes.php';
require_once 'routes/UserRoutes.php';

Flight::start();

?>
