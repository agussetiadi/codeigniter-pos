
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
    	<div class="row">
	      <div class="col-md-6"><h2 class="no-margin-bottom">Item Keluar</h2></div>
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

           <table width="100%">
          <tr>
            <td width="12%">No Transaksi</td>
            <td width="20%">
            <input type="text" class="main-text" id="no_trx" placeholder="Isikan/otomatis terisi">
            <input type="hidden" class="" id="ref_id">
            </td>
            <td rowspan="3" width="1%"></td>
            <td rowspan="3" style="border: 0px solid rgb(218, 218, 218);">
              
            </td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td><input type="text" class="main-text" name="" disabled="" value="<?php echo date("Y/m/d"); ?>" placeholder="Tanggal"></td>
            
          </tr>
          <tr>
            <td>Store</td>
            <td>
              <select class="main-text" name="store" style="margin: 0" disabled="">
                  <?php foreach ($get_store->result_array() as $key => $value) {
                  ?>
                  <option value="<?php echo $value['store_id'] ?>" <?php if($sesi == $value['store_id']){ echo "selected"; } ?>><?php echo $value['store_name'] ?></option>
                  <?php } ?>
                </select>
            </td>
          </tr>
          <tr>
            <td>Status</td>
            <td>
                
                <select class="main-text" disabled="" name="trx_type">
                  <option value="in" <?php if($init == "in"){echo "selected"; } ?>>Stock Masuk</option>
                  <option value="out" <?php if($init == "out"){echo "selected"; } ?>>Stock Keluar</option>
                </select>

            </td>
            
          </tr>
          
        </table>
        <hr>
        <button data-toggle="modal" data-target="#modal1" class="btn btn-info btn-sm" id="btn-add-item">Tambah Item</button>
        <table id="table-detail" class="table-main" border="1.5" bordercolor="#bfbfbf" style="margin-top: 20px;">
          <thead>
            <th>No.</th>
            <th>Nama Item</th>
            <th>Nominal</th>
            <th>HPP</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th></th>
          </thead>
          <tbody>

          </tbody>
        </table>
        <hr>
        <div style="float: right; height: 50px;">
        
        <button class="btn btn-info btn-sm" id="btn-simpan2">Cetak</button>
        <button class="btn btn-info btn-sm" id="btn-simpan">Simpan</button>
        <button class="btn btn-info btn-sm" onclick="window.history.back()">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="modal1" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="text-center">Daftar Produk</h4>
      </div>
      <div class="modal-body">
        
    <input type="text" name="" id="searchData" placeholder="Search by name">
    <table id="look" class="table" width="100%" style="">
      <thead>
        <th>No.</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Stok</th>
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
      <div class="modal-header">
        <h4 class="text-center">Jumlah Produk</h4>
      </div>
      <div class="modal-body">
        <table style="width: 100%" border="0">
          <tr>
            <td>Jumlah</td>
            <input type="hidden" name="billing_id" value="">
            <input type="hidden" name="item_id">
            <td><input type="number" name="trx_qty" class="form-control" value="1"></td>
          </tr>
        </table>

    </div>


    <div class="modal-footer">
      <button class="btn btn-danger btn-sm" name="btn-submit">Simpan</button>
    </div>

    </div>
  </div>
</div>







<script type="text/javascript">
  function get_detail(tableName , data , path){

      $.ajax({
      url:path,
      method : "POST",
      data : data,
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
      }
    })
  }

  if ($("#ref_id").val() != "") {

    var table = $("#table-detail");
    var no_trx = $("#ref_id").val();
    var data = {
      no_trx : no_trx
    }
    var path = "<?php echo base_url() ?>"+"inventory/stock_flow/get_detail";
    get_detail(table,no_trx, path);
  }


  $(document).on("input", "#searchData", function(){
    var table = "#look";
    var value = $(this).val();
    var store_id = $("select[name=store]").val();
    var data = {
      search : value,
      store_id : store_id
    };


    var path = "<?php echo base_url() ?>"+"inventory/stock_flow/get_item";
    get_detail(table,data,path);


  })


  $(document).on("click", ".act-pilih", function(){
    var index = $(".act-pilih").index(this);
    $("input[name=item_id]").val($(".item_id").eq(index).val());

  })






  $(window).on("load", function(){
    var table = "#look";
    var value = "";
    var store_id = $("select[name=store]").val();
    var data = {
      search : value,
      store_id : store_id
    };


    var path = "<?php echo base_url() ?>"+"inventory/stock_flow/get_item";
    get_detail(table,data,path);
  })

  $(document).on("click", "button[name=btn-submit]", function(){
    var item_id = $("input[name=item_id]").val();
    var trx_qty = $("input[name=trx_qty]").val();
    var store_id = $("select[name=store]").val();
    var trx_type = $("select[name=trx_type]").val();
    var ref_id = $("#ref_id").val();
    var ref_data = $("#no_trx").val();
    $.ajax({
      url:'<?php echo base_url() ?>'+'inventory/stock_flow/add_stock_detail/',
      method : "POST",
      data : {item_id : item_id,
              trx_qty : trx_qty,
              ref_id : ref_id,
              trx_type : trx_type,
              store_id : store_id,
              ref_data : ref_data},
      success:function(result){
        var resultJson = JSON.parse(result);


            if (resultJson.status == "success") {
              $("#ref_id").val(resultJson.ref_id);
              $("#no_trx").val(resultJson.ref_data);
              var data = {
                ref_id : resultJson.ref_id
              }
              var path = '<?php echo base_url() ?>' + 'inventory/stock_flow/get_detail';
              get_detail("#table-detail" , data , path);

              $("#modal1").modal("hide");
              $("#modal2").modal("hide");
            }


      }
    })
  })

  $(document).on("click", "#btn-simpan", function(){
    var ref_id = $("#ref_id").val();

    var store_id = $("select[name=store]").val();
    var trx_type = $("select[name=trx_type]").val();
    var no_trx = $("#no_trx").val();

    $.ajax({
      url : '<?php echo base_url() ?>'+'inventory/stock_flow/save_trx',
      method : "POST",
      data : {ref_id : ref_id , store_id : store_id  , trx_type : trx_type , ref_data : no_trx},
      success : function(){
        window.history.back();
      }
    })



  })
  $(document).on("click", ".b-delete", function(){
    var index = $(".b-delete").index(this);
    var stock_id = $(".stock_id").eq(index).val();
    var ref_id = $("#ref_id").val();

    $.ajax({
      url : '<?php echo base_url() ?>'+'inventory/stock_flow/stock_delete',
      method : "POST",
      data : {stock_id : stock_id , ref_id : ref_id},
      success:function(result){
        var jsonData = JSON.parse(result);
        if (jsonData.status == "success") {

            var data = {
                ref_id : ref_id
              }
              var path = '<?php echo base_url() ?>' + 'inventory/stock_flow/get_detail';
              get_detail("#table-detail" , data , path);

        }
      }
    })


  })













/*  $(document).on("click", "#btn-add-item", function(){
    var table = "#look";
    var value = "";
    var store_id = $("select[name=store]").val();
    var data = {
      search : value,
      store_id : store_id
    };


    var path = "<?php echo base_url() ?>"+"inventory/stock_flow/get_item";
    get_detail(table,data,path);
  })

*/


</script>