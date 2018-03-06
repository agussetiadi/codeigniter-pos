<script type="text/javascript" src="<?php echo base_url()."assets/js/tableData.js" ?>"></script>
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
    	<div class="row">
	      <div class="col-md-6"><h2 class="no-margin-bottom">Halaman Transaksi</h2></div>
	      <div class="col-md-6">
	      
	      </div>
      	</div>
    </div>
  </header>
<!-- Dashboard Counts Section-->

<input type="hidden" name="" value="<?php echo $trx ?>" class="billing_id">

<div class="container-fluid top-bottom">
	<div class="row">
		<div class="col-md-12">
			<div class="block-space">
				<table width="100%">
					<tr>
						<td width="12%">No Transaksi</td>
						<td width="20%"><input type="text" class="main-text" id="billing_no" disabled="" placeholder="Auto"></td>
						<td rowspan="3" width="1%"></td>
						<td rowspan="3" style="border: 1px solid rgb(218, 218, 218);"><div id="grand_total_html"></div>
						<input type="hidden"  id="grand_total">
						</td>
					</tr>
					<tr>
						<td>Pelanggan</td>
						<td>
						<div class="input-group">
							<input type="hidden" name="" id="customer_id">
							<input disabled="" id="renderCust1" type="text" class="main-text" placeholder="Nama Pelanggan">
							<button class="btn btn-sm btn-outline-secondary" data-target="#modal5" data-toggle="modal"><span class="fa fa-pencil"></span></button>
						</div>
						</td>
						
					</tr>
					<tr>
					<td>Nomor Telephone</td>
						<td><input disabled="" id="renderCust2" type="text" class="main-text" placeholder="Nomor Telp."></td>
					</tr>
				</table>
			<hr>
				<button data-toggle="modal" data-target="#modal1" class="btn btn-info btn-sm">Daftar Item</button>
				<table id="table-order" class="table-main" border="1.5" bordercolor="#bfbfbf" style="margin-top: 20px;">
					<thead>
						<th>No.</th>
						<th>Nama Item</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Satuan</th>
						<th>Discount(%)</th>
						<th>Discount(peritem)</th>
						<th>Total</th>
						<th></th>
					</thead>
					<tbody>

					</tbody>
				</table>


			<hr>
				<div class="row">
					<div class="col-md-6">

						<table width="100%">
							<tr>
								<td width="20%">Dibuat oleh </td>
								<td width="50%"><input type="text" id="created_by" class="main-text" name="operator" disabled=""></td>
								<td></td>
							</tr>
							<tr>
								<td>Diupdate oleh </td>
								<td><input type="text" id="updated_by" class="main-text" name="cashier" disabled=""></td>
								<td></td>
							</tr>
							<tr>
								<td>Keterangan </td>
								<td><textarea class="main-text" id="billing_notes"></textarea></td>
								<td></td>
							</tr>
						</table>
						
					</div>

					<div class="col-md-6">
					
						<table width="100%">
							<tr>
								<td></td>
								<td width="20%">Sub Total</td>
								<td width="50%"><input type="text" class="main-text" id="total_billing" disabled="" name=""></td>
							</tr>
							<tr>
								<td></td>
								<td>Discount</td>
								<td>
									<div class="input-group">
										<input type="text" disabled="" class="main-text" id="discount_percent_bill" placeholder="" style="width: 40px; margin-right: 5px;">
										<input type="text" class="main-text" id="discount_total" disabled="">
										<button class="btn btn-outline-secondary btn-sm" id="btnModal9" type="button"><span class="fa fa-pencil"></span></button>
									</div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>Pajak</td>
								<td>
									<div class="input-group">
									<input id="tax_percent" disabled="" type="text" class="main-text" style="width: 40px; margin-right: 5px;">
									<input type="text" disabled="" class="main-text" id="tax_total" placeholder="">
									  <div class="input-group-append">
									    <button class="btn btn-outline-secondary btn-sm" id="btnModal8" type="button"><span class="fa fa-pencil"></span></button>
									  </div>
									</div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>Biaya Lain</td>
								<td><input type="text" class="jsPrice main-text" id="biaya_lain">
								</td>
							</tr>
							
						</table>
						
					</div>
				</div>
				<hr>
				<div style="float: right; height: 50px;">

				<?php if($this->role_module->get(32) == true){ ?>
				<button class="btn btn-info btn-sm" id="btn-bayar">Bayar</button>
				<?php } ?>
				<button class="btn btn-info btn-sm" id="btn-add">Tambah Baru</button>
				<button class="btn btn-info btn-sm" id="btn-simpan">Simpan</button>
				<button class="btn btn-info btn-sm" id="btn-cancel">Batalkan</button>
				
				</div>
			</div>
		</div>
	</div>
