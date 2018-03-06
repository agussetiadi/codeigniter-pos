
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
    	<div class="row">
	      <div class="col-md-6"><h2 class="no-margin-bottom">Daftar Piutang</h2></div>
	      <div class="col-md-6">
	      
	      </div>
      	</div>
    </div>
  </header>
<!-- Dashboard Counts Section-->


<div class="container-fluid top-bottom">
	<div class="row">
		<div class="col-md-12">
			<div class="block-space">
			<table style="width: 100%;">
				<tr>
					<td width="12%">Kata Kunci</td>
					<td colspan="4">
						<input type="text" class="form-control searchData" name="" placeholder="Cari nama pelanggan">
					</td>
				</tr>
				<tr style="height: 75px;">
					<td>Office/Cabang</td>
					<td width="20%">
						<select style="margin: 0; height: 40px; width: 100%;" id="store_id">
							<?php foreach($q_store->result_array() as $key => $value) { ?>
							<option <?php if($value['store_id'] == $store_id){ echo "selected"; } ?> value="<?php echo $value['store_id'] ?>"><?php echo $value['store_name'] ?></option>
							<?php } ?>
						</select>
					</td>
					<td style="padding-left: 30px;" width="12%">Tampilkan</td>
					<td>
						<select style="margin: 0; height: 40px; width: 50px;" id="tampilkan">
							<option>7</option>
							<option>15</option>
							<option>25</option>
							<option>50</option>
							<option>100</option>
						</select>
					</td>
					<td><button class="btn btn-success btn-sm" id="btn-refresh">Refresh</button></td>
				</tr>
			</table>
			<table class="table table-list-pending" style="margin-top: 20px; overflow: scroll;" id="look">
				<thead>
					<th>Nama Pelanggan</th>
					<th>Grand Total</th>
					<th>Sudah Dibayar</th>
					<th>Sisa</th>
					<th>Tgl TRX</th>
					<th>Input Oleh</th>
					<th>Store</th>
					<th>Shift</th>
					<th></th>
				</thead>
				<tbody></tbody>
				<tfoot></tfoot>
			</table>
			</div>
		</div>
	</div>
</div>

<div id="modal4" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
	    <div class="modal-body">
	   		
	   		<table class="table">
	   			<tr>
	   				<td width="20%"><h1>Sisa Harus Dibayar</h1></td>
	   				<td colspan="3"><div id="p-total" style=""></div>
	   				<input type="hidden" name="grand_total">
	   				
	   				<input type="hidden" name="piutang_id">
	   				</td>
	   				
	   			</tr>
	   			<tr>
	   				<td>Tunai</td>
	   				<td width="30%">
	   					<input type="text" class="main-text alg-right jsPrice" name="total_cash" placeholder="0,00">
	   				</td>
	   				<td colspan="2"></td>
	   				
	   			</tr>
	   			<tr>
	   				<td>Transfer</td>
	   				<td>
	   					<input type="text" class="main-text alg-right jsPrice cr" name="credit_0" placeholder="0,00">
	   				</td>
	   				<td width="15%">
	   					<select class="main-text" name="bank_0">
	   						<option value="">- Pilih Bank -</option>
	   						<?php foreach ($query3->result_array() as $key => $value) { ?>
	   						<option value="<?php echo $value['bank_id'] ?>"><?php echo $value['bank_name'] ?></option>
	   						<?php } ?>
	   						
	   					</select>
	   				</td>
	   				<td>
	   					<input type="text" class="main-text tr" name="trx_0" placeholder="No TRX">
	   				</td>
	   			</tr>
	   			<tr>
	   				<td>Credit Card</td>
	   				<td>
	   					<input type="text" class="main-text alg-right jsPrice cr" name="credit_1" placeholder="0,00">
	   				</td>
	   				<td width="15%">
	   					<select class="main-text" name="bank_1">
	   						<option value="">- Pilih Bank -</option>
	   						<?php foreach ($query3->result_array() as $key => $value) { ?>
	   						<option value="<?php echo $value['bank_id'] ?>"><?php echo $value['bank_name'] ?></option>
	   						<?php } ?>
	   						
	   					</select>
	   				</td>
	   				<td>
	   					<input type="text" class="main-text tr" name="trx_1" placeholder="No TRX">
	   				</td>
	   			</tr>
	   			<tr>
	   				<td>Debit Card</td>
	   				<td>
	   					<input type="text" class="main-text alg-right jsPrice cr" name="credit_2" placeholder="0,00">
	   				</td>
	   				<td width="15%">
	   					<select class="main-text" name="bank_2">
	   						<option value="">- Pilih Bank -</option>
	   						<?php foreach ($query3->result_array() as $key => $value) { ?>
	   						<option value="<?php echo $value['bank_id'] ?>"><?php echo $value['bank_name'] ?></option>
	   						<?php } ?>
	   						
	   					</select>
	   				</td>
	   				<td>
	   					<input type="text" class="main-text tr" name="trx_2" placeholder="No TRX">
	   				</td>
	   			</tr>
	   			<tr>
	   				<td>Total Bayar</td>
	   				<td colspan="3"><div id="tobay" class="alg-right">0,00</div>
	   				<input type="hidden"  name="tobay">
	   				<input type="hidden" name="less_pay">
	   				<input type="hidden" name="total_return">
	   				</td>
	   				
	   				
	   			</tr>
	   			<tr>
	   				<td id="kekurangan">Kekurangan</td>
	   				<td colspan="3"><div id="return" class="alg-right">0,00</div></td>
	   				
	   			</tr>
	   		</table>

		</div>


		<div class="modal-footer">
			<button class="btn btn-info" id="btn-s-c">Simpan + Cetak</button>
			<button class="btn btn-info">Simpan</button>
			<button class="btn btn-info">Batal</button>
		</div>


    </div>
  </div>
