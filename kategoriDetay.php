<?php

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

<!-- kategori bar start -->

<div class="container-fluid">
    <div class="row  justify-content-center"  style=" background-color: #9c9c9c;" >

        <?php
        $kategoriler = "SELECT * FROM kategoriler";
        $query = mysqli_query($conn, $kategoriler);
        if (!$query){
            echo "Error";
        }else {
            while ($row = mysqli_fetch_array($query)) {
                ?>   <div class="col-sm d-flex flex-wrap justify-content-center homeLink">

                    <?php
                    $kAdı =$row["kategoriAdı"];
                    echo "<form action='kategoriDetay.php' method='POST'><button class='btn '
                                value=" . $row["kategoriId"] . " type='submit' name='kategoriId'>$kAdı</button></form>"
                    ?>
                </div>

                <?php
            }
        }
        ?>

        <!--  <div class="col-sm d-flex flex-wrap justify-content-center homeLink">
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
              <a href="" class="homeLink1 p-2">kitap,muzik,film,hobi</a> </div> -->

    </div>


</div>
<!-- ürünler start-->
<?php

if(isset($_POST['kategoriId'])){
    $kategoriId = $_POST['kategoriId'];
    $findUrun= "SELECT * FROM urun WHERE kategoriId='$kategoriId';";
    $findUrunConn = mysqli_query($conn, $findUrun);

    if (!$findUrunConn){
        echo "Error";
    }else{
        while($row = mysqli_fetch_array($findUrunConn)){
            $uId= $row['urunId'];

                    ?>
                    <div class="container">

                        <div class="row m-5" >
                            <div class="col-sm-3">
                                <div class="card" >
                                    <img  class="card-img-top" src="<?php echo  $row['img'] ; ?>" >

                                </div>
                            </div>
                            <div class="col-sm-9" >
                                <div class="card row" >
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['urunAdı']; ?></h5>
                                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['aciklama']; ?></h6>
                                        <p class="card-text"><?php echo $row['fiyat']; ?>₺</p>
                                        <div class="card-body">



                                            <?php

                                            echo "<form action='kategoriDetay.php' method='POST'><button class='btn btn-outline-info m-3'
                                           value=" . $row["urunId"] . " type='submit' name='urunId'>Sepete Ekle</button></form>"
                                            ?>


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

?>
<!-- ürünler end-->
<?php

      if(isset($_POST['urunId'])){

          echo '<script>
                    if(confirm("Üye ol!")) {
                    window.location.href = "register.php"
                    }</script>';
          exit();
      }

?>

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
<!-- kategori bar end --><!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
</body>
</html>
