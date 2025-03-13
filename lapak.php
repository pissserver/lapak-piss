<?php
	session_start();
	include "connection.php";
	include "components/role_session.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="img/logo.png">
		<link rel="shortcut icon" href="img/logo.png" />
		<title>Lapak | PISS</title>

		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- MetisMenu CSS -->
		<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<!-- Timeline CSS -->
		<link href="css/plugins/timeline.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="css/sb-admin-2.css" rel="stylesheet">
		<!-- Custom Fonts -->
		<link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="js/jquery.min.js"></script>
		<!-- input number -->
		<link href="js/touchpin/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" media="all">
		<script src="js/touchpin/jquery.bootstrap-touchspin.js"></script>
		<script>
			/* hide all elements & show preloader*/
			document.documentElement.className += 'js';
			
			/* display variabel */
			var alertLoadProcess = "<span class='alert alert-info' onclick='clearNotif()'><i class='fa fa-spinner fa-spin'></i> Loading...</span>";
			//fungsi input hanya angka
			function isNumber(event) {
			if (event) {
				var charCode = (event.which) ? event.which : event.keyCode;
				if (charCode != 190 && charCode > 31 && 
				(charCode < 48 || charCode > 57) && 
				(charCode < 96 || charCode > 105) && 
				(charCode < 37 || charCode > 40) && 
					charCode != 110 && charCode != 8 && charCode != 46 )
				return false;
			}
			return true;
			}
		</script>
	</head>
	<body>
		<div id="wrapper">
			<?php include "components/sidebar.php" ?>

			<!-- Start Main Content ============================================================================================================== -->
			<div id="page-wrapper">
				<br><br><br><br>
				<div class="row">
					<div class="col-md-3" style="padding:10px;">
						<br /><br /><br />
						<div class="panel panel-primary">
							<div class="panel-heading">
								<i class="fa fa-pencil fa-fw"></i> Tambah Data Lapak
							</div>
							<div class="panel-body">
								<form class="form-horizontal" id="formLapak" name = "formLapak" method="POST" action="lapak_action.php?task=insert">
									<fieldset>
										<label>Blok</label>
										<select class="form-control" name="block" id="block" autofocus="autofocus" required>
											<option value="">- Pilih Blok -</option>
											<?php 
												$sql 		= mysql_query("select block_id from block where block_now < block_max");
												while($data = mysql_fetch_array($sql)){?>
												<option value="<?php echo $data['block_id'];?>"><?php echo $data['block_id'];?></option>
											<?php } ?>
										</select>
										<div class="row">
											<div class="col-md-6" style="padding:10px;">
												<label>Panjang</label><sup> ( m )</sup>
												<input class="form-control" id="p" name="p" type="number" step="0.01" value="0" required />
											</div>
											<div class="col-md-6" style="padding:10px;">
												<label>Lebar</label><sup> ( m )</sup>
												<input class="form-control" id="l" name="l" type="number" step="0.01" value="0" required />
											</div>
										</div>
										<div class="form-group" style="padding:10px; margin-top: -10px;">
											<label>Harga</label><sup> ( /m<sup>2</sup> - /tahun )</sup>
											<input class="form-control" id="price" name="price" type="text" value="0" required />
											<script>
												$("input[name='price']").TouchSpin({
													min: 0,
													max: 10000000,
													step: 100000,
													postfix: 'Rupiah',
													verticalbuttons: true,
													verticalupclass: 'glyphicon glyphicon-plus',
													verticaldownclass: 'glyphicon glyphicon-minus'
												});
											</script>
										</div>
										<div class="form-group" style="padding:10px; margin-top: -15px;">
											<label>Masa Pakai</label><sup> ( tahun )</sup>
											<input class="form-control" id="dur" name="dur" type="text" value="0" required />
											<script>
												$("input[name='dur']").TouchSpin({
												verticalbuttons: true,
													postfix: 'Tahun',
												verticalupclass: 'glyphicon glyphicon-plus',
												verticaldownclass: 'glyphicon glyphicon-minus'
												});
											</script>
										</div>
										<div class="form-group" style="padding:10px; margin-top: -15px;">
											<label>Jenis</label>
											<select class="form-control" name="type" id="type" required>
												<option value="">- Pilih Jenis Lapak -</option>
												<option value="Sayur">Sayur</option>
												<option value="Buah">Buah</option>
												<option value="Lainnya">Lainnya</option>
											</select>
										</div>
										<div class="form-group" style="padding:10px; margin-top: -10px; margin-bottom: -10px;">
											<center><button type="submit" class="btn btn-outline btn-block btn-primary">Simpan</button></center>
										</div>
									</fieldset>
								</form> 
							</div>
						</div>
					</div>
					<div class="col-md-9" style="margin-top:20px;">
						<div id="Area1">
							<div class="alert alert-info" onclick="clearNotif()">
								<center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Main Content ============================================================================================================== -->
		</div>

		<script>
			$(document).ready(function(){
				// Auto Refresh Page
				$("#notifArea").html(alertLoadProcess);
				$('#Area1').load("lapak_table.php",function(){clearNotif();});
				setTimeout('$("html").removeClass("js")',1000); 
			});
			function clearNotif(){$("#notifArea").html("");}
		</script>

		<!-- jQuery -->
		<script src="js/jquery.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		<!-- Metis Menu Plugin JavaScript -->
		<script src="js/plugins/metisMenu/metisMenu.min.js"></script>
		<!-- Custom Theme JavaScript -->
		<script src="js/sb-admin-2.js"></script>
	</body>
</html>