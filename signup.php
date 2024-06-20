<?php
include './Database.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';

    if ($username && $password && $email && $phone) {
        echo "<script>console.log('User is {$username} and his password is {$password}')</script>";

        if (Database::checkUserExists($username, $email, $phone)) {
            echo "<script>alert('User already exists');</script>";
        } else {
            if (Database::addUser($username, $password, $email, $phone)) {
                echo "<script>alert('Signup successful');</script>";
            } else {
                echo "<script>alert('Signup failed');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>

<form action="signup.php" method="POST">
    <label for="username">Username:
        <input type="text" name="username" placeholder="Enter your name" required>
    </label><br>
    <label for="password">Password:
        <input type="password" name="password" placeholder="Enter your Password" required>
    </label><br>
    <label for="email">Email:
        <input type="text" name="email" placeholder="Enter your Email" required>
    </label><br>
    <label for="phone">Phone:
        <input type="text" name="phone" placeholder="Enter your Phone no" required>
    </label><br>
    <button type="submit">Submit</button>
</form>

</body>
</html>
