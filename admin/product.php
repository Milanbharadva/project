<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location:index.php");
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Mobile Planet | Producut</title>
        <?php
        include('./common/style.php')
        ?>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <?php
            include('./common/menu.php')
            ?>
            <?php
            include('./common/sidebar.php')
            ?>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Product</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item active">Product</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="content">
                    <div class="container-fluid">
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Add Product</h3>
                                            </div>
                                            <form method="post" action="product_process.php" enctype="multipart/form-data">

                                                <div class="card-body">
                                                    
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Product name </label>
                                                        <input type="text" name="productname" class="form-control" id="exampleInputEmail1" placeholder="Enter Product name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Product price </label>
                                                        <input type="number" name="productprice" class="form-control" id="exampleInputEmail1" placeholder="Enter Product price">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>select category</label>
                                                        <select class="form-control select2" name="categoryid" style="width: 100%;">
                                                            <option selected disabled>select category</option>
                                                            <?php
                                                            include_once('include/config.php');
                                                            $qry = "SELECT * FROM category";
                                                            $res = mysqli_query($conn, $qry);
                                                            while ($row = mysqli_fetch_row($res)) {
                                                            ?>
                                                                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>

                                                            <?php
                                                            }
                                                            ?>
                                                        </select>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Product RAM </label>
                                                        <input type="number" name="productram" class="form-control" id="exampleInputEmail1" placeholder="Enter Product RAM">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Product ROM </label>
                                                        <input type="number" name="productrom" class="form-control" id="exampleInputEmail1" placeholder="Enter Product ROM">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Product Image</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="exampleInputFile" name="productimage">
                                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" name="submit" value="add" class="btn btn-primary col-md-12">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">Products</h1>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Product RAM</th>
                                        <th>Product ROM</th>
                                        <th>Product Category</th>
                                        <th>Product Image</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include_once('include/config.php');
                                    $catcount = 1;
                                    $qry = "SELECT * FROM Product ORDER BY categoryid ASC";
                                    $res = mysqli_query($conn, $qry);
                                    while ($row = mysqli_fetch_assoc($res)) {

                                        $cattqry = "SELECT * FROM category WHERE ID='" . $row['categoryid'] . "'";
                                        
                                        $cattres = mysqli_query($conn, $cattqry);
                                        $cattrow = mysqli_fetch_row($cattres);
                                    ?>
                                        <tr>
                                            <td><?php echo $catcount; ?></td>
                                            <td><?php echo $row['productname']; ?></td>
                                            <td><?php echo $row['productprice']; ?></td>
                                            <td><?php echo $row['productram']; ?></td>
                                            <td><?php echo $row['productrom']; ?></td>
                                            <td><?php echo $cattrow[1]; ?></td>
                                            <td><a href="<?php echo '../images/product/' . $row['productimage']; ?>" target="_blank"><img src="<?php echo '../images/product/' . $row['productimage']; ?>" height="100px" width="100px" alt="image of product"></a></td>
                                            <td><a href="product_edit.php?id=<?php echo $row['ID']; ?>&val=edit"><i class="fas fa-edit"></i></a></td>
                                            <td><a href="product_process.php?id=<?php echo $row['ID']; ?>&val=del"><i class="fas fa-trash"></i></a></td>
                                        </tr>
                                    <?php
                                        $catcount++;
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Product RAM</th>
                                        <th>Product ROM</th>
                                        <th>Product Category</th>
                                        <th>Product Image</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            <?php
            include('./common/footer.php')
            ?>
        </div>
        <?php
        include('./common/script.php')
        ?>
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
    </body>

    </html>
<?php
}
?>