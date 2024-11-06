<?php include("partials/header.php"); ?>

    <?php include("partials/navigation.php"); ?>
    
        <section class="login py-5 border-top-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 align-item-center">
                        <div class="border border">
                            <h3 class="bg-gray p-4 text-center">Register Now</h3>
                            <form action="" method="POST" class="p-4">
                                <?php
                                    if (isset($_POST['register'])) {
                                        
                                        $fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
                                        $email = mysqli_real_escape_string($connection, $_POST['email']);
                                        $password = mysqli_real_escape_string($connection, $_POST['password']);
                                        $phone = mysqli_real_escape_string($connection, $_POST['phone']);
                                        $address = mysqli_real_escape_string($connection, $_POST['address']);

                                        $check = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email'");

                                        if (mysqli_num_rows($check) > 0) {
                                            
                                            echo "<div class='alert alert-danger'>Account already exist. Please try Again!</div>";

                                        } else {

                                            $insert = mysqli_query($connection, "INSERT INTO users(fullname, email, password, phone, address) VALUES('$fullname', '$email', '$password', '$phone', '$address')");

                                            if ($insert) {
                                                echo "<div class='alert alert-success'>Account Created Successfully!</div>";
                                            } else {
                                                echo "<div class='alert alert-danger'>Problem creating account. Please try again!</div>";
                                            }

                                        }

                                    }
                                ?>
                                <div class="form-group">
                                    <label for="">Full Name</label>
                                    <span id="fullnamemsg" class="text-danger"></span>
                                    <input id="fullname" type="text" name="fullname" placeholder="Enter Your Full Name" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" placeholder="Enter Your Email" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" placeholder="Enter Your Password" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Phone #</label>
                                    <input type="number" name="phone" placeholder="Enter Your Number" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" name="address" placeholder="Enter Your Address" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="register" class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold w-100">Register Now</button>
                                </div>
                                <div class="form-group text-center">
                                    <a href="login.php">Already have an account? Login.</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php include("partials/footer.php"); ?>
