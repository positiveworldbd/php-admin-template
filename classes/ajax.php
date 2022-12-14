<?php 

    include "./Purchase.php";
    include "./Sales.php";
    $action = $_POST['action'];
    $action();

    // Product Find Using PHP
    function findItem(){
        $purchase = new Purchase;
        $barcode = $_POST['barcode'];
        $info = $purchase->findItem($barcode);
        echo json_encode($info);
    }

    // Find Stock Show
    function stockShow(){
		$product_id = $_POST['product_id'];
		$purchase = new Purchase;
		$sql = $purchase->findStock($product_id);
		echo json_encode($sql);
	}

    // Add Item
    function addItem(){
        $pdate = $_POST['pdate'];
        $cname = $_POST['cname'];
        $invoice = $_POST['invoice'];
        session_start();
        $br_id = $_SESSION['branch_id'];
        $product_id = $_POST['product_id'];
        $barcode = $_POST['barcode'];
        $price = $_POST['price'];
        $qnt = $_POST['qnt'];
        $total = $_POST['total'];
        
        $purchase = new Purchase;
        $sql = $purchase->addItem($pdate, $cname, $invoice, $br_id, $product_id,$barcode, $price, $qnt, $total);
        echo "200";
    } 

    // Show Item
    function showItem(){ 
		$invoice = $_POST['invoice'];
		$purchase = new Purchase;
		$sql = $purchase->showItem($invoice);
		$tdata = "";
		while($data = $sql->fetch_assoc()){
			$tdata .= '<tr>
                    <td>'.$data["pdate"].'</td>
                    <td>'.$data["barcode"].'</td>
                    <td>'.$data["price"].'</td>
                    <td>'.$data["qnt"].'</td>
                    <td>'.$data["total"].'</td>
                    <td>
                        <button class="removeItem btn btn-sm btn-danger" value="'.$data["id"].'">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                </tr>';
		}
		echo $tdata;
	}

    // Remove Item
    function removeItem(){
        $id = $_POST['id'];
		$purchase = new Purchase;
		$info = $purchase->removeItem($id);
		echo $info;
    }

    // Calculate Total Quantity
    function calQnt(){
        $purchase = new Purchase;
        $invoice = $_POST['invoice'];
        $sql = $purchase->calQnt($invoice);
        $totalQnt = 0;
        while($data = $sql->fetch_assoc()){
            $totalQnt = $totalQnt + $data['qnt'];
        }
        echo $totalQnt;
    }

    // Calculate Total Price
    function calPrice(){
        $purchase = new Purchase;
        $invoice = $_POST['invoice'];
        $sql = $purchase->calPrice($invoice);
        $totalPrice = 0;
        while($data = $sql->fetch_assoc()){
            $totalPrice = $totalPrice + $data['total'];
        }
        echo $totalPrice;
    }

    // Purchase Summery
    function purchaseSummery(){ 
        $pdate = $_POST['pdate'];
        $company = $_POST['company'];
        $invoice = $_POST['invoice'];
        $total_quantity = $_POST['total_quantity'];
        $total_price = $_POST['total_price'];
        $dis = $_POST['dis'];
        $dis_amount = $_POST['dis_amount'];
        $grand_total = $_POST['grand_total'];
        $payment = $_POST['payment'];
        $duePayment = $_POST['duePayment'];
        session_start();
        $br_id = $_SESSION['branch_id'];
		$purchase = new Purchase;
		$sql = $purchase->purchaseSummery($pdate, $company, $invoice, $total_quantity,  $total_price, $dis, $dis_amount, $grand_total, $payment, $duePayment, $br_id);
    }


    // Auto Sales Invoice Generate
    function invoiceGen(){
        $sales = new Sales;
        $sql = $sales->invoiceGen();
        
        if($sql == "Empty"){
            echo "Empty";
        } else{
            echo json_encode($sql);
        }
    }

    // Add Sales Item
    function sAddItem(){
        session_start();
        $sdate = $_POST['sdate'];
        $invoice = $_POST['invoice'];
        $product_id =$_POST['product_id'];
        $saleprice = $_POST['saleprice'];
        $quantity = $_POST['quantity'];
        $total_amount = $_POST['total_amount'];
        $br_id = $_SESSION['branch_id'];
        
        $sales = new Sales;
        $sql =$sales->sAddItem($sdate, $invoice, $product_id, $saleprice, $quantity, $total_amount, $br_id);
        echo $sql;
    }

    //Update Sales Stock
    function updateStock(){
        $id = $_POST['id'];
        $qnt = $_POST['qnt'];
        $sales = new Sales;
        $sql = $sales->updateStock($id, $qnt);
        echo $sql;
    }

    // Sales Items Show
    function salesItemShow(){
        $sales = new Sales;
        $invoice = $_POST['invoice'];
        $sql = $sales->salesItemShow($invoice);
        $tabledata ="";
        while($data = $sql->fetch_assoc()){
            $tabledata .= '<tr>
                     <td>'.$data['sdate'].'</td>
                     <td>'.$data['invoice'].'</td>
                     <td>'.$data['saleprice'].'</td>
                     <td>'.$data['quantity'].'</td>
                     <td>'.$data['total_amount'].'</td>
                     <td>
                       <button class="salesRemoveItem btn btn-danger btn-sm" value="'.$data['id'].'">
                        <i class="fas fa-trash"></i>
                       </button>
                     </td>
                  </tr>';
        }
        echo $tabledata;
    }


    // Calculate Total Sales Quantity
    function salesTotalQnt(){
        $invoice = $_POST['invoice'];
        $sales = new Sales;
        $sql = $sales->salesTotalQnt($invoice);
        $totalQnt = 0;
        while($data = $sql->fetch_assoc()){
            $totalQnt = $totalQnt + $data['quantity'];
        }
        echo $totalQnt;
    }

    // Calculate Total Sales Amount
    function salesTotalAmount(){
        $invoice = $_POST['invoice'];
        $sales = new Sales;
        $sql = $sales->salesTotalQnt($invoice);
        $totalAmnt = 0;
        while($data = $sql->fetch_assoc()){
            $totalAmnt = $totalAmnt + $data['total_amount'];
        }
        echo $totalAmnt;
    }

    // Save Sales Summery
    function insertSalesSummery(){
        $sdate = $_POST['sdate'];
        $invoice = $_POST['invoice'];
        $total_quantity = $_POST['total_quantity'];
        $total_price = $_POST['total_price'];
        $dis = $_POST['dis'];
        $dis_amount = $_POST['dis_amount'];
        $grand_total = $_POST['grand_total'];
        $payment = $_POST['payment'];
        $duePayment = $_POST['duePayment'];
        session_start();
        $br_id =  $_SESSION['branch_id'];
        
        $sales = new Sales;
        $sql = $sales->insertSalesSummery($sdate, $invoice, $total_quantity, $total_price, $dis, $dis_amount, $grand_total, $payment, $duePayment, $br_id);
        if($sql){
            echo "OK";
        } else{
            echo "Wrong";
        }
    }

    // Remove Sales Item
    function salesRemoveItem(){
        $id = $_POST['id'];
		$sales = new Sales;
		$info = $sales->salesRemoveItem($id);
		if ($info) {
            echo "Item Remove";
        } else {
            echo "Item Not Remove";
        }
    }
?>