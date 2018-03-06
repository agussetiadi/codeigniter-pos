<!DOCTYPE html>
<html>
<head>
	<title>Print Stock</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/bootstrap.css" ?>">
</head>
<body>
<div class="container">
<div class="row">
	
	<div class="col-md-12" style="padding: 100px 0">
	<div class="row">
		<div class="col-md-6">
			<b>Laporan Data Stock Barang <?php echo $row_store['store_name'] ?></b><br>
			<b>Periode : <?php echo $date ?></b>
		</div>
		<div class="col-md-6" style="text-align: right;">
		</div>
	</div>
	<table class="table">
			<th>No.</th>
            <th>Nama Barang</th>
            <th>Kode Barang</th>
            <th>Kategori</th>
            <th>Harga Jual</th>
            <th>Harga Pokok</th>
            <th>Sisa Stock</th>
		<?php foreach ($query as $key => $value) { ?>
		<tr>	
			<td><?php echo $key +1 ?></td>
			<td><?php echo $value['item_name']; ?></td>
			<td><?php echo $value['item_code']; ?></td>
			<td><?php echo $value['category_id']; ?></td>
			<td><?php echo $value['item_price']; ?></td>
			<td><?php echo $value['item_hpp']; ?></td>
			<td><?php echo $totalStock[$key]; ?></td>
		</tr>
		<?php } ?>
	</table>
	</div>
	
</div>
</div>
</body>
</html>