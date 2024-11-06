<?php include("partials/header.php"); ?>

    <?php include("partials/navigation.php"); ?>
        
    <?php

        if (isset($_GET['item_id'])) {
            
            $item_id = $_GET['item_id'];

            $item = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM items WHERE id = '$item_id'"));

        }

    ?>

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
                                    <div class="col-md-8">
                                        <h3><?php echo $item['title']; ?> : Specifications</h3>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <a href="my-lost-items.php" class="badge bg-dark text-white py-2 px-3">Go Back</a>
                                    </div>
                                </div>
                            </div>
                            <?php

                                if (isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                    unset($_SESSION['msg']);
                                }

                                if (isset($_POST['addspecification'])) {
                                    
                                    $name = mysqli_real_escape_string($connection, $_POST['name']);
                                    $value = mysqli_real_escape_string($connection, $_POST['value']);

                                    $addspecification = mysqli_query($connection, "INSERT INTO item_specifications(item_id, name, value) VALUES('$item_id', '$name', '$value')");

                                    if ($addspecification) {
                                        $_SESSION['msg'] = '
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Info!</strong> Specification Added Successfully!
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        ';

                                        header("Location: add-specification.php?item_id=" . $item_id);
                                    } else {
                                        $_SESSION['msg'] = '
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Info!</strong> Problem saving specifications. Please try again!
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        ';

                                        header("Location: add-specification.php?item_id=" . $item_id);
                                    }

                                }
                            ?>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <form action="" method="POST" class="form-inline justify-content-center">
                                        
                                        <div class="form-group">
                                            <input type="text" name="name" placeholder="Enter Name" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="value" placeholder="Enter Value" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="addspecification" value="Add" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-responsive product-dashboard-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Value</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $myitems = mysqli_query($connection, "SELECT * FROM item_specifications WHERE item_id = '$item_id'");

                                        if (mysqli_num_rows($myitems) > 0) {
                                            
                                            while ($spec = mysqli_fetch_array($myitems)) {
                                                ?>
                                                <tr>
                                                    <td class="product-details">
                                                        <h3 class="title"><?php echo $spec['name']; ?></h3>
                                                    </td>
                                                    <td class="product-details">
                                                        <h3 class="title"><?php echo $spec['value']; ?></h3>
                                                    </td>
                                                    <td class="action" data-title="Action">
                                                        <div class="">
                                                            <ul class="list-inline d-flex">
                                                                <li class="list-inline-item">
                                                                    <a class="delete" data-toggle="tooltip" data-placement="top" title="Delete" href="add-specification.php?delete=<?php echo $spec['id']; ?>&item_id=<?php echo $item_id ?>" onclick="return confirm('Are you sure you want to delete this Specification?')">
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
        if (isset($_GET['delete']) AND isset($_GET['item_id'])) {
            $id = $_GET['delete'];

            $delete = mysqli_query($connection, "DELETE FROM item_specifications WHERE id = '$id'");

            $_SESSION['msg'] = '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Info!</strong> Item Specifications Deleted Successfully!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ';

            header("Location: add-specification.php?item_id=" . $_GET['item_id']);

        }
    ?>

<?php include("partials/footer.php"); ?>