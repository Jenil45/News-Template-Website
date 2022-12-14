<?php
    include "connect.php";

    if(isset($_FILES['fileToUpload']))
    {
        $errors = array();

        $file_name = $_FILES['fileToUpload']['name'];
        $file_size = $_FILES['fileToUpload']['size'];
        $file_tmp = $_FILES['fileToUpload']['tmp_name'];
        $file_type = $_FILES['fileToUpload']['type'];
        $file_ext = strtolower(end(explode('.' , $file_name)));
        $extension = array('jpeg' , 'jpg' , 'png');

        if(in_array($file_ext , $extension) == false)
        {
            $errors[] = "This extension file is not allowed.";
        }

        if($file_size > 2097152)
        {
            $errors[] = "File size must be lower than 2MB";
        }
        $new_name = time()."-".basename($file_name);
        $target="upload/".$new_name;
        $img_name = $new_name;
        if(empty($errors) == true)
        {
            move_uploaded_file($file_tmp , $target);
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
    $sql = "INSERT INTO `post` (`title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES ('$title', '$description', $category , '$date', $author , '$img_name');";
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
