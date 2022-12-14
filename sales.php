<?php
    $title = "Sales Page";
    require "includes/header.php";
    require "includes/preloader.php";
    require "includes/navbar.php";
    require "includes/sidebar.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title;?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title;?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" class="invoice form-control" placeholder="Invoice">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="product_id form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" id="barcode" class="barcode form-control" placeholder="Barcode">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" class="price form-control" placeholder="Price">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" id="qnt" class="qnt form-control" placeholder="Quantity">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" class="total form-control" placeholder="Total">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" class="stock form-control" placeholder="Stock">
                    </div>
                </div>
                <button class="sAddItem btn btn-success ml-2">Add</button>
            </div>
            <!-- /.row -->
            <div class="row mt-3">
                <div class="col-12">
                    <table class="table" border="1">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Invoice</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tableData">
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" id="totalQnt" class="form-control" placeholder="Total Quantity">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" id="totalAmount" class="form-control" placeholder="Total Sales Amount">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="dis form-control">
                            <option >----------Select Discount----------</option>
                            <option value="0">0%</option>
                            <option value="5">5%</option>
                            <option value="10">10%</option>
                            <option value="15">15%</option>
                            <option value="20">20%</option>
                            <option value="25">25%</option>
                            <option value="30">30%</option>
                            <option value="35">35%</option>
                            <option value="40">40%</option>
                            <option value="45">45%</option>
                            <option value="50">50%</option>
                            <option value="55">55%</option>
                            <option value="60">60%</option>
                            <option value="65">65%</option>
                            <option value="70">70%</option>
                            <option value="75">75%</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input readonly type="text" class="disAmount form-control" placeholder="Dis. Amount">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="grandTotal form-control" placeholder="Grand otal">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="payment form-control" placeholder="Payment">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="duePayment form-control" placeholder="Due Payment">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <button class="salesSummery btn btn-success w-100" >Save & Print</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

<!--Footer -->
<?php
require("includes/copyright.php");
require("includes/footer.php");
?>