<?php
include("config.php");

$id = $_REQUEST['slide_id'];
$delete = "DELETE FROM slides WHERE id = '$id'";
$result = mysqli_query($connect, $delete);
if($result == true){
    header('location:slides.php');
    
 
}
else{
    echo "<script>alert('your data not deleted successfully')</script>";
}
?>
