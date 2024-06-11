<?php
include("config.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>banner Data</title>
    <link rel="icon" href="https://static.vecteezy.com/system/resources/previews/000/505/524/original/vector-male-student-icon-design.jpg">
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<body>
<div class="container">
<button><a href="add.php">Add new slides</a></button>
<table class="table table-danger table-hover">
  <thead>
    <tr>
      <th scope="col"> id</th>
      <th scope="col">Image</th>
      <th colspan= "2" align ="center">Action</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
   <?php
   include('config.php');
   $select8 = "SELECT * FROM slides";
   $result8 = mysqli_query($connect,$select8);
   while($row = mysqli_fetch_array($result8))
   {
   ?>
   <tr>
    <td><?php echo $row['slide_id'];?></td>
    <td><?php echo $row['slide_img'];?></td>
    <td><a href="editslide.php?id=<?php echo $row['slide_id'];?>" class= "btn btn-danger">Edit</a></td>
    <td><a href="deleteslide.php?id=<?php echo $row['slide_id'];?>" class= "btn btn-danger">Delete</a></td>


   </tr>
   <?php } ?>
  </tbody>
</table>
</div>
</form>
    
</body>
</html>