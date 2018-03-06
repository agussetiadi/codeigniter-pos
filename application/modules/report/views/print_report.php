<!DOCTYPE html>
<html>
<head>
	<title>Print Billing</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/bootstrap.css" ?>">
</head>
<body>
<div class="container">
<div class="row">
	
	<div class="col-md-12" style="padding: 100px 0">
	<div class="row">
		<div class="col-md-6">
			<b>Laporan Data Penjualan <?php echo $store_name ?></b><br>
			<b>Periode : <?php echo $dateStart." s/d ".$dateEnd ?></b>
		</div>
		<div class="col-md-6" style="text-align: right;">
			<b>Total Omset : <?php echo "Rp. ".number_format($omset)." ,-"  ?></b><br>
			<b>Total Modal : <?php echo "Rp. ".number_format($hpp)." ,-"  ?></b><br>
			<b>Total Keuntungan : <?php echo "Rp. ".number_format($omset - $hpp)." ,-"  ?></b>
			
		</div>
	</div>
	<table class="table">
			<th>No.</th>
            <th>No Invoice</th>
            <th>Toko</th>
            <th>Pelanggan</th>
            <th>Dp</th>
            <th>Status Bayar</th>
            <th>Total HPP</th>
            <th>Total TRX</th>
            <th>Diinput Oleh</th>
		<?php foreach ($query as $key => $value) {

		    	if ($value['is_dp'] == 1) {
		    		$dp = "Ya";
		    	}
		    	else{
		    		$dp = "Tidak";
		    	}

		    	if ($value['paid_off'] == 1) {
		    		$paid_off = "Lunas";
		    	}
		    	else{
		    		$paid_off = "Belum Lunas";
		    	}


		?>
		<tr>	
			<td><?php echo $key +1 ?></td>
			<td><?php echo $value['billing_no']; ?></td>
            <td><?php echo $value['store_name']; ?></td>
            <td><?php echo $value['customer_name']; ?></td>
            <td><?php echo $dp; ?></td>
            <td><?php echo $paid_off; ?></td>
            <td><?php echo $value['total_hpp']; ?></td>
            <td><?php echo $value['grand_total']; ?></td>
            <td><?php echo $value['created_by']; ?></td>
		</tr>
		<?php } ?>
	</table>
	</div>
	
</div>
</div>
</body>
</html>