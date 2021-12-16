<?php
$emotion_name = filter_input(INPUT_POST, 'emotion_name');
$response = filter_input(INPUT_POST, 'response');
$severity_level = filter_input(INPUT_POST, 'severity_level');
if (!empty($emotion_name)) {
   if (!empty($response)) {
      if (!empty($severity_level)) {
         $host = "securesql";
         $dbusername = "root";
         $dbpassword = "example";
         $dbname = "emotions";
         // Create connection
         $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
         if (mysqli_connect_error()) {
            die('Connect Error (' . mysqli_connect_errno() . ') '
               . mysqli_connect_error());
         } else {
            $sql = "INSERT INTO emotions (emotion_name, response, severity_level)
   values ('$emotion_name', '$response','$severity_level')";
            if ($conn->query($sql)) {
               echo "Sucessfully inserted";
            } else {
               echo "Error: " . $sql . "
   " . $conn->error;
            }
         }
      } else {
         echo "Severity gap should not be empty";
         die();
      }
   } else {
      echo "Response gap should not be empty";
      die();
   }
} else {
   echo "Emotion name should not be empty";
   die();
}

/** create XML file */

$query = "SELECT id, emotion_name, response, severity_level FROM emotions";
$emotionsArray = array();
if ($result = $conn->query($query)) {
   /* fetch associative array */
   while ($row = $result->fetch_assoc()) {
      array_push($emotionsArray, $row);
   }

   if (count($emotionsArray)) {
      createXMLfile($emotionsArray);
   }
   /* free result set */
   $result->free();
}
/* close connection */
$conn->close();

function createXMLfile($emotionsArray)
{

   $filePath = 'C:\xampp\htdocs\dashboard\project1\responses.xml';
   $dom     = new DOMDocument('1.0', 'utf-8');
   $root      = $dom->createElement('emotions');
   for ($i = 0; $i < count($emotionsArray); $i++) {

      $emotionId        =  $emotionsArray[$i]['id'];
      //$emotionName = htmlspecialchars($emotionsArray[$i]['title']);
      $emotionName    =  $emotionsArray[$i]['emotion_name'];
      $emotionResponse     =  $emotionsArray[$i]['response'];
      $emotionSeverity      =  $emotionsArray[$i]['severity_level'];
      $emotion = $dom->createElement('emotion');
      $emotion->setAttribute('id', $emotionId);
      $name     = $dom->createElement('emotion_name', $emotionName);
      $emotion->appendChild($name);
      $response   = $dom->createElement('response', $emotionResponse);
      $emotion->appendChild($response);
      $severity    = $dom->createElement('severity_level', $emotionSeverity);
      $emotion->appendChild($severity);

      $root->appendChild($emotion);
   }
   $dom->appendChild($root);
   $dom->save($filePath);
}
