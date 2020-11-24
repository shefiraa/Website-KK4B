<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true) {
        echo '<script>window.location="login.php"</script>';
    }
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
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
</head>
<body>
   <!-- Header -->
    <header>
        <div class="container">
        <h1><a href="dashboard.php">Toko Buku</a></h1>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="category.php">Kategori</a></li>
            <li><a href="book.php">Data Buku</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
        </div>
    </header>

    <!-- Content -->
    <div class="section">
        <div class="container">
            <h3>Tambah Buku</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="kategori" required>
                        <option value="">--Pilih--</option>
                        <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                            while($r = mysqli_fetch_array($kategori)) {
                        ?>
                        <option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
                            <?php } ?>
                    </select>

                    <input type="text" name="nama" class="input-control" placeholder="Judul Buku" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                    <input type="file" name="gambar" class="input-control" required>
                    <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea><br>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1">Stok Tersedia</option>
                        <option value="0">Habis</option>
                    </select>
                    <input type="submit" name="submit" value="Kirim" class="klik">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                       // print_r($_FILES['gambar']);
                       // menampung inputan dari form
                       $kategori    = $_POST['kategori'];
                       $nama        = $_POST['nama'];
                       $harga       = $_POST['harga'];
                       $deskripsi   = $_POST['deskripsi'];
                       $status      = $_POST['status'];

                       // menampung data file yang diupload
                       $filename = $_FILES['gambar']['name'];
                       $tmp_name = $_FILES['gambar']['tmp_name'];

                       $type1 = explode('.', $filename);
                       $type2 = $type1[1];

                       $newname = 'buku'.time().'.'.$type2;

                       // menampung data format file yang diizinkan 
                       $tipe_izin = array('jpg', 'jpeg', 'png', 'gif');

                       // validasi format file
                       if(!in_array($type2, $tipe_izin)) {
                            // jika format file tidak ada di dalam tipe diizinkan
                            echo '<scrip>alert("Format Tidak Sesuai")</script>';
                        
                       }else {
                            // jika format file sesuai dengan yang ada di dalam array tipe diizinkan
                            // proses upload file sekaligus insert ke database
                            move_uploaded_file($tmp_name, './buku/'.$newname);

                            $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
                                        null,
                                        '".$kategori."',
                                        '".$nama."',
                                        '".$harga."',
                                        '".$deskripsi."',
                                        '".$newname."',
                                        '".$status."',
                                        null     
                                            ) ");

                        if($insert) {
                            echo '<script>alert("Data Berhasil Disimpan")</script>';
                            echo '<script>window.location="book.php"</script>';
                        }else {
                            echo 'Gagal'.mysqli_error($conn);
                        }
                    }

                    
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2020 - Toko Buku.</small>
        </div>
    </footer>
    <script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>