<?php include("partials/head.php"); ?>

        <?php include("partials/top-nav.php"); ?>
        
        <?php include("partials/sidebar.php"); ?>
          
        <?php
            $admin = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM admin"));
        ?>

            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="page-header">
                        <h2 class="pageheader-title">Users</h2>
                    </div>

                </div>

            </div>
            
            <div class="ecommerce-widget">

                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th>#</th>
                                            <th>Fullname</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Created At</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $users = mysqli_query($connection, "SELECT * FROM users");
                                                $inc = 1;
                                                while ($user = mysqli_fetch_array($users)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $inc; ?></td>
                                                        <td>
                                                            <strong><?php echo $user['fullname']; ?></strong>
                                                        </td>
                                                        <td>
                                                            <strong><?php echo $user['email']; ?></strong>
                                                        </td>
                                                        <td>
                                                            <strong><?php echo $user['password']; ?></strong>
                                                        </td>
                                                        <td>
                                                            <strong><?php echo $user['phone']; ?></strong>
                                                        </td>
                                                        <td>
                                                            <strong><?php echo $user['address']; ?></strong>
                                                        </td>
                                                        <td><?php echo $user['created_at'] ?></td>
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