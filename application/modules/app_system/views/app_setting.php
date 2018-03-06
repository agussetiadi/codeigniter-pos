
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
    	<div class="row">
	      <div class="col-md-8"><h2 class="no-margin-bottom">Role Setting</h2></div>
	       <div class="col-md-4">

          </div>
      	</div>
    </div>
  </header>
<!-- Dashboard Counts Section-->



 <section class="dashboard-header">
  
  <div class="container-fluid">
    <div class="row">
      

      <div class="col-lg-4 col-12">
        <div style="padding: 20px" class="bg-white align-items-center justify-content-center has-shadow">
          <div class="form-group">
            <label>Pilih Jabatan</label>
            <select class="form-control" id="jabatan_id">
            <?php foreach ($query_jabatan->result_array() as $key => $value) {  ?>
              <option value="<?php echo $value['jabatan_id'] ?>"><?php echo $value['jabatan_name'] ?></option>
            <?php } ?>
            </select>
          </div>
        
        </div>
      </div>

      <div class="col-lg-8 col-12">
      
        <div style="padding: 20px" class="bg-white align-items-center justify-content-center has-shadow">

          <div class="form-group">
            <label>Filter Module</label>
            <select class="form-control" id="module_name">
            <option value="all">Tampilkan Semua</option>
            <?php foreach ($query_module->result_array() as $key => $value) {  ?>
              <option value="<?php echo $value['module_name'] ?>"><?php echo $value['module_name'] ?></option>
            <?php } ?>
            </select>
          </div>


          <hr>

          <label>Hak Akses</label>
          <table class="table">
            <thead>
              <th>ID</th>
              <th>Access Role</th>
              <th><span class="float-right">Active</span></th>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
            <tfoot></tfoot>
            
          </table>
        


        </div>
      </div>






    </div>
  </div>
</section>


<script type="text/javascript">

function render(jabatan_id,module_name,callback){

  var jabatan_id = jabatan_id;
  var module_name = module_name;
  $.ajax({
    url : '<?php echo base_url() ?>' + 'app_system/setting/render_api' ,
    method : 'POST',
    data : {module_name:module_name, jabatan_id : jabatan_id},
    success:function(result){
      var jsonData = JSON.parse(result);

      var jID = jsonData.module_id;
      var jNM = jsonData.module_name;
      var jST = jsonData.is_active;

      var append = "";
      for (var i = 0; i < jID.length; i++) {
        append += '<tr><td class="jId">'+jID[i]+'</td><td>'+jNM[i]+'</td><td><input class="c-role" value="'+jID[i]+'" type="checkbox" '+jST[i]+'></td></tr>'
      }

      $("tbody").html(append);
      $("tfoot").html('<tr><td colspan="3"><button class="btn btn-md btn-primary" id="btn-simpan">Simpan</button> <button class="btn btn-md btn-danger" id="btn-reset">Reset</button> <button class="btn btn-md btn-success" id="btn-checkall">Check All</button></td></tr>')

      if (callback) {
        callback(result);
      }


    }
  })

}

$(document).on("change", "#jabatan_id", function(){

  var jabatan_id = $(this).val();
  var module_name = $("#module_name").val();

  render(jabatan_id,module_name);

})


$(document).on("change", "#module_name", function(){

  var jabatan_id = $("#jabatan_id").val();
  var module_name = $("#module_name").val();

  render(jabatan_id,module_name);

})

$(document).on("click","#btn-simpan", function(){
  var module_id = $(".jID");
  var is_active = $(".c-role");


  var data_id = [];

  for (var i = 0; i < is_active.length; i++) {

      if (is_active.eq(i).prop("checked") == true) {
        data_id.push(is_active.eq(i).val());
      }

  }

  var jabatan_id = $("#jabatan_id").val();
  var module_name = $("#module_name").val();

  $.ajax({
    url : '<?php echo base_url() ?>' + 'app_system/setting/access_update',
    method : 'POST',
    data : {jabatan_id : jabatan_id, module_id : data_id, module_name : module_name},
    success : function(result){
      var resultJson = JSON.parse(result);
      if (resultJson.status == 'success') {

        $(".wrap-alert").html('<div class="alert alert-info">Berhasil mengupdate</div>');
          setTimeout(function(){
            $(".wrap-alert div").fadeOut("slow", function(){
              $(".wrap-alert div").remove();
              location.reload()
            });

          },2000)
      }
    }
  })


})

$(document).on("click", "#btn-checkall", function(){
  $(".c-role").attr("checked","");
})

$(document).on("click", "#btn-reset", function(){
  $(".c-role").removeAttr("checked");
})




</script>