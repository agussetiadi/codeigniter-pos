<script type="text/javascript" src="<?php echo base_url()."assets/js/tableData.js" ?>"></script>
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
    	<div class="row">
	      <div class="col-md-6"><h2 class="no-margin-bottom">Pending Job</h2></div>
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
			<div id="alert-ajax" style="width: 100%">
				
			</div>
			<table style="width: 100%;">
				<tr style="height: 75px;">
					<td style="padding-right: 20px;">
						<label>Live Search</label><br>	
						<div class="custom-fa-search">
							<input type="text" class="form-control form-control-sm" id="searchData" placeholder="Cari Nama Customer">
						</div>
					</td>
					<td>
						<label>Status Bill</label><br>
						<select class="custom-select" style="margin:0" id="billing_status">
							<option value="pending">Pending</option>
							<option value="done">Done</option>
						</select>
					</td>
					<td style="padding-right: 20px;">
						<label>Tampilkan</label><br>
						<select class="custom-select" style="margin:0" id="length">
							<option>7</option>
							<option>15</option>
							<option>25</option>
							<option>50</option>
							<option>100</option>
						</select>
					</td>
					<td style="padding-right: 20px;">
						<br>
						<button class="btn btn-info btn-sm" id="btn-refresh"><span class="fa fa-refresh"></span> Refresh</button>
						</td>
					
				</tr>
			</table>
			<table class="table table-stripped" style="margin-top: 20px; overflow: scroll;" id="lookUp">
				<thead>
					<th>No Invoice</th>
					<th>Tanggal</th>
					<th>Customer</th>
					<th>Status Order</th>
					<th>Total Bill</th>
					<th>Created By</th>
					<th>Action</th>
					
				</thead>
				<tbody></tbody>
			</table>
			</div>
		</div>
	</div>
</div>




<script type="text/javascript">

var renderBilling = $("#lookUp").tableData({
	url : '<?php echo base_url() ?>' + 'sales/billing/render_billing',
	search : '#searchData',
	length : '#length',
	dataFilter : {
		billing_status : "#billing_status"
	}

})

$("#billing_status").on('change', function(){
	renderBilling.reload({
		billing_status : "#billing_status"
	})
})
	
</script>