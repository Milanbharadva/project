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
        <title>Mobile Planet | Edit product</title>
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
                                <h1 class="m-0">Dashboard</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item active"><a href="product.php"> product</a></li>
                                    <li class="breadcrumb-item active">Edit product</li>
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
                                                <h3 class="card-title">Add product</h3>
                                            </div>
                                            <?php
                                            extract($_REQUEST);
                                            include_once('include/config.php');
                                            $qry = "SELECT * FROM product WHERE id='" . $id . "'";
                                            $res = mysqli_query($conn, $qry);
                                            $row = mysqli_fetch_assoc($res);
                                            print_r($row);
                                            ?>
                                            <form method="post" action="product_process.php" enctype="multipart/form-data">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                                        <label for="exampleInputEmail1">product name </label>
                                                        <input type="text" value="<?php echo $row["productname"]; ?>" name="productname" class="form-control" id="exampleInputEmail1" placeholder="Enter product name">

                                                        <label for="exampleInputEmail1">product price </label>
                                                        <input type="text" value="<?php echo $row["productprice"]; ?>" name="productprice" class="form-control" id="exampleInputEmail1" placeholder="Enter product price">

                                                        <label for="exampleInputEmail1">product RAM </label>
                                                        <input type="text" value="<?php echo $row["productram"]; ?>" name="productram" class="form-control" id="exampleInputEmail1" placeholder="Enter product ram">

                                                        <label for="exampleInputEmail1">product ROM </label>
                                                        <input type="text" value="<?php echo $row["productrom"]; ?>" name="productrom" class="form-control" id="exampleInputEmail1" placeholder="Enter product rom">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>select category </label>
                                                        <select class="form-control select2" name="categoryid" style="width: 100%;">
                                                            <option disabled>select category</option>
                                                            <?php
                                                            include_once('include/config.php');
                                                            $subqry = "SELECT * FROM category";
                                                            $subres = mysqli_query($conn, $subqry);
                                                            while ($subrows = mysqli_fetch_row($subres)) {
                                                            ?>

                                                                <option value="<?php echo $subrows[0]; ?>" <?php 
                                                                if($subrows[0] === $row['categoryid']){
                                                                    echo "selected";
                                                                } else{
                                                                    echo "";
                                                                } ?>><?php echo $subrows[1]; ?>
                                                               </option>
                                                            <?php
                                                                echo $row['categoryid']. "<br>";
                                                                echo $subrows[0];
                                                            }
                                                            ?>
                                                        </select>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">product Image</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="exampleInputFile" name="productimage">
                                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                                    file</label>
                                                            </div>
                                                            <div>
                                                                <img class="image-disp" src="../images/product/<?php echo $row["productimage"]; ?>" alt="" height="200px " width="200px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" name="submit" value="edit" class="btn btn-primary col-md-12">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
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