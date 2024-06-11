<?php
$username = "root";
$host = "localhost";
$password ="";
$db = "movietheater";

$connect =mysqli_connect($host,$username,$password,$db);
if($connect==true){
    echo "<script>alert('database connection successfully')</script>";
}
else{
    echo "<script>alert('database connection successfully')</script>";
}

?>