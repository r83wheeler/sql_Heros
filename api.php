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

function createBattle ($conn, $h1, $h2, $w){
  
  $sql = "INSERT INTO battles (hero1, hero2, winner)
  VALUES ($h1, $h2, $w)";

  if ($conn->query($sql) === TRUE) {
    $record = "{'success':'created new battle'}"; // needs the data from the created record
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

// this function updates an ability.  It takes two parameters: the connection and the hero's id to update the ability in the database
function updateAbility ($conn, $heroID, $newAbilityID) {
  
  // query as a string
  $sql="UPDATE ability_hero SET ability_id = '" . $newAbilityID . "' WHERE hero_id='" . $heroID . "'" ; // this is a string
    $result = $conn->query($sql);

  return json_encode($result);
}

function updateHeroBio ($conn, $biography, $newHeroBioId) {
  
  $sql="UPDATE heroes SET biography = '" . $newHeroBioID . "' WHERE biography='" . $biography . "'" ;
    $result = $conn->query($sql);
  
  return json_encode($result);
}

switch ($route) {
  case "getAllHeroes":
    $myData = getAllHeroes($conn);
    break;
  case "createBattle":
    $myData = createBattle($conn, 2, 4, 4);
    break;
  case "getHeroByID":
    //
    $id = $_GET["hero_id"];
    $myData = getHeroByID($conn, $id);
    break;
    
  case "updateAbility":
    $heroID = $_GET["hero_id"];    
    $abilityID = $_GET["ability_hero"];
    $myData = updateAbility($conn, $heroID, $abilityID);
    break;
    
  default:
   $myData = json_encode([]);
}

echo $myData;

$conn->close();


?>