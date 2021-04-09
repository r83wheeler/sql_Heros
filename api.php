<?php

$servername = "localhost";
$username = "root";
$password = "changeme";
$dbname = "sqlheroes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$route = $_GET['route'];

function createHero ($conn){
  
  $sql = "INSERT INTO heroes (id, name, about_me, biography, image_url)
  VALUES ('7','Dart Man','Is hella fast', 'Was born fast, will die fast', 'Null')";

  if ($conn->query($sql) === TRUE) {
    $record = "{'success':'created new hero'}"; // needs the data from the created record
  } else {
    echo "{'error': '" . $sql . " - " . $conn->error . "'}";
  }
  
  return json_encode([$record]);
}

function getAllHeroes($conn){
  $data=array();
  
  $sql = "SELECT * FROM heroes";
  $result = $conn->query($sql);
  
   // blank array
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
//          unset($row['nombre']);
         array_push($data,$row); // push rows to array $myData
      }
  } 
  
  return json_encode($data);
}

function getHeroByID ($conn, $heroID){
  $data=array();
  
  $sql = "SELECT * FROM heroes WHERE id = " . $heroID;
  $result = $conn->query($sql);

  // blank array
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
//          unset($row['nombre']);
         array_push($data,$row); // push rows to array $myData
      }
  } 
  
  return json_encode($data);
}

function deleteHero ($conn){
  $sql = "DELETE FROM heroes WHERE id=7";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}
}



// this function updates an ability.  It takes two parameters: the connection and the hero's id to update the ability in the database
function updateAbility ($conn) {
  $sql = "UPDATE ability_hero SET ability_id='8' WHERE hero_id=2";

if (mysqli_query($conn, $sql)) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . mysqli_error($conn);
}
 
}

function updateHeroBio ($conn, $biography, $newHeroBioId) {
  
  $sql = "INSERT INTO heroes  = (biography)
  VALUES ('Able to see 5 seconds into the future')";
    $result = $conn->query($sql);
  
  return json_encode($result);
}

switch ($route) {
  case "getAllHeroes":
    $myData = getAllHeroes($conn);
    break;
  case "createHero":
    $myData = createHero($conn);
    break;
  case "getHeroByID":
    //
    $id = $_GET["hero_id"];
    $myData = getHeroByID($conn, $id);
    break;
    
  case "updateAbility":
    $myData = updateAbility($conn);
    break;
    
  case "updateHero":
    $myData = updateHero($conn);
    break;
    
    case "deleteHero":
    $myData = deleteHero($conn);
    break;
  default:
   $myData = json_encode([]);
}

echo $myData;

$conn->close();


?>