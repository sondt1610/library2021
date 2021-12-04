<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:adminlogin.php');
} else {

    if (isset($_POST['update'])) {
        $avatar = $_POST['avatar'];
        if (isset($_FILES['thumbn']))
        {
            $file_name  = $_FILES['thumbn']['name'];
            $file_tmp   = $_FILES['thumbn']['tmp_name'];
            $file_type  = $_FILES['thumbn']['type'];
            $file_erro  = $_FILES['thumbn']['error'];

            if ($file_erro == 0)
            {
                $part = ROOT ."book/";
                $avatar = $file_name;
                move_uploaded_file($file_tmp, $part.$file_name);
            }
        }

        $bookname = $_POST['bookname'];
        $category = $_POST['category'];
        $isbn     = $_POST['isbn'];
        $price    = $_POST['price'];
        $type    = $_POST['type'];
        $writer    = $_POST['writer'];
        $bookid   = intval($_GET['bookid']);

        $new_params = [
            'avatar' => $avatar,
            'bookname' => $bookname,
            'category' => $category,
            'isbn' => $isbn,
            'price' => $price,
            'type' => $type,
            'writer' => $writer,
            'bookid' => $bookid,
        ];
        $sql      = "update  yx_books set name=:bookname, images=:avatar, CatId=:category,
            ISBN=:isbn,price=:price, type=:type, writer=:writer where id=:bookid";
        $query    = $dbh->prepare($sql);
        $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->bindParam(':avatar', $avatar, PDO::PARAM_STR);
        $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
        $query->bindParam(':type', $type, PDO::PARAM_STR);
        $query->bindParam(':writer', $writer, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['msg'] = "本の修正が完了しました。";
        header('location:manage-books.php');


    }
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <title>Online Library Management System | Edit Book</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet"/>
        <!-- FONT AWESOME STYLE  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet"/>
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>

    </head>
    <body>
    <?php include('includes/header.php'); ?>
    <div class=" content-wrapper ">
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">本の修正</h4>

            </div>

        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
           
            <div class="panel panel-info">
                <div class="panel-heading">
                    本の情報
                </div>
                <div class="panel-body">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <?php
                        $bookid = intval($_GET['bookid']);
                        $sql    = "SELECT * ,yx_books.id as bookid from  yx_books join tblcategory on tblcategory.id=yx_books.CatId where yx_books.id=:bookid";
                        $query  = $dbh->prepare($sql);
                        $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt     = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>

                                <div class="form-group">
                                    <label>本名<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="bookname" value="<?php echo htmlentities($result->name); ?>" required/>
                                           
                                </div>

                                <div class="form-group">
                                    <label> カテゴリー<span style="color:red;">*</span></label>
                                    <select class="form-control" name="category" required="required">
                                        <option value="<?php echo htmlentities($result->CatId); ?>"> <?php echo htmlentities($catname = $result->CategoryName); ?></option>
                                        <?php
                                        $status = 1;
                                        $sql1   = "SELECT * from  tblcategory where Status=:status";
                                        $query1 = $dbh->prepare($sql1);
                                        $query1->bindParam(':status', $status, PDO::PARAM_STR);
                                        $query1->execute();
                                        $resultss = $query1->fetchAll(PDO::FETCH_OBJ);
                                        if ($query1->rowCount() > 0) {
                                            foreach ($resultss as $row) {
                                                if ($catname == $row->CategoryName) {
                                                    continue;
                                                } else {
                                                    ?>
                                                    <option value="<?php echo htmlentities($row->id); ?>"><?php echo htmlentities($row->CategoryName); ?></option>
                                                <?php }
                                            }
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label> 著者<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="writer" value="<?php echo htmlentities($result->writer); ?>" required="required" autocomplete="off"/>
                                </div>

                                <div class="form-group">
                                    <label>ISBN番号<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="isbn"
                                           value="<?php echo htmlentities($result->ISBN); ?>"
                                           required="required"/>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="inputdm3" >写真</label>
                                    <input type="hidden" name="avatar" value="<?= $result->images ?>">
                                    <input type="file" class="form-control" id="inputmd3" name="thumbn">
                                </div>

                                <div class="form-group">
                                    <label>価格<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="price"
                                           value="<?php echo htmlentities($result->price); ?>" required="required"/>
                                </div>
                            <?php }
                        } ?>
                        <button type="submit" name="update" class="btn btn-info">修正</button>

                    </form>
                </div>
            </div>
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
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
    </body>
    </html>
<?php } ?>
