<?php
include('config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add movie</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div>
            <label for="name">Title:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required><br><br>
        </div>
        <div>
            <label for="duration">Duration:</label>
            <input type="text" id="duration" name="duration" required>
        </div>
        <button type="submit" name="submit">Add Movie</button>
    </form>
</body>
</html>

<?php
if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $duration = mysqli_real_escape_string($connect, $_POST['duration']);

    
    $target_dir = "image/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $image = $target_file;

    
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        
            $sql = "INSERT INTO movies (image, name, duration) VALUES ('$image', '$name', '$duration')";
            if (mysqli_query($connect, $sql)) {
                header('Location: fetchmovies.php');
                exit;
            } else {
                echo "Error: " . mysqli_error($connect);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
}
?>
