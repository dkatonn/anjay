<?php
    session_start();
    $con = mysqli_connect("localhost", "root", "", "ayam_bakar");
    if (!$con) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<style>
    .main{
        height: 100vh;
    }

    .login-box{
        width: 450px;
        height: 250px;
        border-radius: 15px;
    }
</style>

<body>
   <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-4 shadow">
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div>
                    <label for="password">password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div>
                    <button class="btn btn-success form-control mt-4" type="submit" name="loginbtn">Login</button>
                </div>
            </form>
        </div>

        <div class="mt-3">
            <?php
                if (isset($_POST['loginbtn'])) {
                    $username = trim(htmlspecialchars($_POST['username']));
                    $password = trim(htmlspecialchars($_POST['password']));
        
                    $stmt = mysqli_prepare($con, "SELECT * FROM usersadmin WHERE username=?");
                    mysqli_stmt_bind_param($stmt, "s", $username);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                
                    if ($result) {
                        $countdata = mysqli_num_rows($result);
                        if ($countdata > 0) {
                            $data = mysqli_fetch_array($result);
                            if (password_verify($password, $data['password'])){
                                $_SESSION['username'] = $data['username'];
                                $_SESSION['login'] = true;
                                header('location: ..//adminpanel');
                            }
                            else{
                                ?>
                                <div class="alert alert-warning" role="alert">
                                    Password Atau Username salah!
                                </div>
                                <?php
                            }
                        } else {
                           ?>
                            <div class="alert alert-warning" role="alert">
                                Akun Tidak Tersedia Di Database!
                            </div>
                            <?php
                        }
                    } else {
                        echo "Error: ". mysqli_error($con);
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>