</div>

<div id="modal1" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    	<div class="modal-header">
	    	<h4 class="text-center">Daftar Produk</h4>
	    </div>
	    <div class="modal-body">
		<table id="look" class="table" width="100%" style="">
			<thead>
				<th>No.</th>
				<th>Nama</th>
				<th>Stock</th>
				<th>Kategori</th>
				<th>Keterangan</th>
				<th>Harga</th>
				<th>Satuan</th>
				<th></th>
			</thead>
			<tbody>
			
			</tbody>
		</table>

		</div>


		<div class="modal-footer">
			
		</div>


    </div>
  </div>
</div>
<div id="modal2" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
	    <form id="billing_ajax" action="<?php echo base_url()."sales/billing/add_detail/" ?>" method="POST">
    	<div class="modal-header">
	    	<h4 class="text-center">Tambah Produk</h4>
	    </div>
	    <div class="modal-body">
   			<table style="width: 100%" border="0">
   				<tr>
   					<td>Harga</td>
   					<td><input type="number" name="item_price" id="item_price" class="form-control"></td>
   				</tr>
   				<tr>
   					<td>Jumlah</td>
   					<input type="hidden" name="item_id" id="item_id">
   					<td><input type="number" name="order_qty" id="order_qty" class="form-control" value="1"></td>
   				</tr>

   				<tr>
   					<td>Discount</td>
   					<td>
   						<div class="input-group" id="disc_add">
   							<input type="number" name="discount_percent" id="discount_percent"  placeholder="Persen" class="form-control" min="0" max="100">
   							<input type="number" name="" id="discount_price" class="form-control" placeholder="Jumlah">
   						</div>
   					</td>
   				</tr>

   			</table>

		</div>


		<div class="modal-footer">
			<button class="btn btn-danger btn-sm" id="btnAddDetail" name="btn-submit">Simpan</button>
		</div>
		</form>

    </div>
  </div>
</div>



<div id="modal3" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
	    <form id="billing_ajax_edit" action="<?php echo base_url()."sales/billing/edit_detail/" ?>" method="POST">
    	<div class="modal-header">
	    	<h4 class="text-center">Edit Produk</h4>
	    </div>
	    <div class="modal-body">
   			<table style="width: 100%" border="0">
   				<tr>
   					<td>Harga</td>
   					<td><input type="number" name="item_price" id="item_price_update" class="form-control"></td>
   				</tr>
   				<tr>
   					<td>Jumlah</td>
   					<input type="hidden" name="item_id" id="item_id_update">
   					<input type="hidden" name="billing_detail_id" id="billing_detail_id">
   					<td><input type="number" name="order_qty" id="order_qty_update" class="form-control" value="1"></td>
   				</tr>

   				<tr>
   					<td>Discount</td>
   					<td>
   						<div class="input-group">
   							<input type="number" name="discount_percent" id="discount_percent_update"  class="form-control" value="0" min="0" max="100" placeholder="Persen">
   							<input type="number" name="" id="discount_price_update" class="form-control" placeholder="Jumlah">
   						</div>
   					</td>
   				</tr>

   			</table>

		</div>


		<div class="modal-footer">
			<button class="btn btn-danger btn-sm" id="btnUpdateDetail" name="btn-submit">Simpan</button>
		</div>
		</form>

    </div>
  </div>
</div>

