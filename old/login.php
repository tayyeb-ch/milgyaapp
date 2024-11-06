<?php include("partials/header.php"); ?>

    <?php include("partials/navigation.php"); ?>
    
        <section class="login py-5 border-top-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-8 align-item-center">
                        <div class="border">
                            <h3 class="bg-gray p-4 text-center">Login Now</h3>
                            <form action="" method="POST" class="p-4">
                                <?php
                                    if (isset($_POST['login'])) {
                                        
                                        $email = mysqli_real_escape_string($connection, $_POST['email']);
                                        $password = mysqli_real_escape_string($connection, $_POST['password']);

                                        $check = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email'");

                                        if (mysqli_num_rows($check) > 0) {

                                            $user = mysqli_fetch_array($check);

                                            if ($user['password'] == $password) {
                                                
                                                $_SESSION['user_id'] = $user['id'];

                                                header("Location: dashboard.php");

                                            } else {

                                                echo "<div class='alert alert-danger'>Email or Password is incorrect!</div>";

                                            }

                                        } else {

                                            echo "<div class='alert alert-danger'>Email or Password is incorrect!</div>";

                                        }

                                    }
                                ?>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" placeholder="Email" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" placeholder="Password" class="form-control" required="">
                                </div>
                                <div class="loggedin-forgot">
                                        <input type="checkbox" id="keep-me-logged-in">
                                        <label for="keep-me-logged-in" class="pt-3 pb-2">Keep me logged in</label>
                                    </div>
                                <div class="form-group">
                                    <button type="submit" name="login" class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3 w-100">Log in</button>
                                </div>
                                <div class="form-group text-center">
                                    <a class="mt-3 d-inline-block text-primary" href="register.php">Don't have an account? Register Now!</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php include("partials/footer.php"); ?>