<?php include "header.php"; 
    
    if(isset($_POST['sumbit']))
    {
        echo "Line 1";
        include "connect.php";
        echo "Line 2";

        $catid = mysqli_real_escape_string($connection , $_POST['cat_id']);
        echo "Line 3".$catid;

        $catname = mysqli_real_escape_string($connection , $_POST['cat_name']);
        echo "Line 4".$catname;

        $sql = "UPDATE category SET category_name = '$catname' WHERE category_id=$catid";
        echo "Line 5";

        $result = mysqli_query($connection , $sql);
        echo "Line 6";

        if($result)
        {
            header("Location: http://localhost/news-template/admin/category.php");
        }
    }

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                <?php
                    include "connect.php";
                    $id = $_GET['id'];
                    $sql1 = " SELECT * FROM `category` WHERE category_id=$id; ";
                    $result1 = mysqli_query($connection , $sql1) or die("Query Failed");

                    if(mysqli_num_rows($result1) > 0)
                    {
                        $row = mysqli_fetch_assoc($result1);
                        echo '<form action="'.$_SERVER['PHP_SELF'].'" method ="POST">
                        <div class="form-group">
                            <input type="hidden" name="cat_id"  class="form-control" value="'.$id.'" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="cat_name" class="form-control" value="'.$row['category_name'].'"  placeholder="" required>
                        </div>
                        <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                        </form>';
                    }
                 ?> 
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