<div id="modal4" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
	    <div class="modal-body">
	   		
	   		<table class="table">
	   			<tr>
	   				<td width="15%"><h1>Total</h1></td>
	   				<td colspan="3"><div id="p-total" style=""></div></td>
	   				
	   			</tr>
	   			<tr>
	   				<td>Tunai</td>
	   				<td width="30%">
	   					<input type="text" class="main-text alg-right jsPrice" id="totalCash" placeholder="0,00">
	   				</td>
	   				<td colspan="2"></td>
	   				
	   			</tr>
	   			<tr>
	   				<td>Credit Card</td>
	   				<td>
	   					<input type="text" class="main-text alg-right jsPrice cr" id="totalCredit" placeholder="0,00">
	   				</td>
	   				<td width="15%">
	   					<select class="main-text" id="creditCardBank">
	   						<option value="">- Pilih Bank -</option>
	   						<?php foreach ($query3->result_array() as $key => $value) { ?>
	   						<option value="<?php echo $value['bank_id'] ?>"><?php echo $value['bank_name'] ?></option>
	   						<?php } ?>
	   						
	   					</select>
	   				</td>
	   				<td>
	   					<input type="text" class="main-text tr" id="creditCardTrx" placeholder="No TRX">
	   				</td>
	   			</tr>
	   			<tr>
	   				<td>Debit Card</td>
	   				<td>
	   					<input type="text" class="main-text alg-right jsPrice cr" id="totalDebit" placeholder="0,00">
	   				</td>
	   				<td width="15%">
	   					<select class="main-text" id="debitCardBank">
	   						<option value="">- Pilih Bank -</option>
	   						<?php foreach ($query3->result_array() as $key => $value) { ?>
	   						<option value="<?php echo $value['bank_id'] ?>"><?php echo $value['bank_name'] ?></option>
	   						<?php } ?>
	   						
	   					</select>
	   				</td>
	   				<td>
	   					<input type="text" class="main-text tr" id="debitCardTrx" placeholder="No TRX">
	   				</td>
	   			</tr>
	   			<tr>
	   				<td>Total Bayar</td>
	   				<td colspan="3"><div id="tobay" class="alg-right">0,00</div>
	   				</td>
	   				
	   				
	   			</tr>
	   			<tr>
	   				<td id="kekurangan">Kekurangan</td>
	   				<td colspan="3"><div id="return" class="alg-right">0,00</div></td>
	   				
	   			</tr>
	   		</table>

		</div>


		<div class="modal-footer">
			<button class="btn btn-info" id="btnSavePaid"><span class="fa fa-save"></span> Simpan</button>
			
			<button class="btn btn-info">Batal</button>
		</div>


    </div>
  </div>
</div>



<div id="modal5" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

		    <div class="modal-header">
		    	<h4 class="modal-title">Pelanggan</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    </div>

		    <div class="modal-body">
		    	<div class="row">
		    		<div class="col-md-6">
		    			
				    	<input type="text" name="" id="searchCustomerFilter" class="form-control form-control-sm" placeholder="Cari berdasarkan nama">

				    	

		    		</div>
		    		<div class="col-md-3">
		    			<select id="limitCustomerFilter" class="custom-select">
		    				<option>5</option>
				    		<option>10</option>
				    		<option>25</option>
				    		<option>50</option>
				    		<option>100</option>
				    	</select>
		    		</div>
		    		<div class="col-md-3">
		    			<button class="btn btn-primary" data-target="#modal7" data-toggle="modal"><span class="fa fa-plus"></span> tambah</button>
		    		</div>
		    	</div>
		    	<table id="customerLookup" class="table">
		    		<thead>
		    			<th>Kode Pelanggan</th>
		    			<th>Nama Pelanggan</th>
		    			<th>Telp</th>
		    			<th>Alamat</th>
		    			<th>Action</th>
		    		</thead>
		    		<tbody></tbody>
		    	</table>	

		    </div>


		</div>
	</div>
</div>
<div id="modal7" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

		    <div class="modal-header">
		    	<h4 class="modal-title">Tambah Pelanggan</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    </div>

		    <form method="POST" action="<?php echo base_url()."sales/billing/add_customer" ?>" class="ajax_form">
		    <div class="modal-body">
		    		<div class="form-group">
		    			<label>Nama Pelanggan</label>
		    			<input type="text" name="customer_name" id="customer_name" class="form-control form-control-sm" placeholder="(Required)">
		    		</div>
		    		<div class="form-group">
		    			<label>Nomor Telephone</label>
		    			<input type="text" name="customer_phone" class="form-control form-control-sm" placeholder="(Required)">
		    		</div>
		    		<div class="form-group">
		    			<label>Alamat Lengkap</label>
		    			<textarea class="form-control form-control-sm" name="customer_address" placeholder="(Opsional)"></textarea>
		    		</div>
		    </div>
		    <div class="modal-footer">
		    	<button class="btn btn-primary btn-ajax-process" id="btnSaveCustomer"><span class="fa fa-save"></span> Simpan</button>
		    </div>
		    </form>


		</div>
	</div>
