<?php
    require_once 'configs/connect.inc.php';
    include 'template/top.php';
    $msg = "";
    if (isset($_POST['login'])) {
        $username = $conn -> real_escape_string(htmlentities($_POST['username']));
        $password = $conn -> real_escape_string(htmlentities($_POST['password']));

        # login
        $q = $conn -> query("SELECT * FROM user WHERE username = '$username'");

        if ($q -> num_rows > 0) {
            # getting user details
            $user = $q -> fetch_assoc();
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['uid'] = $user['uid'];
                $_SESSION['username'] = $user['username'];
                header('Location: home.php');
            } else {
                $msg = "Invalid username or password";
            }
        }
    }
?>

<section class="container">
    <?php if ($msg != ""): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $msg; ?>
        </div>
    <?php endif ?>
    <form method="POST" action="#">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <button type="submit" name="login" class="btn btn-primary">Login</button>
    </form>
    <p>Don't have account <a href="register.php">Click here to register</a></p>
</section>
<?php include 'template/bottom.php'; ?>