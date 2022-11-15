$(document).ready(function(){
    
    // Find Cost Price Using Barcode
    $(document).on("keyup", "#barcode", function(){
      var barcode = $(this).val();
      var action = "findItem";

      if (barcode == "") {
        $("#costprice").val("");
        $("#stock").val("");
      } else {
        $.ajax({
            url: "././classes/ajax.php",
            type:"POST",
            dataType: "JSON",
            data:{
                "barcode": barcode,
                "action": action,
            },
            success: function(response){
                if (response == null) {
                    
                } else {
                    $("#costprice").val(response.costprice);
                    $("#product_id").val(response.id); 
                    stockShow(response.id);
                }
                
            }
        });
      }
    });

    // Calculate price * quanty and show the value into total
    $(document).on("keyup","#quantity", function(){
        var qnt = $(this).val();
        if (qnt == "") {
            $("#total").val("");
        } else {
            var price = $("#costprice").val();
            var totalPrice = qnt * price;
            $("#total").val(totalPrice);
        }
    });

     // Find Total Stock and Show
     function stockShow(product_id){
        $.ajax({
            url: "././classes/ajax.php",
            type:"POST",
            dataType: "JSON",
            data:{
                "product_id": product_id,
                "action": "stockShow",
            },
            success: function(response){
                $("#stock").val(response.qnt);
            }
        });
    }

    // Add Purchase Item
    $(".addItem").click(function(){
        var pdate = $("#pdate").val();
        var cname = $("#cname").val();
        var invoice = $("#invoice").val();
        var product_id = $("#product_id").val();
        var barcode = $("#barcode").val();
        var price = $("#costprice").val();
        var qnt = $("#quantity").val();
        var total = $("#total").val();
        var action = "addItem";
        
        $.ajax({
            url: "././classes/ajax.php",
            type:"POST",
            data:{
                "pdate": pdate,
                "cname": cname,
                "invoice": invoice,
                "product_id": product_id,
                "barcode": barcode,
                "price": price,
                "qnt": qnt,
                "total": total,
                "action": action
            },
            success:function(response){
				if (response != "200") {
                    alert("Item Added");
                    showItem();
                    calQnt();
                    calPrice();
				}
				else{
					alert("Something Went Wrong");
				}
			}
        });
    });
    
    // Show Item
    function showItem(){
        var invoice = $("#invoice").val();
        var action = "showItem";
        $.ajax({
			url:"././classes/ajax.php",
			type:"POST",
			data:{
				"action": action,
				"invoice": invoice
			},
			success:function(response){
				console.log(response);
				$(".tdata").html(response);
			}
		});
    }

    // Remove Item
    $(document).on("click",".removeItem", function(){
		var id = $(this).val();
		var action="removeItem";
		$.ajax({
			url:"././classes/ajax.php",
			type:"POST",
			data:{
				'id' : id,
				'action': action
			},
			success:function(response){
                if(response){
                    showItem();
                    alert("Item Removed");
                }
			}
		})
	});

    // Calculate Total Quantity
    function calQnt(){
        var invoice = $("#invoice").val();
        var action = "calQnt";
        $.ajax({
			url:"././classes/ajax.php",
			type:"POST",
			data:{ 
				"action": action,
				"invoice": invoice
			},
			success:function(response){
				$("#totalQnt").val(response);
			}
		});
    }

    // Calculate Total Price
    function calPrice(){
        var invoice = $("#invoice").val();
        var action = "calPrice";
        $.ajax({
			url:"././classes/ajax.php",
			type:"POST",
			data:{ 
				"action": action,
				"invoice": invoice
			},
			success:function(response){
				$("#totalAmount").val(response);
			}
		});
    }

    // Calculate Discount Amount and Grand Total
    $(document).on("change", "#dis", function(){
       var dis = $(this).val();
       var totalAmount = $("#totalAmount").val();

       // Discount
       var disAmount = ((totalAmount * dis)/ 100);
       $("#disAmount").val(disAmount);

       // Grand Total
       var grandTotal = totalAmount - disAmount;
       $("#grandTotal").val(grandTotal);

    });

    //Calculate Payment and Due Payment
    $(document).on("keyup", "#payment", function(){
        var payment = $(this).val();
        var grandTotal = $("#grandTotal").val();
        var duePayment = payment - grandTotal;
        $("#duePayment").val(duePayment);
    }); 

    // Save Purchase Summery
    $(document).on("click", "#save", function(){
        var pdate = $("#pdate").val();
        var company = $("#cname").val();
        var invoice = $("#invoice").val();
        var total_quantity = $("#totalQnt").val();
        var total_price = $("#totalAmount").val();
        var dis = $("#dis").val();
        var dis_amount = $("#disAmount").val();
        var grand_total = $("#grandTotal").val();
        var payment = $("#payment").val();
        var duePayment = $("#duePayment").val();
        var action = "purchaseSummery";

        $.ajax({
			url:"././classes/ajax.php",
			type:"POST",
			data:{ 
                "pdate": pdate,
                "company": company,
                "invoice": invoice,
                "total_quantity": total_quantity,
                "total_price": total_price,
                "dis": dis,
                "dis_amount": dis_amount,
                "grand_total": grand_total,
                "payment": payment,
                "duePayment": duePayment,
				"action": action,
			},
			success:function(response){
				alert("Successfully Saved");
			}
		});



    }); 




});