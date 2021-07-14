<?php
session_start();

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
                        echo "Error";
                    }else{
                        while($row = mysqli_fetch_array($queryConn)){
                            $name = $row['userName'];
                            echo "Hi! ".$name;
                        }
                    }
                } ?>
                </button></a>
            <a href="sepet.php" style="text-decoration-line: none" > <button class="btn btn-outline-info m-3" type="button" >
                    <?php
                    $email = $_SESSION['mail'];

                    $query = "SELECT sepetId FROM users WHERE email='$email' ";
                    if (isset($conn)) {
                        $queryConn = mysqli_query($conn, $query);

                        if (!$queryConn){
                            echo "Error";
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

<div class="container-fluid">
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

<!-- slider start -->
<div class="container">
    <div class="row h-100">
        <div class="col-sm-10 offset-1">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators"       >
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../images/slide1.png" class="d-inline-block w-100  " alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="../images/slider2.png" class="d-inline-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="../images/slider3.png" class="d-inline-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

    </div>
</div>

<!-- slider end -->
<!-- markalar start-->

<div class="container">
    <div class="row mt-5 offset-1">
        <?php
        $marka = "SELECT * FROM marka  ";
        if (isset($conn)) {
            $queryConnMarka = mysqli_query($conn, $marka);
            if (!$queryConnMarka){
                echo "Error";
            }else{
                while($row = mysqli_fetch_array($queryConnMarka)){
                    $mId= $row['markaId'];

                    ?>
                    <div class="col-sm-2 m-2 ">
                        <a target="_blank" href="">
                            <!-- <img src="images/ebebekLogo.png"  alt="Forest" style="width:150px"> -->
                            <img  class="marka w-100 h-100" src="data:image/jpeg;base64,<?php echo base64_encode( $row['logo'] ); ?>" />
                        </a>
                    </div>




                    <?php
                }
            }


        }
        ?>

    </div>
</div>
<!-- markalar end -->
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
