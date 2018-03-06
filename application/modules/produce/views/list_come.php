
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
    	<div class="row">
	      <div class="col-md-6"><h2 class="no-margin-bottom">SPK Masuk</h2></div>
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
			<div id="alert-ajax" style="width: 100%">
				
			</div>
			<table style="width: 100%;">
				<tr>
					<td width="12%">Kata Kunci</td>
					<td colspan="5">
						<input type="text" class="form-control searchData" name="" placeholder="Cari berdasarkan nama">
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
					<td><input type="checkbox" name="chk" <?php if($this->role_module->get(35) == true){ echo 'checked=""'; }else{ echo "disabled"; } ?>> Hanya tampil belum diproses</td>
				</tr>
			</table>
			<table class="table table-list-pending" style="margin-top: 20px; overflow: scroll;" id="look">
				<thead>
					<th>Nama Customer</th>
					<th>Tgl Input</th>
					<th>Keterangan</th>
					<th>Komputer</th>
					<th>Input Oleh</th>
					<th>Aksi</th>
				</thead>
				<tbody></tbody>
				<tfoot></tfoot>
			</table>
			</div>
		</div>
	</div>
</div>

<div id="modal1" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
	    <div class="modal-body">
	    	
		    	
		    <input type="hidden" class="form-control" id="no_trx">
	    	
	    	<div class="form-group">
	   		<label>Pilih Target</label>
		   		<select class="main-select" id="target">
		   			<?php foreach($jabatan->result_array() as $key => $value){ ?>
		   			<option value="<?php echo $value['jabatan_id'] ?>"><?php echo $value['jabatan_name'] ?></option>
		   			<?php } ?>
		   		</select>
	   		</div>
		</div>


		<div class="modal-footer">
			<button class="btn btn-info" id="btn-sent">Kirim SPK</button>
		</div>


    </div>
  </div>
</div>



<script type="text/javascript">


		if ($("#btn-next").length == 0) {
				$("tfoot").html('<td colspan="4"><button id="btn-pre" class="btn btn-info btn-sm"> Previous </button> <input type="text" style="width : 40px" id="start" value="1"> <button id="btn-next" class="btn btn-info btn-sm"> Next </button></td><td colspan="2" id="total"></td>');

		}

		function fetchData(){

			var search_value = $(".searchData").val();
			var tampilkan = $("#tampilkan").val();
			var startP = $("#start").val();
			var store_id = $("#store_id").val();
			var chk = $("input[name=chk]").prop("checked");

			if (startP == "" || startP == 0) {
				start = 0;
			}
			else{
				start = (startP * tampilkan) - tampilkan
			}


		$.ajax({
			url:"<?php echo base_url() ?>"+"produce/spk/list_come_server",
			method : "POST",
			data : {search:search_value , length : tampilkan , start : start, store_id : store_id , chk : chk},
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
	$(document).on("change", "input[name=chk]", function(){
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

	$(document).on("click",".btn-pilih", function(){
		var index = $(".btn-pilih").index(this);
		var ref_id = $(".ref_id").eq(index).attr("href");
		document.location = ref_id;
	})

	$(document).on("click", ".btn-process-spk", function(){
		var index = $(".btn-process-spk").index(this);
		var spk_id = $(".spk_id").eq(index).val();

		$.ajax({
			url:'<?php echo base_url() ?>'+'produce/spk/status_update',
			method:'POST',
			data:{spk_id : spk_id},
			success:function(result){
				var resultJson = JSON.parse(result);
				if (resultJson.status == 'success') {
					fetchData();
					$(".wrap-alert").html('<div class="alert alert-success">Berhasil</div>');
					setTimeout(function(){
						$(".wrap-alert div").fadeOut("slow", function(){
							$(".wrap-alert div").remove();
						});

					},2000)
				}
			}
		})

	})

	$(document).on("click", ".btn-view-spk", function(){
		var index = $(".btn-view-spk").index(this);

		var spk_id = $(".spk_id").eq(index).val();
		document.location = '<?php echo base_url() ?>' + 'produce/spk/get_detail/' + spk_id;

	})


	fetchData();

	$(document).on("click", "#btn-refresh", function(){
		$("#start").val(1);
		fetchData();		
	})


</script>