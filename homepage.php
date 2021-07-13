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
                        <img src="logo.png" alt="" width="410" height="114" class="d-inline-block align-text-top">
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
<?php
$kategori = array();
  $kategoriler = "SELECT * FROM kategoriler";
  if (isset($conn)){
      $result = mysqli_query($conn, $kategoriler);
      if(!$result){

      }else{

         #$kategori= $row['kategoriAdı'];
        while( $row = mysqli_fetch_array($result)) {

            array_push($kategori,$row['kategoriAdı']);

        }
      }
  }


?>
    <div class="container-fluid">
        <div class="row p-6 "  style=" background-color: #9c9c9c;">
            <div class=" col-sm d-flex flex-wrap align-items-center justify-content-center mx-2" style="float:left;">
                <table class="table-primary  " style="float:left;">
                    <tr >
             <?php
                 for($i=0;$i<count($kategori);$i++){

                    ?>  <th></th>
                     <?php
                 }

             foreach ($kategori as $value) { ?>
                    <tr style="float:left;">
                        <td class="kategoriBox " > <?php echo $value ?></td>
              <?php
              }
              ?>
                </table>
            </div>
        </div>


    </div>

<!-- kategori bar end -->
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
