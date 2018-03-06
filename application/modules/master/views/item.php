<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/js/dataTables.bootstrap.js"></script>


<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
    	<div class="row">
	      <div class="col-md-6"><h2 class="no-margin-bottom">Dashboard</h2></div>
	      <div class="col-md-6">
	      	<button data-target="#modal1" data-toggle="modal" class="btn btn-info float-right btn-modal">Tambah</button>
	      </div>
      	</div>
    </div>
  </header>
<!-- Dashboard Counts Section-->


<div class="container-fluid top-bottom">
	<div class="row">
		<div class="col-md-12">
			<div class="block-space">
					
		  	<table id="lookup" class="table">
				<thead>
					<th>No.</th>
					<th>Nama Produk</th>
					<th>Satuan</th>
					<th>Kategori Item</th>
					<th>Keterangan</th>
					<th>Harga Produk</th>
					<th>HPP Produk</th>
					<th></th>
				</thead>
				<tbody>
				
				</tbody>
			</table>


			</div>
		</div>
	</div>
</div>



<div id="modal1" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

    <form action="<?php echo base_url()."master/item/add_item" ?>" method="POST" class="ajax_form">

    	<div class="modal-header">
	    	<h4 class="text-center">Tambah Data Produk</h4>
	    </div>
	    <div class="modal-body">
	    	<div class="form-group">
				<label>Nama Produk</label>
				<input type="text" class="form-control" name="item_name" >
			</div>

			<div class="form-group">
				<label>Kategori Produk</label>
					<div class="selector">
				      <select class="form-control" name="category_id">
				      	<?php 
				      	foreach ($query2->result_array() as $key2 => $value2) {
				      	?>
				      	<option value="<?php echo $value2['category_id'] ?>"><?php echo $value2['category_name'] ?></option>
				      	<?php } ?>
				      </select>
				     </div>

			</div>


			<div class="form-group">
				<label>Satuan</label>
					<div class="selector">
				      <select class="form-control" name="unit_id">
				      	<?php 
				      	foreach ($query->result_array() as $key => $value) {
				      	?>
				      	<option value="<?php echo $value['unit_id'] ?>"><?php echo $value['unit_name'] ?></option>
				      	<?php } ?>
				      </select>
				     </div>

			</div>
			<div class="form-group">
				<label>Kode Item</label>
				<input type="text" class="form-control" name="item_code">
			</div>
			<div class="form-group">
				<label>Keterangan</label>
				<textarea class="form-control" name="item_desc"></textarea>

			</div>
			<div class="form-group">
			<label>Harga Jual</label>
			<input type="number" class="form-control" name="item_price"  >
			</div>
			<div class="form-group">
				<label>Harga HPP</label>
				<input type="number" class="form-control" name="item_hpp"  >
			</div>
		</div>


		<div class="modal-footer">
			<button class="btn btn-primary btn-ajax-process">Simpan</button>
		</div>

		</form>
    </div>
  </div>
</div>