</div>

<div id="modal8" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">

		    <div class="modal-header">
		    	<h4 class="modal-title">Edit Pajak</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    </div>
		    <div class="modal-body">
			    <div class="col-md-12">
			    	<label>Jumlah Pajak <i>(dalam persen)</i></label>
			    	<div class="input-group">
			    	<input type="number" id="setTax" class="form-control" name="" min="0" max="100" placeholder="dalam persen">
			    	</div>
			    </div>

		    </div>
		    <div class="modal-footer">
		    	<button class="btn btn-primary btn-ajax-process" id="btnSaveTax"><span class="fa fa-save"></span> Simpan</button>
		    </div>
		</div>
	</div>
</div>


<div id="modal9" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">

		    <div class="modal-header">
		    	<h4 class="modal-title">Discount Per Billing</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    </div>
		    <div class="modal-body">
			    <div class="col-md-12">
			    	<div class="form-group">
				    	<label>Jumlah Diskon <i>(dalam persen)</i></label>
				    	<div class="input-group">
				    	<input type="number" id="setDiscountPercent" class="form-control" name="" min="0" max="100" placeholder="dalam persen">
				    	</div>
			    	</div>
			    	<div class="form-group">
			    		<label>Jumlah Diskon <i>(dalam rupiah)</i></label>
				    	<div class="input-group">
				    	<input type="number" id="setDiscountPrice" class="form-control" name="" placeholder="Jumlah">
				    	</div>
			    	</div>
			    </div>

		    </div>
		    <div class="modal-footer">
		    	<button class="btn btn-primary btn-ajax-process" id="btnSaveDiscount"><span class="fa fa-save"></span> Simpan</button>
		    </div>
		</div>
	</div>
