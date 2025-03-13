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
	<?php 
		$id		= $_GET['id'];
		$edit	= mysql_query("select * from request where req_id = '".$id."'");
		while($r = mysql_fetch_array($edit)){
	?>
    <div id="wrapper">
	<?php include "components/sidebar.php" ?>

		<div id="page-wrapper">
		<br><br><br><br>
            <div class="row">
                <div class="col-lg-12" style="padding:10px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-pencil fa-fw"></i> Permohonan Menempati Lapak PIOS
                        </div>
                        <div class="panel-body">
                            	<fieldset>
								<div class="col-lg-4" style="padding:10px; margin-top:-20px; margin-bottom:-10px;">
								<form action="register_action.php?task=update&id=<?php echo $id; ?>" id="formRegisterAcc" name = "formRegisterAcc" method="POST" class="form-horizontal">
									<div class="form-group" style="padding:10px; margin-right:10px;">
										<label>No. PL</label>
										<input id="pl" name="pl" value="<?php 
											$idq = sprintf("%03d", $id);echo 'PL'.$idq; ?>" type="text" class="form-control" disabled /> 
										<br />
										<label>Nama</label>
										<input id="name1" name="name1" value="<?php echo $r['req_name']; ?>" type="text" class="form-control" required /> 
										<input id="name2" name="name2" value="<?php echo $r['req_nick']; ?>" type="text" class="form-control" > 
										<br />
										<label>Alamat</label>
										<input id="adrs1" name="adrs1" value="<?php echo $r['address1']; ?>" type="text" class="form-control" required />
										<input id="adrs2" name="adrs2" value="<?php echo $r['address2']; ?>" type="text" class="form-control" required />
										
									</div>
								</div>
								<div class="col-lg-4" style="padding:10px; margin-top:-20px; margin-bottom:-10px;">
									<div class="form-group" style="padding:10px; margin-right:10px;">
										<label>Telepon</label>
										<input id="tlp1" name="tlp1" value="<?php echo $r['phone1']; ?>" maxlength="10" onkeydown="return isNumber(event);" type="text" class="form-control" />
										<input id="tlp2" name="tlp2" value="<?php echo $r['phone2']; ?>" maxlength="13" onkeydown="return isNumber(event);" type="text" class="form-control" />
										<br />
										<label>No Identitas</label>
										<input id="ktp" name="ktp" value="<?php echo $r['nid_ktp']; ?>" maxlength="16" onkeydown="return isNumber(event);" type="text" class="form-control" />
										<input id="sim" name="sim" value="<?php echo $r['nid_sim']; ?>" maxlength="12" onkeydown="return isNumber(event);" type="text"  class="form-control" />
										<input id="lain" name="lain" value="<?php echo $r['nid_lain']; ?>"  maxlength="20" onkeydown="return isNumber(event);" type="text" class="form-control"/>
										<select class="form-control" name="nid" id="nid">
											<option value="<?php echo $r['nid_type']; ?>"><?php echo $r['nid_type']; ?></option>
											<option value="KTP">KTP</option>
											<option value="SIM">SIM</option>
											<option value="PASPOR">PASPOR</option>
											<option value="Pelajar">Kartu Pelajar/Mahasiswa</option>
											<option value="Lainnya">Lainnya</option>
										</select>
									</div>
								</div>
								<div class="col-lg-4" style="padding:10px; margin-top:-20px; margin-bottom:-10px;">
									<div class="form-group" style="padding:10px;">
										<label>Lapak</label>
										<select class="form-control" name="lapak" id="lapak">
											<?php 
												$lapak 	= mysql_query("select lapak_id, lapak_name, lapak_type from lapak where lapak_id='".$r['lapak_id']."'");
												while($d = mysql_fetch_array($lapak)){
													echo '<option value="'.$d['lapak_id'].'">'.$d['lapak_name'].' / '.$d['lapak_type'].'</option>';
												}
												$sql 		= mysql_query("select lapak_id, lapak_name, lapak_type from lapak where lapak_status = 'Kosong'");
												while($data = mysql_fetch_array($sql)){?>
												<option value="<?php echo $data['lapak_id'];?>"><?php echo $data['lapak_name'].' / '.$data['lapak_type'];?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group" style="padding:10px; margin-top:-20px;">
										<label>Jenis Jualan</label>
										<select class="form-control" name="type" id="type">
											<option value="<?php echo $r['merchant_type']; ?>"><?php echo $r['merchant_type']; ?></option>
											<option value="Sayur">Sayur</option>
											<option value="Buah">Buah</option>
											<option value="Sembako">Sembako</option>
											<option value="Lainnya">Lainnya</option>
										</select>
									</div>
									<div class="form-group" style="padding:10px; margin-top:-20px;">
										<center>
											<button type="submit" class="btn btn-outline btn-block btn-primary">Ubah Data</button>
										</center>
									</form>
										<center>
											<a href="htmltopdf/permohonan_pedagang.php?id=<?php echo $id;?>" target="_blank">
												<button style="margin-top:10px;" class="btn btn-outline btn-block btn-info" type="button">
													Cetak Form Permohonan
												</button>
											</a>
										</center>
										<?php 
											if($r['req_status']!='Disetujui'){
												echo '<center>
												<a href="register_acc2.php?id='.$id.'">
													<button style="margin-top:10px;" class="btn btn-outline btn-block btn-primary">Setujui (Ke form Selanjutnya)</button>
												</a></center>';
											}
											else{
												echo '';
											}
										?>
									</div>
								</div>
								</fieldset>
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
		function print(){
			window.location=('weighing_action.php?task=merge&id=<?php echo $r['merchant_id']; ?>');
		}
		function clearNotif(){$("#notifArea").html("");}
    </script>
	
	<?php }?>
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
