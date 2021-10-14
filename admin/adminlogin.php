
<?php
session_start();
error_reporting(0);
include('includes/config.php');

if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}
//hcaptcha mới
if ( isset($_POST['login']) ) {
    $data = array(
        'secret' => "0xCdcf8C9DbC55117e7A792Ef1Db6EE8E3f958673f",
        'response' => $_POST['h-captcha-response']
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://hcaptcha.com/siteverify");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $responseData = json_decode($response,TRUE);
     if(!$responseData['success']) {
         echo "<script>alert('人間の確認が失敗しました');</script>";
     } else {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql      = "SELECT UserName,Password FROM admin WHERE UserName=:username and Password=:password";
        $query    = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $_SESSION['alogin'] = $_POST['username'];
            echo "<script type='text/javascript'> document.location ='home.php'; </script>";
        } else {
            echo "<script>alert('ログインが失敗しました');</script>";
        }
     }
    
}

// vercode cũ 
// if (isset($_POST['login'])) {
//     //code for captach verification
//     if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
//         echo "<script>alert('確認コードが正しくない');</script>";
//     } else {
//         $username = $_POST['username'];
//         $password = md5($_POST['password']);
//         $sql      = "SELECT UserName,Password FROM admin WHERE UserName=:username and Password=:password";
//         $query    = $dbh->prepare($sql);
//         $query->bindParam(':username', $username, PDO::PARAM_STR);
//         $query->bindParam(':password', $password, PDO::PARAM_STR);
//         $query->execute();
//         $results = $query->fetchAll(PDO::FETCH_OBJ);
//         if ($query->rowCount() > 0) {
//             $_SESSION['alogin'] = $_POST['username'];
//             echo "<script type='text/javascript'> document.location ='home.php'; </script>";
//         } else {
//             echo "<script>alert('ログインが失敗しました');</script>";
//         }
//     }
// }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Online Library Management System</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <!-- FONT AWESOME STYLE  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet"/>
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>

    <style type="text/css">
        body {
            height:100%;
            margin: 0;
            background-image: url(./assets/img/login_04.gif);
            background-repeat: no-repeat;
            background-size:cover;
        }
        .login-form{
            margin-top: 120px;
        }
           
        .capt-key {
    margin-left: 190px;
    margin-top: 31px;
    margin-bottom: 15px;
}
    </style>
</head>
<body>
<div class="content-wrapper">
    <div class="container">
    
        <!--LOGIN - START-->
        <div class="row login-form">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading">管理者ログインフォーム</div>
                    <div class="panel-body">
                        <form role="form" method="post">
                          <div class="form-group">
                                <label>Admin</label>
                                <input class="form-control" type="text" name="username" autocomplete="off" required/>
                            </div>
                            <div class="form-group">
                                <label>パスワード</label>
                                <input class="form-control" type="password" name="password" autocomplete="off" required/>         
                            </div>
                            <div class="form-group">
                                <!-- vercode cũ -->
                                <!-- <label>確認コード : </label>
                                <input type="text" name="vercode" maxlength="10" autocomplete="off" required  style="width:150px; height: 25px;"/>&nbsp;&nbsp;<img src="captcha.php">  -->

                                  <!-- hcaptcha mới -->
                                 <div class="h-captcha capt-key" data-sitekey="5d54f2da-f729-46d7-933e-b26f33eda5f6"></div>
                            </div>
                            
                            <button type="submit" name="login" class="btn btn-info">ログイン</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
        <!---LOGIN PABNEL END-->

    </div>
</div>

<!-- FOOTER SECTION END-->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
<!-- CUSTOM SCRIPTS  -->
<script src="assets/js/custom.js"></script>
<script src="https://hcaptcha.com/1/api.js" async defer></script>
</script>
</body>
</html>
