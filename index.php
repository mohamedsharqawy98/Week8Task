<?php include 'html/header.php'; ?>
<?php include 'inc/users.php'; ?>
<?php
if (!isset($_SESSION['user'])) {
    header('location:login.php');
}
?>
<?php
if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
}
?>
<h1>Welcom<?php echo " " . $_SESSION['user']  ?></h1>
<form action="" method="post">
    <p>you have been logged in </p><br />
    <button type="submit" name="logout">Logout</button>
</form>
<?php include 'html/footer.php'; ?>