</div>







<script type="text/javascript">
$('.jsPrice').number(true);		   

	var lookData = function(param){

		if ($("#btn-next").length == 0) {
				$("tfoot").html('<td colspan="6"><button id="btn-pre" class="btn btn-info btn-sm"> Previous </button> <input type="hidden" id="start" value="1"> <button id="btn-next" class="btn btn-info btn-sm"> Next </button></td><td colspan="2" id="total"></td>');

		}

		function fetchData(){

			var search_value = $(".searchData").val();
			var tampilkan = $("#tampilkan").val();
			var startP = $("#start").val();
			var store_id = $("#store_id").val();

			if (startP == "" || startP == 0) {
				start = 0;
			}
			else{
				start = (startP * tampilkan) - tampilkan
			}


		$.ajax({
			url:"<?php echo base_url() ?>"+"sales/billing/get_list_piutang",
			method : "POST",
			data : {search:search_value , length : tampilkan , start : start, store_id : store_id},
			success:function(resultJson){
				var result = JSON.parse(resultJson);
				var jsonData = result.data;
				var totalData = result.total;
				var num = jsonData.length;
				
				
				var container = $("#look tbody");
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
				$("#total").html("<i>Total data "+totalData+" rows </i>");
				if (totalData > tampilkan) {

					$("#start").removeAttr("disabled");
					$("#start").val(startP);
				}
				else{
					$("#start").val(1);	
					$("#start").attr("disabled","");
				}

				if (num < tampilkan) {
					$("#btn-next").attr("disabled","");
				}
				else{
					$("#btn-next").removeAttr("disabled");	
				}


			}
		})
	}


	$(document).on("input", ".searchData", function(){
		$("#start").val(1);
		fetchData();
	})
	$(document).on("input", "#tampilkan", function(){
		 $("#start").val(1); 
		fetchData();
	})
	$(document).on("change", "#start", function(){
		fetchData();
	})
	$(document).on("change", "#store_id", function(){
		fetchData();
	})

	$(document).on("click", "#btn-next", function(){
		var cur = $("#start").val();
		$("#start").val(parseInt(cur) + 1);
		fetchData();
	})
	$(document).on("click", "#btn-pre", function(){
		var cur = $("#start").val();
		if (cur >= 1) {
			$("#start").val(parseInt(cur) - 1);
			fetchData();
		}
		else{
			$("#start").val(1);
		}
	})

	$(document).on("click",".btn-view-piutang", function(){
		var index = $(".btn-view-piutang").index(this);
		
		$("#modal4").modal("show");
		$("#p-total").html($.number($(".sisa").eq(index).val()));
		$("input[name=grand_total]").val($(".sisa").eq(index).val());
		$("input[name=piutang_id]").val($(".piutang_id").eq(index).val());
		
	})



	fetchData();

	$(document).on("click", "#btn-refresh", function(){
		$("#start").val(1);
		fetchData();		
	})





	function hitung_bayar(){
	var total = $("input[name=grand_total]").val();
	var total_cash = $("input[name=total_cash]").val() ? $("input[name=total_cash]").val() : 0;
	var credit_0 = $("input[name=credit_0]").val() ? $("input[name=credit_0]").val() : 0;
	var credit_1 = $("input[name=credit_1]").val() ? $("input[name=credit_1]").val() : 0;
	var credit_2 = $("input[name=credit_2]").val() ? $("input[name=credit_2]").val() : 0;

	var tobay = parseInt(total_cash) + parseInt(credit_1) + parseInt(credit_2) + parseInt(credit_0);
	$("input[name=tobay]").val(tobay);
	$("#tobay").html($.number(tobay));

	if (tobay < total ) {

		var result = total - tobay;

		$("input[name=less_pay]").val(result);
		$("input[name=total_return]").val(0);
		$("#kekurangan").html("Kekurangan");
		$("#return").html($.number(result));
	}
	else{
		var result = tobay - total;

		$("input[name=less_pay]").val(0);
		$("input[name=total_return]").val(result);		
		$("#kekurangan").html("Kembalian");
		$("#return").html($.number(result));
	}

	return tobay;
	}

	$(document).on("input", "input[name=total_cash]", function(){
		var tobay = hitung_bayar();
	})
	$(document).on("input", "input[name=credit_0]", function(){
		var tobay = hitung_bayar();
	})

	$(document).on("input", "input[name=credit_1]", function(){
		var tobay = hitung_bayar();
		
	})

	$(document).on("input", "input[name=credit_2]", function(){
		var tobay = hitung_bayar();
	})




	$(document).on("click", "#btn-s-c", function(){


	var total 			= $("input[name=grand_total]").val();
	var total_cash 		= $("input[name=total_cash]").val();


	var total_transfer 	= $("input[name=credit_0]").val();
	var total_credit 	= $("input[name=credit_1]").val();
	var total_debit 	= $("input[name=credit_2]").val();

	var transfer_bank_id 	= $("select[name=bank_0]").val();
	var credit_bank_id 		= $("select[name=bank_1]").val();
	var debit_bank_id 		= $("select[name=bank_2]").val();

	var transfer_trx = $("input[name=trx_0]").val();
	var credit_trx = $("input[name=trx_1]").val();
	var debit_trx = $("input[name=trx_2]").val();

	var piutang_id = $("input[name=piutang_id]").val();
	var tobay = hitung_bayar();


		if (tobay == 0) {
			swal("Alert","Pembayaran tidak boleh kosong","warning");
			return false;
		}
		if (tobay < total) {
			swal("Alert","Pembayaran tidak boleh kurang dari sisa yang harus dibayar","warning");
			return false;
		}
	$.ajax({
		url:'<?php echo base_url() ?>' + 'sales/billing/piutang_pay/',
		data:{
			piutang_id : piutang_id,
			total_paid : tobay,
			total_cash : total_cash,
			total_transfer : total_transfer, 
			total_credit : total_credit, 
			total_debit : total_debit,
			transfer_trx : transfer_trx,
			credit_trx : credit_trx,
			debit_trx : debit_trx,
			transfer_bank_id : transfer_bank_id,
			credit_bank_id : credit_bank_id,
			debit_bank_id : debit_bank_id
			
			},
		method: "POST",
		success:function(result){
			var jsonData = JSON.parse(result);

				if (jsonData.status == "success") {
					$("#modal4").modal("hide");
					fetchData();
				}
				else{
					swal("Gagal menyimpan", "warning");
				}
		}
	})
})

}


	$(window).on("load", function(){
		var data = lookData();
	})





</script>