<div id="modal2" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

    <form action="<?php echo base_url()."master/item/update_item/" ?>" method="POST" class="ajax_form">

    	<div class="modal-header">
	    	<h4 class="text-center">Edit Data Produk</h4>
	    </div>
	    <div class="modal-body">
	    	<div class="form-group">
				<label>Nama Produk</label>
				<input type="text" class="form-control" name="item_name" >
				<input type="hidden" class="form-control" name="item_id" >
			</div>

			<div class="form-group">
				<label>Kategori Produk</label>
					<div class="selector">
				      <select class="form-control" name="category_id">
				      	<?php 
				      	foreach ($query2->result_array() as $key2 => $value2) {
				      	?>
				      	<option value="<?php echo $value2['category_id'] ?>"><?php echo $value2['category_name'] ?></option>
				      	<?php } ?>
				      </select>
				     </div>

			</div>

			<div class="form-group">
				<label>Satuan</label>
					<div class="selector">
				      <select class="form-control" name="unit_id">
				      	<?php 
				      	foreach ($query->result_array() as $key => $value) {
				      	?>
				      	<option value="<?php echo $value['unit_id'] ?>"><?php echo $value['unit_name'] ?></option>
				      	<?php } ?>
				      </select>
				     </div>

			</div>
			<div class="form-group">
				<label>Kode Item</label>
				<input type="text" class="form-control" name="item_code">
			</div>
			<div class="form-group">
				<label>Keterangan</label>
				<textarea class="form-control" name="item_desc"></textarea>

			</div>
			<div class="form-group">
			<label>Harga Jual</label>
			<input type="number" class="form-control" name="item_price"  >
			</div>
			<div class="form-group">
				<label>Harga HPP</label>
				<input type="number" class="form-control" name="item_hpp"  >
			</div>
		</div>


		<div class="modal-footer">
			<button class="btn btn-primary btn-ajax-process">Simpan</button>
		</div>

		</form>
    </div>
  </div>
</div>


<script>
        var dataTable = $('#lookup').DataTable( {
            "processing": true,
            "serverSide": true,
            "searching": true,
            "ajax":{
                url :"<?php echo base_url() ?>"+"master/item/view_all", // json datasource
                type: "POST",  // method  , by default get
                error: function(){  // error handling
                    $(".lookup-error").html("");
                    $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#lookup_processing").css("display","none");
                    
                }
            }
        } );
         
	
	$(document).on("submit", ".ajax_form", function(e){

	e.preventDefault();
	$(".btn-ajax-process").html("Processing ...");
	$(".btn-ajax-process").attr("disabled","");
	var path = $(this).attr("action");
	var get_method = $(this).attr("method");

	$.ajax({
		url : path,
		method : get_method,
		data : new FormData(this),
		contentType : false,
		processData : false,
		success:function(data){
			$(".btn-ajax-process").html("Simpan");
			$(".btn-ajax-process").removeAttr("disabled");
			jsonData = JSON.parse(data);
			if (jsonData.action) {
				$("input").val("");
				$("textarea").val("");
				$('#modal1').modal('hide');
				$('#modal2').modal('hide');
				dataTable.ajax.reload();		
			}
			else if (jsonData.msg) {
				alert(jsonData.required+" Harus terisi");
			}
		}
	})
})

$(document).on("click", ".btn-edit", function(){
	var index = $(".btn-edit").index(this);
	$("select[name=unit_id] option").removeAttr("selected");

	$("input[name=item_id]").val($(".item_id").eq(index).val())
	$("input[name=item_name]").val($(".item_name").eq(index).val())
	$("select[name=unit_id] option[value="+ $(".unit_id").eq(index).val() +"]").attr("selected","");
	$("select[name=category_id] option[value="+ $(".category_id").eq(index).val() +"]").attr("selected","");
	$("input[name=item_code]").val($(".item_code").eq(index).val())
	$("textarea[name=item_desc]").val($(".item_desc").eq(index).val())
	$("input[name=item_price]").val($(".item_price").eq(index).val())
	$("input[name=item_hpp]").val($(".item_hpp").eq(index).val())
})


$(document).on("click", ".btn-delete", function(e){
	var index = $(".btn-delete").index(this);
		var path = $(".btn-delete").eq(index).attr("href");
        e.preventDefault();
        swal({
        title: "Yakin Ingin Menghapus?",
        text: "Data Akan Terhapus Dari Aplikasi",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus",
        closeOnConfirm: true
      },
        function(isConfirm){
          if (isConfirm) {
                

                /*Ajax function OPEN*/
                $.ajax({
                    url:path,
                    success:function(data){
                    	dataTable.ajax.reload();
                    }

                })
                /*Ajax function CLOSE*/

          } else {
            swal("Batal", "Batalkan menghapus)", "error");
          }
        });


})
</script>