<?php
    include 'connect.php';
    $title_name = basename($_SERVER['PHP_SELF']);
    switch ($title_name) {
        case 'single.php':
            if(isset($_GET['id']))
            {
                $sql_title = "SELECT * FROM post WHERE post_id={$_GET['id']}";
                $result_title = mysqli_query($connection , $sql_title);
                $row_title = mysqli_fetch_assoc($result_title);
                $page_title = $row_title['title'];
            }
            else
            {
                $page_title = "No post Found";

            }
            break;
        case 'category.php':
            if(isset($_GET['cid']))
            {
                $sql_title = "SELECT * FROM category WHERE category_id={$_GET['cid']}";
                $result_title = mysqli_query($connection , $sql_title);
                $row_title = mysqli_fetch_assoc($result_title);
                $page_title = $row_title['category_name'];
            }
            else
            {
                $page_title = "No post Found";

            }
            break;
        case 'author.php':
            if(isset($_GET['aid']))
            {
                $sql_title = "SELECT * FROM user WHERE user_id={$_GET['aid']}";
                $result_title = mysqli_query($connection , $sql_title);
                $row_title = mysqli_fetch_assoc($result_title);
                $page_title = $row_title['username'];
            }
            else
            {
                $page_title = "No post Found";

            }
            break;
        case 'search.php':
            $page_title = $_GET['search'];
            break;
        
        default:
            $page_title = "News";
            break;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">

                <?php
                        include "connect.php";
                        $sql = "SELECT * FROM setting" ;
                        $result = mysqli_query($connection ,$sql) or die("Query failed");
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                if($row['logo'] =="")
                                {
                                    echo '<a href="post.php">'.$row['websitename'].'</a>';
                                }
                                else
                                {
                                    echo '<a href="post.php"><img class="logo" src="admin/images/'.$row['logo'].'"></a>';
                                }
                            }
                        }
                ?>
                <!-- <a href="index.php" id="logo"><img src="images/news.jpg"></a> -->
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    include "connect.php";

                    if(isset($_GET['cid']))
                    {
                        $cat_id = $_GET['cid'];
                    }

                    $sql = "SELECT * FROM category WHERE post > 0";
                    $result = mysqli_query($connection , $sql);
                    if(mysqli_num_rows($result) > 0)
                    {
                ?>
                <ul class='menu'>
                    <li><a href='http://localhost/news-template/'>Home</a></li>
                    <?php
                        $active = "";
                        while($row = mysqli_fetch_assoc($result))
                        {
                            if(isset($_GET['cid']))
                            {
                                if($row['category_id'] == $cat_id)
                                {
                                    $active="active";
                                }
                                else
                                {
                                    $active="";
                                }
                            }
                            echo "<li><a class='{$active}' href='category.php?cid=".$row['category_id']."'>".$row['category_name']."</a></li>";
                        }
                    ?>
                </ul>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
