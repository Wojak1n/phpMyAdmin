<?php

$host = 'localhost';
$user = 'root';
$dbname = 'Mine';
$db_pass = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {
        $dsn = "mysql:host=$host;";
        $pdo = new PDO($dsn, $user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'Connected to database successfully!';
    } catch (\Throwable $th) {
        die('Failed to connect to database: ' . $th->getMessage());
    }

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert User Data</title>
</head>
<body>
    <h1>Click to connect DataBase</h1>
    <form method="POST" action="">
        <button type="submit">Submit</button>
    </form>
</body>
</html>