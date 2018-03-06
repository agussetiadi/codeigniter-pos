
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
    	<div class="row">
	      <div class="col-md-8"><h2 class="no-margin-bottom">Antrian</h2></div>
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
      <div class="chart col-lg-6 col-12" style="color: #484848;">
        <div style=" padding: 20px" class="bg-white align-items-center justify-content-center has-shadow">
          <div style="font-size: 70px;" class="text-center"><pre id="fg"></pre></div>

          <hr>

          <div class="text-center">

           <div id="replaceQ"></div>
          </div>

        </div>

      </div>


      <div class="chart col-lg-6 col-12">
      <?php foreach ($query->result_array() as $key => $value) {
       ?>
        <div class="w-queue statistic cursor-hover d-flex align-items-center bg-white has-shadow">
          <div class="icon bg-violet"><i class="icon-user"></i></div>
          <div class="text"><strong><?php echo $value['queue_name'] ?></strong></div>
        </div>
        <input type="hidden" class="m_queue_id" value="<?php echo $value['m_queue_id'] ?>" name="">
       <?php } ?>

      </div>
    </div>
  </div>

  <input type="hidden" name="" id="store_id" value="<?php echo $this->session->userdata('store_id') ?>">

</section>

<script type="text/javascript">
  function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('fg').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
  function checkTime(i) {
      if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
      return i;
  }
  startTime();
</script>



<script type="text/javascript">



/*var node_url = '<?php echo node_url() ?>';
var socket = io.connect(node_url);

var store_id = $("#store_id").val();*/

/*send notif connect*/
/*socket.emit("come", {
  store_id : store_id
})*/

 var store_id = $("#store_id").val();


  $(document).on("click", ".w-queue", function(){
    var index = $(".w-queue").index(this);
    var m_queue_id = $(".m_queue_id").eq(index).val();

    var data = {
      m_queue_id : m_queue_id,
      store_id : store_id
    }

    socket.emit("queue", data);


  })

socket.on('queue', function(msg){
  window.open('<?php echo base_url() ?>' + 'queue/execute_print?number='+msg.number);
})

function getNum(store_id,m_queue_id){


  var store_id = $("#store_id").val();
  var m_queue_id = $("#m_queue_id").val();


  $.ajax({
    url : '<?php echo base_url() ?>' + 'queue/get_num/',
    method : 'POST',
    data : {store_id : store_id , m_queue_id : m_queue_id},
    success : function(data){

      var rJson = JSON.parse(data);
      var queue_name = rJson.queue_name;
      var queue_num = rJson.queue_num;



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
  getNum(store_id,m_queue_id);
  
})



var store_id = $("#store_id").val();
var m_queue_id = $("#m_queue_id").val();
getNum(store_id,m_queue_id);
</script>

