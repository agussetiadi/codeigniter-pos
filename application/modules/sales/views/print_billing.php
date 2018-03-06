<!DOCTYPE html>
<html>
<head>
	<title>Print Billing</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/bootstrap.css" ?>">
</head>
<body>
<div class="container">
<div class="row">
	
	<div class="col-md-12" style="border: 1px black solid; margin:20px;">
		<table class="table">
			<thead>
				<td width="25%">Jl. Raya Arif Rahman Hakim, <br>Margonda Raya Depok Jawa Barat, Indonesia.<br>
				Telp. (021) 87171890<br>
				Fax. (019282)<br>
				Email. suryaprint@gmail.com
				</td>
				<td><div style="float: right;">
					Nomor Transaksi<br>
					Nama Pelanggan<br>
					Tanggal Input<br>
					Store<br>
				</div>
				</td>
				<td>
				
				: <?php echo $query1['billing_no'] ?><br>
				: <?php echo $query1['customer_name'] ?><br>
				: <?php echo $query1['date_created'] ?><br>
				: <?php echo $query1['store_name'] ?><br>

				</td>
				<td>
				<div style="float: right;">
				Input Oleh<br>
					Cashier<br>
					Shift<br>
					Counter<br>
				</div>
				</td>
				<td>
					: <?php echo $query1['created_by'] ?><br>
					: <?php echo $query1['cashier_name'] ?><br>
					: <?php echo $query1['shift_name'] ?><br>
					: <?php echo $query1['no_loket'] ?><br>
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
					<td>Discount</td>
					<td>Pajak</td>
				</tr>

				<?php foreach ($query_detail->result_array() as $key => $value) {
					
				?>
				<tr>
					<td><?php echo $key+1 ?></td>
					<td><?php echo $value['item_name'] ?></td>
					<td><?php echo $value['printer_name'] ?></td>
					<td><?php echo $value['item_price'] ?></td>
					<td><?php echo $value['order_qty'] ?></td>
					<td><?php echo $value['unit_name'] ?></td>
					<td><?php echo $value['discount_price'] ?></td>
					<td><?php echo $value['tax_price'] ?></td>
				</tr>
				<?php } ?>


			</tbody>
			<tfoot>
				<tr>
					<td colspan="6"></td>
					<td>Subtotal<br>
						Potongan<br>
						Pajak<br>
						Biaya Lain<br>
						<b>Grand Total</b><br>
						</td>
					<td>: <?php echo $query1['total_billing'] ?><br>
					: <?php echo $query1['discount_total'] ?><br>
					: <?php echo $query1['tax_total'] ?><br>
					: <?php echo $query1['biaya_lain'] ?><br>
					: <b><?php echo $query1['grand_total'] ?></b></td>
					</td>
				</tr>
				
			</tfoot>
		</table>
	</div>
	
</div>
</div>
<script type="text/javascript">
	window.load(print());
</script>
</body>
</html>