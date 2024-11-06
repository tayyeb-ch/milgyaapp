<?php include("partials/head.php"); ?>

        <?php include("partials/top-nav.php"); ?>
        
        <?php include("partials/sidebar.php"); ?>
        
            <?php
                $admin = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM admin"));
            ?>

            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="page-header">
                        <h2 class="pageheader-title">All Items</h2>
                    </div>

                </div>

            </div>
            
            <div class="ecommerce-widget">

                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" style="font-size: 12px;">
                                        <thead>
                                            <th>#</th>
                                            <th>Posted By</th>
                                            <th>Category</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Location</th>
                                            <th>Views</th>
                                            <th>Type</th>
                                            <th>Created At</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $users = mysqli_query($connection, "SELECT * FROM items");
                                                $inc = 1;
                                                while ($item = mysqli_fetch_array($users)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $inc; ?></td>
                                                        <td>
                                                            <img src="../<?php echo $item['picture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;">
                                                            <strong><?php echo $item['title']; ?></strong><br>
                                                            <a href="../item.php?id=<?php echo $item['id']; ?>" target="_blank" class="badge bg-dark text-white mt-2">View Item</a>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $user = mysqli_fetch_array(mysqli_query($connection, "SELECT fullname FROM users WHERE id = '" . $item['user_id'] . "'"));
                                                                echo $user['fullname'];
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $category = mysqli_fetch_array(mysqli_query($connection, "SELECT name FROM categories WHERE id = '" . $item['category_id'] . "'"));
                                                                echo $category['name'];
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <strong><?php echo $item['description']; ?></strong>
                                                        </td>
                                                        <td>
                                                            <?php echo $item['location']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $item['views']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $item['type']; ?>
                                                        </td>
                                                        <td><?php echo $item['created_at'] ?></td>
                                                    </tr>
                                                    <?php
                                                    $inc++;
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>

        <?php
            if (isset($_GET['delete'])) {
                $id = $_GET['delete'];
                $delete = mysqli_query($connection, "DELETE FROM categories WHERE id = '$id'");
                header("Location: categories.php");
            }
        ?>

<?php include("partials/footer.php"); ?>