</div>
<script type="text/javascript">
$('.jsPrice').number( true);		   


	var tableCustomer = $('#look').DataTable( {
    "processing": true,
    "serverSide": true,
    "searching": true,
    "responsive": true,
    "ajax":{
	        url :"<?php echo base_url()."sales/billing/get_table" ?>", // json datasource
	        type: "POST",  // method  , by default get
	        error: function(){  // error handling
	            $(".lookup-error").html("");
	            $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
	            $("#lookup_processing").css("display","none");
	            
	        }
	    }
	});
	$("#look_length select").addClass("custom-select").css('height','35px');


	$(document).on("click", ".act-pilih", function(e){
		showLoader('#modal2 .modal-body');

		var index = $(".act-pilih").index(this);
		var item_id = $(".act-pilih").eq(index).attr('data-value');
		$("#modal2").modal("show");

		$.ajax({
			url : '<?php echo base_url() ?>' + 'sales/billing/get_item',
			method : 'POST',
			data : {
				item_id : item_id
			},
			success : function(jsonData){
				var dataObj = JSON.parse(jsonData);
				var data = dataObj.data;
				removeLoader('#modal2 .modal-body');

				$("#item_id").val(data.item_id);
				$("#item_price").val(data.item_price);
				$("#order_qty").val("1");
			}
		})


	})



	/*
	Billling ajax request
	*/



	/*
	request table ke server
	*/
	function get_detail(tableName, billing_id){

			$.ajax({
			url:"<?php echo base_url() ?>"+"sales/billing/get_detail",
			method : "POST",
			data : {billing_id:billing_id},
			success:function(resultJson){
				var result = JSON.parse(resultJson);
				var jsonData = result.data;
				var totalData = result.data;
				var num = jsonData.length;
				var container = $(tableName+" tbody");
				var tr = "";
				for (var i = 0; i < num; i++) {

					var frontTr = '<tr>';
					var backTr = '</tr>';

					var nested = jsonData[i];
					var numNested = nested.length;
					var td = "";
						for (var b = 0; b < numNested; b++) {
							td += '<td>'+nested[b]+'</td>';
						}
					tr += frontTr+td+backTr;
				}
				container.html(tr);
				setBilling(billing_id)


			}
		})
	}

	function getBilling(billing_id, callback){
		$.ajax({
			url : '<?php echo base_url() ?>' + 'sales/billing/get_billing',
			method : 'POST',
			data : {billing_id : billing_id},
			success : function(jsonData){
				var dataObj = JSON.parse(jsonData);
				if (dataObj.status == 'ok') {
					var data = dataObj.data;
					if (callback)
						callback(data)
				}
			}
		})
	}

	function setBilling(billing_id, callback){
		getBilling(billing_id, function(data){
			$("#created_by").val(data.created_by);
			$("#updated_by").val(data.updated_by);
			$("#billing_no").val(data.billing_no);
			$("#total_billing").val(data.total_billing);
			$("#discount_percent_bill").val(data.discount_percent_bill+'%');
			$("#discount_total").val(data.discount_total);
			$("#tax_percent").val(data.tax_percent+'%');
			$("#tax_total").val(data.tax_total);
			$("#grand_total").val(data.grand_total);
			$("#grand_total_html").html($.number(data.grand_total));

			if (callback)
				callback(data)
		})
	}

	$(document).on("submit", "#billing_ajax", function(e){
		e.preventDefault();
		btnLoader('#btnAddDetail');
		$("#modal2").modal("hide");
		$("#modal1").modal("hide");
		var path = $(this).attr("action");
		var method = $(this).attr("method");

		var billing_id = $(".billing_id").val();
		var item_id = $("#item_id").val();
		var order_qty = $("#order_qty").val();
		var item_price = $("#item_price").val();
		var discount_percent = $("#discount_percent").val();
		var discount_price = $("#discount_price").val();
		$.ajax({
			url : path,
			method : method,
			data : {
				item_id : item_id,
				billing_id : billing_id,
				order_qty : order_qty,
				item_price : item_price,
				discount_percent : discount_percent,
				discount_price : discount_price
			},
			success : function(jsonData){

				btnRemoveLoader('#btnAddDetail','Simpan');
				showLoader('.block-space');
				var dataObj = JSON.parse(jsonData);
				$(".billing_id").val(dataObj.billing_id)
				get_detail("#table-order", dataObj.billing_id)

				$("#discount_percent").val(0);
				$("#discount_price").val(0);

				$(document).ajaxStop(function(){
					removeLoader('.block-space');
				})
			}
		})
	})


	$(document).on("submit", "#billing_ajax_edit", function(e){
		e.preventDefault();
		btnLoader('#btnUpdateDetail');
		$("#modal3").modal("hide");
		var path = $(this).attr("action");
		var method = $(this).attr("method");

		var billing_id = $(".billing_id").val();
		var billing_detail_id = $("#billing_detail_id").val();
		var item_id = $("#item_id_update").val();
		var order_qty = $("#order_qty_update").val();
		var item_price = $("#item_price_update").val();
		var discount_percent = $("#discount_percent_update").val();
		var discount_price = $("#discount_price_update").val();
		$.ajax({
			url : path,
			method : method,
			data : {
				item_id : item_id,
				billing_id : billing_id,
				billing_detail_id : billing_detail_id,
				order_qty : order_qty,
				item_price : item_price,
				discount_percent : discount_percent,
				discount_price : discount_price
			},
			success : function(jsonData){

				btnRemoveLoader('#btnUpdateDetail','Simpan');
				showLoader('.block-space');
				var dataObj = JSON.parse(jsonData);
				get_detail("#table-order", dataObj.data.billing_id)
				$(document).ajaxStop(function(){
					removeLoader('.block-space');
				})
			}
		})
	})


$(window).on("load", function(){
	var billing_id = $(".billing_id").val();

	if (billing_id !== "") {

		getBilling(billing_id);
	}

})



/*Pembayaran*/

