<?php
$link=mysqli_connect("localhost","root","","studentdb");
if(!$link)
{
echo "Error: Unable to connect to MySQL." . PHP_EOL;
echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
exit;
}
$studs=simplexml_load_file("studentss.xml");
foreach($studs as $stud)
{
$name = $stud->name;
$class = $stud->class;
$address = $stud->address;

$sql = "INSERT into student (name,class,address) values('$name','$class','$address')";

if (mysqli_query($link, $sql)) {
 } else {
    echo "Error: " . $sql . "" . mysqli_error($link);
 }
}

echo "data trasfered to database";
?>