<?php
	session_start();
	include "connection.php";
	//Validasi role
	if($_SESSION['role']!='admin'){
		if($_SESSION['role']!='super_admin'){
			header("Location:index.php");
		}
	}
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
    <title>Permohonan Lapak Baru | PISS</title>

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
	<!-- CSS Search dropdown -->
	<link href="css/plugins/chosen/chosen.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="js/jquery.min.js"></script>
	<script language="javascript">
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
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Admin PISS</a>
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
								<li><a href="block.php"><i class="fa fa-sort-alpha-asc fa-fw"></i> Blok</a></li>
								<li><a href="instalment.php"><i class="fa fa-clock-o fa-fw"></i> Jangka Waktu Angsuran</a></li>
							</ul>
						</li>
						<li class="active">
                            <a href="#"><i class="fa fa-users fa-fw"></i> Pedagang<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a class="active" href="register.php"><i class="fa fa-user-plus fa-fw"></i> Pendaftaran Lapak Baru</a></li>
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
						<li >
                            <a href="#"><i class="fa fa-retweet fa-fw"></i> Perpindahan lapak<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="move_select.php"><i class="fa fa-retweet fa-fw"></i> Pindah Ke Lapak Kosong</a></li>
								<li><a href="move_select2.php"><i class="fa fa-retweet fa-fw"></i> Tukar Lapak</a></li>
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
                <div class="col-lg-12" style="padding:10px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-pencil fa-fw"></i> Permohonan Menempati Lapak Pasar Induk Surabaya Sidotopo
                        </div>
                        <div class="panel-body">
                            <form action="register_action.php?task=insert"  id="formRegister" name = "formRegister" method="POST" class="form-horizontal">
								<fieldset>
								<div class="col-lg-3" style="padding:10px; margin-top:-20px; margin-bottom:-10px;">
									<div class="form-group" style="padding:10px; margin-right:5px;">
										<label>Nama</label>
										<input id="name1" name="name1" placeholder="Nama Sesuai Ktp" type="text" class="form-control" autofocus="autofocus" required> 
										<input id="name2" name="name2" placeholder="Nama Alias" type="text" class="form-control" >                
										<br />
										<label>Alamat</label>
										<input id="adrs1" name="adrs1" placeholder="Alamat Sesuai KTP" type="text" class="form-control" required/>
										<input id="adrs2" name="adrs2" placeholder="Alamat Surat (Tidak Perlu Diisi Jika Sama)" type="text" class="form-control" />
									</div>
								</div>
								<div class="col-lg-3" style="padding:10px; margin-top:-20px; margin-bottom:-10px;">
									<div class="form-group" style="padding:10px; margin-right:5px;">
										<label>Telepon</label>
										<input id="tlp1" name="tlp1" placeholder="Telepon Rumah" maxlength="11" onkeydown="return isNumber(event);" type="text" class="form-control" />
										<input id="tlp2" name="tlp2" placeholder="Handphone (HP)" maxlength="13" onkeydown="return isNumber(event);" type="text" class="form-control" />
										<br />
										<label>Lapak</label>
										<select class="form-control chzn-select" name="lapak" id="lapak" required>
											<option value="">- Pilih Lapak -</option>
											<?php 
												$sql 		= mysql_query("select lapak_id, lapak_name, lapak_type from lapak where lapak_status is null");
												while($data = mysql_fetch_array($sql))
											{?>
												<option value="<?php echo $data['lapak_id'];?>"><?php echo $data['lapak_name'].' / '.$data['lapak_type'];?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-lg-3" style="padding:10px; margin-top:-20px; margin-bottom:-10px;">
									<div class="form-group" style="padding:10px; margin-right:5px;">
										<label>No Identitas</label>
										<input id="ktp" name="ktp" placeholder="KTP" maxlength="16" onkeydown="return isNumber(event);" type="text" class="form-control" />
										<input id="sim" name="sim" placeholder="SIM (Tidak Perlu Diisi Jika Kolom KTP Sudah)" maxlength="12" onkeydown="return isNumber(event);" type="text"  class="form-control" />
										<input id="lain" name="lain" placeholder="Lainnya (Diisi Jika Tidak Ada KTP & SIM)"  maxlength="20" onkeydown="return isNumber(event);" type="text" class="form-control"/>
										<select class="form-control" name="nid" id="nid">
											<option value="">Jenis Identitas Yang Diisi</option>
											<option value="KTP">KTP</option>
											<option value="SIM">SIM</option>
											<option value="PASPOR">PASPOR</option>
											<option value="Pelajar">Kartu Pelajar/Mahasiswa</option>
											<option value="Lainnya">Lainnya</option>
										</select>
									</div>
								</div>
								<div class="col-lg-3" style="padding:10px; margin-top:-20px; margin-bottom:-10px;">
									<div class="form-group" style="padding:10px;">
										<label>Jenis Pedagang</label>
										<select class="form-control" name="kat_merchant" id="kat_merchant" >
											<option value="0" selected disabled>-- Pilih Jenis Pedagang --</option>
											<option value="Tetap">Tetap</option>
											<option value="Trial Lapak">Trial Lapak</option>
											<option value="Trial Lapak Jalan">Trial Lapak Jalan</option>
										</select>
										</br>
										<label>Asal Pasar</label>
										<select class="form-control chzn-select" name="asal_pasar" id="asal_pasar" >
											<option value="0" selected disabled>-- Pilih Asal Pasar --</option>
											<option value="Belum Pernah">Belum Pernah</option>
											<option value="Pasar Osowilangun">Pasar Osowilangun</option>
											<option value="Pasar Pandegiling">Pasar Pandegiling</option>
											<option value="Pasar Keputran">Pasar Keputran</option>
											<option value="Pasar Mangga Dua">Pasar Mangga Dua</option>
											<option value="Pasar Pabean">Pasar Pabean</option>
											<option value="Pasar Pabean">Pasar Wonokusumo</option>
											<option value="Pasar Pabean">Pasar Lainnya</option>
										</select>
									</div>
								</div>
								<div class="form-group" style="padding:10px; margin-bottom:-10px; margin-right:0px; margin-left:0px;">
									<center><button type="submit" class="btn btn-outline btn-block btn-primary">Simpan <i class="fa fa-angle-double-right fa-lg"></i></button></center>
								</div>
								</fieldset>
							</form> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top:10px;">
                    <div id="Area1">
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
			$('#Area1').load("register_table.php",function(){clearNotif();});
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
	<script src="js/plugins/chosen/chosen.jquery.js"></script>
	<script type="text/javascript">
    	$(".chzn-select").chosen({"search_contains": true,"width":"100%", "no_results_text":"Hasil tidak ditemukan !"});
    </script>
</body>
</html>