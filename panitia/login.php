<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);    
    define("RESMI", "OK");
    session_start();
    
        //konfigurasi
    require('../config/database.php');
    require('../config/csrf-token.php');
    require('../config/fungsi.php');
    require('../config/gump.class.php');
    //token
    $csrf = new csrf();
    $token_id = $csrf->get_token_id();    
    $token_value = $csrf->get_token($token_id);

    if(isset($_GET['mod'])){
        $mod = sanitasi($_GET['mod']);
        $hal = sanitasi($_GET['hal']);
    }
    $sql = $db->prepare("SELECT skl_nama FROM rp_sekolah");
    $sql->execute();
    $skl = $sql->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIAKAD <?= $skl['skl_nama'];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">        
    <!-- Theme style -->
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/AdminLTE.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../asset/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">  
    <!-- jQuery -->
    <script src="../asset/js/jquery.min.js"></script>  
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="../asset/plugins/sweetalert/sweetalert.css">
    <script src="../asset/plugins/sweetalert/sweetalert.min.js"></script>    
</head>
<body class="hold-transition login-page">
    <?php 
        //if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($csrf->check_valid('post')){
            //var_dump($_POST[$token_id]);
            $gump = new GUMP();
            $login = $_POST['login'];
            $pass  = $_POST['pass'];

            $_POST = array(
                'login' => $login,
                'pass'  => $pass
            );

            $_POST = $gump->sanitize($_POST);

            $gump->validation_rules(array(
                'login' => 'required',
                'pass'  => 'required'
            ));

            $gump->filter_rules(array(
                'login' => 'trim|sanitize_string',
            ));

            $boleh = $gump->run($_POST);
            if($boleh === false){
                $error[] = $gump->get_readable_errors(true);
            }else{
                $sql = $db->prepare("SELECT * FROM rp_admin WHERE adm_username = ?");
                $sql->execute(array($login));
                $log = $sql->fetch(PDO::FETCH_ASSOC);
                if($log){
                    if(password_verify($pass, $log['adm_password'])){
                        $_SESSION['admID'] = $log['adm_id'];
                        $_SESSION['nama'] = $log['adm_username'];
                        $_SESSION['admin'] = $log['adm_nama'];
                        header("Location: index.php");
                    }else{
                        ?><script>sweetAlert("Oops...", "Kata sandi/pengguna tidak sesuai", "error");</script><?php
                    }
                }else{
                    ?><script>sweetAlert("Oops...", "Nama pengguna/sandi tidak sesuai", "error");</script><?php
                }
            }
        }
    ?>
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Admin</b>SIAKAD</a>
        </div>        
        <div class="login-box-body">            
              <p class="login-box-msg">Silahkan login untuk memulai</p>
                <?php 
                    if(isset($error)){
                        foreach ($error as $error) {
                            ?>
                            <div class="alert alert-warning">
                                <h5><i class="fa fa-warning"></i> Terjadi Kesalahan</h5>
                                <?= $error;?>
                            </div>
                            <?php
                        }
                    }
                ?>
                <form action="" method="post">
                    <div class="form-group has-feedback">
                        <input type="hidden" name="<?= $token_id ?>" value="<?= $token_value ?>">
                        <input type="text" name="login" class="form-control" placeholder="username" required>
                        <span class="fa fa-envelope form-control-feedback"></span>                           
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="pass" class="form-control" placeholder="Password" required>                      
                            <span class="fa fa-lock form-control-feedback"></span>                           
                    </div>
                    <div class="row">
                        <div class="col-8">
                            
                        </div>                        
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>                        
                    </div>
                </form>                
            </div>            
        
    </div>
    <!-- Bootstrap 4 -->
    <script src="../asset/js/bootstrap.min.js"></script>             
</body>
</html>