<?php
    $host = 'localhost';
    $user = 'root';
    $db_name= 'Human';
    $db_pass = '';
  
        try{
            $dsn = "mysql:host=$host;";
            $pdo = new PDO($dsn, $user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("CREATE DATABASE IF NOT EXISTS $db_name");
            $pdo->exec("USE $db_name");

            $sql = "CREATE TABLE IF NOT EXISTS Genetics (
                id INT AUTO_INCREMENT PRIMARY KEY,
                NAME VARCHAR(255),
                EMAIL VARCHAR(255),
                PHONE VARCHAR(10),
                AGE INT(255),
                MAJOR VARCHAR(255),
                ADDRESS VARCHAR(255),
                created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP            
            )";
            $pdo->exec($sql);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $NAME = $_POST['NAME'];
        $EMAIL = $_POST['EMAIL'];
        $PHONE = $_POST['PHONE'];
        $AGE = $_POST['AGE'];
        $MAJOR = $_POST['MAJOR'];
        $ADDRESS = $_POST['ADDRESS'];

        $stnt = $pdo->prepare("INSERT INTO GENETICS (NAME,EMAIL,PHONE,AGE,MAJOR,ADDRESS) VALUE(?,?,?,?,?,?)");
        $stnt->execute([$NAME,$EMAIL,$PHONE,$AGE,$MAJOR,$ADDRESS]);
        $lastId = $pdo->lastInsertId(); 
        $sql = $pdo->prepare("SELECT id FROM GENETICS ORDER BY id  DESC LIMIT 3");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $kimakan){
            echo $kimakan['id'] ."<br>";
        }

        
        
        
        // 🔥 Get last inserted ID
        echo "DATABASE CREATED AND CONNECTED SUCCESSFULLY! Last Inserted ID: $lastId";
         // 🔥 Get last inserted ID


    }
        

    }catch(\Throwable $th){
        die('Failed to connect database' .$th->getMessage());
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