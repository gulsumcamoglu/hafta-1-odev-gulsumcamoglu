<?php

session_start();
include("database.php");

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
    <title>Üye Ol</title>
</head>
<body>
<!-- navbar start -->
<div class="container-fluid">

    <div class="row" >
        <div class="col-sm-4 d-flex flex-wrap align-items-center justify-content-center " >
            <a class="navbar-brand" href="homepage.php">
                <img src="logo.png" alt="" width="410" height="114" class="d-inline-block align-text-top">
            </a>
        </div>
        <div class="col-sm-8 d-flex flex-wrap align-items-center justify-content-center " >
            <form class="d-flex">
                <input class="form-control " type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-info" type="submit" name="search">Search</button>
            </form>
            <a href="register.php"> <button class="btn btn-outline-info m-3" type="button" >Giriş</button></a>
            <button class="btn btn-outline-info" type="button">Kayıt</button>
        </div>


    </div>


</div>
<!-- navbar end -->

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-7 d-2">
             <form action="#" method="post" class="mt-5 regBox p-5">
                 <h1 class="d-flex justify-content-center">Kayıt</h1>
                 <hr>
                 <div class="input-group mb-3">

                     <input type="text" class="form-control" placeholder="AD" aria-label="ad" name="ad" aria-describedby="basic-addon1" required>
                 </div>
                 <div class="input-group mb-3">

                     <input type="text" class="form-control" placeholder="SOYAD" aria-label="soyad" name="soyad"  aria-describedby="basic-addon1" required>
                 </div>
                 <div class="input-group mb-3">

                     <input type="text" class="form-control" placeholder="MAIL" aria-label="mail" name="mail" aria-describedby="basic-addon1" required>
                 </div>
                 <div class="input-group mb-3">

                     <input type="text" class="form-control" placeholder="ŞİFRE" aria-label="sifre" name="sifre" aria-describedby="basic-addon1" required>
                 </div>
                 <div class="input-group mb-3 d-flex justify-content-center">
                     <a href="homepage.php"> <button type="button" class="btn btn-outline-info m-3">Cancel</button></a>
                     <button type="submit" class="btn btn-outline-info m-3" name="signupbtn">Register Now</a></button>

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
if (isset($_POST['signupbtn'])){
    $name = $_POST['ad'];
    $surname = $_POST['soyad'];

    $email = $_POST['mail'];
    $psw = $_POST['sifre'];
    $rolId = 1;
    $sepetId= rand(10000000, 99999999);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>
        if(confirm("Invalid email address !")) {
        window.location.href = "register.php"
        }</script>';
        exit();
    }else {
        $registration = "SELECT email FROM users WHERE email=?";
        if (isset($conn)) {
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $registration)) {
                echo '<script>
                if(confirm("Some connection troubles !")) {
                window.location.href = "register.php"
                }</script>';
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt); //execute into database
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck > 0) {
                    echo '<script>
                    if(confirm("User already taken !")) {
                    window.location.href = "register.php"
                    }</script>';
                    exit();
                } else {
                    $registration = "INSERT INTO users(userName,userSurname,email,rollId, pwd,sepetId) 
                         VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $registration)) {
                        echo '<script>
                        if(confirm("Some connection troubles by registering !")) {
                        window.location.href = "register.php"
                        }</script>';
                        exit();
                    } else {
                        $password_hash = password_hash($psw, PASSWORD_DEFAULT);

                        mysqli_stmt_bind_param($stmt, "ssssss", $name, $surname, $email,$rolId, $password_hash, $sepetId);
                        mysqli_stmt_execute($stmt);

                        echo '    <div id="id01" style=" 
                                    position: fixed; 
                                    z-index: 1;
                                    left: 0;
                                    top: 0;
                                    width: 100%; 
                                    height: 100%; 
                                    overflow: auto; 
                                    padding-top: 50px;
                                    background-color: rgb(0, 0, 0); 
                                    background-color: rgba(0, 0, 0, 0.4); "> 
                                <form style=" background-color: cornflowerblue;
                                    margin: 5% auto 15% auto; 
                                    border: 1px solid #888;
                                    width: 50%; ">
                                    <div style=" padding: 60px; text-align: center;">
                                        <h1 style="color: blanchedalmond">Registered completed, successfully.</h1>
                                        <p>Click Login Button</p>
                                        <button class="adminSignbtn" style="width: 10%; background-color: #ff7733 " type="submit"><a href="login.php">LOGIN</a></button>
                                    </div>
                                </form>
                            </div>';
                        exit();
                    }
                }
            }
        }
    }
}



?>