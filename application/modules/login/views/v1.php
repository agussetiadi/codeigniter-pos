<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login | Point Of Sale</title>


<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/login.css">
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.number.min.js"></script>

</head>
<body style="background-color: #d7d7d7; background-image: url('<?php echo base_url() ?>assets/img/system/slider-2.jpg'); background-size: 100% auto;">
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>

  <div class="cont">
  <div class="demo">
    <div class="login">
      <div class="login__check">
        
      </div>

<div id="wrap-msg" style="display: none; font-size: 15px; padding: 10px;"></div>

  <form method="POST" id="form1" action="<?php echo base_url()."login/v1/validate" ?>">
      <div class="login__form">
        <div class="login__row">
          <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
          </svg>
          <input type="text" class="login__input name" placeholder="Username" name="username"/>
        </div>
        <div class="login__row">
          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
          </svg>
          <input type="password" class="login__input pass" placeholder="Password" name="password"/>
        </div>
        <button type="submit" class="login__submit btn-log">Sign in</button>
        <p class="login__signup">Login V1 | Powered By Agus Setiad</p>
      </div>
      </form>




    </div>
    <div class="app" style="background : linear-gradient(to bottom, rgba(146, 135, 187, 0.8) 0%, rgba(0, 0, 0, 0.6) 100%)">
        
    <div id="wrap-msg2" style="display: none; font-size: 15px; padding: 10px;"></div>
      <form method="POST" id="form2" action="<?php echo base_url()."login/v1/loket" ?>">

      <div class="head-l">
        <h3 style="text-align: center;">Nomor Loket <br> & <br>Shift</h3>
      </div>


      <div class="login__form">
        <div class="login__row">
          <input type="text" class="jsPrice loket-form" style="" placeholder="Nomor Loket" name="no_loket"/>
        </div>
        <div class="login__row">

          <select class="loket-form" name="shift_id">
              <?php foreach($query->result_array() as $key => $value){ ?>
            <option value="<?php echo $value['shift_id'] ?>"><?php echo $value['shift_name'] ?></option>
            <?php } ?>
          </select>
        </div>
        <button type="submit" class="login__submit btn-log">Sign in</button>
        <p class="login__signup">Login V1 | Powered By Agus Setiad</p>
      </div>
      </form>



    </div>
  </div>
</div>




      
  </div>
</div>



<script type="text/javascript">
$('.jsPrice').number(true);


  var animating = false,
      submitPhase1 = 1100,
      submitPhase2 = 400,
      logoutPhase1 = 800,
      $login = $(".login"),
      $app = $(".app");
  
  function ripple(elem, e) {
    $(".ripple").remove();
    var elTop = elem.offset().top,
        elLeft = elem.offset().left,
        x = e.pageX - elLeft,
        y = e.pageY - elTop;
    var $ripple = $("<div class='ripple'></div>");
    $ripple.css({top: y, left: x});
    elem.append($ripple);
  };
  
  $(document).on("click", ".login__submit", function(e) {

  });
  
  $(document).on("click", ".app__logout", function(e) {
    if (animating) return;
    $(".ripple").remove();
    animating = true;
    var that = this;
    $(that).addClass("clicked");
    setTimeout(function() {
      $app.removeClass("active");
      $login.show();
      $login.css("top");
      $login.removeClass("inactive");
    }, logoutPhase1 - 120);
    setTimeout(function() {
      $app.hide();
      animating = false;
      $(that).removeClass("clicked");
    }, logoutPhase1);
  });




var base_url = '<?php echo base_url() ?>';
  $("#form1").submit(function(e){
    e.preventDefault();
    $(".btn-log").html("Sedang memeriksa ...");
    var path = $(this).attr("action");
    var method = $(this).attr("method");
    $.ajax({
      url : path,
      method : method,
      data : new FormData(this),
      processData : false,
      contentType : false,
      success : function(result){
         $(".btn-log").html("Masuk");
        var jsonData = JSON.parse(result);
        if (jsonData.status == 'validate') {
            for (var i = 0; i < jsonData.message.length; i++) {
              var alert = jsonData.message[i];
              $("#wrap-msg").append('<div class="alert alert-info">'+alert+' Harus Terisi</div>');
              $("#wrap-msg").fadeIn("slow");
            }
            setTimeout(function(){
              $("#wrap-msg").fadeOut("slow", function(){
                $("#wrap-msg").html("");
              });

            },1500)
        }
        else if(jsonData.status == 'failed'){
            var alert = jsonData.message;
            $("#wrap-msg").append('<div class="alert alert-danger">'+alert+'</div>');
            $("#wrap-msg").fadeIn("slow");
            setTimeout(function(){
              $("#wrap-msg").fadeOut("slow", function(){
                $("#wrap-msg").html("");
              });

            },1500)
        }
        else if(jsonData.status == 'success'){

            if (jsonData.redirect) {
              var path = jsonData.redirect;
              var alert = "Anda akan segera dialihkan ...";
              
              $("#wrap-msg").append('<div class="alert alert-success">'+alert+'</div>');
              $("#wrap-msg").fadeIn("slow");
              setTimeout(function(){
                document.location=path;
              },1000)
              
            }
            if (jsonData.continue) {

              console.log(jsonData.continue);
              if (animating) return;
              animating = true;
              var that = ".login__submit";
              ripple($(that), e);
              $(that).addClass("processing");
              setTimeout(function() {
                $(that).addClass("success");
                setTimeout(function() {
                  $app.show();
                  $app.css("top");
                  $app.addClass("active");
                }, submitPhase2 - 70);
                setTimeout(function() {
                  $login.hide();
                  $login.addClass("inactive");
                  animating = false;
                  $(that).removeClass("success processing");
                }, submitPhase2);
              }, submitPhase1);
            }

            $("#form2").attr("action",jsonData.continue);

        }

      }
    })
  })
</script>


<script type="text/javascript">
  
$("#form2").on("submit", function(x){
  x.preventDefault();
    $(".btn-log").html("Sedang memeriksa ...");
    var path = $(this).attr("action");
    var method = $(this).attr("method");
    $.ajax({
      url : path,
      method : method,
      data : new FormData(this),
      processData : false,
      contentType : false,
      success : function(result){
         $(".btn-log").html("Masuk");
        var jsonData = JSON.parse(result);

        if(jsonData.status == 'success'){

            if (jsonData.redirect) {
              var path = jsonData.redirect;
              var alert = "Anda akan segera dialihkan ...";
              
              $("#wrap-msg2").append('<div class="alert alert-success">'+alert+'</div>');
              $("#wrap-msg2").fadeIn("slow");
              setTimeout(function(){
                document.location=path;
              },1000)
              
            }

        }

      }
    })

})
  
</script>


</body>
</html>