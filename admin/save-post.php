<?php
    include "connect.php";

    if(isset($_FILES['fileupload']))
    {
        $errors = array();

        $file_name = $_FILES['fileupload']['name'];
        $file_size = $_FILES['fileupload']['size'];
        $file_tmp = $_FILES['fileupload']['tmp_name'];
        $file_type = $_FILES['fileupload']['type'];
        $file_ext = strtolower(end(explode('.' , $file_name)));
        $extension = array('jpeg' , 'jpg' , 'png');

        if(in_array($file_ext , $extension) == false)
        {
            $errors[] = "This extension file is not allowed.";
        }

        if($file_size > 2097152)
        {
            $errors[] = "File siz emust be lower than 2MB";
        }

        if(empty($errors) == true)
        {
            move_uploaded_file($file_tmp , "upload/".$file_name);
        }

        else
        {
            print_r($errors);
            die();
        }
    }

    session_start();
    $title = mysqli_real_escape_string($connection , $_POST['post_title']);
    $description = mysqli_real_escape_string($connection , $_POST['postdesc']);
    $category = mysqli_real_escape_string($connection , $_POST['category']);
    $date = date("d,M,Y");
    $author = $_SESSION['user_id'];

    // $sql = "INSERT INTO post(title , description , category , post_date , author , post_img) VALUES('$title' , '$description' , $category , '$date' , $author , '$file_name')";
    $sql = "INSERT INTO `post` (`title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES ('$title', '$description', $category , '$date', $author , '$file_name');";
    $sql .= "UPDATE category SET post=post+1 WHERE category_id=$category";
    // $result = mysqli_multi_query($connection , $sql);
    if(mysqli_multi_query($connection , $sql))
    {
        header("Location: http://localhost/news-template/admin/post.php");
    }

    else
    {
        echo '<div class="alert alert-danger" role="alert">
                Invalid Credential
              </div>';
    }
?>
