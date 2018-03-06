
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Laporan</h2></div>
        <div class="col-md-6">
        
        </div>
        </div>
    </div>
  </header>

<div class="container-fluid top-bottom">
  <div class="row">
    <div class="col-md-12">
      <div class="block-space">
         <div class="row">


            <div class="col-md-3">
              <select class="form-control" id="store_id">
                <option value="0">Tampilkan Semua</option>
                <?php foreach ($query->result_array() as $key => $value) { ?>
                <option value="<?php echo $value['store_id'] ?>"><?php echo $value['store_name'] ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="col-md-3">
              <input type="text" class="form-control datepicker" name="" placeholder="Filter Awal tanggal" id="dateStart">
            </div>

            <div class="col-md-3">
              <input type="text" class="form-control datepicker" name="" placeholder="Filter Akhir tanggal" id="dateEnd">
            </div>

            <div class="col-md-2">

              <select class="form-control" id="tampilkan">
                <option>7</option>
                <option>15</option>
                <option>25</option>
                <option>50</option>
              </select>
            </div>
            <div class="col-md-1">
              
              <button class="btn btn-info" id="btn-print">Print</button>
            </div>
          </div>


      </div>
    </div>
  </div>
</div>


<div class="container-fluid top-bottom">
  <div class="row">
    <div class="col-md-12">
      <div class="block-space">
        <div class="row">

          <div class="col-md-4">
            <input type="text" class="form-control" name="" id="searchData" placeholder="Cari berdasarkan kata kunci"><br>
          </div>
        </div>
        <table id="lookup" class="table">
          <thead>
            <th>No. TRX</th>
            <th>Toko</th>
            <th>Pelanggan</th>
            <th>Dp</th>
            <th>Status Bayar</th>
            <th>Total HPP</th>
            <th>Total TRX</th>
            <th>Diinput Oleh</th>
            
            
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
      $("#lookup tfoot").html('<td colspan="6"><button id="btn-pre" class="btn btn-info btn-sm"> Previous </button> <input style="width:30px" type="text" id="start" value="1"> <button id="btn-next" class="btn btn-info btn-sm"> Next </button></td><td colspan="2" id="total"></td>');
    }



 function fetchData(){
    
      var store_id = $("#store_id").val();
      var search_value = $("#searchData").val();
      var tampilkan = $("#tampilkan").val();
      var startP = $("#start").val();
      var startF = $("#dateStart").val();
      var endF = $("#dateEnd").val();

      if (startP == "" || startP == 0) {
        start = 0;
      }
      else{
        start = (startP * tampilkan) - tampilkan
      }


    $.ajax({
      url:"<?php echo base_url() ?>"+"report/sales/sales_report_api",
      method : "POST",
      data : {search:search_value,
            length : tampilkan,
            start : start,
            store_id : store_id,
            dateStart : startF,
            dateEnd : endF
            },
      success:function(resultJson){
        var result = JSON.parse(resultJson);
        var jsonData = result.data;
        var totalData = result.total;
        var num = jsonData.length;
        
        
        var container = $("#lookup tbody");
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


  $(document).on("change", "#dateStart", function(){
    if ($("#dateEnd").val() != "") {
      fetchData();
    }
  })

  $(document).on("change", "#dateEnd", function(){
    if ($("#dateStart").val() != "") {
      fetchData();
    }
  })

  $(document).on("input", "#searchData", function(){
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
   $(document).on("change", "#startF", function(){
    $("#start").val(1); 
    fetchData();
  })
  $(document).on("change", "#endF", function(){
    $("#start").val(1); 
    fetchData();
  })
  $(document).on("change", "#store_id", function(){
    $("#start").val(1); 
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

  $(document).on("click", "#btn-print", function(){
    var startF  = $("#dateStart").val();
    var endF    = $("#dateEnd").val();
    var store_id = $("#store_id").val();
    window.open('<?php echo base_url() ?>' + 'report/sales/print_report?dateStart=' + startF + '&dateEnd=' + endF + '&store=' + store_id ,'_blank');
  })




fetchData()




</script>