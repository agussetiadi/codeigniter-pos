<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/js/dataTables.bootstrap.js"></script>


<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
    	<div class="row">
	      <div class="col-md-6"><h2 class="no-margin-bottom">Rekap Stok Harian</h2></div>
	      <div class="col-md-6">
	      	<div class="">

	      	</div>
	      </div>
      	</div>
    </div>
  </header>
<!-- Dashboard Counts Section-->


<div class="container-fluid top-bottom">
	<div class="row">
		<div class="col-md-12">
			<div class="block-space">
				<div class="row" style="margin-bottom: 50px">
					<div class="col-md-3">
						<input class="form-control searchData" name="" placeholder="Cari berdasar kata kunci" list="item">
						<datalist id="item">
							<?php foreach ($get_item->result_array() as $key_i => $value_i) {
							?>
							<option><?php echo $value_i['item_name'] ?></option>
							<?php } ?>
						</datalist>
					</div>
					<div class="col-md-3">
						<select style="margin: 0; height: 40px; width: 70px;" id="tampilkan">
							<option>7</option>
							<option>15</option>
							<option>25</option>
							<option>50</option>
							<option>100</option>
						</select>
					</div>
					<div class="col-md-6">
					
						
		      			<input type="text" class="in-search float-right datepicker" placeholder="Tanggal" name="date" >
			      		<select class="in-search float-right" name="store">
			      			<?php foreach ($get_store->result_array() as $key => $value) {
			      			?>
			      			<option value="<?php echo $value['store_id'] ?>" <?php if($sesi == $value['store_id']){ echo "selected"; } ?>><?php echo $value['store_name'] ?></option>
			      			<?php } ?>
			      		</select>
					</div>

				</div>
		  	<table id="look" class="table table-hover">
				<thead>
					<th>Item</th>
					<th>Store</th>
					<th>Tanggal</th>
					<th>Masuk</th>
					<th>Keluar</th>
					<th>Stok</th>
					<th>Satuan</th>
				</thead>
				<tbody>
				
				</tbody>
				<tfoot></tfoot>
			</table>

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
		if ($("#btn-next").length == 0) {
			$("tfoot").html('<td colspan="6"><button id="btn-pre" class="btn btn-info btn-sm"> Previous </button> <input style="width:30px" type="text" id="start" value="1"> <button id="btn-next" class="btn btn-info btn-sm"> Next </button></td><td colspan="2" id="total"></td>');
		}

		function fetchData(){
			var where1 = $("input[name=date]").val();
			var where2 = $("select[name=store]").val();
			var search_value = $(".searchData").val();
			var tampilkan = $("#tampilkan").val();
			var startP = $("#start").val();

			if (startP == "" || startP == 0) {
				start = 0;
			}
			else{
				start = (startP * tampilkan) - tampilkan
			}


		$.ajax({
			url:"<?php echo base_url() ?>"+"inventory/stock_card/get_stock",
			method : "POST",
			data : {search:search_value , length : tampilkan , start : start , trx_date : where1 , store_id : where2},
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

	$(document).on("dblclick",".table-list-pending tbody tr", function(){
		var index = $(".table-list-pending tbody tr").index(this);
		var ref_id = $(".ref_id").eq(index).attr("href");
		document.location = ref_id;
	})



	fetchData();

	$(document).on("change", "input[name=date]", function(){
		$("#start").val(1);
		fetchData();		
	})
	$(document).on("change", "select[name=store]", function(){
		$("#start").val(1);
		fetchData();		
	})
	$(document).on("click", "#look tbody tr", function(){
		var index = $("#look tbody tr").index(this);
		var init = $(".init").eq(index).attr("href");
		document.location = init;
	})


</script>