$(document).on("click", "#btn-bayar", function(){
	if ($("#billing_id").val() != "") {

		$("#modal4").modal("show");
		var total1 = $("#grand_total").val();
		$("#p-total").html($.number(total1));

	}

	/*$("#return").html($.number(total1));*/
})

function hitung_bayar(){
	var grand_total = parseInt($("#grand_total").val());
	var totalCash = parseInt($("#totalCash").val() ? $("#totalCash").val() : 0);
	var totalCredit = parseInt($("#totalCredit").val() ? $("#totalCredit").val() : 0);
	var totalDebit = parseInt($("#totalDebit").val() ? $("#totalCredit").val() : 0);


	var totalPay = totalCash + totalCredit + totalDebit;

	if (totalPay > grand_total) {
		var result = totalPay - grand_total;	
		$("#kekurangan").html('Kembalian');
		$("#return").html(result);
	}
	else{
		var result = grand_total - totalPay;
		$("#kekurangan").html('Kekurangan');
		$("#return").html(result);
	}
	$("#tobay").html(totalPay);

	return result;
}


$(document).on("input", "#totalCash", function(){
	hitung_bayar();
})

$(document).on("input", "#totalCredit", function(){
	hitung_bayar();
})

$(document).on("input", "#totalDebit", function(){
	hitung_bayar();
})
var tableCustomer = $("#customerLookup").tableData({
	url : '<?php echo base_url() ?>' + 'sales/billing/load_customer',
	search : "#searchCustomerFilter",
	length : "#limitCustomerFilter",
	defaultSort : ['customer_id','DESC']
})


$(document).on("submit", ".ajax_form", function(e){

	btnLoader("#btnSaveCustomer");

	e.preventDefault();

	var path = $(this).attr("action");
	var get_method = $(this).attr("method");

	$.ajax({
		url : path,
		method : get_method,
		data : new FormData(this),
		contentType : false,
		processData : false,
		success:function(data){

			btnRemoveLoader("#btnSaveCustomer",'<span class="fa fa-save"></span> Simpan');

			jsonData = JSON.parse(data);
			if (jsonData.action) {
				$(".ajax_form input").val("");
				$(".ajax_form textarea").val("");
				$('#modal7').modal('hide');
				tableCustomer.reload();		
			}
			else if (jsonData.msg) {
				swal(jsonData.required+" Harus terisi","warning");
			}
		}
	})
})
function renderCustomer(customer_id){
	var renderCust1 = $("#renderCust1");
	var renderCust2 = $("#renderCust2");
	$.ajax({
		url : '<?php echo base_url() ?>' + 'sales/billing/render_customer',
		method : 'POST',
		data : {customer_id : customer_id},
		success:function(data){
			var dataObj = JSON.parse(data);
			if (dataObj.status == 'success') {
				renderCust1.val(dataObj.data.customer_name);
				renderCust2.val(dataObj.data.customer_phone);
			}
		}
	})
}
$(document).on("click",".btn-cust", function(){
	var index = $(".btn-cust").index(this);
	var idValue = $(".btn-cust").eq(index).attr('data-value');
	$("#modal5").modal("hide");
	$("#customer_id").val(idValue);
	renderCustomer(idValue);

})


$(document).on('click','#btnModal8', function(){
	var billing_id = $(".billing_id").val();
	if (billing_id == "") {
		return false;
	}

	$("#modal8").modal('show');
	showLoader("#modal8 .modal-body");
	$.ajax({
		url : '<?php echo base_url() ?>' + 'sales/billing/get_billing',
		method : 'POST',
		data : {billing_id : billing_id},
		success : function(jsonData){
			removeLoader("#modal8 .modal-body");
			var dataObj = JSON.parse(jsonData);
			if (dataObj.status == 'ok') {
				$("#setTax").val(dataObj.data.tax_percent);

			}
		}
	})

})

$(document).on('click','#btnModal9', function(){
	var billing_id = $(".billing_id").val();
	if (billing_id == "") {
		return false;
	}

	$("#modal9").modal('show');
	showLoader("#btnModal9 .modal-body");
	$.ajax({
		url : '<?php echo base_url() ?>' + 'sales/billing/get_billing',
		method : 'POST',
		data : {billing_id : billing_id},
		success : function(jsonData){
			removeLoader("#modal9 .modal-body");
			var dataObj = JSON.parse(jsonData);
			if (dataObj.status == 'ok') {
				$("#setDiscountPercent").val(dataObj.data.discount_percent_bill);
				$("#setDiscountPrice").val(dataObj.data.discount_price_bill);
			}
		}
	})

})

