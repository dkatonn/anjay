<?php
    require("session.php");
    require "../database/DBController.php";

    $id = $_GET['p'];

    $con = mysqli_connect("localhost", "root", "", "ayam_bakar");

    $query = mysqli_query($con, "SELECT a.*, b.item_name AS item_name FROM product a JOIN kategori b ON a.item_id =b.item_id WHERE a.item_id='$id'");
    $data = mysqli_fetch_array($query);

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori WHERE item_id!='$data[item_id]'");

    function generateRandomString($lenght = 10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $lenght; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Detail</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<style>
    form div{
        margin-bottom: 10px;
    }
</style>
<body>
    <?php require "navbar.php"?>

    <div class="container mt-4">
        <h2>Detail Produk</h2>

        <div class="col-12 col-md-6 mb-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $data['item_name'];?>" class="form-control" autocomplete=off required>
                </div>
                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="<?php echo $data['item_id'];?>"><?php echo $data['item_name'];?></option>
                        <?php
                            while($dataKategori = mysqli_fetch_array($queryKategori)){
                        ?>
                            <option value="<?php echo $dataKategori['item_id']; ?>"><?php echo $dataKategori['item_name']; ?></option>
                        <?php        
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga">Harga</label>
                    <input type="number" class="from-control" value="<?php echo $data['item_price']; ?>" name="harga" required>
                </div>
                <div>
                    <label for="currentFoto">Foto Dari Produk</label>
                    <img src="../image/<?php echo $data['item_image']?>" alt="" width="500px">
                </div>
                <div>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">
                        <?php echo $data['item_detail'];?>
                    </textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" name="Update">Update</button>
                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                </div>
            </form>
            <?php
                if(isset($_POST['Update'])){
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['item_detail']);

                    $target_dir = "../image/";
                    $nama_file = basename($_FILES['foto']["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"]; 
                    $random_name = generateRandomString(20);
                    $new_name = $random_name ."." . $imageFileType;

                    if($nama==''|| $kategori==''|| $harga==''){
            ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            Nama, kategori dan harga wajib di isi!
                        </div>
            <?php            
                    }
                    else{
                        $queryUpdate = mysqli_query($con, "UPDATE product SET item_id='$kategori', item_name='$nama', item_price='$harga', item_detail='$detail' WHERE item_id=$id");

                        if($nama_file!=''){
                            if($image_size > 600000){
            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    Foto tidak bisa lebih dari 600Kb!
                                </div>
            <?php                    
                            }
                            else{
                                if($imageFileType != 'jpg' && $imageFileType != 'png'){
            ?>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        Foto wajib bersifat jpg atau png!
                                    </div>
            <?php                        
                                }
                                else{
                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);

                                    $queryUpdate = mysqli_query($con, "UPDATE produk SET foto='$new_name' WHERE id='$id'");

                                    if($queryUpdate){
            ?>
                                        <div class="alert alert-primary mt-3" role="alert">
                                            Produk Berhasil Terupdate
                                        </div>

                                        <meta http-equiv="refresh" content="2; url=produk.php" />
            <?php                            
                                    }
                                    else{
                                        echo mysqli_error($con);
                                    }
                                }
                            }
                        }
                    }
                }
                if(isset($_POST['hapus'])){
                    $queryHapus = mysqli_query($con, "DELETE FROM produk WHERE id='$id'");
                    if($queryHapus){
            ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            Produk Berhasil Terupdate
                        </div>
    
                        <meta http-equiv="refresh" content="1; url=produk.php" />
            <?php            
                    }
                }
            ?>    
        </div>
    </div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>