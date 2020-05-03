<?php
    require_once 'configs/connect.inc.php';
    include 'template/top.php';
    $success_msg = array();
    $error_msg = array();
    if (isset($_POST['register'])) {
        $name = $conn -> real_escape_string(htmlentities($_POST['name']));
        $username = $conn -> real_escape_string(htmlentities($_POST['username']));
        $password = $conn -> real_escape_string(htmlentities($_POST['password']));
        $repassword = htmlentities($_POST['repassword']);
        $sex = $_POST['sex'];

        # validating user input

        $check_username = $conn -> query("SELECT * FROM user WHERE username = '$username'");

        if ($check_username -> num_rows > 0) {
            array_push($error_msg, "Username already exists!");
        } else {
            if ($password != $repassword) {
                array_push($error_msg, "Password do not match!");
            } else {
                $hash_password = password_hash($password, PASSWORD_BCRYPT);
                $q = $conn -> query("INSERT INTO user (name, username, password, sex) VALUES ('$name', '$username', '$hash_password', '$sex')");
                if ($q) {
                    array_push($success_msg, "User registered successfully! Redirecting.... to login page");
                    sleep(2);
                    header("Location: login.php");
                } else {
                    array_push($error_msg, "Something went wrong... Please try again later or contact admin!");
                }
            }
        }
    }

?>
<section class="container">
    <?php foreach($success_msg as $msg): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $msg ?>
        </div>
    <?php endforeach ?>
    <?php foreach($error_msg as $msg): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $msg ?>
        </div>
    <?php endforeach ?>
    <h1>Register yourself to vote!</h1>
    <form method="POST" action="#">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="repassword">Re-Enter Password</label>
            <input type="password" id="repassword" name="repassword" class="form-control">
        </div>
        <div class="form-group">
            <label for="sex">Sex: </label><br>
            <input type="radio" value="Male" name="sex"> Male
            <input type="radio" value="Female" name="sex"> Female
            <input type="radio" value="Others" name="sex"> Others
        </div>
        <button type="submit" name="register" class="btn btn-primary">Register</button>
    </form>
    <p>Already registered <a href="login.php">Click here to login</a></p>
</section>
<?php include 'template/bottom.php'; ?>