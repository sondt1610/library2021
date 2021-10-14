<!-- LOGO HEADER START-->
<div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand">
                <img src="assets/img/main_01.gif"/>
            </a>
        </div>
        <div class="right-div">
            <a href="logout.php" class="btn btn-danger pull-right">ログアウト</a>
        </div>
    </div>
</div>
<!-- LOGO HEADER END-->

<!-- MENU HEAER START-->
<section class="menu-section">
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="navbar-collapse collapse ">
                    <ul id="menu-top" class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> カテゴリー <i  class="fa fa-angle-down"></i></a>
                                      
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="add-categori.php">カテゴリー追加</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-categories.php">カテゴリー管理</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">蔵書管理 <i class="fa fa-angle-down"></i></a>     
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="add-book.php">蔵書登録</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-books.php">蔵書管理</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-yoyaku.php">ユーザー予約本確認</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> 貸出履歴<i class="fa fa-angle-down"></i></a>            
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-lead.php">貸出リスト</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="ninki.php">貸出数</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> 利用者管理<i class="fa fa-angle-down"></i></a>  
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-user.php">利用者管理</a></li>
                              
                            </ul>   
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">管理者情報 <i  class="fa fa-angle-down"></i></a>           
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="setting.php">貸出設定</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="statistical.php">統計</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="change-password.php">パスワードを変更</a></li>    
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- MENU HEAER END-->