<?php
    session_start();
    require_once 'configs/connect.inc.php';
    include 'template/top.php';
    $uid = $_SESSION['uid'];
    $username = $_SESSION['username'];

    if (!isset($uid) && !isset($username)) {
        header('Location: login.php');
    }
    
    $q = $conn -> query("SELECT * FROM user WHERE uid = '$uid'");
    $user = $q -> fetch_assoc();
?>
<section class="container">
    <h1>Welcome <?php echo $user['name']; ?></h1>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</section>
<?php include 'template/bottom.php'; ?>