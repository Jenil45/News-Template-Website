<?php

    include 'connect.php';
    $id = $_GET['id'];

    $sql = "DELETE FROM user WHERE user_id=$id";
    $result = mysqli_query($connection , $sql);

    if($result)
    {
        header("Location: http://localhost/news-template/admin/users.php");
    }

?>
