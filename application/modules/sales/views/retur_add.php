<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
    	<div class="row">
	      <div class="col-md-6"><h2 class="no-margin-bottom">Retur Penjulan</h2></div>
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
            <td width="20%"><input type="text" class="main-text" id="no_trx" placeholder="Isikan nomor TRX"></td>
            <td rowspan="3" width="1%"></td>
            <td rowspan="3">
            
            </td>
          </tr>
          
          <tr>
            <td>Pelanggan</td>
            <td><input id="customer_name" type="text" class="main-text required" name="customer_name" placeholder="Nama Pelanggan"></td>
            
          </tr>
          <tr>
            <td>Phone</td>
            <td><input id="phone" type="text" class="main-text" name="phone" placeholder="No HP"></td>
            
          </tr>
        </table>
      <hr>
        <button data-toggle="modal" data-target="#modal1" class="btn btn-info btn-sm">Daftar Item</button>
        <table id="table-order" class="table-main" border="1.5" bordercolor="#bfbfbf" style="margin-top: 20px;">
          <thead>
            <th>No.</th>
            <th>Nama Item</th>
            <th>Printer</th>
            
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Satuan</th>
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
                <td width="20%">Operator </td>
                <td width="50%"><input type="text" class="main-text" id="created_by" name="operator" disabled=""></td>
                <td></td>
              </tr>
              
              <tr>
                <td>Keterangan </td>
                <td><textarea class="main-text" id="info"></textarea></td>
                <td></td>
              </tr>
            </table>
            
          </div>

          <div class="col-md-6">
          
            <table width="100%">
             <tr>
                <td></td>
                <td>Total Akhir</td>
                <td><input type="text" class="jsPrice main-text" name="total" id="total">
                </td>
              </tr>
              <tr>
                <td></td>
                <td width="20%">Sub Total</td>
                <td width="50%">
                <input type="text" class="main-text" id="subtotal" disabled="" name="subtotal"></td>
              </tr>
              <tr>
                <td></td>
                <td>Tunai</td>
                <td><input id="tunai" type="text" class="jsPrice main-text" name="tunai">
                </td>
              </tr>
              
            </table>
            
          </div>
        </div>
        <hr>
        <div style="float: right; height: 50px;">
        <button class="btn btn-info btn-sm" id="btn-save">Simpan</button>
        <a href="<?php echo base_url()."sales/billing/print_retur/".$retur_id ?>">
          <button class="btn btn-info btn-sm" id="btn-cetak" <?php if($retur_id == ""){ echo "disabled"; } ?>>Cetak</button>
        </a>
        <button class="btn btn-info btn-sm">Cancel</button>
        
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
      <table style="margin-bottom: 20px; width: 100%;">
        <tr>
          <td width="20%"><b>Cari Produk</b></td>
          <td width="60%">
            <input type="text" name="" class="searchData form-control" placeholder="Cari berdasrkan nama">
          </td>
          <td width="10%" style="text-align: right;"><b style="margin-right: 10px;">Rows</b></td>
          <td width="10%">
            <select class="form-control" style="margin: 0;" id="limit">
              <option>7</option>
              <option>15</option>
              <option>25</option>
              <option>50</option>
              <option>100</option>
            </select>
          </td>
        </tr>
      </table>
    <table id="table-item" class="table" width="100%" style="">
      <thead>
        <th>No.</th>
        <th>Nama</th>
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
      <form id="retur_ajax" method="POST">
      <div class="modal-header">
        <h4 class="text-center">Produk</h4>
      </div>
      <div class="modal-body">
        <table style="width: 100%" border="0">
          <tr>
            <td>Jumlah</td>
            <td>
            <input type="hidden" name="item_id">
            <input type="hidden" name="retur_id">
            <input type="number" name="retur_qty" class="form-control" value="1"></td>
          </tr>
          <tr>
            <td>Harga</td>
            <td><input type="number" name="item_price" class="form-control"></td>
          </tr>
          
          <tr>
            <td>Printer</td>
            <td>
              
              <select class="form-control" name="printer_id">
                <option value=""><i>- None -</i></option>
                <?php foreach ($query->result_array() as $key => $value) { ?>
                <option value="<?php echo $value['printer_id'] ?>"><?php echo $value['printer_name'] ?></option>
                <?php } ?>
              </select>

            </td>
          </tr>

        </table>

    </div>


    <div class="modal-footer">
      <button class="btn btn-danger btn-sm" id="btn-submit">Simpan</button>
    </div>
    </form>

    </div>
  </div>
