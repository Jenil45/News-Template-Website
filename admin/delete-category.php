<?php
    if($_SESSION['role'] == 0)
    {
        header("Location: http://localhost/news-template/admin/post.php");
    }
    include 'connect.php';
    $id = $_GET['id'];

    $sql = "DELETE FROM category WHERE category_id=$id";
    $result = mysqli_query($connection , $sql);

    if($result)
    {
        header("Location: http://localhost/news-template/admin/category.php");
    }

?>
