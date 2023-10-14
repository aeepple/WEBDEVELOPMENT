<?php
include "../Connection/dbconn.php";

$registrationMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Store the password as plain text

    // TODO: Validate and sanitize user input

    $sql = "INSERT INTO `web_tbl` (`user_id`, `first_name`, `last_name`, `username`, `email`, `password`) VALUES
    ('$user_id', '$first_name', '$last_name', '$username', '$email', '$password')";

    if ($connection->query($sql) === TRUE) {
        $registrationMessage = "Registered Successfully";
    } else {
        echo "Error: " . $connection->error;
    }
    $connection->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
            text-align: center;
        }

        .container h2 {
            margin-bottom: 20px;
            color: teal; /* Teal color for the title */
        }

        .container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .container button {
            width: 100%;
            padding: 10px;
            background-color: teal; /* Teal color for the Register button */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .container button:hover {
            background-color: #005e5e; /* Slightly darker teal on hover */
        }

        /* Input field labels */
        .container label {
            text-align: left;
            display: block;
            color: teal; /* Teal color for labels */
        }

        /* Additional styling for the "Login now" link */
        .container a {
            text-decoration: none;
            color: gray; /* Gray color for the link text */
        }

        .container a:hover {
            color: #333; /* Slightly darker gray on hover */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Registration Form</h2>

    <form method="post" action="index.php">
        <label for="user_id">User ID:</label>
        <input type="text" id="user_id" name="user_id" placeholder="Enter ID" required>

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" placeholder="Enter your firstname" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" placeholder="Enter your lastname" required>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <button type="submit">Register</button>
        <p>Already have an account? <a href="../log_in/login.php">Login now</a></p>
    </form>
    
    <!-- JavaScript for displaying the registration message and redirecting -->
    <script>
        <?php if (!empty($registrationMessage)) { ?>
            alert('<?php echo $registrationMessage; ?>');
            window.location.href = '../log_in/login.php'; // Redirect to the login page
        <?php } ?>
    </script>
</div>

</body>
</html>
