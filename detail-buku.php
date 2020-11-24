<?php
error_reporting(0);
    include 'db.php';
    $mimin = mysqli_query($conn, "SELECT admin_telpon, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($mimin);

    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Buku</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
   <!-- Header -->
    <header>
        <div class="container">
        <h1><a href="index.php">Toko Buku</a></h1>
        <ul>
            <li><a href="buku.php">Produk</a></li>
        </ul>
        </div>
    </header>

    <!--Pencarian-->
    <div class="cari">
        <div class="container">
            <form action="buku.php">
                <input type="text" name="cari" placeholder="Cari Buku" value="<?php echo $_GET['cari'] ?>">
                <input type="hidden" name="kat" value=<?php echo $_GET['kat'] ?>>
                <input type="submit" name="search" value="Cari Buku">
            </form>
        </div>
    </div>

    <!--Detail Buku-->
    <div class="section">
        <div class="container">
        <h3>Detail Buku</he>
            <div class="box">
                <div class="col-2">
                    <img src="buku/<?php echo $p->product_image ?>" width="100%">
                </div>
                <div class="col-2">
                    <h3><?php echo $p->product_name ?></h3>
                    <h4>Rp. <?php echo number_format($p->product_price) ?></h4>
                    <p>Deskripsi :<br>
                        <?php echo $p->product_description ?>
                    </p>
                    <p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telpon ?>&text=Saya ingin membeli buku anda." target="_blank">Hubungi Whatsapp Penjual <img src="img/WhatsApp-Logo (1).png" width="50px"></a></p>
                </div>
            </div>
        </div>
    </div>


    <!--footer-->
    <div class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p><?php echo $a->admin_address ?></p>

            <h4>Email</h4>
            <p><?php echo $a->admin_email ?></p>

            <h4>Telepon</h4>
            <p><?php echo $a->admin_telpon ?></p>

            <small>Copyright &copy; 2020 - Toko Buku.</small>
        </div>
    </div>
</body>
</html>