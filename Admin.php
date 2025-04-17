<?php

    $host = 'localhost';
    $user = 'root';
    $db_name = 'motamadris';
    $db_pass = '';

    try{
        $dsn = "mysql:host=$host;";
        $pdo = new PDO($dsn, $user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("CREATE DATABASE IF NOT EXISTS $db_name");
        $pdo->exec("USE $db_name");

        $sql = "CREATE TABLE IF NOT EXISTS ASATIDA (
              id INT AUTO_INCREMENT PRIMARY KEY,
              NAME VARCHAR(255),
              EMAIL VARCHAR(255),
              AGE INT,
              MAJOR VARCHAR(255),
              PHONE VARCHAR(10),
              ADDRESS VARCHAR(255),
              created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        $pdo->exec($sql);
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $NAME = $_POST['NAME'];
        $EMAIL = $_POST['EMAIL'];
        $AGE = $_POST['AGE'];
        $MAJOR = $_POST['MAJOR'];
        $PHONE = $_POST['PHONE'];
        $ADDRESS = $_POST['ADDRESS'];
        
        $stnt = $pdo->prepare("INSERT INTO ASATIDA(NAME,EMAIL,AGE,MAJOR,PHONE,ADDRESS)VALUE(?,?,?,?,?,?)");
        $stnt->execute([$NAME,$EMAIL,$AGE,$MAJOR,$PHONE,$ADDRESS]);
        echo 'DATABASE CREATED AND CONNECTED SUCCESFULY !';


    }

        echo 'database saved succesfuly !';
    }catch(\Throwable $th){
        die('Failed to save the database !' .$th->getMessage());

    
}









?>







<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f4f4f4;
        }

        form {
            background: white;
            padding: 20px;
            max-width: 412px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
        }

        input, select {
            width: 100%;
            margin: 8px 0;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            background: #2ecc71;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .message {
            text-align: center;
            margin-bottom: 15px;
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<form method="POST">
    <h2 style="text-align: center;">Mota3alim forum</h2>
    <input type="text" name="NAME" placeholder="Full Name" required>
    <input type="email" name="EMAIL" placeholder="Email" required>
    <input type="number" name="AGE" placeholder="Age" required>
    <input type="text" name="MAJOR" placeholder="Major" required>
    <input type="text" name="PHONE" placeholder="Phone Number" maxlength="10" required>
    <input type="text" name="ADDRESS" placeholder="Address" required>
    <button type="submit">Submit</button>
</form>

</body>
</html>