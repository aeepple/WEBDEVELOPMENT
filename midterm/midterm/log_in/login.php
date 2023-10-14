<?php
session_start();
include "../Connection/dbconn.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `web_tbl` WHERE Email = '$email' AND Password = '$password'";
    $result = $connection->query($sql);

    if (!$result) {
        die("Database query failed: " . $connection->error);
    }

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        $response = array("status" => "success");
    } else {
        $response = array("status" => "error", "message" => "Invalid password or email. Please try again.");
    }

    echo json_encode($response);
    exit();
}

$connection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            color: teal;
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
            background-color: teal;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .container button:hover {
            background-color: #005e5e;
        }

        .container button + button {
            margin-top: 10px;
        }

        .register-button {
            background-color: gray;
        }

        .register-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="email">Email:</label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required><br>

        <label for="password">Password:</label>
        <input type="password" placeholder="Enter Password" name="password" id="password" required><br>

        <button type="submit" name="login" id="loginButton">Login</button>
        <button type="button" class="register-button" onclick="redirectToRegistration()">Register</button>
    </form>
</div>

<script>
    function redirectToRegistration() {
        window.location.href = '../register/index.php';
    }

    document.getElementById("loginButton").addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the default form submission
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        fetch("login.php", {
            method: "POST",
            body: new URLSearchParams({ email, password }),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert("Login Successfully");
                    window.location.href = '../Dashboard/dashboard.php';
                } else {
                    alert(data.message);
                }
            });
    });
</script>

</body>
</html>
