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
                                        <h3>My Lost Items</h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="add-lost-item.php" class="badge bg-dark text-white py-2 px-3">Add New</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                                if (isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                    unset($_SESSION['msg']);
                                }
                            ?>
                            <table class="table table-responsive product-dashboard-table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Title</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $myitems = mysqli_query($connection, "SELECT * FROM items WHERE user_id = '" . $_SESSION['user_id'] . "'");
                                        if (mysqli_num_rows($myitems) > 0) {
                                            
                                            while ($item = mysqli_fetch_array($myitems)) {
                                                ?>
                                                <tr>
                                                    <td class="product-thumb">
                                                        <?php
                                                            if (!empty($item['picture'])) {
                                                                $itempicturepath = $item['picture'];
                                                            } else {
                                                                $itempicturepath = "images/placeholder.png";
                                                            }

                                                            $category = mysqli_fetch_array(mysqli_query($connection, "SELECT name FROM categories WHERE id = '" . $item['category_id'] . "'"));

                                                        ?>
                                                        <img width="80px" height="auto" src="<?php echo $itempicturepath; ?>" alt="image description">
                                                    </td>
                                                    <td class="product-details">
                                                        <h3 class="title"><?php echo $item['type']; ?> : <?php echo $item['title']; ?></h3>
                                                        <span class="status active"><strong>Views</strong><?php echo $item['views']; ?></span>
                                                        <span class="location"><strong>Location</strong><?php echo $item['location']; ?></span>
                                                        <span><strong>Specifications: </strong> &nbsp;&nbsp;&nbsp;&nbsp; <a href="add-specification.php?item_id=<?php echo $item['id']; ?>" style="text-decoration: underline;">Add Specification 
                                                            (<?php
                                                                $countSpecs = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM item_specifications WHERE item_id = '" . $item['id'] . "'"));
                                                                echo $countSpecs;
                                                            ?>)
                                                        </a> </span>
                                                    </td>
                                                    <td class="product-category"><span class="categories"><?php echo $category['name']; ?></span></td>
                                                    <td class="action" data-title="Action">
                                                        <div class="">
                                                            <ul class="list-inline justify-content-center">
                                                                <li class="list-inline-item">
                                                                    <a data-toggle="tooltip" data-placement="top" title="view" class="view" href="item.php?id=<?php echo $item['id']; ?>" target="_blank">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <a class="edit" data-toggle="tooltip" data-placement="top" title="Edit" href="edit-item.php?id=<?php echo $item['id']; ?>">
                                                                    <i class="fa fa-pencil"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <a class="delete" data-toggle="tooltip" data-placement="top" title="Delete" href="my-lost-items.php?delete=<?php echo $item['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?')">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }

                                        } else {
                                            ?>
                                            <tr class="text-center">
                                                <td colspan="4">No Items Found!</td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <!-- Row End -->
            </div>
        </section>

    <?php
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];

            $delete = mysqli_query($connection, "DELETE FROM items WHERE id = '$id'");

            $_SESSION['msg'] = '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Info!</strong> Item Deleted Successfully!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ';

            header("Location: my-lost-items.php");

        }
    ?>

<?php include("partials/footer.php"); ?>