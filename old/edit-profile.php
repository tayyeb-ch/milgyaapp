<?php include("partials/header.php"); ?>

    <?php include("partials/navigation.php"); ?>
        
        <section class="dashboard section">

            <div class="container">

                <div class="row">
                    <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
                        <?php include("partials/sidebar.php"); ?>
                    </div>
                    <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                        
                        <div class="widget dashboard-container my-adslist">
                            <h3 class="widget-header">Update Profile</h3>
                            <form action="" method="POST" class="p-4">
                                <?php
                                    if (isset($_POST['updateprofile'])) {
                                        
                                        $fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
                                        $password = mysqli_real_escape_string($connection, $_POST['password']);
                                        $phone = mysqli_real_escape_string($connection, $_POST['phone']);
                                        $address = mysqli_real_escape_string($connection, $_POST['address']);

                                        $update = mysqli_query($connection, "
                                        UPDATE users SET 
                                            fullname = '$fullname', 
                                            password = '$password', 
                                            phone = '$phone',
                                            address = '$address' 
                                        WHERE id = '" . $_SESSION['user_id'] . "'
                                            ");

                                        if ($update) {
                                            echo "<div class='alert alert-success'>Account Updated Successfully!</div>";
                                        } else {
                                            echo "<div class='alert alert-danger'>Problem updating profile. Please try again!</div>" . mysqli_error($connection);
                                        }

                                    }
                                ?>
                                <div class="form-group">
                                    <label for="">Full Name</label>
                                    <input type="text" name="fullname" value="<?php echo $user['fullname']; ?>" placeholder="Enter Your Full Name" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" value="<?php echo $user['email']; ?>" placeholder="Enter Your Email" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" value="<?php echo $user['password']; ?>" placeholder="Enter Your Password" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Phone #</label>
                                    <input type="number" name="phone" value="<?php echo $user['phone']; ?>" placeholder="Enter Your Number" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" name="address" value="<?php echo $user['address']; ?>" placeholder="Enter Your Address" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="updateprofile" class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold w-100">Update Profile</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- Row End -->
            </div>
        </section>

<?php include("partials/footer.php"); ?>