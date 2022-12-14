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
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
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
                    $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT $offset , $limit";
                    $result = mysqli_query($connection ,$sql) or die("Query failed");
                    if(mysqli_num_rows($result) > 0)
                    {

                        echo '<table class="content-table">
                            <thead>
                                <th>S.No.</th>
                                <th>Full Name</th>
                                <th>User Name</th>
                                <th>Role</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>';
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $sno = $offset+1;
                                echo "<tr>
                                <td class='id'>".$sno."</td>
                                <td>".$row['first_name']." ".$row['last_name']."</td>
                                <td>".$row['username']."</td>
                                <td>";
                                    if($row['role'] == 1)
                                    {
                                        echo "Admin";
                                    }

                                    else
                                    {
                                        echo "Normal user";
                                    }
                                echo  "</td>
                                <td class='edit'><a href='update-user.php?id=".$row['user_id']."'><i class='fa fa-edit'></i></a></td>
                                <td class='delete'><a href='delete-user.php?id=".$row['user_id']."'><i class='fa fa-trash-o'></i></a></td>
                                </tr>";
                                $offset++;
                            }    
                                
                            echo '</tbody>
                        </table>';
                    }
                ?>

                <?php

                    $sql1 = "SELECT * FROM user";
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
                            
                            echo "<li class=".$active."><a href='users.php?page=".$i."'>".$i."</a></li>";
                        }
                        if($page < $total_page)
                        {
                            echo "<li><a href='users.php?page=".($page+1)."'>Next</a></li>";
                        }
                    echo "</ul>";
                    }
                ?>

            </div>
        </div>
    </div>
</div>
