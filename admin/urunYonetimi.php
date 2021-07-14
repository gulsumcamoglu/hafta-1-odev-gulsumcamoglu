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
        <div class="col-sm-5">
            <div class="mt-5 regBox p-5">
                <form action="#" method="post" enctype="multipart/form-data">
                    <h1 class="d-flex justify-content-center">Ürün Ekle</h1>
                    <hr>
                    <div class="input-group mb-3">

                        <input type="text" class="form-control" placeholder="ÜRÜN ADI GİR" aria-label="ad" name="ad" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-3">

                        <input type="text" class="form-control" placeholder="ÜRÜN ID GİR" aria-label="id" name="id" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-3">
                        <select id="kategoriId" class="form-control"  name="kategoriId" style="width: 30%; background-color: #f1f1f1">

                            <?php
                            $query = "SELECT * FROM kategoriler";
                            if (isset($conn)) {
                                $queryConn = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($queryConn)) {
                                    $kategoriId = $row['kategoriId'];
                                    $kategoriAdı = $row['kategoriAdı'];

                                    echo '<option value=' . $kategoriId . '>KATEGORİ SEÇ: ' . $kategoriId . ' - ' . $kategoriAdı . ' </option>';
                                }
                            }
                            ?>

                        </select>
                       </div>
                    <div class="input-group mb-3">
                        <select id="markaId" class="form-control"  name="markaId" style="width: 30%; background-color: #f1f1f1">

                            <?php
                            $query = "SELECT * FROM marka";
                            if (isset($conn)) {
                                $queryConn = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($queryConn)) {
                                    $markaId = $row['markaId'];
                                    $markaAdı = $row['markaAdı'];

                                    echo '<option value=' . $markaId . '>MARKA SEÇ: ' . $markaId . ' - ' . $markaAdı . ' </option>';
                                }
                            }
                            ?>

                        </select>   </div>
                    <div class="input-group mb-3">

                        <input type="text" class="form-control" placeholder="ÜRÜN SAYISI GİR" aria-label="sayi" name="sayi" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-3">

                        <input type="text" class="form-control" placeholder="AÇIKLAMA GİR" aria-label="aciklama" name="aciklama" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-3">

                        <input type="text" class="form-control" placeholder="FİYAT GİR" aria-label="fiyat" name="fiyat" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-3">

                        <input type="file" class="form-control"  name="file">    </div>
                    <div class="input-group mb-3 d-flex justify-content-center">
                        <button class="btn btn-outline-info m-3" type="submit" name="ekle" >Ekle</button>



                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="mt-5 regBox p-5">
                <form action="#" method="post" >
                    <h1 class="d-flex justify-content-center">Ürün Sil</h1>
                    <hr>
                    <div class="input-group mb-3">

                        <input type="text" class="form-control" placeholder="ÜRÜN ID GİR" aria-label="id" name="id" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-3">

                        <input type="text" class="form-control" placeholder="ÜRÜN ADI GİR" aria-label="ad" name="ad" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-3">

                        <input type="text" class="form-control" placeholder="ANA KATEGORİ ID GİR" aria-label="anaad" name="anaad" aria-describedby="basic-addon1" >
                    </div>
                    <div class="input-group mb-3 d-flex justify-content-center">
                        <button class="btn btn-outline-info m-3" type="submit" name="sil" >Sil</button>



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
    $ad = $_POST['ad'];
    $id = $_POST['id'];
    $kategoriId = $_POST['kategoriId'];
    $markaId = $_POST['markaId'];
    $sayi = $_POST['sayi'];
    $aciklama = $_POST['aciklama'];
    $fiyat = $_POST['fiyat'];

    $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = "../images/".$filename;


    //$yeni_ad="../images/".$uret[rand(0,4)].$sayi_tut.$uzanti;
    if (move_uploaded_file($tempname, $folder)){
        echo 'Dosya başarıyla yüklendi.';
  $addu = "INSERT INTO urun(urunAdı,urunId,kategoriId,markaId,sayi,aciklama,fiyat,img) VALUES ('$ad','$id','$kategoriId','$markaId','$sayi','$aciklama','$fiyat','$folder');";
        if (isset($conn)) {
            $result = mysqli_query($conn, $addu);

            if (!$result) {

                #echo "SQL error!";
                echo '<script>
                      if(confirm("Journey can not add !")) {
                                window.location.href = "adminProfile.php"
               }</script>';
                exit();


        }else {
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
                <h1 style="color: blanchedalmond">New journey added, successfully.</h1>
                <p>Do you want to continue ?</p>
		        <button class="adminSignbtn" style="width: 10%; background-color: #ff7733 " type="submit"><a href="adminProfile.php">OK</a></button>
            </div>
        </form>
    </div>';
            exit();
        }
    }}else{
        echo 'Dosya Yüklenemedi!';
    }



}
?>



//"INSERT INTO urun(urunAdı,urunId,kategoriId,markaId,sayi,aciklama,fiyat,img) VALUES ('$ad','$id','$kategoriId','$markaId','$sayi','$aciklama','$fiyat','$targetFilePath')"

//   $addJourney = "INSERT INTO urun(urunAdı,urunId,kategoriId,markaId,sayi,aciklama,fiyat,img) VALUES ('$ad','$id','$kategoriId','$markaId','$sayi','$aciklama','$fiyat','$yeni_ad')";
