<?php
class NotepadDao{
private $conn;

public function __construct (){
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $schema = "webprog";


  $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
  // set the PDO error mode to exception
  $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


}
public function getAll(){
  $stmt = $this->conn->prepare("SELECT * FROM webprog.webprog");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
public function get_by_id($id){
    $stmt = $this->conn->prepare("SELECT * FROM webprog.webprog WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return @reset($result);

}

public function add($pad){
  $stmt = $this->conn->prepare("INSERT INTO webprog.webprog (description, created) VALUES (:description, :created)");
  //$stmt->execute(['description' => $description,'created' => $created ]); //another way to prevent sql in
  $stmt->execute($pad);
}
public function delete($id){
  $stmt = $this->conn->prepare("DELETE FROM  webprog.webprog WHERE id=:id");
  $stmt->bindParam(':id', $id); //sql injection prevention
  $stmt->execute();

}
public function update($pad){
  $stmt = $this->conn->prepare("UPDATE webprog.webprog SET description= :description, created= :created  WHERE id= :id");
  $stmt->execute($pad);
  return $pad;
}

}


 ?>
