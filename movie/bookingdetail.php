<?php
session_start();
include("config.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Bookings</title>
</head>
<body>
    <h2>Admin Bookings</h2>
    <table>
        <thead>
            <tr>
                <th>User Name</th>
                <th>Movie Name</th>
                <th>Screen</th>
                <th>Show Time</th>
                <th>Seats</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch bookings data with user name and movie name
            $query = "SELECT u.username, m.name AS movie_name, b.screen_id, b.show_time, b.seats, b.total_amount 
                      FROM bookings b
                      INNER JOIN users u ON b.user_id = u.id
                      INNER JOIN movies m ON b.movie_id = m.id";
            $result = mysqli_query($connect, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['movie_name'] . "</td>";
                    echo "<td>" . $row['screen_id'] . "</td>";
                    echo "<td>" . $row['show_time'] . "</td>";
                    echo "<td>" . $row['seats'] . "</td>";
                    echo "<td>" . $row['total_amount'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No bookings found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
