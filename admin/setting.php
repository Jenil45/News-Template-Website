<?php
    include 'header.php';
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">
                    Website Setting
                </h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
            <?php
                include "connect.php";
                $sql = "SELECT * FROM setting" ;
                $result = mysqli_query($connection ,$sql) or die("Query failed");
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
            ?>
                <form action="save-setting.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="website_name">Website Name</label>
                        <input type="text" name="wname" class="form-control" value="<?php echo $row['websitename'] ?>"  autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="logo">Website Logo</label>
                        <input type="file" name="logo" >
                        <img src="images/<?php echo $row['logo']; ?>" alt="" height="80px" class="my-5">
                        <input type="hidden" name="old_logo" value="<?php echo $row['logo']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="footerdesc">Footer Description</label>
                        <textarea name="footerdesc" class="form-control" cols="30" rows="10" ><?php echo $row['footerdesc']; ?></textarea>
                    </div>
                    <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                </form>
            <?php
                    }
                }
            ?>
            </div>
        </div>
    </div>
</div>



<!-- 
 -->
 <!--  -->
 <!--  -->
    <!--  -->
   
