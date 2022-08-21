<?php include "header.php";

    if($_SESSION['role'] == 0)
    {
        header("Location: http://localhost/news-template/admin/post.php");
    }
    include "connect.php";
    if(isset($_POST['save']))
    {
        $cat = mysqli_real_escape_string($connection , $_POST['cat']);
        $sql = "SELECT category_name FROM category WHERE category_name='$cat'";
        $result = mysqli_query($connection , $sql) or die("Query failed");

        if(mysqli_num_rows($result) > 0){
            echo "<div class='alert alert-danger' role='alert'>
            Category Already Exist
          </div>";
        }
        else
        {
            $sql1 = "INSERT INTO category (category_name , post) VALUES ('{$cat}' , 0 )";
            if (mysqli_query($connection , $sql1)) {
                header("Location: http://localhost/news-template/admin/category.php");
            }
        }
    }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>  
      </div>
  </div>
<?php include "footer.php"; ?>
