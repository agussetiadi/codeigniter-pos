
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Retur Penjualan</h2></div>
        <div class="col-md-6">
          <button class="btn btn-success float-right" id="rdr">Tambah Retur</button>
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
            <input type="text" class="form-control searchData" name="">
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
          <td></td>
        </tr>
      </table>
      <table class="table table-list-pending" style="margin-top: 20px; overflow: scroll;" id="look">
        <thead>
          <th>No Transaksi</th>
          
          <th>Nama Customer</th>
          <th>Shift</th>
          <th>Tanggal</th>
          <th>Jam</th>
          <th>Keterangan</th>
          <th>Total Retur</th>
          <th></th>
        </thead>
        <tbody></tbody>
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
      url:"<?php echo base_url() ?>"+"sales/billing/get_retur",
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


  fetchData();

  $(document).on("click", "#rdr", function(){
    document.location = '<?php echo base_url() ?>' + 'sales/billing/retur_add';
  })

  $(document).on("click",".btn-go",function(){
    var index = $(".btn-go").index(this);
    var retur_id = $(".retur_id").eq(index).val();
    document.location = '<?php echo base_url() ?>' + 'sales/billing/retur_add?trx='+retur_id;


  })


</script>