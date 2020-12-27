<?php


$mysqli = new mysqli("localhost", "root", "", "studentdb");


if ($mysqli->connect_errno) {

   echo "Connect failed ".$mysqli->connect_error;

   exit();
}

$query = "SELECT id,name,class,address FROM student";

$studsArray = array();

if ($result = $mysqli->query($query)) {

    
    while ($row = $result->fetch_assoc()) {

       array_push($studsArray, $row);
    }
  
    if(count($studsArray)){

         createXMLfile($studsArray);

     }

    
    $result->free();
}


$mysqli->close();

function createXMLfile($studsArray){
  
   $filePath = 'stud.xml';

   $dom     = new DOMDocument('1.0', 'utf-8'); 

   $root      = $dom->createElement('books'); 

   for($i=0; $i<count($studsArray); $i++){
     
     $sid        =  $studsArray[$i]['id'];  

     $sname      =  htmlspecialchars($studsArray[$i]['name']); 

     $sclass    =  $studsArray[$i]['class']; 

     $saddress     =  $studsArray[$i]['address']; 


     $studess = $dom->createElement('book');

     $studess->setAttribute('id', $sid);

     $name     = $dom->createElement('title', $sname); 

     $studess->appendChild($name); 

     $class   = $dom->createElement('class', $sclass); 

     $studess->appendChild($class); 

     $addresss    = $dom->createElement('address', $saddress); 

     $studess->appendChild($addresss); 

     
 
     $root->appendChild($studess);

   }

   $dom->appendChild($root); 

   $dom->save($filePath); 

   echo "data trasfered in xml";
 } 