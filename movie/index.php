<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

   include('config.php');
   
   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $email = $_POST['email'];

    
    $sql1 = "INSERT INTO subscribers (email) VALUES ('$email')";
    $result1 = mysqli_query($connect, $sql1);
    if ($result1 === TRUE) {
        echo "<script>alert('subscribed')</script>";
    } else {
        echo "Error: " . $connect->error;
    }
}
$slides = [];

// Fetch slides from the database
$sql = "SELECT slide_img FROM slides";
$result = $connect->query($sql);

if ($result !== false && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $slides[] = $row["slide_img"];
    }
} else {
    echo "No slides found.";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie-app</title>
    <link rel="shortcut icon" href="2ndbanner.jpg" type="image/x-icon">
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- boxicons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- swiper css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

</head>

<body>
    <!-- header -->
    <header>
        <a href="#" class="logo"><i class='bx bxs-camera-movie'></i>Movies</a>
        <div class="menu-icon"><i class="bx bx-menu"></i></div>
        <!-- navlist -->
        <ul class="navbar">
            <li><a href="#">Home</a></li>
            
            <li><a href="#movies">Movies</a></li>
            <li><a href="#newsletter">subscribe</a></li>
            
    
            <?php
            session_start();
        if(isset($_SESSION['username'])) {
            if($_SESSION['role_id'] == 0) {
                echo '<li><a href="admindashboard.php">Dashboard</a></li>';
            }
            echo '<li><a href="logout.php" class="btn">Logout</a></li>';
        } else {
            echo '<li><a href="registration.php" class="btn">Signup</a></li>';
            echo '<li><a href="login.php" class="btn">Login</a></li>';
        }
        ?>
    </header>
 
    <!-- banners -->
    <section class="home" id="home">
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php foreach ($slides as $slide): ?>
                <div class="swiper-slide">
                    <img src="<?php echo htmlspecialchars($slide); ?>" alt="Slide Image">
                    <div class="home-text">
                        <h1>Movie</h1>
                        <a href="bookingform.php" class="btn">Book now</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- movies -->
    <section class="movies" id="movies">
        <h2 class="heading1">New Movies</h2>
        <div class="movie-container">
  <div class="row row-cols-4">
  <?php
// Include database connection
include('config.php');

// Fetch movie data from the database
$sql = "SELECT * FROM movies";
$result = mysqli_query($connect, $sql);

// Check if any rows are returned
if (mysqli_num_rows($result) > 0) {
    // Loop through each row
    while ($row = mysqli_fetch_assoc($result)) {
        // Process each movie data here
        $movieId = $row['id'];
        $movieImage = $row['image'];
        $movieTitle = $row['name'];
        $movieDuration = $row['duration'];

        
        echo '<div class="col">';
        echo '<div class="image-container">';
        echo '<img src="' . $movieImage . '" alt="' . $movieTitle . '">';
        echo '<a href="bookingform.php"><button class="img-btn">Book now</button></a>';
        echo '</div>';
        echo '<h3>' . $movieTitle . '</h3>';
        echo '<span>' . $movieDuration . ' mins | Action</span>';
        echo '</div>';
    }
} else {
    // No movies found in the database
    echo '<p>No movies found.</p>';
}
?>

    
  </div>
</div>

    </section>
    <!-- footer -->
    <section class="newsletter" id="newsletter">
    <h2 class="heading1"> subcribe now</h2>
<footer class="footer-newsletter">
    <div class="container">
        <h2 class="footer-heading">Subscribe Now</h2>
        <p class="footer-paragraph">Enter your email address to stay aware of upcoming movies</p>
        <form action="<?php echo $_SERVER ['PHP_SELF'];?>" method="post" class="footer-form">
            <input type="email" name="email" id="email" placeholder="Your email address" required>
            <button type="submit" name="submit" class="btn">Subscribe</button>
        </form>
    </div>
</footer>


    </section>
    <script src="main.js"></script>

    

    <!-- swiper js -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper', {
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });
        document.addEventListener("DOMContentLoaded", function() {
    const header = document.querySelector("header");
    const menuIcon = document.querySelector(".menu-icon");
    const navbar = document.querySelector(".navbar");
  
    window.addEventListener("scroll", function() {
      if (window.scrollY > 0) {
        header.classList.add("scrolled");
      } else {
        header.classList.remove("scrolled");
      }
    });
  
    menuIcon.addEventListener("click", function() {
      navbar.classList.toggle("active");
    });
  });
    </script>

    
</body>

</html>
