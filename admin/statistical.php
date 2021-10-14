<?php
    session_start();
    error_reporting(0);

    $conn = mysqli_connect("localhost", "root", "", "library2021") or die ("Errors Connect DB");
    mysqli_set_charset($conn, "utf8");

    $sql   = "SELECT * FROM  WHERE 1";
    $rows  = mysqli_query($conn, $sql);
    $datas = array();
    while ($row = mysqli_fetch_array($rows)) {
        $datas[] = $row;
    }

if (strlen($_SESSION['alogin']) == 0) {
    header('location:adminlogin.php');
} else {


    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <title>統計</title>
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
                    <h4 class="header-line">統計</h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">リスト</div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"
                                           id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>本のタイトル</th>
                                            <th>借りる回数</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($datas as $key => $item) :?>
                                            <tr class="odd gradeX">
                                                <td class="center"><?= ($key + 1) ?></td>
                                                <td class="center"><?= $item['BookName'] ?></td>
                                                <td class="center">
                                                    <?php
                                                        $sqlLet = "SELECT * FROM lead WHERE book_id = ". $item['id'];
                                                        $rowsCount  = mysqli_query($conn, $sqlLet);
                                                        $count = 0;
                                                        while ($row = mysqli_fetch_array($rowsCount)) {
                                                            $count ++;
                                                        }
                                                    ?>
                                                    <?= $count ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
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
