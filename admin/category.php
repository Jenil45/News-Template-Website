<?php include "header.php";
    if($_SESSION['role'] == 0)
    {
        header("Location: http://localhost/news-template/admin/post.php");
    }
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">

            <?php
                    include "connect.php";

                    $limit = 3;

                    if(isset($_GET['page']))
                    {
                        $page = $_GET['page'];
                    }

                    else
                    {
                        $page = 1;
                    }

                    $offset = ($page-1)*$limit;
                    $sql = "SELECT * FROM category ORDER BY category_id DESC LIMIT $offset , $limit";
                    $result = mysqli_query($connection ,$sql) or die("Query failed");
                    if(mysqli_num_rows($result) > 0)
                    {

                        echo '<table class="content-table">
                            <thead>
                                <th>S.No.</th>
                                <th>Category Name</th>
                                <th>No. of Posts</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>';
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $sno = $offset +1 ; 
                                echo "<tr>
                                <td class='id'>".$sno."</td>
                                <td>".$row['category_name']."</td>
                                <td>".$row['post']."</td>
                                <td class='edit'><a href='update-category.php?id=".$row['category_id']."'><i class='fa fa-edit'></i></a></td>
                                <td class='delete'><a href='delete-category.php?id=".$row['category_id']."'><i class='fa fa-trash-o'></i></a></td>
                                </tr>";
                                $offset++;
                            }    
                                
                            echo '</tbody>
                        </table>';
                    }
            ?>


                <?php
                    $sql1 = "SELECT * FROM category";
                    $result1 = mysqli_query($connection , $sql1) or die("Query failed");
                    
                    if(mysqli_num_rows($result1) > 0)
                    {
                        $total_record = mysqli_num_rows($result1);
                        $limit = 3;
                        $total_page = ceil($total_record/$limit);
                        
                        echo "<ul class='pagination admin-pagination'>";
                        
                        if($page > 1)
                        {
                            echo "<li><a href='users.php?page=".($page-1)."'>Previous</a></li>";
                        }
                        for($i = 1 ; $i <= $total_page ; $i++)
                        {
                            if($i == $page)
                            {
                                $active = "active";
                            }

                            else
                            {
                                $active = "";
                            }
                            
                            echo "<li class=".$active."><a href='category.php?page=".$i."'>".$i."</a></li>";
                        }
                        if($page < $total_page)
                        {
                            echo "<li><a href='category.php?page=".($page+1)."'>Next</a></li>";
                        }
                    echo "</ul>";
                    }
                ?>
                    
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
 
