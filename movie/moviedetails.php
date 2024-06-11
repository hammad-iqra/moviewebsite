<!-- movie_details.php -->

<?php
// Include config file and connect to the database
include("config.php");

// Check if movie ID is provided in URL parameters
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch movie details from the database
    $query = "SELECT * FROM movies WHERE id='$id'";
    $result = mysqli_query($connect, $query);
    $movie = mysqli_fetch_assoc($result);
} else {
    // Redirect back to index.php if movie ID is not provided
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Movie Details</title>
</head>
<body>

<h2><?php echo $movie['title']; ?></h2>
<p>Release Year: <?php echo $movie['release_year']; ?></p>
<p>Director: <?php echo $movie['director']; ?></p>
<p>Price: <?php echo $movie['price']; ?></p>
<p>Time: <?php echo $movie['time']; ?></p>
<p>Screen: <?php echo $movie['screen']; ?></p>

<?php if (isset($_SESSION['username'])): ?>
    <form method="post" action="booking_process.php">
        <input type="hidden" name="movie_id" value="<?php echo $movie['id']; ?>">
        <!-- Other booking form fields -->
        <button type="submit" name="book_now">Book Now</button>
    </form>
<?php else: ?>
    <p>Please <a href="login.php">login</a> to book tickets.</p>
<?php endif; ?>

</body>
</html>
