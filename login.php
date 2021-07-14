<?php
session_start();
include("database.php");
if (isset($_SESSION['email'])) {
    echo '<script> 
        if(confirm("You are already logged in ! \n Do you want to continue?")) {
            window.location.href = "login.php"
         }</script>';
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet"  >

    <title>Istanbul Market</title>
</head>
<body>
<!-- navbar start -->
<div class="container-fluid">

    <div class="row" >
        <div class="col-sm-4 d-flex flex-wrap align-items-center justify-content-center " >
            <a class="navbar-brand" href="homepage.php">
                <img src="images/logo.png" alt="" width="410" height="114" class="d-inline-block align-text-top">
            </a>
        </div>
        <div class="col-sm-8 d-flex flex-wrap align-items-center justify-content-center " >
            <form class="d-flex">
                <input class="form-control " type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-info" type="submit" name="search">Search</button>
            </form>
            <a href="login.php">  <button class="btn btn-outline-info m-3" type="button" >Giriş</button></a>
            <a href="register.php">  <button class="btn btn-outline-info" type="button">Kayıt</button></a>
        </div>


    </div>


</div>
<!-- navbar end -->


<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-7 d-2">
            <form action="#" method="post" class="mt-5 regBox p-5">
                <h1 class="d-flex justify-content-center">Giriş</h1>
                <hr>
                <div class="input-group mb-3">

                    <input type="text" class="form-control" placeholder="MAIL" aria-label="mail" name="mail" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group mb-3">

                    <input type="text" class="form-control" placeholder="ŞİFRE" aria-label="sifre" name="sifre" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group mb-3 d-flex justify-content-center">
                    <a href="login.php">  <button class="btn btn-outline-info m-3" type="submit" name="login" >Giriş</button></a>
                    <a href="register.php">  <button class="btn btn-outline-info m-3" type="button">Kayıt</button></a>


                </div>
            </form>
        </div>
    </div>

</div>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
</body>
</html>

<?php
if (isset($_POST['login'])){
    $email = $_POST['mail'];
    $psw = $_POST['sifre'];

    if (empty($email) || empty($psw)) {
        echo '<script>
        if(confirm("Fill all blanks !")) {
        window.location.href = "login.php"
        }</script>';
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>
        if(confirm("Invalid email address !")) {
        window.location.href = "login.php"
        }</script>';
        exit();
    } else {

        $query = "SELECT * FROM users WHERE email=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            echo '<script>
            if(confirm("Some connection troubles !")) {
            window.location.href = "login.php"
            }</script>';
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {

                if($row['rollId'] == 2) {
                    $_SESSION['mail'] = $row['email'];
                    echo '<script>window.location.href = "admin/adminProfile.php"</script>';
                    exit();
                }



                $pwdCheck = password_verify($psw, $row['pwd']);
                if ($pwdCheck == false) {
                    echo '<script>
                    if(confirm("Invalid password !")) {
                    window.location.href = "login.php"
                    }</script>';
                    exit();

                } else if ($pwdCheck == true) {
                    $_SESSION['mail'] = $row['email'];
                    header("Location: ru/homepage_RU.php");
                    exit();

                } else {
                    echo '<script>
                    if(confirm("Wrong user input !")) {
                    window.location.href = "login.php"
                    }</script>';
                    exit();
                }
            } else {
                echo '<script>
                if(confirm("No user match!")) {
                window.location.href = "login.php"
                }</script>';
                exit();
            }
        }
    }

}

?>