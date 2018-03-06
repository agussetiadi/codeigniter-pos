
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
      <div class="statistics col-lg-6 col-12">

      <div class="row" id="wrap-loket">


      <?php foreach ($queryQ->result_array() as $key => $value) {
        
      ?>
        <div class="col-md-6 m-bottom-25 user<?php echo $value['user_id'] ?>">
          <div class="statistic align-items-center bg-white has-shadow">

            <div class="row">
              <div class="col-md-6">
                 
                <div class="w-dis-que"><img class="img-dis-que" src="<?php echo base_url()."assets/img/".$value['avatar'] ?>"></div>
              </div>
            
                
              <div class="col-md-6">
                <div class="row">
                  
                  <h2><?php echo $value['status'] ?></h2>
                  <p style="margin: 0;">LOKET <?php echo $value['no_loket'] ?></p>
                </div>
              </div>
            </div>

          </div>
        </div>
        <?php } 

        ?>






      </div>

        
      </div>





      <!-- Line Chart            -->
      <div class="chart col-lg-6 col-12">
        <div style="text-align: center; padding: 20px" class="bg-white align-items-center justify-content-center has-shadow">
          <h1 id="no_antrian" style="font-size: 100px; color: #ff7676;"></h1><hr>
          <h1 style="font-size: 60px; color: grey;">Loket <span id="no_loket"></span></h1><hr>

          <div id="replaceQ"></div>

        </div>
      </div>
    </div>
  </div>
</section>

<!-- Load Package Antrian js -->
<script type="text/javascript" src="<?php echo base_url()."assets/js/antrian.js" ?>"></script>

<script type="text/javascript">
  
/*var node_url = '<?php echo node_url() ?>';
var socket = io.connect(node_url);

var store_id = $("#store_id").val();*/

/*send notif connect*/
/*socket.emit("come", {
  store_id : store_id
})*/

  var store_id = $("#store_id").val();



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

      console.log(rows);
      if (rows != null) {

        $("#queue_id").val(rows.queue_id);
        
      }
      else{
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
})

socket.on("come", function(dataRec){

  $("#wrap-loket").html("");
  Object.keys(dataRec).forEach(function(key){

  var dataAppend = '<div class="col-md-6 m-bottom-25 user'+dataRec[key].user_id+'"><div class="statistic align-items-center bg-white has-shadow"><div class="row"><div class="col-md-6"><div class="w-dis-que"><img class="img-dis-que" src="<?php echo base_url() ?>assets/img/'+dataRec[key].avatar+'"></div></div><div class="col-md-6"><div class="row"><h2>'+dataRec[key].status+'</h2><p style="margin: 0;">LOKET '+dataRec[key].no_loket+'</p></div></div></div></div></div>';

    $("#wrap-loket").append(dataAppend);
    
  })
  
  

})

socket.on("leave", function(dataRec){
  var user_id = dataRec.user_id;
  $(".user"+user_id).remove();
})




$(document).on("change", "#store_id", function(){
  var store_id = $(this).val();
  document.location = '<?php echo base_url() ?>'+'queue/display?store=' + store_id;
})


socket.on("calling", function(data){
  var store_id = $("#store_id").val();
  var m_queue_id = $("#m_queue_id").val();
  getNum(store_id,m_queue_id);


      var  no_antrian = data.no_antrian;
      var  no_loket = data.no_loket;
      var  store_id = data.store_id;
      var  queue_id = data.queue_id;

      console.log(no_antrian);
      $("#no_antrian").html(no_antrian);
      $("#no_loket").html(no_loket);

      calling(no_antrian,no_loket,'<?php echo base_url() ?>' + 'assets/sounds/');

})

socket.on("callAgain", function(){

})



var store_id = $("#store_id").val();
var m_queue_id = $("#m_queue_id").val();
getNum(store_id,m_queue_id);
</script>