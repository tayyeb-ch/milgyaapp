<?php include("partials/head.php"); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center py-2">Admin Login</h3>
                        <form action="" method="POST">
                            <?php
                                if (isset($_POST['login'])) {
                                    
                                    $email = $_POST['email'];
                                    $password = $_POST['password'];

                                    $check = mysqli_query($connection, "SELECT * FROM admin WHERE email = '$email'");

                                    if (mysqli_num_rows($check) > 0) {

                                        $admin = mysqli_fetch_array($check);

                                        if ($password == $admin['password']) {
                                            
                                            $_SESSION['admin_email'] = $admin['email'];

                                            header("Location: index.php");

                                        } else {
                                            echo "<div class='alert alert-danger'>Email or Password is invalid.</div>";
                                        }

                                    } else {
                                        echo "<div class='alert alert-danger'>Email or Password is invalid.</div>";
                                    }
                                }
                            ?>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" placeholder="Enter Email" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" placeholder="Enter Password" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="login" value="Login" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("partials/footer.php"); ?>