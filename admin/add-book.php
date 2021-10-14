<?php
session_start();
error_reporting(0);
include('includes/config.php');

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

    if (isset($_POST['add'])) {

        $avatar = '';
        if (isset($_FILES['thumbn'])) {
            $file_name = $_FILES['thumbn']['name'];
            $file_tmp  = $_FILES['thumbn']['tmp_name'];
            $file_type = $_FILES['thumbn']['type'];
            $file_erro = $_FILES['thumbn']['error'];

            if ($file_erro == 0) {
                $part   = ROOT . "book/";
                $avatar = $file_name;
                move_uploaded_file($file_tmp, $part . $file_name);
            }
        }

        $bookname  = $_POST['bookname'];
        $category  = $_POST['category'];
        //$author    = $_POST['author'];
        $isbn      = $_POST['isbn'];
        $price     = $_POST['price'];
        $detail    = $_POST['detail'];
        $type      = $_POST['type'];
        $writer    = $_POST['writer'];
        $publisher = $_POST['writer'];
        $link      = null;
        $borrow    = 0;
        $total    = 0;

        $params = $_POST;
        $new_params = [
            'detail' => $detail,
            'publisher' => $publisher,
            'link' => $link,
            'borrow' => $borrow,
            'avatar' => $avatar,
        ];
        $all_params = array_merge($params, $new_params);
        $sql       = "INSERT INTO  yx_books(name,CatId,ISBN,price,images,detail,type,borrow,writer,link,publisher,total) 
        VALUES(:bookname,:category,:isbn,:price,:avatar,:detail,:type,:borrow,:writer,:link,:publisher,:total)";
        $query     = $dbh->prepare($sql);
        $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->bindParam(':avatar', $avatar, PDO::PARAM_STR);
        $query->bindParam(':detail', $detail, PDO::PARAM_STR);
        $query->bindParam(':type', $type, PDO::PARAM_STR);
        $query->bindParam(':borrow', $borrow, PDO::PARAM_STR);
        $query->bindParam(':writer', $writer, PDO::PARAM_STR);
        $query->bindParam(':link', $link, PDO::PARAM_STR);
        $query->bindParam(':publisher', $publisher, PDO::PARAM_STR);
        $query->bindParam(':total', $total, PDO::PARAM_STR);
        $query->execute();
        // $query->debugDumpParams();

        // var_dump( $all_params );
        // $query_detail = interpolateQuery($query->queryString, $all_params);
        // var_dump( $query_detail );
//        die;
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "本の追加できました。";
            header('location:manage-books.php');
        } else {
            $_SESSION['error'] = "エラー：追加できませんでした。";
            header('location:manage-books.php');
        }

    }
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <title>Online Library Management System | Add Book</title>
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
   
    
    <div class=" content-wrapper">
   
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">本を追加</h4>
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
                        <div class="form-group">
                            <label>本のタイトル<span style="color:red;">*</span></label>
                            <input class="form-control" type="text" name="bookname" autocomplete="off" required/>
                        </div>
                        <div class="form-group">
                            <label> カテゴリー<span style="color:red;">*</span></label>
                            <select class="form-control" name="category" required="required">
                                <option value=""> カテゴリーを選ぶ</option>
                                <?php
                                $status = 1;
                                $sql    = "SELECT * from  tblcategory where Status=:status";
                                $query  = $dbh->prepare($sql);
                                $query->bindParam(':status', $status, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt     = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) { ?>
                                        <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->CategoryName); ?></option>
                                    <?php }
                                } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> 内容<span style="color:red;">*</span></label>
                            <input class="form-control" type="text" name="detail" value="" required="required" autocomplete="off"/>          
                        </div> 
                        <div class="form-group">
                            <label> 著者<span style="color:red;">*</span></label>
                            <input class="form-control" type="text" name="writer" value="" required="required" autocomplete="off"/>        
                        </div>

                        <div class="form-group">
                            <label>ISBN 番号<span style="color:red;">*</span></label>
                            <input class="form-control" type="text" name="isbn" required="required" autocomplete="off"/> 
                        </div>
                        <div class="form-group">
                            <label for="inputdm3" class="control-label">本の写真</label>
                            <input type="file" class="form-control" id="inputmd3" name="thumbn">
                        </div>
                        <div class="form-group">
                            <label>価格<span style="color:red;">*</span></label>
                            <input class="form-control" type="text" name="price" autocomplete="off"
                                   required="required"/>
                        </div>
                        <button type="submit" name="add" class="btn btn-info">追加</button>

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
