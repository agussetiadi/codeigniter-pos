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
					<th>Nama Supplier</th>
					<th>Contact</th>
					<th>Alamat</th>
					<th>Phone</th>
					<th>Fax</th>
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
    <form action="<?php echo base_url()."master/supplier/add_supplier" ?>" method="POST" class="ajax_form">

    	<div class="modal-header">
	    	<h4 class="text-center">Tambah Jenis Pembayaran</h4>
	    </div>
	    <div class="modal-body">
	    	<div class="form-group">
				<label>Nama Supplier</label>
				<input type="text" class="form-control" name="supplier_name" placeholder="">
			</div>
			<div class="form-group">
				<label>Contact Supplier</label>
				<input type="text" class="form-control" name="supplier_contact" placeholder="">
			</div>
			<div class="form-group">
				<label>Alamat Supplier</label>
				<textarea class="form-control" name="supplier_address" placeholder=""></textarea>
			</div>
			<div class="form-group">
				<label>Telp.</label>
				<input type="text" class="form-control" name="supplier_phone" placeholder="">
			</div>
			<div class="form-group">
				<label>Fax.</label>
				<input type="text" class="form-control" name="supplier_fax" placeholder="">
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

    

	<form action="<?php echo base_url()."master/supplier/update_supplier/" ?>" method="POST" class="ajax_form">
    	<div class="modal-header">
	    	<h4 class="text-center">Edit Jenis Pembayaran</h4>
	    </div>
	    <div class="modal-body">


			    	<div class="form-group">
						<label>Nama Supplier</label>
						<input type="text" class="form-control" name="supplier_name" placeholder="">
						<input type="hidden" class="form-control" name="supplier_id" placeholder="">
					</div>
					<div class="form-group">
						<label>Contact Supplier</label>
						<input type="text" class="form-control" name="supplier_contact" placeholder="">
					</div>
					<div class="form-group">
						<label>Alamat Supplier</label>
						<textarea class="form-control" name="supplier_address" placeholder=""></textarea>
					</div>
					<div class="form-group">
						<label>Telp.</label>
						<input type="text" class="form-control" name="supplier_phone" placeholder="">
					</div>
					<div class="form-group">
						<label>Fax.</label>
						<input type="text" class="form-control" name="supplier_fax" placeholder="">
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
                url :"<?php echo base_url() ?>"+"master/supplier/view_all", // json datasource
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
				swal(jsonData.required+" Harus terisi","warning");
			}
		}
	})
})

$(document).on("click", ".btn-edit", function(){
	var index = $(".btn-edit").index(this);

	$("input[name=supplier_id]").val($(".supplier_id").eq(index).val())
	$("input[name=supplier_name]").val($(".supplier_name").eq(index).val())
	$("input[name=supplier_contact]").val($(".supplier_contact").eq(index).val())
	$("textarea[name=supplier_address]").val($(".supplier_address").eq(index).val())
	$("input[name=supplier_phone]").val($(".supplier_phone").eq(index).val())
	$("input[name=supplier_fax]").val($(".supplier_fax").eq(index).val())

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