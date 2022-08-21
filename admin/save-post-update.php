<?php
    include "connect.php";

    if(empty($_FILES['new-image']['name']))
    {
        $file_name = $_POST['old-image'];
    }

    else
    {
        $errors = array();

        $file_name = $_FILES['new-image']['name'];
        $file_size = $_FILES['new-image']['size'];
        $file_tmp = $_FILES['new-image']['tmp_name'];
        $file_type = $_FILES['new-image']['type'];
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

    $sql = "UPDATE post SET title='{$_POST["post_title"]}' , description='{$_POST["postdesc"]}' , category={$_POST["category"]} , post_img='$img_name'
    WHERE post_id={$_POST["post_id"]};";

    if($_POST['old_category'] != $_POST['category'])
    {
        $sql .= "UPDATE category SET post=post-1 WHERE category_id={$_POST['old_category']};";
        $sql .= "UPDATE category SET post=post+1 WHERE category_id={$_POST['category']};";
    }

    $result = mysqli_multi_query($connection , $sql);

    if($result)
    {
        header("Location: http://localhost/news-template/admin/post.php");
    }

    else
    {
        echo '<div class="alert alert-danger" role="alert">
        Can not update
      </div>';
    }
?>
