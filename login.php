<?php
include 'inc/users.php';
if (isset($_SESSION['user'])) {

    header('location:index.php');
}
if (isset($_POST['username']) && isset($_POST['password'])) {
    $isUserExist = loginUser($_POST['username'], $_POST['password']);
    if ($isUserExist) {
        header('location:index.php');
    }
}
?>
<?php include 'html/header.php'; ?>
<h1>Login</h1>
<?php if (isset($isUserExist) && !$isUserExist) : ?>
    <div role="alert">
        Username or password incorrect
    </div>
<?php endif; ?>

<form action="login.php" method="post">
    <label for="username">Username :</label><br />
    <input type="text" name="username" /><br />
    <label for="password">Password :</label><br />
    <input type="password" name="password" /><br />
    <input type="submit" value="Login" />
</form>
<?php include 'html/footer.php'; ?>