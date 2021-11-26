<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:adminlogin.php');
} else {
    if($_SESSION['msg']){
        $msg = $_SESSION['msg'];
    }
    if($_SESSION['error']){
        $error = $_SESSION['error'];
    }
    if (isset($_GET['lend_id']) && isset($_GET['book_id'])) {
        $lend_id    = $_GET['lend_id'];
        $book_id    = $_GET['book_id'];
//        $book_id    = 2;
        $sql_query_lend = "SELECT * FROM `lend` WHERE lend.id = '" . $lend_id . "'";
        $query_select_lend    = $dbh->prepare($sql_query_lend);
        $query_select_lend->execute();
        $lend = $query_select_lend->fetch(PDO::FETCH_OBJ);
        $status_update_lend = false;
        $mess = '';
        if($lend) {
            $sql_update_lend      = "update  lend set is_returned=1 where id='" . $lend->id . "'";
            $query_update_lend    = $dbh->prepare($sql_update_lend);
            $status_update_lend = $query_update_lend->execute();
//            var_dump($status_update_lend);
        }
        if($status_update_lend){
            $mess = 'Trả sách thành công';
        }
        $sql_query_reserve = "SELECT yx_books.name as book_name, user.name as user_name, yoyaku.id, yoyaku.book_id, yoyaku.user_id  FROM `yoyaku` 
            join user on user.id=yoyaku.user_id 
            join yx_books on yx_books.id=yoyaku.book_id 
            WHERE yoyaku.book_id = '" . $book_id . "' AND yoyaku.is_booked=0 ORDER BY booking_time ASC";
        $query_select_reserve    = $dbh->prepare($sql_query_reserve);
        $query_select_reserve->execute();
        $reserve = $query_select_reserve->fetch(PDO::FETCH_OBJ);
//        var_dump($query_select_reserve); die('sdfs');
        if($reserve) {
            $sql_update_reserve = "update  yoyaku set is_booked=1 where id='" . $reserve->id . "'";
            $query_update_reserve  = $dbh->prepare($sql_update_reserve);
            $status_update_reserve = $query_update_reserve->execute();
            if($status_update_reserve) {
                $now = date('Y-m-d');
                $date = strtotime($now);
                $date = strtotime("+14 day", $date);
                $date = date('Y-m-d', $date);
                $sql_create_lend      = "INSERT INTO lend (book_id, lend_time, return_time, user_id)
                    VALUES (". $book_id .", '". $now ."', '". $date ."', ". $reserve->user_id .")";
                $query_create_lend    = $dbh->prepare($sql_create_lend);
                $status_create_lend  = $query_create_lend->execute();
                if($status_create_lend){
                    $mess = "Trả sách thành công và cho user: $reserve->user_name mượn sách: $reserve->book_name thành công";
                }
            }
        }

        if($mess) {
            $_SESSION['msg'] = $mess;
        } else {
            $_SESSION['error'] = "Lỗi hệ thống, trả sách không thành công";
        }
        header('location:manage-lead.php');
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
        <title>貸出履歴</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet"/>
        <!-- FONT AWESOME STYLE  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
        <!-- DATATABLE STYLE  -->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet"/>
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet"/>
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>

    </head>
    <body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">貸出管理</h4>
                </div>
            </div>
            <div class="row">
                <?php if ($error != "") {
                    ?>
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <strong>Error :</strong>
                            <?php echo htmlentities($error); ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($msg != "") {
                    ?>
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <strong>Success :</strong>
                            <?php echo htmlentities($msg); ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">貸出リスト</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>学籍番号</th>
                                        <th>名前</th>
                                        <th>本のタイトル</th>
                                        <th>借りる日</th>
                                        <th>返却日</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- database info -->
                                    <?php $sql = "SELECT user.name,user.number as GakuSekiNumber, yx_books.name as BookName, yx_books.leave_number,  
                                    lend.id, lend.return_time , lend.book_id, lend.is_returned,
                                            lend.lend_time, lend.user_id  from lend join user 
                                        on user.id = lend.user_id join yx_books on yx_books.id = lend.book_id";
//die('43');
                                    $query     = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt     = 1;

                                    $sql_query_reserve_book = "SELECT yx_books.name as book_name, user.name as user_name, yoyaku.id, yoyaku.book_id, yoyaku.user_id  FROM `yoyaku` 
            join user on user.id=yoyaku.user_id 
            join yx_books on yx_books.id=yoyaku.book_id where yoyaku.is_booked=0";
                                    $query_select_reserve_book    = $dbh->prepare($sql_query_reserve_book);
                                    $query_select_reserve_book->execute();
                                    $reserve_book = $query_select_reserve_book->fetchAll(PDO::FETCH_OBJ);
                                    $new_reserves = [];
                                    foreach($reserve_book as $book){
                                        $new_reserves[$book->book_id] = $book->book_name;
                                    }
//                                    var_dump($results);die('sfds');
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>
                                            <tr class="odd gradeX">
                                                <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                <td class="center"><?php echo htmlentities($result->GakuSekiNumber); ?></td>
                                                <td class="center"><?php echo htmlentities($result->name); ?></td>
                                                <td class="center"><?php echo htmlentities($result->BookName); ?></td>
                                                <td class="center"><?php echo htmlentities($result->lend_time); ?></td>
                                                <td class="center"><?php echo htmlentities($result->return_time); ?></td>
                                                <td class="center">
                                                    <?php if (!empty($new_reserves[$result->book_id]) && !$result->is_returned) {
                                                        ?>
                                                        <a href="manage-lead.php?lend_id=<?php echo htmlentities($result->id); ?>&book_id=<?php echo htmlentities($result->book_id); ?>"
                                                        <button class="btn btn-xs btn-primary">Trả sách</button>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php $cnt = $cnt + 1;
                                        }
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
//                                $_SESSION['msg'] = '';
//                                $_SESSION['error'] = '';
                            ?>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
    </body>
    </html>
<?php } ?>