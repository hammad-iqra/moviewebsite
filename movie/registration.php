<?php
include('config.php');
session_start();
if(isset($_SESSION["username"])){
  header("location:index.php");
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Get Register</p>

                <form class="mx-1 mx-md-4" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                      <input type="text" id="username" name="username" class="form-control" required />
                      <label class="form-label" for="username">Your Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                      <input type="email" id="email" name="email" class="form-control" required />
                      <label class="form-label" for="email">Your Email</label>
                    </div>
                  </div>

                  <input type="hidden" name="role_id" value="1" />

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                      <input type="password" id="password" name="password" class="form-control" required />
                      <label class="form-label" for="password">Password</label>
                    </div>
                  </div>

                  <div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" required />
                    <label class="form-check-label" for="form2Example3c">
                      I agree to all statements in <a href="#!">Terms of service</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                <img src="registration.jpg" class="img-fluid" alt="Sample image">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>

<?php
session_start();
include("config.php");

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $role_id = 1; 

    if(empty($username) || empty($email) || empty($password)){
        echo "<script>alert('Please fill all fields');</script>";
    } else {
        // Insert user into the database
        $sql = "INSERT INTO users (username, email, password, role_id) VALUES ('$username', '$email', '$password', $role_id)";
        if(mysqli_query($connect, $sql)){
            // Get the newly created user's id
            $user_id = mysqli_insert_id($connect);

            // Set session variables
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $user_id;
            $_SESSION['role_id'] = $role_id;

            // Redirect to index.php
            header('Location: index.php');
            exit();
        } else {
            echo "<script>alert('Error: Could not register.');</script>";
        }
    }
}
?>