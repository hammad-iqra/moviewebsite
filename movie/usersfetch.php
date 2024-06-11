
<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>userData</title>
    <link rel="icon" href="https://static.vecteezy.com/system/resources/previews/000/505/524/original/vector-male-student-icon-design.jpg">
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<body>
<div class="container">
<a href="registration.php" class = "btn btn-success"> Add user Data</a><br><br>
<table class="table table-danger table-hover">
  <thead>
    <tr>
      <th scope="col"> User id</th>
    <th scope="col">Username</th>
    <th scope="col">email</th>
      <th scope="col">Password</th>
      <th scope="col">Admin/User</th>
      <th colspan= "2" align ="center">Action</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
   <?php
   include('config.php');
   $select = "SELECT * FROM users INNER JOIN roles ON users.role_id = roles.role_id;";
   $result4 = mysqli_query($connect,$select);
   while($row = mysqli_fetch_array($result4))
   {
   ?>
   <tr>
    <td><?php echo $row['id'];?></td>
    <td><?php echo $row['username'];?></td>
    <td><?php echo $row['email'];?></td>
    <td><?php echo $row['password'];?></td>
    <td><?php echo $row['role_id'];?></td>
    <td><a href="update.php?id=<?php echo $row['id'];?>" class= "btn btn-danger">Edit</a></td>
    <td><a href="delete.php?id=<?php echo $row['id'];?>" class= "btn btn-danger">Delete</a></td>


   </tr>
   <?php } ?>
  </tbody>
</table>
</div>
    
</body>
</html>