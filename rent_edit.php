<?php
	session_start();
	include "connection.php";
	//Validasi role
	if($_SESSION['role']!='admin'){
		if($_SESSION['role']!='super_admin'){
			header("Location:index.php");
		}
	}
	//Ambil id_rent
	$id		= $_GET['id'];
	$lid 	= executeScalar("select lapak_id from rent where rent_id = '".$id."'");
	$mid 	= executeScalar("select merchant_id from rent where rent_id = '".$id."'");
	$lapak 	= executeScalar("select lapak_name from lapak where lapak_id = '".$lid."'");
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
						<li class="active">
                            <a href="#"><i class="fa fa-money fa-fw"></i> Angsuran Lapak<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a class="active" href="rent.php"><i class="fa fa-money fa-fw"></i> Pembayaran Angsuran</a></li>
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
			<div class="panel panel-primary">
				<div class="panel-heading">
					<i class="fa fa-pencil fa-fw"></i> Data Angsuran Pedagang <?php echo $mid; ?>
				</div>
				<div class="panel-body">
					<?php
						$sql 	= mysql_query("select * from rent r, merchant m, lapak l
								where r.rent_id = '".$id."' and r.merchant_id = m.merchant_id and
								r.lapak_id = l.lapak_id and rent_sts != 'Batal'");
						while($r = mysql_fetch_array($sql)){
						$ins 	= executeScalar("select instalment_count from instalment where instalment_id = '".$r['instalment_id']."'");
						$did 	= executeScalar("select count(rent_id) from rent_detail where rent_id = '".$id."'");
						$did	= $did+1;
						
						//Cek Sisa Angsuran
						$pay	 	= executeScalar("select sum(cash_total) from rent_detail where rent_id = '".$r['rent_id']."'");
						$leftover3	= $r['leftover2']-$pay;
						
						//generate tgl jatuh tempo
						$date_in 	= $r['rent_date'];
						$date_plus	= $did.' month';
						$exp 		= strtotime($date_plus, strtotime($date_in));
						$dateline 	= date('Y-m-j' , $exp);
					?>
					<div class="col-lg-4" style="padding:10px; margin-bottom:-20px;">
						<div class="form-group" style="padding:10px; margin-top:-20px;">
							<label>Nama</label>
							<div><?php echo $r['merchant_name']; ?> / <?php echo $r['merchant_nick']; ?></div>               
						</div>
						<div class="form-group" style="padding:10px; margin-top:-20px;">
							<label>Alamat</label>
							<div><?php echo $r['address1']; ?></div>
						</div>
						<div class="form-group" style="padding:10px; margin-top:-20px;">
							<label>Telepon</label>
							<div><?php echo $r['phone1']; ?> / <?php echo $r['phone2']; ?></div>
						</div>
						<div class="form-group" style="padding:10px; margin-top:-20px;">
							<label>No Identitas</label>
							<div><?php echo $r['nid_ktp'].$r['nid_sim'].$r['nid_lain']; ?> <?php if($r['nid_type']!=''){echo '('.$r['nid_type'].')';} ?></div>
						</div>
						<div class="form-group" style="padding:10px; margin-top:-20px;">
							<label>Jenis Jualan</label>
							<div><?php echo $r['merchant_type']; ?></div>
						</div>
						<div class="form-group" style="padding:10px; margin-top:-20px;">
							<label>Tanggal Masuk</label>
							<div><?php echo date("d-m-Y", strtotime($r['rent_date'])); ?></div>
						</div>
					</div>
					<div class="col-lg-5" style="padding:10px; margin-bottom:-20px;">
						<div class="form-group" style="padding:10px; margin-top:-20px;">
							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-6">
											<label>Lapak</label>
											<div><?php echo $r['lapak_name']; ?></div>
										</div>
										<div class="col-md-6" style="text-align:left;">
											<label>Ukuran</label>
											<div><?php echo $r['lapak_size']; ?> M<sup>2</sup></div>
										</div>
									</div>
								</div>
								<div class="col-md-6" style="text-align:left;">
									<div class="row">
										<div class="col-md-6">
											<label>Angsuran</label>
											<div><?php echo $ins; ?>x</div>
										</div>
										<div class="col-md-6">
											<label>Bunga</label>
											<div><?php echo $r['interest']; ?>%</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group" style="padding:10px; margin-top:-20px;">
							<div class="row">
								<div class="col-md-6">
									<label>Harga /M<sup>2</sup></label>
									<div><?php echo format_rupiah($r['lapak_price']); ?></div>
								</div>
								<div class="col-md-6" style="text-align:left;">
									<label>Total Harga</label>
									<div><?php echo format_rupiah($r['rent_total']); ?></div>
								</div>
							</div>
						</div>
						<div class="form-group" style="padding:10px; margin-top:-20px;">
							<div class="row">
								<div class="col-md-6">
									<label>Pembayaran DP</label>
									<div><?php echo format_rupiah($r['rent_dp']); ?></div>
								</div>
								<div class="col-md-6" >
									<label>Sisa Pokok</label>
									<div><?php echo format_rupiah($r['leftover']);?></div>
								</div>
							</div>
						</div>
						<div class="form-group" style="padding:10px; margin-top:-20px;">
							<div class="row">
								<div class="col-md-6">
									<label>Total Angsuran</label>
									<div><?php echo format_rupiah($r['leftover2']); ?></div>
								</div>
								<div class="col-md-6">
									<label>Angsuran Perbulan</label>
									<div><?php echo format_rupiah($r['rent_instalment']); ?></div>
								</div>
							</div>
						</div>
						<div class="form-group" style="padding:10px; margin-top:-20px;">
							<div class="row">
								<div class="col-md-6">
									<label>Sisa Angsuran</label>
									<div><?php echo format_rupiah($leftover3); ?></div>
								</div>
								<div class="col-md-6">
									<label>Kajian</label>
									<div><?php echo $r['rent_desc']; ?></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3" style="padding:10px; margin-bottom:-30px;">
						<?php 
							//Jika Angsuran Telat
							if($r['rent_dl']<$date_now){
								//Hitung Perbedaan Tanggal
								$diff 	= abs(strtotime($r['rent_dl']) - strtotime($date_now));
								
								$years	= floor($diff / (365*60*60*24));
								$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
								$days 	= floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
								if($years==0){
									$a = '';
								}
								else{
									$a = $years.' Tahun';
								}
								echo '<div class="panel panel-danger" style="margin-top:-10px;">
										<div class="panel-body" style="margin-top:-10px;">
											<label>Keterangan Angsuran</label>
											Angsuran Lapak Ini Terlambat <br />
											'.$a.' '.$months.' Bulan '.$days.' Hari <br /><br />
											<label>Total Angsuran (Terlambat)</label>
										</div>
									</div>';
							}
							//Jika Angsuran Telah Lunas
							$angsrn = executeScalar("select sum(trans_total+cash_total) from rent_detail where rent_id = '".$id."'");
							$lo2 	= executeScalar("select leftover2 from rent where rent_id = '".$id."'");
							if($angsrn>=$lo2){
								echo '<div class="panel panel-info">
									<div class="panel-body" style="margin-top:-10px;">
										<label>Angsuran Lapak Ini Telah Lunas</label>
									</div>
								</div>';
							}
							else{
						?>
						<form id="formInstalment" name="formInstalment" method="POST" action="rent_action.php?task=ins&id=<?php echo $id; ?>" class="form-horizontal" >
							<div class="panel panel-info">
								<div class="panel-body" style="margin-top:-10px;">
									<div class="form-group" style="padding:10px; margin-top:-10px;">
										<label>Pembayaran Angsuran Ke-<?php echo $did; ?></label>
										<div><?php echo format_rupiah($r['rent_instalment']); ?></div>
									</div>
									<div class="form-group" style="padding:10px; margin-top:-20px;">
										<label>Jatuh Tempo</label>
										<div><?php echo date("d-m-Y", strtotime($dateline)); ?></div>
									</div>
									<div class="form-group" style="padding:10px; margin-top:-20px; margin-bottom:-10px;">
										<!--<button type="submit" class="btn btn-outline btn-block btn-primary">Bayar Cicilan</button>-->
										<label>Pilih Jenis Pembayaran</label>
										<select class="form-control" id="mySelect" onchange="switchTime()">
											<option value="">- Jenis Pembayaran -</option>
											<option value="cash">Tunai</option>
											<option value="trans">Transfer / Debit</option>
											<option value="cek">Cek</option>
											<option value="giro">Giro</option>
											<option value="combo1">Tunai & Transfer</option>
											<!--<option value="combo1">Tunai & Debit</option>-->
										</select>
									</div>
								</div>
							</div>
						</form>
						<?php }?>
					</div>
					<?php }?>
				</div>
			</div>
			<div id="Area1"></div>
			<div class="panel panel-info">
				<?php
					$sql2	= mysql_query("select * from rent_detail where rent_id = '".$id."' order by rent_detail_id desc");
					while($r2 = mysql_fetch_array($sql2)){
						//generate tgl jatuh tempo
						$date_in 	= executeScalar("select rent_date from rent where rent_id = '".$id."'");
						$date_plus	= $r2['instalment_no'].' month';
						$exp 		= strtotime($date_plus, strtotime($date_in));
						$dateline 	= date('Y-m-j' , $exp);
				?>
				<div class="panel-heading">
					<i class="fa fa-money fa-fw"></i> Pembayaran Angsuran Ke-<?php echo $r2['instalment_no'];?>
				</div>
				<div class="panel-body">
					<form id="formIns" method="POST" action="htmltopdf/Angsuran.php?id=<?php echo $r2['rent_detail_id']; ?>" target="_blank" class="form-horizontal" >
						<div class="col-lg-2" style="padding:10px; margin-bottom:-20px;">
							<div class="form-group" style="padding:10px; margin-top:-20px;">
								<label>Tanggal Jatuh Tempo</label>
								<div><?php echo date("d-m-Y", strtotime($dateline)); ?></div>               
							</div>
						</div>
						<div class="col-lg-2" style="padding:10px; margin-bottom:-20px;">
							<div class="form-group" style="padding:10px; margin-top:-20px;">
								<label>Tanggal Pembayaran</label>
								<div><?php echo date("d-m-Y", strtotime($r2['rent_detail_date'])); ?></div>               
							</div>
						</div>
						<div class="col-lg-2" style="padding:10px; margin-bottom:-20px;">
							<div class="form-group" style="padding:10px; margin-top:-20px;">
								<label>Jumlah Pembayaran</label>
								<div><?php echo format_rupiah($r2['cash_total']+$r2['trans_total']); ?></div>               
							</div>
						</div>
						<div class="col-lg-2" style="padding:10px; margin-bottom:-20px;">
							<div class="form-group" style="padding:10px; margin-top:-20px;">
								<label>Metode Pembayaran</label>
								<div><?php echo $r2['rent_detail_type']; ?></div>               
							</div>
						</div>
						<div class="col-lg-2" style="padding:10px; margin-bottom:-20px;">
							<div class="form-group" style="padding:10px; margin-top:-10px;">
								<button class="btn btn-outline btn-block btn-info">Lihat Detail</button>
							</div>
						</div>
						<div class="col-lg-2" style="padding:10px; margin-bottom:-20px;">
							<div class="form-group" style="padding:10px; margin-top:-10px;">
								<button type="submit" class="btn btn-outline btn-block btn-primary">Cetak</button>
							</div>
						</div>
					</form>
				</div>
				<?php }?>
			</div>
		</div>
    </div>

	<script>
		$(document).ready(function(){
			// Auto Refresh Page
			$("#notifArea").html(alertLoadProcess);
			setTimeout('$("html").removeClass("js")',1000); 
		});
		//Ganti Type Pembayaran
		function switchTime() {
			var x = document.getElementById("mySelect").value;
			
			if(x==""){
				$("#notifArea").html(alertLoadProcess);
				$("#Area1").load("blank.php",function(){clearNotif();});
			}
			else if(x=="cash"){
				$("#notifArea").html(alertLoadProcess);
				$("#Area1").load("cash.php?id=<?php echo $id; ?>",function(){clearNotif();});
			}
			else if(x=="trans"){
				$("#notifArea").html(alertLoadProcess);
				$("#Area1").load("trans.php?id=<?php echo $id; ?>",function(){clearNotif();});
			}
			else if(x=="cek"){
				$("#notifArea").html(alertLoadProcess);
				$("#Area1").load("cek.php?id=<?php echo $id; ?>",function(){clearNotif();});
			}
			else if(x=="giro"){
				$("#notifArea").html(alertLoadProcess);
				$("#Area1").load("giro.php?id=<?php echo $id; ?>",function(){clearNotif();});
			}
			else if(x=="combo1"){
				$("#notifArea").html(alertLoadProcess);
				$("#Area1").load("combo1.php?id=<?php echo $id; ?>",function(){clearNotif();});
			}
			else if(x=="combo2"){
				$("#notifArea").html(alertLoadProcess);
				$("#Area1").load("combo2.php?id=<?php echo $id; ?>",function(){clearNotif();});
			}
		}
		
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
