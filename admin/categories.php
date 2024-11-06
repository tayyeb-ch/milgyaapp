<?php include("partials/head.php"); ?>

        <?php include("partials/top-nav.php"); ?>
        
        <?php include("partials/sidebar.php"); ?>
          
        <?php
            $admin = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM admin"));
        ?>

            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="page-header">
                        <h2 class="pageheader-title">Categories</h2>
                    </div>

                </div>

            </div>
            
            <div class="ecommerce-widget">

                <div class="row">

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                    if (isset($_GET['edit'])) {
                                        $category_id = $_GET['edit'];

                                        $cat = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM categories WHERE id = '$category_id'"));

                                        ?>
                                        <h3>Update Category</h3>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <?php
                                                if (isset($_POST['updatecategory'])) {
                                                    
                                                    $name = $_POST['name'];

                                                    if (!empty($_FILES['picture']['name'])) {

                                                        $picture         = $_FILES['picture']['name'];
                                                        $picture_tmp     = $_FILES['picture']['tmp_name'];
                                                        $picture_path = "images/items/" . $picture;
                                                        move_uploaded_file($picture_tmp, "../images/items/$picture");

                                                    } else {
                                                        $picture_path = $cat['picture'];
                                                    }

                                                    $createcategory = mysqli_query($connection, "UPDATE categories SET name = '$name', picture = '$picture_path' WHERE id = '$category_id'");

                                                    echo "<div class='alert alert-success'>Category Updated.</div>";

                                                }
                                            ?>
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" name="name" value="<?php echo $cat['name']; ?>" placeholder="Enter Category Name" class="form-control" required="">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Picture</label><br>
                                                <img src="../<?php echo $cat['picture']; ?>" class="img-thumbnail" style="width: 100px;height: 100px;margin-bottom: 10px;">
                                                <input type="file" name="picture" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="updatecategory" value="Update Category" class="btn btn-primary">
                                                <a href="categories.php" class="btn btn-brand">Cancel</a>
                                            </div>
                                        </form>
                                        <?php
                                    } else {
                                ?>
                                <h3>Create Category</h3>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <?php
                                        if (isset($_POST['createcategory'])) {
                                            
                                            $name = $_POST['name'];

                                            if (!empty($_FILES['picture']['name'])) {

                                                $picture         = $_FILES['picture']['name'];
                                                $picture_tmp     = $_FILES['picture']['tmp_name'];
                                                $picture_path = "images/items/" . $picture;
                                                move_uploaded_file($picture_tmp, "../images/items/$picture");

                                            } else {
                                                $picture_path = "";
                                            }

                                            $createcategory = mysqli_query($connection, "INSERT INTO categories(name, picture) VALUES('$name', '$picture_path')");

                                            echo "<div class='alert alert-success'>Category Created.</div>";

                                        }
                                    ?>
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" placeholder="Enter Category Name" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Picture</label>
                                        <input type="file" name="picture" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="createcategory" value="Create Category" class="btn btn-primary">
                                    </div>
                                </form>
                                <?php
                                    }
                                ?>
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
                                            <th>Category</th>
                                            <th>Created At</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $categories = mysqli_query($connection, "SELECT * FROM categories");
                                                $inc = 1;
                                                while ($category = mysqli_fetch_array($categories)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $inc; ?></td>
                                                        <td>
                                                            <img src="../<?php echo $category['picture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;">
                                                            <strong><?php echo $category['name']; ?></strong><br>
                                                            <a href="categories.php?edit=<?php echo $category['id']; ?>">Edit</a> / <a href="categories.php?delete=<?php echo $category['id']; ?>" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                                                        </td>
                                                        <td><?php echo $category['created_at'] ?></td>
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