</div>


<div id="modal3" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <form id="retur_ajax2" method="POST">
      <div class="modal-header">
        <h4 class="text-center">Produk</h4>
      </div>
      <div class="modal-body">
        <table style="width: 100%" border="0">
          <tr>
            <td>Jumlah</td>
            <td>
            <input type="hidden" name="item_id">
            <input type="hidden" name="retur_id">
            <input type="hidden" name="retur_detail_id">
            <input type="number" name="retur_qty" class="form-control" value="1"></td>
          </tr>
          <tr>
            <td>Harga</td>
            <td><input type="number" name="item_price" class="form-control"></td>
          </tr>
          
          <tr>
            <td>Printer</td>
            <td>
              
              <select class="form-control" name="printer_id">
                <option value=""><i>- None -</i></option>
                <?php foreach ($query->result_array() as $key => $value) { ?>
                <option value="<?php echo $value['printer_id'] ?>"><?php echo $value['printer_name'] ?></option>
                <?php } ?>
              </select>

            </td>
          </tr>

        </table>

    </div>


    <div class="modal-footer">
      <button class="btn btn-danger btn-sm" id="btn-submit">Simpan</button>
    </div>
    </form>

    </div>
  </div>
</div>




<input type="hidden" id="retur_id" value="<?php echo $retur_id ?>">


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
        return resultJson;
      }
    })
  }
  var search_value = $(".searchData").val();
  var tableName = "#table-item";
  var limit = $("#limit").val();
  var data = {
    search : search_value,
    length : limit
  };
  var path = '<?php echo base_url() ?>' + 'sales/billing/get_table/';
  get_detail(tableName , data , path);

  $(document).on("input", ".searchData", function(){
    var search_value = $(".searchData").val();
    var limit = $("#limit").val();
    var data = {
      search : search_value,
      length : limit
    };
    get_detail(tableName , data , path);    
  })

  $(document).on("change", "#limit", function(){
    var search_value = $(".searchData").val();
    var limit = $(this).val();
    var data = {
      search : search_value,
      length : limit
    };
    get_detail(tableName , data , path);    
  })



    $(document).on("click", ".act-pilih", function(e){

    var index = $(".act-pilih").index(this);

    
    $("#modal2").modal("show");
    $("input[name=item_id]").val($(".item_id").eq(index).val());


    /*clear field*/
    $("input[name=retur_qty]").val("1");
    $("input[name=item_price]").val($(".set_price").eq(index).val());
    
    $("select[name=printer_id] option").removeAttr("selected");
  })


  
  $(document).on("submit", "#retur_ajax", function(e){
    e.preventDefault();

    $.ajax({
      url : '<?php echo base_url() ?>' + 'sales/billing/add_detail_retur',
      method : 'POST',
      data : new FormData(this),
      contentType : false,
      processData : false,
      success : function(result){
        var resultJson = JSON.parse(result);

        var status = resultJson.status;
        var no_trx = resultJson.no_trx;
        var retur_id = resultJson.retur_id;
        var subtotal = resultJson.subtotal;
        var total = resultJson.total;
        var created_by = resultJson.created_by;
        var tableRetur = "#table-order";
        var dataRetur = {
          retur_id : retur_id
        }
        var pathRetur = '<?php echo base_url() ?>' + 'sales/billing/get_detail_retur';
        if (status == "success") {
          $("input[name=retur_id]").val(retur_id);
          $("#retur_id").val(retur_id);
          
          $("input[name=subtotal]").val(subtotal);
          $("input[name=total]").val(total);
          $("input[name=operator]").val(created_by);
          
          /*$("#no_trx").val(no_trx);*/
          $("#modal1").modal("hide");
          $("#modal2").modal("hide");
          get_detail(tableRetur , dataRetur , pathRetur);
        }

      }
    })
  })

  $(document).on("click", ".b-delete", function(){
    var index = $(".b-delete").index(this);
    var retur_detail_id = $(".retur_detail_id").eq(index).val();
    var retur_id = $("#retur_id").val();
    $.ajax({
      url : '<?php echo base_url() ?>' + 'sales/billing/delete_retur_detail/',
      method : 'POST',
      data:{retur_detail_id : retur_detail_id , retur_id : retur_id},
      success:function(resultJson){
        var result = JSON.parse(resultJson);
        if (result.status == "success") {

          var tableRetur = "#table-order";
          var dataRetur = {
            retur_id : retur_id
          }
          $("input[name=subtotal]").val(result.subtotal);
          $("input[name=total]").val(result.total);
          var pathRetur = '<?php echo base_url() ?>' + 'sales/billing/get_detail_retur';

          get_detail(tableRetur , dataRetur , pathRetur); 

        }
      }
    })


  })

  $(document).on("click", ".btn-edit-retur-detail", function(){
    var index = $(".btn-edit-retur-detail").index(this);
    var retur_detail_id = $(".retur_detail_id").eq(index).val();
    var item_id = $(".detail_item_id").eq(index).val();

    $("#retur_ajax2 select[name=printer_id] option").removeAttr("selected");
    $("#modal3").modal("show");
    $("input[name=retur_detail_id]").val(retur_detail_id);

    $.ajax({
      url : '<?php echo base_url() ?>' + 'sales/billing/retur_item_detail',
      method : 'POST',
      data : {retur_detail_id : retur_detail_id},
      success:function(resultJson){
        var result = JSON.parse(resultJson);

        /*Removing attr selected*/

        $("#retur_ajax2 input[name=item_id]").val(result.item_id);
        $("#retur_ajax2 input[name=retur_qty]").val(result.retur_qty);
        $("#retur_ajax2 input[name=item_price]").val(result.item_price);
        
        $("#retur_ajax2 select[name=printer_id] option[value="+result.printer_id+"]").attr("selected","");
        
      }
    })


    

  })

  $(document).on("submit", "#retur_ajax2", function(e){
    e.preventDefault();
    var retur_id = $("#retur_id").val();
    $.ajax({
      url : '<?php echo base_url() ?>' + 'sales/billing/update_detail_retur',
      method : 'POST',
      data : new FormData(this),
      contentType : false,
      processData : false,
      success : function(result){
        var resultJson = JSON.parse(result);

        var status = resultJson.status;
        var subtotal = resultJson.subtotal;
        var total = resultJson.total;
        var tableRetur = "#table-order";
        var dataRetur = {
          retur_id : retur_id
        }
        var pathRetur = '<?php echo base_url() ?>' + 'sales/billing/get_detail_retur';
        if (status == "success") {
          $("input[name=subtotal]").val(subtotal);
          $("input[name=total]").val(total);

          $("#modal3").modal("hide");
          get_detail(tableRetur , dataRetur , pathRetur);
        }

      }
    })
  })

  $(document).on("click", "#btn-save", function(){
      
        var param = $(".required");
        var lg = param.length;
        if (param.val() == "") {
          param.focus();
          return false;
        }


    var retur_id = $("#retur_id").val();
    var no_trx = $("#no_trx").val();
    var customer_name = $("#customer_name").val();
    var phone = $("#phone").val();
    var info = $("#info").val();
    var tunai = $("#tunai").val();

    $.ajax({
      url : '<?php echo base_url() ?>' + 'sales/billing/retur_status',
      method : 'POST',
      data : {retur_id : retur_id,
              no_trx : no_trx,
              phone : phone,
              info : info,
              tunai : tunai,
              customer_name : customer_name},
      success:function(){
        document.location = '<?php echo base_url() ?>' + 'sales/billing/retur';
      }
    })
  })

  function render_retur(retur_id){
    var retur_id = retur_id;
    $.ajax({
      url : '<?php echo base_url() ?>' + 'sales/billing/render_retur',
      method : 'POST',
      data : {retur_id : retur_id},
      success : function(data){
        var result = JSON.parse(data);
        
        $("#no_trx").val(result.no_trx);
        $("#customer_name").val(result.customer_name);
        $("#created_by").val(result.created_by);
        $("#phone").val(result.phone);
        $("#info").val(result.info);
        $("#total").val(result.total);
        $("#subtotal").val(result.subtotal);
        $("#tunai").val(result.tunai);


      }
    })

  }
if ($("#retur_id").val() != "") {
  var retur_id = $("#retur_id").val();
  render_retur(retur_id);
  var tableRetur = "#table-order";
  var dataRetur = {
    retur_id : retur_id
  }
  var pathRetur = '<?php echo base_url() ?>' + 'sales/billing/get_detail_retur';

  get_detail(tableRetur , dataRetur , pathRetur); 
}




</script>