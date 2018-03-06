<!DOCTYPE html>
<html>
<head>
	<title>Print Billing</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/bootstrap.css" ?>">
</head>
<body>

<div class="col-md-12" style="">
	<div class="row">
		<div class="col-md-4" style=""></div>
		<div class="col-md-4" style="padding-top :20px; border: 1px solid black; ">
			<div>
				<hr>
				<h3 class="text-center">Nomor Antrian Anda</h3>
				<h1 class="text-center"><b><?php echo $number ?></b></h1><hr>
				<ul>
					<li>Silahkan menunggu sampai ada panggian dari operator</li>
					<li>Jika nomor antrian anda terlewatkan, silahkan print kembali</li>

				</ul>
				<hr>
				<h4 class="text-center">SURYA PRINT</h4>
				<p class="text-center">Jl. Raya Arif Rahman Hakim, <br>Margonda Raya Depok Jawa Barat, Indonesia.<br>
				Telp. (021) 87171890</p>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>
<script type="text/javascript">
	window.load(print());
</script>
</body>
</html>