<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::route('POST /login', function(){

  $login = Flight::request()->data->getData();

  $user = Flight::userDao()->get_user_by_email($login ["email"]);
  if(isset($user["id"])){
    $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');
    Flight::json (["token" => $jwt]);
  }else{
    Flight::json (["massage" => "User dosent exist"], 404);

  }

});

?>
