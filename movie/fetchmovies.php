<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include('config.php');

// Fetch movie data from the database
$sql = "SELECT * FROM movies";
$result = mysqli_query($connect, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<button><a href="addmovies.php"><h2>Add Movie</h2></a></button>

<h2>Movie List</h2>
<table>
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>image</th>
            <th>duration</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
        $select = "SELECT * FROM movies";
        $result4 = mysqli_query($connect,$select);
        while($row = mysqli_fetch_array($result4))
        {
   ?>
   <tr>
    <td><?php echo $row['id'];?></td>
    <td><?php echo $row['name'];?></td>
    <td><img src="<?php echo $row['image'];?>" alt="Movie Image" style="max-width: 100px;"></td>
    <td><?php echo $row['duration'];?></td>
    <td><a href="editmovie.php?id=<?php echo $row['id'];?>" class= "btn btn-danger">Edit</a></td>
    <td><a href="deletemovie.php?id=<?php echo $row['id'];?>" class= "btn btn-danger">Delete</a></td>
   </tr>
   <?php } ?>
    </tbody>
</table>

</body>
</html>
