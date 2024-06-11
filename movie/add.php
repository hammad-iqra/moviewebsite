<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Slider Form</title>
</head>
<body>
    <h2>Add a New Slide</h2>
    <form action="<?php echo $_SERVER ['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
        <label for="slide_img">Slide Image:</label>
        <input type="file" id="slide_img" name="slide_img" accept="image/*" required><br><br>

        <button type="submit">Add Slide</button>
    </form>
</body>
</html>
<?php
include('config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $slide_img = $_FILES["slide_img"]["name"];
    $target_dir = "image/";
    $target_file = $target_dir . basename($slide_img);
    
    // Check if the file is a valid image
    $check = getimagesize($_FILES["slide_img"]["tmp_name"]);
    if ($check !== false) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["slide_img"]["tmp_name"], $target_file)) {
            // Insert the slide information into the database
            $sql = "INSERT INTO slides (slide_img) VALUES ('$target_file')";
            
            if ($connect->query($sql) === TRUE) {
                header('location:slides.php');
            } else {
                echo "Error: " . $sql . "<br>" . $connect->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
}


?>