$(document).on("click","#btnSaveTax", function(){

	btnLoader('#btnSaveTax');

	var tax_percent = $("#setTax").val();
	var billing_id = $(".billing_id").val();
	$.ajax({
		url : '<?php echo base_url() ?>' + 'sales/billing/set_tax',
		method : 'POST',
		data : {billing_id : billing_id, tax_percent : tax_percent},
		success : function(jsonData){
			var dataObj = JSON.parse(jsonData);
			if (dataObj.status == 'ok') {
				showLoader('.block-space');
				$("#modal8").modal('hide');
				setBilling(billing_id);
				get_detail("#table-order", billing_id);
				btnRemoveLoader('#btnSaveTax','<span class="fa fa-save"></span> Simpan');
				$(document).ajaxStop(function(){
					removeLoader('.block-space');
				})
			}
		}
	})

})

$(document).on("click","#btnSaveDiscount", function(){

	btnLoader('#btnSaveDiscount');

	var discount_percent_bill = $("#setDiscountPercent").val();
	var discount_price_bill = $("#setDiscountPrice").val();
	var billing_id = $(".billing_id").val();
	$.ajax({
		url : '<?php echo base_url() ?>' + 'sales/billing/set_discount',
		method : 'POST',
		data : {billing_id : billing_id, 
				discount_percent_bill : discount_percent_bill,
				discount_price_bill : discount_price_bill
				},
		success : function(jsonData){
			var dataObj = JSON.parse(jsonData);
			if (dataObj.status == 'ok') {
				showLoader('.block-space');
				$("#modal8").modal('hide');
				setBilling(billing_id);
				btnRemoveLoader('#btnSaveDiscount','<span class="fa fa-save"></span> Simpan');
				$(document).ajaxStop(function(){
					removeLoader('.block-space');
				})
			}
		}
	})

})


$(document).on('change', '#biaya_lain', function(){
	var billing_id = $(".billing_id").val();
	var biaya_lain = $("#biaya_lain").val();
	if (billing_id == "") {
		return false;
	}

	showLoader('.block-space');
	$.ajax({
		url : '<?php echo base_url() ?>' + 'sales/billing/set_biaya_lain',
		method : 'POST',
		data : {billing_id : billing_id, biaya_lain : biaya_lain},
		success : function(jsonData){
			var dataObj = JSON.parse(jsonData);
			if (dataObj.status == 'ok') {
				
				setBilling(billing_id);
				get_detail("#table-order", billing_id);
				$(document).ajaxStop(function(){
					removeLoader('.block-space');
				})
			}
		}
	})
})


$(document).on('click', '.btn-delete-bill', function(){
	var index = $('.btn-delete-bill').index(this);
	var billing_detail_id = $(".btn-delete-bill").eq(index).attr('data-value');
	var billing_id = $(".billing_id").val();
	var objAlert = {
		title : 'Yakin Ingin Menghapus ?',
		text : 'Data akan terhapus dari database'
	}

	dataAlert(objAlert, function(){
		showLoader(".block-space");
		$.ajax({
			url : '<?php echo base_url() ?>' + 'sales/billing/delete_billing_detail',
			method : 'POST',
			data : {billing_id : billing_id, billing_detail_id : billing_detail_id},
			success : function(jsonData){
				removeLoader('.block-space');
				var dataObj = JSON.parse(jsonData);
				if (dataObj.status == 'ok') {
					setBilling(billing_id);
					get_detail("#table-order", billing_id);
				}
			}
		})
	})

})

