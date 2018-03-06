
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
    	<div class="row">
	      <div class="col-md-8"><h2 class="no-margin-bottom">Panggilan Antrian</h2></div>
	       <div class="col-md-4">
           <select class="form-control" id="store_id">
           <?php foreach ($query_store->result_array() as $k => $v) {  ?>
            <option value="<?php echo $v['store_id'] ?>" <?php if($v['store_id'] == $this->session_data->store_id()){ echo "selected"; } ?> ><?php echo $v['store_name'] ?></option> 
            <?php } ?>
           </select>
          </div>
      	</div>
    </div>
  </header>
<!-- Dashboard Counts Section-->
 <section class="dashboard-header">
  <div class="container-fluid">
    <div class="row">
      <!-- Statistics -->
      <!-- Line Chart            -->
      <div class="chart col-lg-6 col-12">
        <div style="text-align: center; padding: 20px" class="bg-white align-items-center justify-content-center has-shadow">
          <h1 style="font-size: 100px; color: #ff7676;" id="no_antrian"></h1><hr>
          <input type="hidden" name="" id="queue_id">


          <select class="form-control" id="m_queue_id">

            <?php foreach ($get_queue->result_array() as $key_opt => $value_opt) { ?>
            <option value="<?php echo $value_opt['m_queue_id'] ?>">Antrian <?php echo $value_opt['queue_name'] ?></option>
            <?php } ?>
          </select>



          <hr>
          <div id="replaceQ">

          </div>
          <hr>
          <button class="btn btn-lg btn-success" id="btn_panggil">Panggil</button>
          <button class="btn btn-lg btn-primary" id="btn_ulang">Ulangi</button>
          <hr>
          <h3>Loket <span id="no_loket"><?php echo $this->session_data->no_loket() ?></span></h3>
        </div>
      </div>


    </div>
  </div>
</section>

<input type="hidden" name="" id="w-replay">


<script type="text/javascript">
/*  var node_url = '<?php echo node_url() ?>';
  var socket = io.connect(node_url);

  var store_id = $("#store_id").val();*/

  /*send notif connect*/
/*  socket.emit("come", {
    store_id : store_id
  })*/




  function getNum(store_id,m_queue_id){
  $.ajax({
    url : '<?php echo base_url() ?>' + 'queue/get_num/',
    method : 'POST',
    data : {store_id : store_id , m_queue_id : m_queue_id},
    success : function(data){

      var rJson = JSON.parse(data);
      var queue_name = rJson.queue_name;
      var queue_num = rJson.queue_num;
      var rows = rJson.rows;
      if (rows != null) {

        $("#no_antrian").html(rows.queue_number);
        $("#queue_id").val(rows.queue_id);
        
      }
      else{
        $("#no_antrian").html("");
        $("#queue_id").val("");

      }


      var app = "";

      for (var i = 0; i < queue_num.length; i++) {
        app += '<p><button class="btn btn-danger btn-sm">Sisa Antrian '+queue_name[i]+'</button> <button class="btn btn-danger btn-sm">'+queue_num[i]+'</button></p>'
      }

      $("#replaceQ").html(app);

        /*Object.keys(queue_num).forEach(function(key) {

          

        });*/
    }
  })
}


socket.on('updateNum', function(){
  var store_id = $("#store_id").val();
  var m_queue_id = $("#m_queue_id").val();
  getNum(store_id,m_queue_id)
});






$(document).on("click", "#btn_panggil", function(){
  var no_antrian = $("#no_antrian").html();
  var no_loket = $("#no_loket").html();
  var queue_id = $("#queue_id").val();
  $("#w-replay").val(no_antrian);


  var dataObj = {
      no_antrian : no_antrian,
      no_loket : no_loket,
      store_id : store_id,
      queue_id : queue_id
    }
  if (queue_id != "") {

   socket.emit("calling", dataObj);
  }
})


$(document).on("click", "#btn_ulang", function(){
  var no_antrian = $("#w-replay").val();
  var no_loket = $("#no_loket").html();
  $("#w-replay").val(no_antrian);


  var dataObj = {
      no_antrian : no_antrian,
      no_loket : no_loket,
      store_id : store_id
    }
    socket.emit("calling", dataObj);

})


$(document).on("change","#m_queue_id", function(){
  var store_id = $("#store_id").val();
  var m_queue_id = $("#m_queue_id").val();
  getNum(store_id,m_queue_id)
})

var store_id = $("#store_id").val();
var m_queue_id = $("#m_queue_id").val();
getNum(store_id,m_queue_id);
  


</script>