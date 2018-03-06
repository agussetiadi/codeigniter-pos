
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
                
                <?php foreach ($query->result_array() as $key => $value) { ?>
                <option value="<?php echo $value['store_id'] ?>"><?php echo $value['store_name'] ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="col-md-3">
              <input type="text" class="form-control datepicker" name="" placeholder="Filter tanggal" id="date">
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
            <th>Toko</th>
            <th>Nama Barang</th>
            <th>Kode Barang</th>
            <th>Kategori</th>
            <th>Harga Jual</th>
            <th>Harga Pokok</th>
            <th>Stok Tersedia</th>
            
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
      var date = $("#date").val();

      if (startP == "" || startP == 0) {
        start = 0;
      }
      else{
        start = (startP * tampilkan) - tampilkan
      }


    $.ajax({
      url:"<?php echo base_url() ?>"+"report/stock/stock_report_api",
      method : "POST",
      data : {search:search_value,
            length : tampilkan,
            start : start,
            store_id : store_id,
            date : date
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

  $(document).on("change", "#date", function(){
      fetchData();
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
    var initDate  = $("#date").val();
    var store_id = $("#store_id").val();
    window.open('<?php echo base_url() ?>' + 'report/stock/print_report?initDate='+initDate+'&store=' + store_id ,'_blank');

    

  })




fetchData()




</script>