$(document).on('click', '.btn-edit-bill', function(){
	var index = $('.btn-edit-bill').index(this);
	var billing_detail_id = $(".btn-edit-bill").eq(index).attr('data-value');
	var billing_id = $(".billing_id").val();

		$("#modal3").modal("show");

		$.ajax({
			url : '<?php echo base_url() ?>' + 'sales/billing/get_edit_detail',
			method : 'POST',
			data : {
				billing_detail_id : billing_detail_id
			},
			success : function(jsonData){
				var dataObj = JSON.parse(jsonData);
				if (dataObj.status == 'ok') {
					var data = dataObj.data;
					removeLoader('#modal3 .modal-body');
					$("#item_id_update").val(data.item_id);
					$("#billing_detail_id").val(data.billing_detail_id);
					$("#item_price_update").val(data.item_price);
					$("#order_qty_update").val(data.order_qty);
					$("#discount_percent_update").val(data.discount_percent);
					$("#discount_price_update").val(data.discount_price);
				}
			}
		})
})


function discountHitung(total,percent,price){

	if (percent > 0) {
		var result = Math.floor((total * percent) / 100);
	}
	else if(price > 0){
		var getValue = total / price;

		var result = Math.floor(100/getValue);	
	}

	return result;
}

$(document).on("input", "#discount_percent", function(){
	$("#discount_price").val(0);
	var total = $("#item_price").val();
	var discountPercent = $(this).val() ? $(this).val() : 0;
	var discountPrice = 0;
	$("#discount_price").val(discountHitung(total, discountPercent, discountPrice))
})

$(document).on("input", "#discount_price", function(){
	$("#discount_percent").val(0);
	var total = $("#item_price").val();
	var discountPercent = 0;
	var discountPrice = $(this).val() ? $(this).val() : 0;;
	$("#discount_percent").val(discountHitung(total, discountPercent, discountPrice))
})
$(document).on("input", "#item_price", function(){
	$("#discount_percent").val(0);
	$("#discount_price").val(0);
})

/*Udpdate*/
$(document).on("input", "#discount_percent_update", function(){
	$("#discount_price_update").val(0);
	var total = $("#item_price_update").val();
	var discountPercent = $(this).val() ? $(this).val() : 0;
	var discountPrice = 0;
	$("#discount_price_update").val(discountHitung(total, discountPercent, discountPrice))
})

$(document).on("input", "#discount_price_update", function(){
	$("#discount_percent_update").val(0);
	var total = $("#item_price_update").val();
	var discountPercent = 0;
	var discountPrice = $(this).val() ? $(this).val() : 0;;
	$("#discount_percent_update").val(discountHitung(total, discountPercent, discountPrice))
})
$(document).on("input", "#item_price_update", function(){
	$("#discount_percent_update").val(0);
	$("#discount_price_update").val(0);
})

$(document).on("input", "#setDiscountPercent", function(){
	var grand_total = $("#grand_total").val();
	var setDiscountPercent = $(this).val();
	$("#setDiscountPrice").val(discountHitung(grand_total,setDiscountPercent,0));
})

$(document).on("input", "#setDiscountPrice", function(){
	var grand_total = $("#grand_total").val();
	var setDiscountPrice = $(this).val();
	$("#setDiscountPercent").val(discountHitung(grand_total,0,setDiscountPrice));
})

$(document).on('click','#btnSavePaid', function(){
	var billing_id = $(".billing_id").val();
	var billing_notes = $("#billing_notes").val();
	var customer_id = $("#customer_id").val();
	var totalCash = $("#totalCash").val();
	var totalCredit = $("#totalCredit").val();
	var creditCardBank = $("#creditCardBank").val();
	var creditCardTrx = $("#creditCardTrx").val();
	var totalDebit = $("#totalDebit").val();
	var debitCardBank = $("#debitCardBank").val();
	var debitCardTrx = $("#debitCardTrx").val();

	var dataSend = {
			billing_id : billing_id,
			billing_notes : billing_notes,
			customer_id : customer_id,
			total_cash : totalCash,
			total_credit : totalCredit,
			credit_card_bank : creditCardBank,
			credit_card_trx : creditCardTrx,
			total_debit : totalDebit,
			debit_card_bank : debitCardBank,
			debit_card_trx : debitCardBank
		}

	console.log(dataSend);
	$.ajax({
		url : '<?php echo base_url() ?>' + 'sales/billing/save_paid',
		method : 'POST',
		data : dataSend,
		success : function(jsonData){
			var dataObj = JSON.parse(jsonData);
			if (dataObj.status == 'ok') {
				console.log("Success");
			}
		}
	})

})


</script>