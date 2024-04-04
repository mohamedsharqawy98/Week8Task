<?php

include 'inc/users.php';

if (isset($_SESSION['user'])) {

    header('location:index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $isPasswordSet = false;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirmation = $_POST['passwordConfirm'];

    $valid = isUserValid($username, $email, $password, $passwordConfirmation);
    $isDuplicate = unique($username, $email);
    if ($valid && !$isDuplicate) {
        $formData = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];
        registerUserInJsonFile($formData);
        header('location:login.php');
    }

    // if ($_POST['password'] == $_POST['passwordConfirm']) {
    //     
    //     $isPasswordSet = true;
    // }
    // else {
    //     header('location:register.php');
    // }
}
?>

<?php include 'html/header.php'; ?>
<h1>Register</h1>
<!-- <?php if (isset($isPasswordSet) && !$isPasswordSet) : ?>
    <div role="alert">
        Password doesn't match
    </div>
<?php endif; ?> -->
<form action="register.php" method="post">
    <label for="username">Username :</label><br />
    <input type="text" name="username" /><br />
    <label for="email">Email :</label><br />
    <input type="email" name="email" /><br />
    <label for="password">Password :</label><br />
    <input type="password" name="password" /><br />
    <label for="passwordConfirm">Confirm Password :</label><br />
    <input type="password" name="passwordConfirm" /><br />
    <input type="submit" value="Register" /><br />
    <input type="submit" value="Login">
</form>
<?php include 'html/footer.php'; ?>