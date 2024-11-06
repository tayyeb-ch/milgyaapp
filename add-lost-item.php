<?php include("partials/header.php"); ?>

    <?php include("partials/navigation.php"); ?>
        
        <section class="dashboard section">

            <div class="container">

                <div class="row">
                    <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
                        <?php include("partials/sidebar.php"); ?>
                    </div>
                    <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                        <!-- Recently Favorited -->
                        <div class="widget dashboard-container my-adslist">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Add Lost Items</h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="my-lost-items.php" class="badge bg-dark text-white py-2 px-3">Go Back</a>
                                    </div>
                                </div>
                            </div>
                            
                            <form action="" method="POST" enctype="multipart/form-data">
                                <?php
                                    if (isset($_POST['additem'])) {
                                        
                                        $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
                                        $type = mysqli_real_escape_string($connection, $_POST['type']);
                                        $title = mysqli_real_escape_string($connection, $_POST['title']);
                                        $location = mysqli_real_escape_string($connection, $_POST['location']);

                                        if (!empty($_FILES['picture']['name'])) {

                                            $picture         = $_FILES['picture']['name'];
                                            $picture_tmp     = $_FILES['picture']['tmp_name'];
                                            $picture_path    = "images/items/" . $picture;
                                            move_uploaded_file($picture_tmp, "images/items/$picture");

                                        } else {
                                            $picture_path = "";
                                        }

                                        $description = mysqli_real_escape_string($connection, $_POST['description']);

                                        $additem = mysqli_query($connection, "INSERT INTO items(user_id, category_id, title, description, picture, location, type) VALUES('" . $_SESSION['user_id'] . "', '$category_id', '$title', '$description', '$picture_path', '$location', '$type')");

                                        if ($additem) {
                                            echo "<div class='alert alert-success'>Item Saved Successfully!</div>";
                                        } else {
                                            echo "<div class='alert alert-danger'>Problem saving item. Please try again!</div>";
                                        }

                                    }
                                ?>
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select name="category_id" id="" class="form-control" required="">
                                        <option value="">Select</option>
                                        <?php
                                            $categories = mysqli_query($connection, "SELECT * FROM categories");
                                            while ($category = mysqli_fetch_array($categories)) {
                                                ?>
                                                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <select name="type" class="form-control" required="">
                                        <option value="">Select</option>
                                        <option value="Found">Found</option>
                                        <option value="Lost">Lost</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title" placeholder="Enter Title" class="form-control" required=""> 
                                </div>
                                <div class="form-group">
                                    <label for="">Enter Location</label>
                                    <input type="text" name="location" placeholder="Enter Location" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Picture</label>
                                    <input type="file" name="picture" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" cols="5" rows="5" placeholder="Write here..." class="form-control" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="additem" class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold w-100">Save</button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
                <!-- Row End -->
            </div>
        </section>

<?php include("partials/footer.php"); ?>