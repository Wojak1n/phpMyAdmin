<?php
require "config.php";

// Redirect if not logged in
if (!isset($_SESSION['ostad'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['ostad']['id'];

// Get user data from DB
$stmt = $pdo->prepare("SELECT * FROM asatida WHERE id = :id");
$stmt->execute(['id' => $id_user]);
$user = $stmt->fetch();

// Check if user is found
if (!$user) {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

<h1>WELCOME <?php echo htmlspecialchars($user["NAME"]); ?> dzeb</h1>
<p>my email :<?php echo htmlspecialchars($user["EMAIL"]); ?> </p>
<p>my Phone :<?php echo htmlspecialchars($user["PHONE"]); ?> </p>


</body>
</html>
