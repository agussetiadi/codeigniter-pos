<!DOCTYPE html>
<html>
<head>
	<title>Print Billing</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/bootstrap.css" ?>">
</head>
<body>
<div class="container">
<div class="row">
	
	<div class="col-md-12" style="border: 1px black solid; padding: 20px; margin-top: 50px;">
		<table class="" style="width: 100%">
			<thead>
				<td width="25%">Jl. Raya Arif Rahman Hakim, <br>Margonda Raya Depok Jawa Barat, Indonesia.<br>
				Telp. (021) 87171890<br>
				
				</td>
				<td width="45%"></td>
				<td width="15%">
					<div style="float: right;">
					Nomor Transaksi<br>
					Nama Pelanggan<br>
					Tanggal Input<br>
					Store<br>
					</div>
				</td>
				<td>
					<div style="float: right;">
					: <?php echo $query1['no_trx'] ?><br>
					: <?php echo $query1['customer_name'] ?><br>
					: <?php echo $query1['date_retur'] ?><br>
					: <?php echo $query1['store_name'] ?><br>
					</div>
				</td>
				<td>
				</td>
				<td>
					
				</td>
			</thead>
		</table>
		<table class="table">
			<tbody>
				<tr>
					<td>No.</td>
					<td>Nama Item</td>
					<td>Printer</td>
					<td>Harga</td>
					<td>Jumlah</td>
					<td>Satuan</td>
					
				</tr>

				<?php foreach ($query2->result_array() as $key => $value) {
					
				?>
				<tr>
					<td><?php echo $key+1 ?></td>
					<td><?php echo $value['item_name'] ?></td>
					<td><?php echo $value['printer_name'] ?></td>
					<td><?php echo $value['item_price'] ?></td>
					<td><?php echo $value['retur_qty'] ?></td>
					<td><?php echo $value['item_price'] ?></td>
					
				</tr>
				<?php } ?>


			</tbody>
			<tfoot>
				<tr>
					<td colspan="4"></td>
					<td>Subtotal<br>
						Tunai<br>
						Grand Total<br>
						
						</td>
					<td>: <?php echo $query1['subtotal'] ?><br>
					: <?php echo $query1['tunai'] ?><br>
					: <?php echo $query1['total'] ?><br>
					</td>
					</td>
				</tr>
				
			</tfoot>
		</table>
	</div>
	
</div>
</div>
</body>
</html>