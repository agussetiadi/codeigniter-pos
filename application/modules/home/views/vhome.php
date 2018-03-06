 <section class="dashboard-header">
            <div class="container-fluid">
              <div class="row">
                <!-- Statistics -->
                <div class="statistics col-lg-3 col-12">

                <?php foreach ($query->result_array() as $key => $value) { ?>
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-red"><i class="fa fa-tasks"></i></div>
                    <div class="text"><strong><?php echo $store_name[$key] ?></strong><br><small><?php echo $online_users[$key] ?> Online Users</small></div>
                  </div>
                <?php } 
                ?>


                </div>
                <!-- Line Chart            -->
                <div class="chart col-lg-6 col-12">
                  <div id="lineCahrt" style="width: 100%;"></div>
                </div>
                <div class="chart col-lg-3 col-12">
                  <!-- Bar Chart   -->
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-green"><i class="fa fa-line-chart"></i></div>
                    <div class="text"><strong><?php echo number_format($query_item['order_qty']) ?> Item</strong><br><small>Terjual 3 Hari Terakhir</small></div>
                  </div>
                  <!-- Numbers-->
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-green"><i class="fa fa-line-chart"></i></div>
                    <div class="text"><strong>Rp. <?php echo number_format($query_sum['paid_detail_total']) ?></strong><br><small>Omset 3 Hari Terakhir</small></div>
                  </div>
                </div>
              </div>
            </div>
          </section>


<script src="<?php echo base_url()."assets/" ?>js/highcharts.js"></script>

<script type="text/javascript">
/*var store = [{
  name : 'ARH',
  data : [0,1,1,7,1,9]
},{
  name : 'Bojong Sari',
  data : [3,0,1,6,1,5]
}] 

var categories = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ]*/


$.ajax({
  url : '<?php echo base_url() ?>' + 'home/home_state_api',
  method : 'POST',
  success : function(resutJson){

    var jsonObj = JSON.parse(resutJson);
    var store = jsonObj.data;
    var categories = jsonObj.categories;

      Highcharts.chart('lineCahrt', {
    chart: {
        type: 'areaspline'
    },
    title: {
        text: 'Statistics Penjualan Percabang'
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        verticalAlign: 'top',
        x: 150,
        y: 100,
        floating: true,
        borderWidth: 1,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
    xAxis: {
        categories: categories,
        plotBands: [{ // visualize the weekend
            from: 4.5,
            to: 6.5,
            color: 'rgba(68, 170, 213, .2)'
        }]
    },
    yAxis: {
        title: {
            text: 'Value'
        }
    },
    tooltip: {
        shared: true,
        valueSuffix: ' Transaksi'
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        areaspline: {
            fillOpacity: 0.5
        }
    },
    series: store
});



  }
})






</script>