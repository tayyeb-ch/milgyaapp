<?php include("partials/head.php"); ?>

        <?php include("partials/top-nav.php"); ?>
        
        <?php include("partials/sidebar.php"); ?>
          
        <?php
            $news = mysqli_query($connection, "SELECT * FROM news");
        ?>

            <div class="row">

                <div class="col-md-6">

                    <div class="page-header">
                        <h2 class="pageheader-title">News</h2>
                    </div>

                </div>

            </div>
            
            <div class="ecommerce-widget">

                <div class="row">

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4>Add News</h4>
                                <?php
                                    if (isset($_POST['add'])) {
                                        
                                        $news = $_POST['news'];

                                        $save = mysqli_query($connection, "INSERT INTO news(news) VALUES('$news')");

                                        $_SESSION['msg'] = "<div class='alert alert-info'>News Added Successfully!</div>";

                                        header("Location: news.php");

                                    }
                                    if (isset($_SESSION['msg'])) {
                                        echo $_SESSION['msg'];
                                        unset($_SESSION['msg']);
                                    }
                                ?>
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="">News</label>
                                        <input type="text" name="news" placeholder="Enter here" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="add" value="Submit" class="btn btn-dark">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th>#</th>
                                            <th>News</th>
                                            <th>Created At</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $inc = 1;
                                                while ($new = mysqli_fetch_array($news)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $inc; ?></td>
                                                        <td>
                                                            <strong><?php echo $new['news']; ?></strong>
                                                        </td>
                                                        <td>
                                                            <a href="news.php?delete=<?php echo $new['id']; ?>" onclick="return confirm('Are you sure you want to delete this new?')" class="btn btn-danger btn-sm">Delete</a>
                                                        </td>
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
                $delete = mysqli_query($connection, "DELETE FROM news WHERE id = '$id'");
                header("Location: news.php");
            }
        ?>

<?php include("partials/footer.php"); ?>