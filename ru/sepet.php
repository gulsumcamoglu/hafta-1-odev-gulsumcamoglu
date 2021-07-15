<?php
session_start();
#$conn = mysqli_connect("localhost", "root", "", "busdb");
include("../database.php");

if (!isset($_SESSION['mail'])) {
    echo '<script> 
        if(confirm("You are not logged in ! \n Do you want to continue?")) {
            window.location.href = "login.php";
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
    <link href="../style.css" rel="stylesheet"  >

    <title>Istanbul Market</title>
</head>
<body>
<!-- navbar start -->
<div class="container-fluid">

    <div class="row" >
        <div class="col-sm-4 d-flex flex-wrap align-items-center justify-content-center " >
            <a class="navbar-brand" href="homepage_RU.php">
                <img src="../images/logo.png" alt="" width="410" height="114" class="d-inline-block align-text-top">
            </a>
        </div>
        <div class="col-sm-8 d-flex flex-wrap align-items-center justify-content-center " >
            <form class="d-flex">
                <input class="form-control " type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-info" type="submit" name="search">Search</button>
            </form>
            <a href="homepage_RU.php" style="text-decoration-line: none" > <button class="btn btn-outline-info m-3" type="button" >
                    <?php
                    $email = $_SESSION['mail'];
                    $query = "SELECT * FROM users WHERE email='$email'";
                    if (isset($conn)) {
                        $queryConn = mysqli_query($conn, $query);

                        if (!$queryConn){
                            echo "Kullanıcı Bulunamadı!";
                        }else{
                            while($row = mysqli_fetch_array($queryConn)){
                                $name = $row['userName'];
                                echo "Hoşgeldin! ".$name;
                            }
                        }
                    } ?>
                </button></a>
            <a href="sepet.php" style="text-decoration-line: none" > <button class="btn btn-outline-info m-3" type="button" >
                    <?php
                    $email = $_SESSION['mail'];
                    $sId= 0;
                    $query = "SELECT sepetId FROM users WHERE email='$email' ";
                    if (isset($conn)) {
                        $queryConn = mysqli_query($conn, $query);

                        if (!$queryConn){
                            echo "Sepette Ürün Bulunmamaktadır";
                        }else{
                            while($row = mysqli_fetch_array($queryConn)){
                                $sId= $row['sepetId'];
                                $query2 = "SELECT count(urunId) as num FROM sepet WHERE sepetId=$sId;  ";
                                $queryConn2 = mysqli_query($conn, $query2);

                                if (!$queryConn2){
                                    echo "Error";
                                }else{
                                    while($row2 = mysqli_fetch_array($queryConn2)){
                                        $n = $row2['num'];

                                        echo "Sepette ".$n." Ürün ";
                                    }
                                }
                            }
                        }
                    } ?>
                </button></a>
            <a href="../logout.php">  <button class="btn btn-outline-info m-3" type="button" >Çıkış</button></a>

        </div>


    </div>


</div>
<!-- navbar end -->

<!-- kategori bar start -->

<div class="container">
    <div class="row  justify-content-center"  style=" background-color: #9c9c9c;" >
        <div class="col-sm d-flex flex-wrap justify-content-center homeLink">
            <a href="" class="homeLink1 p-2  "> elektronik</a>
        </div>
        <div class="col-sm d-flex flex-wrap justify-content-center homeLink">
            <a href="" class="homeLink1 p-2">  moda</a>
        </div>
        <div class="col-sm d-flex flex-wrap justify-content-center homeLink">

            <a href="" class="homeLink1 p-2">ev,yaşam,kırtasiye</a> </div>

        <div class="col-sm d-flex flex-wrap justify-content-center homeLink">
            <a href="" class="homeLink1 p-2"> oto,bahce,yapi market</a></div>
        <div class="col-sm d-flex flex-wrap justify-content-center homeLink">
            <a href="" class="homeLink1 p-2">anne,bebek,oyuncak</a> </div>
        <div class="col-sm d-flex flex-wrap justify-content-center homeLink">
            <a href="" class="homeLink1 p-2"> spor,outdoor</a></div>
        <div class="col-sm d-flex flex-wrap justify-content-center homeLink">
            <a href="" class="homeLink1 p-2"> kozmetik,kisisel bakim</a></div>
        <div class="col-sm d-flex flex-wrap justify-content-center homeLink">
            <a href="" class="homeLink1 p-2">supermarket,petshop</a> </div>
        <div class="col-sm d-flex flex-wrap justify-content-center homeLink">
            <a href="" class="homeLink1 p-2">kitap,muzik,film,hobi</a> </div>

    </div>


</div>

<!-- kategori bar end -->
<?php
    $urunler = "SELECT * FROM sepet WHERE sepetId='$sId' ";
if (isset($conn)) {
    $queryConnUrun = mysqli_query($conn, $urunler);

    if (!$queryConnUrun){
        echo "Error";
    }else{
        while($row = mysqli_fetch_array($queryConnUrun)){
            $uId= $row['urunId'];
            $urun = "SELECT *  FROM urun WHERE urunId=$uId;  ";
            $queryConn2 = mysqli_query($conn, $urun);

            if (!$queryConn2){
                echo "Sepette Ürün Bulunmamaktadır!";
            }else{
                while($row2 = mysqli_fetch_array($queryConn2)){
                    ?>
                        <div class="container">

                            <div class="row m-5" >
                                <div class="col-sm-3">
                                    <div class="card" >
                                        <img  class="card-img-top" src="<?php echo  $row2['img'] ; ?>" >

                                    </div>
                                </div>
                                <div class="col-sm-9" >
                                    <div class="card row" >
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row2['urunAdı']; ?></h5>
                                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $row2['aciklama']; ?></h6>
                                            <p class="card-text"><?php echo $row2['fiyat']; ?>₺</p>
                                            <div class="card-body">

                                                <a href="#" class="card-link">Card link</a>
                                                <a href="#" class="card-link">Another link</a>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <?php
                }
            }

        }
    }
}
?>

<div  class="container">

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