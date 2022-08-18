<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                <?php
                    include "connect.php";
                    $search = $_GET['search'];
                    // $sql1 = "SELECT * FROM user WHERE user_id = $search";
                    // $result1 = mysqli_query($connection , $sql1);
                    // $row = mysqli_fetch_assoc($result1);
                ?>
                <h2 class="page-heading">Search : <?php echo $search; ?></h2>
                <?php
                            include "connect.php";
                            $search = $_GET['search'];
                            $search = mysqli_real_escape_string($connection , $_GET['search']);

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

                            $sql = "SELECT * FROM post  
                            LEFT JOIN category ON post.category=category.category_id 
                            LEFT JOIN user ON post.author=user.user_id 
                            WHERE post.title LIKE '%{$search}%'
                            ORDER BY post.post_id DESC LIMIT $offset , $limit
                            ";
                            $result = mysqli_query($connection ,$sql) or die("Query failed");

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
                    ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row['post_id']?>"><img src="admin/upload/<?php echo $row['post_img'];?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $row['post_id']?>'><?php echo $row['title']?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row['category_id'];?>'><?php echo $row['category_name']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php'><?php 
                                                if($row['title'] == 1)
                                                {
                                                    echo "Admin";
                                                }    
                                                else
                                                {
                                                    echo "Normal User";
                                                }
                                                ?>
                                            </a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date']?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo substr($row['description'] , 0 , 50)."...";?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }}

                    else
                    {
                        echo "<h2>No records found</h2>";
                    }
                    ?>
                    <?php
                    $sql1 = "SELECT * FROM post WHERE title LIKE  '%$search%' ";
                    $result1 = mysqli_query($connection , $sql1);
                    // $row = mysqli_fetch_assoc($result1);
                    
                    if(mysqli_num_rows($result1) > 0)
                    {
                        $total_record = mysqli_num_rows($result1);
                        $limit = 3;
                        $total_page = ceil($total_record/$limit);
                        
                        echo "<ul class='pagination admin-pagination'>";
                        
                        if($page > 1)
                        {
                            echo "<li><a href='search.php?search=".$search."&page=".($page-1)."'>Previous</a></li>";
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
                            
                            echo "<li class=".$active."><a href='search.php?search=".$search."&page=".$i."'>".$i."</a></li>";
                        }
                        if($page < $total_page)
                        {
                            echo "<li><a href='search.php?search=".$search."&page=".($page+1)."'>Next</a></li>";
                        }
                    echo "</ul>";
                    }
                ?>

                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
