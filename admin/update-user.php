<?php include "header.php"; 

    if($_SESSION['role'] == 0)
    {
        header("Location: http://localhost/news-template/admin/post.php");
    }
    
    if(isset($_POST['update']))
    {
        include "connect.php";

        // mysqli_real_escape_string() function is use to protect the website from special characters , html tags or java script code [in short from XSS attack]
        $userid = mysqli_real_escape_string($connection , $_POST['user_id']);
        $fname = mysqli_real_escape_string($connection , $_POST['f_name']);
        $lname = mysqli_real_escape_string($connection , $_POST['l_name']);
        $user = mysqli_real_escape_string($connection , $_POST['username']);
        $role = mysqli_real_escape_string($connection , $_POST['role']);

        // check that is username already exist in database or not
        $sql = "UPDATE user SET first_name = '$fname' , last_name = '$lname' , username = '$user' , `role` = $role  WHERE user_id = $userid ";
        $result = mysqli_query($connection , $sql) or die("Query failed");
        
        if($result)
        {
            header("Location: http://localhost/news-template/admin/users.php");
        }
        
        // if(mysqli_num_rows($result) > 0){
        //     echo "<div class='alert alert-danger' role='alert'>
        //     A simple danger alert—check it out!
        //   </div>";
        // }
        // else
        // {
        //     $sql1 = "INSERT INTO user (first_name , last_name , username , password , role) VALUES ('{$fname}' , '{$lname}' , '{$user}' , '{$password}' , '{$role}' )";
        //     if (mysqli_query($connection , $sql1)) {
        //     }
        // }
    }
?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">

                <?php

                    include 'connect.php';
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM user WHERE user_id=$id";
                    $result = mysqli_query($connection , $sql) or die("Query Failed");

                    if(mysqli_num_rows($result) > 0)
                    {

                    $row = mysqli_fetch_assoc($result);
                //   <!-- Form Start -->
                    echo '<form  action="'.$_SERVER['PHP_SELF'].'" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="'.$id.'" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="'.$row['first_name'].'" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="'.$row['last_name'].'" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="'.$row['username'].'" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="'. $row['role'].'">';

                            if($row['role'] == 1)
                            {
                                echo '<option value="0">normal User</option>
                                <option value="1" selected>Admin</option>';
                            }

                            else
                            {
                                echo '<option value="0" selected>normal User</option>
                                <option value="1 ">Admin</option>';
                            }
                          echo '</select>
                      </div>
                      <input type="submit" name="update" class="btn btn-primary" value="Update" required />
                  </form>';


                //   <!-- /Form -->
                    }
                ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
