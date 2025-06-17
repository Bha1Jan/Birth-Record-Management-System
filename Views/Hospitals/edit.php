<?php
require_once __DIR__ . '/../../controllers/HospitalController.php';

$controller = new HospitalController();
$hospital = null;

if (isset($_GET['id'])) {
    $hospital = $controller->show($_GET['id']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->update();
}

if (!$hospital) {
    die("Hospital not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hospital</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/navbar.css">
</head>
<body>
<nav class="navbar">
    <a href="index.php" class="logo">BRMS</a>
    <span class="menu-toggle">&#9776;</span>
    <ul>
    <li><a href="../home.php" class="nav-link">Home</a></li>
    <!-- <li><a href="create.php" class="nav-link">Add New Doctor</a></li> -->
        <li><a href="index.php" class="nav-link">View Hopitals List</a></li>
      

    </ul>
</nav>
<div>
    <h2>Edit Hospital</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $hospital['HOSPITAL_ID']; ?>">

        <label>Name:</label>
        <input type="text" name="name" value="<?= $hospital['HOSPITAL_NAME']; ?>" required><br>

        <label>Address:</label>
        <input type="text" name="address" value="<?= $hospital['HOSPITAL_ADDRESS']; ?>" required><br>

        <label>Ward:</label>
        <input type="text" name="ward" value="<?= $hospital['HOSPITAL_WARD']; ?>" required><br>

        <button type="submit">Update</button>
    </form>
</div>
<footer ><strong>CopyWrite© 2025</strong> Blood Bank Mannagement ltd.</footer>

</body>
</html>
