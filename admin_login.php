<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "product";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION["admin"] = $username;
            header("Location: admin_dashboard.php");
            exit;
        } else {
            $error = "❌ Incorrect password.";
        }
    } else {
        $error = "❌ Admin user not found.";
    }
}
?>

<head>
    <title>Amind Login</title>
    <style>

        body {
            margin: 0;
            padding: 0;
            background: peachpuff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #ff6f3c;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ffb385;
            border-radius: 6px;
            outline: none;
        }

        button {
            background: #ff6f3c;
            color: white;
            border: none;
            padding: 10px 0;
            width: 100%;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #e55a24;
        }

        a {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #555;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }

        p {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>

</head>
<!-- Login Form -->
<form method="post">
    <h2>Admin Login</h2>
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
    <a href="index.php">Back Home</a>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</form>