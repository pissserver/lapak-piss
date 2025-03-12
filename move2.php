<?php
	session_start();
	include "connection.php";
	//Validasi role
	if($_SESSION['role']!='admin'){
		if($_SESSION['role']!='super_admin'){
			header("Location:login.html");
		}
	}
	
	$m1		= $_POST['m1'];
	$m2		= $_POST['m2'];
	$type1 	= executeScalar("select merchant_type from merchant where merchant_id = '".$m1."'");
	$type2 	= executeScalar("select merchant_type from merchant where merchant_id = '".$m2."'");
	if($m1==$m2){
		echo "<script>window.alert('Pedagang yg sama tidak bisa bertukar tempat');
			window.history.back()</script>";
			exit();
	}
	elseif($type1!=$type2){
		echo "<script>window.alert('Pedagang buah dan pedagang sayur tidak bisa bertukar tempat');
			window.history.back()</script>";
			exit();
	}
	$name1 	= executeScalar("select merchant_name from merchant where merchant_id = '".$m1."'");
	$name2 	= executeScalar("select merchant_name from merchant where merchant_id = '".$m2."'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="icon" href="../images/icon.png">
    <link rel="shortcut icon" href="../images/icon.png" />
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="js/jquery.min.js"></script>
	<script>
		/* hide all elements & show preloader*/
		document.documentElement.className += 'js';

		/* display variabel */
		var alertLoadProcess = "<span class='alert alert-info' onclick='clearNotif()'><i class='fa fa-spinner fa-spin'></i> Loading...</span>";
    </script>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Admin PIOS</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Akun <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
           
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li><a href="dashboard.php"><i class="fa fa-bar-chart fa-fw"></i> Dashboard</a></li>
						<li> 
							<a href="#"><i class="fa fa-building fa-fw"></i> Data Master<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="lapak.php"><i class="fa fa-building fa-fw"></i> Lapak</a></li>
								<li><a href="block.php"><i class="fa fa-sort-alpha-asc fa-fw"></i> Block</a></li>
								<li><a href="instalment.php"><i class="fa fa-clock-o fa-fw"></i> Jangka Waktu Cicilan</a></li>
							</ul>
						</li>
						<li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Pedagang<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="register.php"><i class="fa fa-user-plus fa-fw"></i> Pendaftaran Lapak Baru</a></li>
								<li><a href="register2.php"><i class="fa fa-user-plus fa-fw"></i> Pendaftaran Tambah Lapak</a></li>
								<li><a href="register_view.php"><i class="fa fa-user-plus fa-fw"></i> Permohonan Yg Disetujui</a></li>
								<li><a href="merchant.php"><i class="fa fa-users fa-fw"></i> Data Pedagang</a></li>
							</ul>
						</li>
						<li>
                            <a href="#"><i class="fa fa-money fa-fw"></i> Angsuran Lapak<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="rent.php"><i class="fa fa-money fa-fw"></i> Pembayaran Angsuran</a></li>
								<li><a href="rent2.php"><i class="fa fa-money fa-fw"></i> Angsuran Yg Terlambat</a></li>
							</ul>
						</li>
						<li class="active">
                            <a href="#"><i class="fa fa-retweet fa-fw"></i> Perpindahan lapak<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="move_select.php"><i class="fa fa-retweet fa-fw"></i> Pindah Ke Lapak Kosong</a></li>
								<li><a class="active" href="move_select2.php"><i class="fa fa-retweet fa-fw"></i> Tukar Lapak</a></li>
								<li><a href="move_log.php"><i class="fa fa-book fa-fw"></i> Histori Perpindahan</a></li>
							</ul>
						</li>
						<li>
                            <a href="#"><i class="fa fa-window-close fa-fw"></i> NonAktif<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="nonactive_merchant.php"><i class="fa fa-user-times fa-fw"></i> NonAktif Pedagang</a></li>
								<li><a href="nonactive_lapak.php"><i class="fa fa-window-close-o fa-fw"></i> NonAktif Lapak</a></li>
								<li><a href="nonactive_log.php"><i class="fa fa-book fa-fw"></i> Histori NonAktif</a></li>
							</ul>
						</li>
						<li>
                            <a href="#"><i class="fa fa-book fa-fw"></i> Laporan<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="report_merchant.php"><i class="fa fa-user fa-fw"></i> Data Pedagang</a></li>
								<li><a href="report_credit.php"><i class="fa fa-user fa-fw"></i> Piutang Lapak</a></li>
							</ul>
						</li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-4" style="padding:10px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-plus fa-fw"></i> Pertukaran Lapak
                        </div>
                        <div class="panel-body">
                            <?php 
							?>
							<form class="form-horizontal" id="formHome" name="formHome" method="POST" action="move_action.php?task=move2" >
								<div class="panel panel-primary">
									<div class="panel-body">
										<div class="form-group" style="padding:10px; margin-top:-10px;">
											<label>Pedagang 1</label>
											<input type="text" class="form-control" id="m1" name="m1" value="<?php echo $name1; ?>" disabled>
										</div>
										<div class="form-group" style="padding:10px; margin-top:-10px;">
											<label>Lapak</label>
											<select class="form-control" name="lapak1" id="lapak1" required>
												<option value="">- Lapak Yg Akan Dipindah -</option>
												<?php 
													$sql2 = mysql_query("select l.lapak_id, l.lapak_name from lapak l, rent r where l.lapak_id = r.lapak_id and r.merchant_id = '".$m1."' and (r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal')");
													while($r2 = mysql_fetch_array($sql2)){
												?>
													<option value="<?php echo $r2['lapak_id'];?>"><?php echo $r2['lapak_name'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="panel panel-primary">
									<div class="panel-body">
										<div class="form-group" style="padding:10px; margin-top:-10px;">
											<label>Pedagang 2</label>
											<input type="text" class="form-control" id="m2" name="m2" value="<?php echo $name2; ?>" disabled>
										</div>
										<div class="form-group" style="padding:10px; margin-top:-10px;">
											<label>Lapak Tujuan</label>
											<select class="form-control" name="lapak2" id="lapak2" required>
												<option value="">- Lapak Yg Akan Dipindah -</option>
												<?php 
													$sql3 = mysql_query("select l.lapak_id, l.lapak_name from lapak l, rent r where l.lapak_id = r.lapak_id and r.merchant_id = '".$m2."' and (r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal')");
													while($r3 = mysql_fetch_array($sql3)){
												?>
													<option value="<?php echo $r3['lapak_id'];?>"><?php echo $r3['lapak_name'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group" style="padding:10px; margin-top:-10px; margin-bottom:-10px;">
									<center><button type="submit" class="btn btn-outline btn-block btn-primary">Simpan</button></center>
								</div>
							</form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8" style="margin-top:20px;">
                    <h3>Histori Pindah Lapak</h3>
					<div id="Area2">
						<div class="alert alert-info" onclick="clearNotif()">
							<center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>

	<script>
		$(document).ready(function(){
			// Auto Refresh Page
			$("#notifArea").html(alertLoadProcess);
			$('#Area1').load("merchant_table3.php",function(){clearNotif();});
			$('#Area2').load("move_table.php",function(){clearNotif();});
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
