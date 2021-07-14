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
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <hr>
                    <?php
                    $kategori = "SELECT * FROM kategoriler  ";
                    if (isset($conn)) {
                    $queryConnK = mysqli_query($conn, $kategori);
                    if (!$queryConnK){
                        echo "Error";
                    }else{
                    while($row = mysqli_fetch_array($queryConnK)){
                    $mId= $row['kategoriId'];
                    ?>


                    <tbody>
                    <tr>
                        <th scope="row"><?php echo $row['kategoriId']; ?></th>
                        <td><?php echo $row['kategoriAdı']; ?></td>
                        <td>
                            <?php
                            echo "<form action='silKategori.php' method='POST'><button class='btn btn-outline-info m-3'
                                value=" . $row["kategoriId"] . "  name='sil'>Sil</button></form>"
                            ?>

                           </td>
                        <td><a href="kategoriDuzenle.php">  <button class="btn btn-outline-info m-3" type="button" name="duzenle" >Düzenle</button></a></td>
                    </tr>

                    <?php
                    }
                    }


                    }
                    ?>
                </table>
                <a href="kategoriEkle.php">  <button class="btn btn-outline-info m-3" type="button" name="ekle" >Ekle</button></a>
            </div>
        </div>
    </div>
</div>

</div>
</body>
</html>