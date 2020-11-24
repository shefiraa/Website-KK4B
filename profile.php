<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true) {
        echo '<script>window.location="login.php"</script>';
    }

    $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."' ");
    $d = mysqli_fetch_object($query);
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
            <h3>Profile</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name ?>" required>
                    <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username ?>" required>
                    <input type="text" name="telpon" placeholder="Nomor Telepon" class="input-control" value="<?php echo $d->admin_telpon ?>" required>
                    <input type="text" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email ?>" required>
                    <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->admin_address ?>" required>
                    <input type="submit" name="submit" value="Ubah Profile" class="klik">
                </form>
                <?php
                    if(isset($_POST['submit'])) {

                        $nama       = ucwords($_POST['nama']);
                        $user       = $_POST['user'];
                        $telpon     = $_POST['telpon'];
                        $email      = $_POST['email'];
                        $alamat     = ucwords($_POST['alamat']);

                        $update     = mysqli_query($conn, "UPDATE tb_admin SET
                                            admin_name = '".$nama."' ,
                                            username = '".$user."' ,
                                            admin_telpon = '".$telpon."' ,
                                            admin_email = '".$email."' ,
                                            admin_address = '".$alamat."'
                                            WHERE admin_id = '".$d->admin_id."' ");
                        if($update) {
                            echo '<script>alert("Yeay! Data Berhasil Diubah!")</script>';
                            echo '<script>window.location="profile.php"</script>';
                        }else {
                            echo 'Gagal'.mysqli_error($conn);
                        }

                    }
                ?>
            </div>

            <h3>Ubah Password</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="password" name="passbaru" placeholder="Password Baru" class="input-control" required>
                    <input type="password" name="passkonfir" placeholder="Konfirmasi Password Baru Anda" class="input-control" required>
                    <input type="submit" name="ubah_pass" value="Ubah Password" class="klik">
                </form>
                <?php
                    if(isset($_POST['ubah_pass'])) {

                        $passbaru     = $_POST['passbaru'];
                        $passkonfir   = $_POST['passkonfir'];

                        if($passkonfir != $passbaru) {
                            echo '<script>alert("Konfirmasi Password Baru Tidak Sesuai!")</script>';
                        }else {

                            $u_pass    = mysqli_query($conn, "UPDATE tb_admin SET
                                            password = '".MD5($passbaru)."'
                                            WHERE admin_id = '".$d->admin_id."' ");
                            if($u_pass) {
                                echo '<script>alert("Yeay! Data Berhasil Diubah!")</script>';
                                echo '<script>window.location="profile.php"</script>';
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
</body>
</html>