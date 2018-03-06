
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
    	<div class="row">
	      <div class="col-md-6"><h2 class="no-margin-bottom">Detail Order</h2></div>
	      <div class="col-md-6">
           <a target="_blank" style="margin-right: 10px;" class="float-right" href="<?php echo base_url()."sales/billing/print_billing/".$query1['billing_id'] ?>">
            <button class="btn btn-success ">Print</button>
           </a>
  	       <!-- <button class="btn btn-success float-right">Save PDF</button> -->
	      </div>
      	</div>
    </div>
  </header>
<!-- Dashboard Counts Section-->
<div class="container-fluid top-bottom">
  <div class="row">
    <div class="col-md-12">
      <div class="block-space">

      <table>
        <thead>
          <th>Nomor Transaksi</th>
          <th> : </th>
          <th><?php echo $query1['billing_no'] ?></th>

          <th width="20%"></th>

          <th>Input Oleh</th>
          <th> : </th>
          <th><?php echo $query1['created_by'] ?></th>
        </thead>
        <thead>
          <th>Nama Pelanggan</th>
          <th> : </th>
          <th><?php echo $query1['customer_name'] ?></th>
          <th></th>
          <th>Cashier</th>
          <th> : </th>
          <th><?php echo $query1['cashier_name'] ?></th>
        </thead>
        <thead>
          <th>Tanggal Input</th>
          <th> : </th>
          <th><?php echo $query1['date_created']." ".substr($query1['time_created'], 0,5) ?></th>
          <th></th>
          <th>Shift</th>
          <th> : </th>
          <th><?php echo $query1['shift_name'] ?></th>
        </thead>
        <thead>
          <th>Store</th>
          <th> : </th>
          <th><?php echo $query1['store_name'] ?></th>
          <th></th>
          <th>Info</th>
          <th> : </th>
          <th><?php echo $query1['billing_notes'] ?></th>
        </thead>
        
      </table>



      </div>
    </div>
  </div>
</div>
<!-- Dashboard Counts Section-->
<div class="container-fluid top-bottom">
  <div class="row">
    <div class="col-md-12">
      <div class="block-space">
      <h3>Detail Order</h3>
        <table id="table-order" class="table">
          <thead>
            <th>No.</th>
            <th>Nama Item</th>
            <th>Printer</th>
            <th>Ukuran</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Discount</th>
            <th>Pajak</th>
            <th>Total</th>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid top-bottom">
  <div class="row">
    <div class="col-md-12">
      <div class="block-space">
        <h3>History Pembayaran</h3>
        <table class="table" id="table-paid">
          <thead>
            <th>Jenis Pembayaran</th>
            <th>Nama Bank</th>
            <th>Info TRX</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Jumlah</th>
          </thead>
          <tbody></tbody>
          <tfoot>
        <tr>
          <td colspan="4"></td>
          <td>Subtotal<br>
            Potongan<br>
            Pajak<br>
            Biaya Lain<br>
            <b>Grand Total</b><br>
            </td>
          <td>: <?php echo $query1['total_billing'] ?><br>
          : <?php echo $query1['discount_total'] ?><br>
          : <?php echo $query1['tax_total'] ?><br>
          : <?php echo $query1['biaya_lain'] ?><br>
          : <b><?php echo $query1['grand_total'] ?></b></td>
          </td>
        </tr>
        
      </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<input type="hidden" value="<?php echo $query1['billing_id'] ?>" id="billing_id">

<script type="text/javascript">
  function get_detail(tableName , data , path){

      $.ajax({
      url:path,
      method : "POST",
      data : data,
      success:function(resultJson){
        $(".loader").hide();
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



  $(window).on("load", function(){
    var tableName = "#table-order";
    var tableName2 = "#table-paid";
    var billing_id = $("#billing_id").val();
    var data = {
      billing_id : billing_id
    }
    var path = '<?php echo base_url() ?>' + 'sales/billing/get_detail2/';
    var path2 = '<?php echo base_url() ?>' + 'sales/billing/paid_detail/';
    get_detail(tableName,data,path);
    get_detail(tableName2,data,path2);

  })

</script>