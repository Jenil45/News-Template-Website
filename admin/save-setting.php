<?php
    include "connect.php";

    if(empty($_FILES['logo']['name']))
    {
        $file_name = $_POST['old_logo'];
    }

    else
    {
        $errors = array();

        $file_name = $_FILES['logo']['name'];
        $file_size = $_FILES['logo']['size'];
        $file_tmp = $_FILES['logo']['tmp_name'];
        $file_type = $_FILES['logo']['type'];
        $exp = explode('.' , $file_name);
        $file_ext = end($exp);
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
            move_uploaded_file($file_tmp , "images/".$file_name);
        }

        else
        {
            print_r($errors);
            die();
        }
    }

    $sql = "UPDATE setting SET websitename='{$_POST["wname"]}' , logo='{$file_name}' , footerdesc='{$_POST["footerdesc"]}' ";

    $result = mysqli_query($connection , $sql);

    if($result)
    {
        header("Location: http://localhost/news-template/admin/setting.php");
    }

    else
    {
        echo '<div class="alert alert-danger" role="alert">
        Can not update
      </div>';
    }
?>
