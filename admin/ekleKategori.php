<?php
session_start();
include("../database.php");
if (!isset($_SESSION['mail'])) {
    $loginError = "You are not logged in !";
    echo '<script language="javascript">';
    echo "alert('$loginError')";
    echo '</script>';
    include("../admin/loginAdmin.php");
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
    <link href="../style.css" rel="stylesheet"  >

    <title>Istanbul Market</title>
</head>
<body>
<!-- navbar start -->
<div class="container-fluid">

    <div class="row" >
        <div class="col-sm-4 d-flex flex-wrap align-items-center justify-content-center " >
            <a class="navbar-brand" href="adminProfile.php">
                <img src="../images/logo.png" alt="" width="410" height="114" class="d-inline-block align-text-top">
            </a>
        </div>
        <div class="col-sm-8 d-flex flex-wrap align-items-center justify-content-center " >
            <form class="d-flex">
                <input class="form-control " type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-info" type="submit" name="search">Search</button>
            </form>
            <a href="adminProfile.php" style="text-decoration-line: none" > <button class="btn btn-outline-info m-3" type="button" >
                    <?php
                    $email = $_SESSION['mail'];
                    $query = "SELECT * FROM users WHERE email='$email'";
                    if (isset($conn)) {
                        $queryConn = mysqli_query($conn, $query);

                        if (!$queryConn){
                            echo "Error";
                        }else{
                            while($row = mysqli_fetch_array($queryConn)){
                                $name = $row['userName'];
                                echo "Hi! ".$name;
                            }
                        }
                    } ?>
                </button></a>
            <a href="../logout.php">  <button class="btn btn-outline-info m-3" type="button" >Çıkış</button></a>

        </div>


    </div>


</div>
<!-- navbar end -->
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-7 d-2">
            <div class="mt-5 regBox p-5">
                <form action="#" method="post" >
                    <h1 class="d-flex justify-content-center">Kategori Ekle</h1>
                    <hr>
                    <div class="input-group mb-3">

                        <input type="text" class="form-control" placeholder="KATEGORİ ID GİR" aria-label="id" name="id" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-3">

                        <input type="text" class="form-control" placeholder="KATEGORİ ADI GİR" aria-label="ad" name="ad" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-3">

                        <input type="text" class="form-control" placeholder="ANA KATEGORİ ID GİR" aria-label="anaad" name="anaad" aria-describedby="basic-addon1" >
                    </div>
                    <div class="input-group mb-3 d-flex justify-content-center">
                         <button class="btn btn-outline-info m-3" type="submit" name="ekle" >Ekle</button>



                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
</body>
</html>

<?php

if(isset($_POST['ekle'])){
    $id = $_POST['id'];
    $ad = $_POST['ad'];
    $anaad = 0;
    if(!empty($_POST['anaad'])){
        $anaad = $_POST['anaad'];
    }
    $addK = "INSERT INTO kategoriler(kategoriId,kategoriAdı,anakatagoriId) VALUES ('$id','$ad','$anaad');";
    if (isset($conn)) {
        $result = mysqli_query($conn, $addK);

        if (!$result) {
            #echo "SQL error!";
            echo '<script>
                      if(confirm("Kategori eklenemedi !")) {
                                window.location.href = "ekleKategori.php"
               }</script>';
            exit();
        } else {
            #echo "New journey added, successfully.";
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
        <form style=" background-color: #87bdd8;
            margin: 5% auto 15% auto; 
            border: 1px solid #888;
            width: 50%; ">
            <div style=" padding: 60px; text-align: center;">
                <h1 style="color: blanchedalmond">Kategori eklendi.</h1>
                <p>Do you want to continue ?</p>
		        <button class="adminSignbtn" style="width: 10%; background-color: #ff7733 " type="submit"><a href="adminProfile.php">OK</a></button>
            </div>
        </form>
    </div>';
            exit();
        }
    }

}
?>


