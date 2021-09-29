<?php

    include 'config/config.php';

    session_start();
    if (!isset($_SESSION['nama']) && $_SESSION['hak_akses'] == 'pengguna'){
        header("Location: login.php");
    }

    if(isset($_GET['kategori'])){
        $kategori = $_GET['kategori'];
    }
    else{
        die("sorry. No kategori selected");
    }

    $ambil_data_kategori = "SELECT * FROM produk_kulit WHERE kategori=:kategori";
    
    $sql = $db->prepare($ambil_data_kategori);

    $sql->bindParam(':kategori',$kategori);

    $sql->execute();

    function rupiah($rupiah){
        $hasil_rupiah = "Rp " . number_format($rupiah,2,',','.');
        return $hasil_rupiah;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/css/main.css" />
        <title>Kategori | INTANA LEATHER COLLECTION</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    </head>
    <body class="bg-light">
        <section>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand fs-6" href="index.php">
                        <img src="/assets/images/logo.png" class="img-logo" alt="" />
                        INTANA LEATHER COLLECTION
                    </a>
                    <div class="d-flex collapse navbar-collapse me-4" id="navbarSupportedContent">
                        <form class="d-flex flex-fill">
                            <input class="flex-auto form-control me-2" type="search" placeholder="Cari produk disini" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Cari</button>
                        </form>
                    </div>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION['nama']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="pengaturan.php">Pengaturan</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="./utils/logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div className="mt-3">
                <p class="text-dark fs-1 fw-bold text-center">Kategori : <?php echo $kategori; ?></p>
                <div class="row justify-content-start min-vh-100 w-100 mx-auto">
                        <?php
                            while($hasil = $sql->fetch(PDO::FETCH_ASSOC)){
                                echo '
                                    <div class="col-md-4">
                                        <div class="mx-1 my-1 pb-1 position-relative cursor-pointer rounded shadow-sm" style="background-color: white; aspect-ratio: 1/1;">
                                            <a href="/kategori/produk.php?id='.$hasil['pkid'].'" class="text-decoration-none">
                                                <img src="admin/assets/images/produk/'.$hasil['foto'].'" class="w-100 h-100 position-relative object-fill">
                                                <div class="p-3">
                                                    <p class="text-dark fs-3 text-break fw-bold whitespace-nowrap overflow-hidden text-ellipsis mb-0">'.$hasil['namapk'].'</p>
                                                    <p class="text-dark fs-6 mb-0">'.rupiah($hasil['harga']).'</p>
                                                </div>        
                                                <p class="text-center text-dark mt-3 fs-6">Lihat Produk</p> 
                                            </a>    
                                        </div>      
                                    </div>
                                ';
                            }
                        ?>
                    <!-- <div class="col-md-4">
                        <div class="mx-1 my-1 pb-1 position-relative cursor-pointer rounded shadow-sm" style="background-color: white; aspect-ratio: 1/1;">
                            <a href="/kategori/produk.php" class="text-decoration-none">
                                <img src="/assets/images/Sepatu/2.png" class="w-100 h-100 position-relative object-fill">
                                <div class="p-3">
                                    <p class="text-dark fs-3 text-break fw-bold whitespace-nowrap overflow-hidden text-ellipsis mb-0">Sampel 2</p>
                                    <p class="text-dark fs-6 mb-0">Rp 78.000</p>
                                </div>        
                                <p class="text-center text-dark mt-3 fs-6">Lihat Produk</p> 
                            </a>    
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mx-1 my-1 pb-1 position-relative cursor-pointer rounded shadow-sm" style="background-color: white; aspect-ratio: 1/1;">
                            <a href="/kategori/produk.php" class="text-decoration-none">
                                <img src="/assets/images/Sepatu/3.png" class="w-100 h-100 position-relative object-fill">
                                <div class="p-3">
                                    <p class="text-dark fs-3 text-break fw-bold whitespace-nowrap overflow-hidden text-ellipsis mb-0">Sampel 3</p>
                                    <p class="text-dark fs-6 mb-0">Rp 23.000</p>
                                </div>        
                                <p class="text-center text-dark mt-3 fs-6">Lihat Produk</p> 
                            </a>    
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mx-1 my-1 pb-1 position-relative cursor-pointer rounded shadow-sm" style="background-color: white; aspect-ratio: 1/1;">
                            <a href="/kategori/produk.php" class="text-decoration-none">
                                <img src="/assets/images/Sepatu/4.png" class="w-100 h-100 position-relative object-fill">
                                <div class="p-3">
                                    <p class="text-dark fs-3 text-break fw-bold whitespace-nowrap overflow-hidden text-ellipsis mb-0">Sampel 4</p>
                                    <p class="text-dark fs-6 mb-0">Rp 76.000</p>
                                </div>        
                                <p class="text-center text-dark mt-3 fs-6">Lihat Produk</p> 
                            </a>    
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mx-1 my-1 pb-1 position-relative cursor-pointer rounded shadow-sm" style="background-color: white; aspect-ratio: 1/1;">
                            <a href="/kategori/produk.php" class="text-decoration-none">
                                <img src="/assets/images/Sepatu/5.png" class="w-100 h-100 position-relative object-fill">
                                <div class="p-3">
                                    <p class="text-dark fs-3 text-break fw-bold whitespace-nowrap overflow-hidden text-ellipsis mb-0">Sampel 5</p>
                                    <p class="text-dark fs-6 mb-0">Rp 23.000</p>
                                </div>        
                                <p class="text-center text-dark mt-3 fs-6">Lihat Produk</p> 
                            </a>    
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mx-1 my-1 pb-1 position-relative cursor-pointer rounded shadow-sm" style="background-color: white; aspect-ratio: 1/1;">
                            <a href="/kategori/produk.php" class="text-decoration-none">
                                <img src="/assets/images/Sepatu/6.png" class="w-100 h-100 position-relative object-fill">
                                <div class="p-3">
                                    <p class="text-dark fs-3 text-break fw-bold whitespace-nowrap overflow-hidden text-ellipsis mb-0">Sampel 6</p>
                                    <p class="text-dark fs-6 mb-0">Rp 65.000</p>
                                </div>        
                                <p class="text-center text-dark mt-3 fs-6">Lihat Produk</p> 
                            </a>    
                        </div>
                    </div> -->
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <ul class="pagination align-bottom">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </div>
            </div>
            <footer class="text-center text-lg-start bg-light text-muted">
                <div class="text-center p-4">
                    Copyright &copy; 2021 - Powered by Intana Leather Collection 
                </div>
            </footer> 
        </section>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    </body>
</html>