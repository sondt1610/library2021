<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:adminlogin.php');
} else {
    if (isset($_GET['email'])) {
        $id    = $_GET['email'];
        var_dump($id);
//        $sql   = "delete from yx_books  WHERE id=:id";
//        $query = $dbh->prepare($sql);
//        $query->bindParam(':id', $id, PDO::PARAM_STR);
//        $query->execute();
//        $_SESSION['delmsg'] = "Category deleted scuccessfully ";
//        header('location:manage-books.php');
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
                    <h4 class="header-line">Danh sách mượn quá hạn</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">Danh sách mượn quá hạn</div>
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
<!--                                        <th>Action</th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- database info -->
                                    <?php $sql = "SELECT user.email,user.name,user.number as GakuSekiNumber, yx_books.name as BookName, yx_books.leave_number,  
                                    lend.id, lend.return_time , lend.book_id, 
                                            lend.lend_time, lend.user_id  from lend join user 
                                        on user.id = lend.user_id join yx_books on yx_books.id = lend.book_id  WHERE lend.return_time < '" . date('Y-m-d') . "'";

                                    $query     = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt     = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>
                                            <tr class="odd gradeX">
                                                <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                <td class="center"><?php echo htmlentities($result->GakuSekiNumber); ?></td>
                                                <td class="center"><?php echo htmlentities($result->name); ?></td>
                                                <td class="center"><?php echo htmlentities($result->BookName); ?></td>
                                                <td class="center"><?php echo htmlentities($result->lend_time); ?></td>
                                                <td class="center"><?php echo htmlentities($result->return_time); ?></td>
<!--                                                <td class="center">-->
<!--                                                    <a href="list_lend_overdue.php?email=--><?php //echo htmlentities($result->email); ?><!--"-->
<!--                                                    <button class="btn btn-xs btn-primary">Thông báo</button>-->
<!--                                                </td>-->
                                            </tr>
                                            <?php $cnt = $cnt + 1;
                                        }
                                    } ?>
                                    </tbody>
                                </table>
                            </div>

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