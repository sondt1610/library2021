<?php
session_start();
include('includes/config.php');
error_reporting(0);

function interpolateQuery($query, $params) {
    $keys = array();

    # build a regular expression for each parameter
    foreach ($params as $key => $value) {
        if (is_string($key)) {
            $keys[] = '/:'.$key.'/';
        } else {
            $keys[] = '/[?]/';
        }
    }

    $query = preg_replace($keys, $params, $query, 1, $count);

    #trigger_error('replaced '.$count.' keys');

    return $query;
}

if (strlen($_SESSION['alogin']) == 0) {
    header('location:adminlogin.php');
} else {
    $sql_select      = "SELECT * FROM setting";
    $query_select    = $dbh->prepare($sql_select);
    $query_select->execute();
    $setting = $query_select->fetch();
    if(empty($setting)) {
        $setting = [
            'id' => 0,
            'school_name' => '',
            'school_mail' => '',
            'max_lended_book' => SOLANMUON,
            'max_lended_time' => SONGAY,
        ];
    }
//    var_dump($_SESSION);
    if($_SESSION['msg']){
        $msg = $_SESSION['msg'];
    }
    if($_SESSION['error']){
        $error = $_SESSION['error'];
    }
    if (isset($_POST['save_settings'])) {
        $id = $_POST['id'];
        $school_name = $_POST['school_name'];
        $school_mail = $_POST['school_mail'];
        $max_lended_book = $_POST['max_lended_book'];
        $max_lended_time = $_POST['max_lended_time'];

        if($id) {
            $sql_update = "update  setting set school_name=:school_name, school_mail=:school_mail,
                max_lended_book=:max_lended_book, max_lended_time=:max_lended_time where id=:id";
        } else {
            $sql_update = "INSERT INTO  setting(school_name, school_mail, max_lended_book, max_lended_time)
                VALUES(:school_name, :school_mail, :max_lended_book, :max_lended_time)";
        }
        $query_update = $dbh->prepare($sql_update);
        if($id) {
            $query_update->bindParam(':id', $id, PDO::PARAM_STR);
        }
        $query_update->bindParam(':school_name', $school_name, PDO::PARAM_STR);
        $query_update->bindParam(':school_mail', $school_mail, PDO::PARAM_STR);
        $query_update->bindParam(':max_lended_book', $max_lended_book, PDO::PARAM_STR);
        $query_update->bindParam(':max_lended_time', $max_lended_time, PDO::PARAM_STR);
        $status_update = $query_update->execute();
        $new_params = [
            'id' => $id,
            'school_name' => $school_name,
            'school_mail' => $school_mail,
            'max_lended_book' => $max_lended_book,
            'max_lended_time' => $max_lended_time,
        ];
        $query_detail = interpolateQuery($query_update->queryString, $new_params);
        if($status_update){
            $_SESSION['msg'] = "update setting success";
        } else {
            $_SESSION['error'] = "error";
        }
        header('location:setting.php');
    } else {
        $_SESSION['msg'] = "";
        $_SESSION['error'] = "";
    }

    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <title>Setting </title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet"/>
        <!-- FONT AWESOME STYLE  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet"/>
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>
    </head>
    <script type="text/javascript">
        function valid() {
            if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                alert("New Password and Confirm Password Field do not match  !!");
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>

    <body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">貸出設定</h4>
                </div>
            </div>
            <?php if ($error) { ?>
                <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                </div><?php } else if ($msg) { ?>
                <div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div><?php } ?>
            <!--LOGIN PANEL START-->
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">設定</div>
                        <div class="panel-body">
                            <form role="form" method="post" name="chngpwd">
                                <input name="id" class="form-control d-none" type="text" value="<?= $setting['id'] ?>"/>
<!--                                <div class="form-group">-->
<!--                                    <label>Tên trường</label>-->
<!--                                    <input name="school_name" class="form-control" type="text" value="--><?//= $setting['school_name'] ?><!--"/>-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>Mail trường</label>-->
<!--                                    <input name="school_mail" class="form-control" type="text" value="--><?//= $setting['school_mail'] ?><!--"/>-->
<!--                                </div>-->
                                <div class="form-group">
                                    <label>最多の借りる回数</label>
                                    <input name="max_lended_book" class="form-control" type="number"  value="<?= $setting['max_lended_book'] ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Số ngày mượn tối đa</label>
                                    <input name="max_lended_time" class="form-control" type="number"  value="<?= $setting['max_lended_time'] ?>"/>
                                </div>
                                <button type="submit" name="save_settings" class="btn btn-info">Lưu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!---LOGIN PABNEL END-->


        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    </body>
    </html>
<?php } ?>
