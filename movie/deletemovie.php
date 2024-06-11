<?php
include("config.php");



$id = $_REQUEST['id'];
$delete2 = "DELETE FROM movies WHERE id = '$id'";
$result6 = mysqli_query($connect, $delete2);
if($result6 == true){
    header('location:fetchmovies.php');
    
 
}
else{
    echo "<script>alert('your data not deleted successfully')</script>";
}
?>
