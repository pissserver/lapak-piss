<?php
	session_start();
	include "connection.php";
	include "components/role_session.php";

	$merchant 	= executeScalar("select count(merchant_id) from merchant");
	$lapak 		= executeScalar("select count(lapak_id) from lapak");
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
    <title>Admin</title>

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
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script>
		/* hide all elements & show preloader*/
		document.documentElement.className += 'js';
		
		/* display variabel */
		var alertLoadProcess = "<span class='alert alert-info' onclick='clearNotif()'><i class='fa fa-spinner fa-spin'></i> Loading...</span>";
	</script>
</head>
<body>
    <div id="wrapper">
    <?php include "components/sidebar.php" ?>

        <div id="page-wrapper">
        <br><br><br><br>
			<div class="row">
				<div class="col-lg-6">
					<br />
					<div id="Area1"><div class="alert alert-info" onclick="clearNotif()"><center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center></div></div>
					<div class="panel panel-primary">
						<div class="panel-heading">
                            <i class="fa fa-book fa-fw"></i> Laporan Data Piutang PerPedagang
                        </div>
						<div class="panel-body">
							<form class="form-horizontal" action="htmltopdf/laporan_piutang.php" id="reportMerchant" name = "reportMerchant" method="POST" target="_blank">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" style="padding:10px; margin-top:-10px;">
											<label>Jenis Pedagang</label>
											<select class="form-control" name="mtype" id="mtype" autofocus="autofocus" required>
												<option value="Semua">Semua</option>
												<?php 
													$sql 		= mysql_query("SELECT distinct(merchant_type) as type_m FROM `merchant`");
													while($data = mysql_fetch_array($sql)){?>
													<option value="<?php echo $data['type_m'];?>"><?php echo $data['type_m'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group" style="padding:10px; margin-top:15px;">
											<center><button type="submit" class="btn btn-outline btn-primary btn-block">Lihat <i class="fa fa-angle-double-right fa-lg"></i></button></center>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading">
                            <i class="fa fa-book fa-fw"></i> Laporan Data Piutang PerLapak
                        </div>
						<div class="panel-body">
							<form class="form-horizontal" action="htmltopdf/laporan_piutang3.php" id="reportMerchant" name = "reportMerchant" method="POST" target="_blank">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" style="padding:10px; margin-top:-10px;">
											<label>Jenis Pedagang</label>
											<select class="form-control" name="mtype" id="mtype" autofocus="autofocus" required>
												<option value="Semua">Semua</option>
												<?php 
													$sql 		= mysql_query("SELECT distinct(merchant_type) as type_m FROM `merchant`");
													while($data = mysql_fetch_array($sql)){?>
													<option value="<?php echo $data['type_m'];?>"><?php echo $data['type_m'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group" style="padding:10px; margin-top:15px;">
											<center><button type="submit" class="btn btn-outline btn-primary btn-block">Lihat <i class="fa fa-angle-double-right fa-lg"></i></button></center>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<br />
					<div id="Area2"><div class="alert alert-info" onclick="clearNotif()"><center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center></div></div>
					<div class="panel panel-primary">
						<div class="panel-heading">
                            <i class="fa fa-book fa-fw"></i> Laporan Data Piutang Pedagang Per Block
                        </div>
						<div class="panel-body">
							<form class="form-horizontal" action="htmltopdf/laporan_piutang2.php" id="reportMerchant" name = "reportMerchant" method="POST" target="_blank">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" style="padding:10px; margin-top:-10px;">
											<label>Blok</label>
											<select class="form-control" name="block" id="block" autofocus="autofocus" required>
												<option value="">- Pilih Block -</option>
												<?php 
													$sql 		= mysql_query("select block_id from block");
													while($data = mysql_fetch_array($sql)){?>
													<option value="<?php echo $data['block_id'];?>"><?php echo $data['block_id'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group" style="padding:10px; margin-top:15px;">
											<center><button type="submit" class="btn btn-outline btn-primary btn-block">Lihat <i class="fa fa-angle-double-right fa-lg"></i></button></center>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
	
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
	<!-- highcharts -->
	<script src="highcharts/js/highcharts.js"></script>
	<script src="highcharts/js/highcharts-more.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>
	<script>
		$(document).ready(function(){
			$("#notifArea").html(alertLoadProcess);
			setTimeout('$("html").removeClass("js")',1000); 
			loadChart();
			
			//Modal Password
			$('#modalPassword').on('shown.bs.modal', function (e) {
				$("#notifArea").html(alertLoadProcess);
				$("#data_password").load("password.php",function(){clearNotif();});
			})
		});
		//Meload Chart
		function loadChart(){
			$("#notifArea").html(alertLoadProcess);
			$("#Area1").load("line_revenue1.php",function(){clearNotif();});
			$("#Area2").load("line_report_merchant2.php",function(){clearNotif();});
			//$("#Area5").load("line_block5.php",function(){clearNotif();});
		}
		function clearNotif(){$("#notifArea").html("");}
    </script>
</body>
</html>