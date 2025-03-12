<?php
	include "connection.php";
	//Validasi role
	session_start();
	if($_SESSION['role']!='admin'){
		if($_SESSION['role']!='super_admin'){
			header("Location:login.html");
		}
	}
	//$id		= $_GET['id'];
	$edit	= mysql_query("select * from merchant where merchant_id = '".$_GET['id']."'");
	while ($r = mysql_fetch_array($edit)){
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
		var alertLoadProcess = "<span class='alert alert-danger' onclick='clearNotif()'><i class='fa fa-spinner fa-spin'></i> Loading...</span>";
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
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
						<li class="active">
                            <a href="#"><i class="fa fa-users fa-fw"></i> Pedagang<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="register.php"><i class="fa fa-user-plus fa-fw"></i> Pendaftaran Lapak Baru</a></li>
								<li><a href="register2.php"><i class="fa fa-user-plus fa-fw"></i> Pendaftaran Tambah Lapak</a></li>
								<li><a href="register_view.php"><i class="fa fa-user-plus fa-fw"></i> Permohonan Yg Disetujui</a></li>
								<li><a class="active" href="merchant.php"><i class="fa fa-users fa-fw"></i> Data Pedagang</a></li>
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
                            <i class="fa fa-user fa-fw"></i> Detail Data Pedagang (<b><?php echo $r['merchant_id']; ?></b>)
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" id="formMerchant" name = "formMerchant" method="POST" action="merchant_action.php?task=update&id=<?php echo $r[0]; ?>">
								<fieldset>
								<div class="row">
									<div class="col-lg-3" style="margin-top:-10px;">
										<div class="form-group" style="padding:10px;">
											<label>Nama</label>
											<input type="text" class="form-control" id="name" name="name" value="<?php echo $r['merchant_name']; ?>">                
										</div>
										<div class="form-group" style="padding:10px;margin-top:-20px;">
											<label>Alias</label>
											<input type="text" class="form-control" id="nick" name="nick" value="<?php echo $r['merchant_nick']; ?>">
										</div>
										<div class="form-group" style="padding:10px;margin-top:-20px;">
											<label>Alamat (KTP)</label>
											<input class="form-control" id="adrs1" name="adrs1" type="text" value="<?php echo $r['address1']; ?>" />
										</div>
										<div class="form-group" style="padding:10px;margin-top:-20px;">
											<label>Alamat (Surat)</label>
											<input class="form-control" id="adrs2" name="adrs2" type="text" value="<?php echo $r['address2']; ?>" />
										</div>
									</div>
									<div class="col-lg-3" style="margin-top:-10px;">
										<div class="form-group" style="padding:10px;">
											<label>Telepon Rumah</label>
											<input id="tlp1" name="tlp1" value="<?php echo $r['phone1']; ?>" maxlength="11" onkeydown="return isNumber(event);" type="text" class="form-control" />
										</div>
										<div class="form-group" style="padding:10px;margin-top:-20px;">
											<label>Handphone</label>
											<input id="tlp2" name="tlp2" value="<?php echo $r['phone2']; ?>" maxlength="13" onkeydown="return isNumber(event);" type="text" class="form-control" />
										</div>
										<div class="form-group" style="padding:10px;margin-top:-20px;">
											<label>Jenis Jualan</label>
											<select class="form-control" name="type" id="type">
												<option value="<?php echo $r['merchant_type']; ?>"><?php echo $r['merchant_type']; ?></option>
												<option value="Sayur">Sayur</option>
												<option value="Buah">Buah</option>
												<option value="Lainnya">Lainnya</option>
											</select>
										</div>
										<div class="form-group" style="padding:10px;margin-top:-20px;">
										<label>Status Pedagang</label>
											<div class="row">
												<div class="col-lg-6">
													<select class="form-control" name="sts" id="sts" disabled>
														<option value="<?php echo $r['merchant_status'];?>"><?php echo $r['merchant_status'];?></option>
														<option value="Aktif">Aktif</option>
														<option value="Tidak Aktif">Tidak Aktif</option>
													</select>
												</div>
												<div class="col-lg-6">
													<select class="form-control" name="sts2" id="sts2">
														<option value="<?php echo $r['merchant_status2'];?>"><?php echo $r['merchant_status2'];?></option>
														<option value="Lama Sewa">Lama Sewa</option>
														<option value="Baru Sewa">Baru Sewa</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3" style="margin-top:-10px;">
										<div class="form-group" style="padding:10px;">
											<label>No Identitas</label>
											<input id="ktp" name="ktp" <?php 
												if($r['nid_ktp']!=''){
													echo 'value="'.$r['nid_ktp'].'"';
												}
												else{ 
													echo 'placeholder="KTP"';
												} ?> maxlength="16" onkeydown="return isNumber(event);" type="text" class="form-control" />
											<br /><input id="sim" name="sim" 
											<?php 
												if($r['nid_sim']!=''){
													echo 'value="'.$r['nid_sim'].'"';
												}
												else{
													echo 'placeholder="SIM"';
												} ?> maxlength="12" onkeydown="return isNumber(event);" type="text"  class="form-control" />
											<br /><input id="lain" name="lain" 
											<?php 
												if($r['nid_lain']!=''){
													echo 'value="'.$r['nid_lain'].'"';
												}
												else{
													echo 'placeholder="Lainnya"';
												} ?>maxlength="20" onkeydown="return isNumber(event);" type="text" class="form-control"/>
											<br />
											<select class="form-control" name="nid" id="nid">
												<option value="<?php echo $r['nid_type']; ?>">
												<?php if($r['nid_type']==''){
													echo '- Pilih Jenis Identitas -';
												}
												else{
													echo $r['nid_type'];
												} ?>
												</option>
												<option value="KTP">KTP</option>
												<option value="SIM">SIM</option>
												<option value="PASPOR">PASPOR</option>
												<option value="Pelajar">Kartu Pelajar/Mahasiswa</option>
												<option value="Lainnya">Lainnya</option>
											</select>
										</div>
										<div class="form-group" style="padding:10px;margin-top:0px;">
											<label>Blok Yang Aktif: <?php echo $r['active_block'];?></label>
										</div>
									</div>
									<div class="col-lg-3" style="margin-top:-10px;">
										<div class="form-group" style="padding:10px;">
											<label>Jenis Pedagang</label>
											<select class="form-control" name="kat_merchant" id="kat_merchant">
												<option value="<?php echo $r['kat_merchant']; ?>">
												<?php if($r['kat_merchant'] == ''){
													echo '-- Pilih Jenis Pedagang --';
												}
												else{
													echo $r['kat_merchant'];
												} ?>
												</option>
												<option value="Tetap">Tetap</option>
												<option value="Trial Lapak">Trial Lapak</option>
												<option value="Trial Lapak Jalan">Trial Lapak Jalan</option>
											</select>
										</div>
										<div class="form-group" style="padding:10px;">
											<label>Asal Pasar</label>
											<select class="form-control" name="asal_pasar" id="asal_pasar">
												<option value="<?php echo $r['asal_pasar']; ?>">
												<?php if($r['asal_pasar'] == ''){
													echo '-- Pilih Asal Pasar --';
												}
												else{
													echo $r['asal_pasar'];
												} ?>
												</option>
												<option value="Belum Pernah">Belum Pernah</option>
												<option value="Pasar Osowilangun">Pasar Osowilangun</option>
												<option value="Pasar Pandegiling">Pasar Pandegiling</option>
												<option value="Pasar Keputran">Pasar Keputran</option>
												<option value="Pasar Mangga Dua">Pasar Mangga Dua</option>
												<option value="Pasar Pabean">Pasar Pabean</option>
											</select>
										</div>
									</div>
									<center>
										<button style="margin-top:10px;" class="btn btn-outline btn-block btn-primary">Simpan</button>
									</center>
								</div>
								</fieldset>
							</form> 
                        </div>
                    </div>
					<?php
						$query1	= mysql_query("select lapak_id from rent where merchant_id = '".$_GET['id']."' and (rent_sts2 != 'Batal' && rent_sts2 != 'Pindah')");
						while ($q1 = mysql_fetch_array($query1)){
							$lid	= $q1['lapak_id'];
							$rid	= executeScalar("select rent_id from rent where merchant_id = '".$_GET['id']."' and lapak_id = '".$lid."' and (rent_sts2 != 'Batal' && rent_sts2 != 'Pindah')");
							
							$query2	= mysql_query("select * from rent where rent_id = '".$rid."'");
							while ($q2 = mysql_fetch_array($query2)){
								$iid 	= executeScalar("select instalment_id from rent where rent_id = '".$rid."'");
								$ins 	= executeScalar("select instalment_count from instalment where instalment_id = '".$iid."'");
								
								$query3	= mysql_query("select * from lapak where lapak_id = '".$lid."'");
								while ($q3 = mysql_fetch_array($query3)){
					?>
						<div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-building fa-fw"></i> Detail Data Lapak (<b><?php echo $q3['lapak_name'];?></b>)
                        </div>
                        <div class="panel-body">
							<div class="row">
								<div class="col-lg-3">
									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>Block</label>
										<input type="text" class="form-control" value="<?php echo $q3['block_id'];?>" disabled>
											</div>
											<div class="col-md-6" >
										<label>Lokasi</label>
										<input type="text" class="form-control" value="<?php echo $q3['lapak_name'];?>" disabled>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Masa Pakai</label>
										<input type="text" class="form-control" value="<?php echo $q3['duration'];?> Tahun" disabled>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>Panjang</label>
												<input class="form-control" value="<?php echo $q3['p']; ?> M" disabled />
											</div>
											<div class="col-md-6" >
												<label>Lebar</label>
												<input class="form-control" value="<?php echo $q3['l'];?> M" disabled />
											</div>
										</div>
									</div>
									<div class="form-group" >
										<label>Harga Per M<sup>2</sup></label>
										<input class="form-control" type="text" value="<?php echo format_rupiah($q3['lapak_price']);?>" disabled />
									</div>
									<div class="form-group" >
										<label>Harga Total</label>
										<input class="form-control" type="text" value="<?php echo format_rupiah($q3['lapak_total']);?>" disabled />
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label>DP</label>
										<input type="text" class="form-control" value="<?php echo format_rupiah($q2['rent_dp']);?>" disabled>    
									</div>
									<div class="form-group" >
										<label>Sisa Pembayaran</label>
										<input type="text" class="form-control" value="<?php echo format_rupiah($q2['leftover']);?>" disabled>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6" >
												<label>Angsuran</label>
												<input class="form-control" value="<?php echo $ins;?>x" disabled />
											</div>
											<div class="col-md-6" >
												<label>Bunga /Tahun</label>
												<input class="form-control" value="<?php echo $q2['interest'];?> %" disabled />
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Jumlah Yg Harus Diangsur</label>
										<input type="text" class="form-control" value="<?php echo format_rupiah($q2['leftover2']);?>" disabled>   
									</div>
									<div class="form-group" >
										<label>Cicilan Perbulan</label>
										<input type="text" class="form-control" value="<?php echo format_rupiah($q2['rent_instalment']);?>" disabled>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group" >
										<label>Tanggal Masuk</label>
										<input type="text" class="form-control" value="<?php echo date("d-m-Y", strtotime($q2['rent_date']));?>" disabled>                
									</div>
									<div class="form-group" >
										<label>Tanggal Berakhir</label>
										<input type="text" class="form-control" value="<?php echo date("d-m-Y", strtotime($q2['rent_expired']));?>" disabled>
									</div>
									<div class="form-group" >
										<label>Jatuh Tempo Angsuran</label>
										<input type="text" class="form-control" value="<?php echo date("d-m-Y", strtotime($q2['rent_dl']));?>" disabled>
									</div>
									<div class="form-group" >
										<label>Status Lapak</label>
										<input type="text" class="form-control" value="<?php echo $q2['rent_sts']; ?>" disabled>                
									</div>
									<div class="form-group" >
										<label>Status Lapak 2</label>
										<input type="text" class="form-control" value="<?php echo $q2['rent_sts2']; ?>" disabled>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group" >
										<label>Keterangan</label><br />
										<textarea class="form-control" cols="20" rows="5" disabled><?php echo $q2['rent_desc'];?></textarea>
									</div>
									<div class="form-group" >
										<form action="htmltopdf/instalment_table.php?id=<?php echo $q2['rent_id']; ?>" target="_blank" class="form-horizontal" id="formAngs" name="formAngs" method="POST">
											<center>
												<button style="margin-top:35px;" class="btn btn-outline btn-block btn-primary">Cetak Tabel Angsuran</button>
											</center>
										</form>
									</div>
								</div>
							</div>
						</div>
                    </div>
					<?php } } } ?>
                </div>
            </div>
        </div>
    </div>

	<script>
    $(document).ready(function(){
			// Auto Refresh Page
			$("#notifArea").html(alertLoadProcess);
			$('#Area1').load("employee_table.php",function(){clearNotif();});
			setTimeout('$("html").removeClass("js")',1000); 
		});
		function clearNotif(){$("#notifArea").html("")};
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
<?php }?>