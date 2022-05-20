<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
* @OA\Post(
*     path="/login",
*     description="Login to the system",
*     tags={"note"},
*     @OA\RequestBody(description="Basic user information", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				 @OA\Property(property="email", type="string", example="eldar.jahic@stu.ibu.edu.ba",	description="Email" ),
*    				 @OA\Property(property="password", type="string", example="1234",	description="Password" )
*          )
*       )),
*     @OA\Response(
*         response=200,
*         description="jwt Token on successful response"
*
*     ),
*     @OA\Response(
*         response="404",
*         description="Wrong Password | User does not exist"
*
*     )
* )
*/

Flight::route('POST /login', function(){

  $login = Flight::request()->data->getData();

  $user = Flight::userDao()->get_user_by_email($login ["email"]);
  if(isset($user["id"])){
    if($user['password'] == md5 ($login['password'])){
      unset ($user['password']);

      $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');
      Flight::json(['token' => $jwt]);
    }else{
      Flight::json(["message" => "Wrong password"], 404);
    }

  }else{
    Flight::json (["message" => "User dosent exist"], 404);

  }

});

?>
