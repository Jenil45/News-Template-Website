<?php
    include "connect.php";
    $post_id = $_GET['id'];
    $catid = $_GET['catid'];

    $sql="DELETE FROM post WHERE post_id=$post_id;";
    $sql .= "UPDATE category SET post=post-1 WHERE category_id=$catid";

    if(mysqli_multi_query($connection , $sql))
    {
        header("Location: http://localhost/news-template/admin/post.php");
    }

    else
    {
        echo '<div class="alert alert-danger" role="alert">
         Cannot delete
      </div>';
    }
?>
