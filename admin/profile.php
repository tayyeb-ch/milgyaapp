<?php include("partials/head.php"); ?>

        <?php include("partials/top-nav.php"); ?>
        
        <?php include("partials/sidebar.php"); ?>
          
        <?php
            $admin = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM admin"));
        ?>

            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="page-header">
                        <h2 class="pageheader-title">My Profile</h2>
                    </div>

                </div>

            </div>
            
            <div class="ecommerce-widget">

                <div class="row">

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h3>Profile Details</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><strong>Email</strong></td>
                                                <td><?php echo $admin['email']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Password</strong></td>
                                                <td><?php echo $admin['password']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h3>Update Profile</h3>
                                <form action="" method="POST">
                                    <?php
                                        if (isset($_POST['updateprofile'])) {
                                            
                                            $email = $_POST['email'];
                                            $password = $_POST['password'];

                                            $updateprofile = mysqli_query($connection, "UPDATE admin SET email = '$email', password = '$password'");

                                            echo "<div class='alert alert-success'>Profile Updated.</div>";

                                        }
                                    ?>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" value="<?php echo $admin['email']; ?>" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="text" name="password" value="<?php echo $admin['password'] ?>" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="updateprofile" value="Update" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>


<?php include("partials/footer.php"); ?>