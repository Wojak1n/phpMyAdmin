<?php
$host = 'localhost';
$user = 'root';
$db_name = 'Mydata';
$db_pass = "";

try {
    $dsn = "mysql:host=$host;";
    $pdo = new PDO($dsn, $user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $pdo->exec("CREATE DATABASE IF NOT EXISTS $db_name");
    $pdo->exec("USE $db_name");


    $sql = "CREATE TABLE IF NOT EXISTS students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        email VARCHAR(100),
        age INT,
        major VARCHAR(100),
        phone VARCHAR(20),
        address VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $major = $_POST['major'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $stmt = $pdo->prepare("INSERT INTO students (name, email, age, major, phone, address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $age, $major, $phone, $address]);

        echo 'DATABASE CONNECTED SUCCESSFULLY AND DATA INSERTED ✅';
    }

} catch (\Throwable $th) {
    die('Failed to connect to database: ' . $th->getMessage());
}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Database connection</h1>
    <form method="post">
    <label>Name: <input type="text" name="name" required></label><br><br>
        <label>Email: <input type="email" name="email" required></label><br><br>
        <label>Age: <input type="number" name="age" required></label><br><br>
        <label>Major: <input type="text" name="major" required></label><br><br>
        <label>Phone: <input type="text" name="phone" required></label><br><br>
        <label>Address: <input type="text" name="address" required></label><br><br>
       <button type="submit" value="click here"> Click to connect</button>
    </form>
</body>
</html>