<?php
session_start();
include("config.php");

// Check if the user is logged in
if (!isset($_SESSION["role_id"])) {
    header("Location: login.php");
    exit();
}

// Set default value for username
$username = '';

// If user is logged in, fetch the username
if(isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    $query = "SELECT username FROM users WHERE id = $userId";
    $result = mysqli_query($connect, $query);
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
</head>
<body>
    <h2>Booking Form</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <div>
            <div>
                <label for="username">Username:</label>
                <label id="username"><?php echo $username; ?></label>
            </div>
            <label for="movie">Movie:</label>
            <select id="movie" name="movie" required>
                <option value="">Select Movie</option>
                <?php
                $query = "SELECT id, name FROM movies";
                $result = mysqli_query($connect, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div>
            <label for="screen">Screen:</label>
            <select id="screens" name="screens" required>
            <?php
                $query2= "SELECT id,screen_name FROM screens";
                $result2 = mysqli_query($connect, $query2);
                while ($row = mysqli_fetch_assoc($result2)) {
                    echo '<option value="' . $row['id'] . '">' . $row['screen_name'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div>
            <label for="show_time">Select Show Time:</label>
            <select id="show_time" name="show_time" required>
                <option value="">Select Show Time</option>
                <option value="7-9">7:00 AM - 9:00 AM</option>
                <option value="10-12">10:00 AM - 12:00 PM</option>
            </select>
        </div>
        <div>
            <label for="seats">Number of Seats:</label>
            <input type="number" id="seats" name="seats" min="1" required>
        </div>
        <div>
            <label for="seats">Total Amount:</label>
            <input type="number" id="total_amount" name="total_amount" min="1" required readonly>
        </div>
        <button type="submit" name="book_now">Book Now</button>
    </form>

    <script>
        // Get reference to the seats and total amount input fields
        const seatsInput = document.getElementById('seats');
        const totalAmountInput = document.getElementById('total_amount');

        // Add event listener to seats input field
        seatsInput.addEventListener('input', () => {
            // Calculate total amount
            const seats = parseInt(seatsInput.value);
            const pricePerSeat = 1000;
            const totalAmount = seats * pricePerSeat;

            // Update total amount input field value
            totalAmountInput.value = totalAmount;
        });
    </script>
</body>
</html>

<?php
include('config.php');

if (isset($_POST['book_now'])) {
    // Ensure user_id is set and not empty
    $user_id = isset($_SESSION["id"]) ? $_SESSION["id"] : ''; 

    // Retrieve other form data
    $movie_id = $_POST['movie'];
    $screen_id = $_POST['screens'];
    $show_time = $_POST['show_time'];
    $seats = $_POST['seats'];
    $total_amount = $seats * 1000;

    // Insert booking into database
    $insert_query = "INSERT INTO bookings (user_id, movie_id, screen_id, show_time, seats, total_amount) 
                     VALUES ('$user_id', '$movie_id', '$screen_id', '$show_time', '$seats', '$total_amount')";
    
    if (mysqli_query($connect, $insert_query)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}
?>
