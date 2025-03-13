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
    <title>Persetujuan Lapak Baru | PISS</title>

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
	</script>
</head>
<body>
    <div id="wrapper">
		<?php include "components/sidebar.php" ?>

		<div id="page-wrapper">
		<br><br><br><br>
            <div class="row">
                <div class="col-lg-12" style="padding:10px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-pencil fa-fw"></i> Permohonan Menempati Lapak Pasar Induk Surabaya Sidotopo
                        </div>
                        <div class="panel-body">
							<?php 
								$id			= $_GET['id'];
								$edit		= mysql_query("select * from request where req_id = '".$id."'");
								
								while($r = mysql_fetch_array($edit)){
								$lapak 		= executeScalar("select lapak_name from lapak where lapak_id = '".$r['lapak_id']."'");
								$price	 	= executeScalar("select lapak_price from lapak where lapak_id = '".$r['lapak_id']."'");
								$duration 	= executeScalar("select duration from lapak where lapak_id = '".$r['lapak_id']."'");
								$total	 	= executeScalar("select lapak_total from lapak where lapak_id = '".$r['lapak_id']."'");
							?>
                            <form action="register_action.php?task=acc&id=<?php echo $id; ?>"  id="formRegisterAcc" name="formRegisterAcc" method="POST" class="form-horizontal">
								<fieldset>
								<div class="col-lg-4" style="padding:10px; margin-top:-20px; margin-bottom:-10px;">
									<div class="form-group" style="padding:10px; margin-right:10px;">
										<label>No. PL</label>
										<input id="pl" name="pl" value="<?php 
											$idq = sprintf("%03d", $id);echo 'PL'.$idq; ?>" type="text" class="form-control" disabled /> 
										<br />
										<label>Nama</label>
										<input id="name1" name="name1" value="<?php echo $r['req_name']; ?>" type="text" class="form-control" disabled /> 
										<br />
										<label>Alamat</label>
										<input id="adrs1" name="adrs1" value="<?php echo $r['address1']; ?>" type="text" class="form-control" disabled />
										<br />
										<label>Jenis Jualan</label>
										<select class="form-control" name="type" id="type" disabled>
											<option value="<?php echo $r['merchant_type']; ?>"><?php echo $r['merchant_type']; ?></option>
										</select>
									</div>
								</div>
								<div class="col-lg-4" style="padding:10px; margin-top:-20px; margin-bottom:-10px;">
									<div class="form-group" style="padding:10px; margin-right:10px;">
										<label>Lapak</label>
										<select class="form-control" name="lapak" id="lapak" disabled>
											<option value="<?php echo $r['lapak_id']; ?>"><?php echo $lapak; ?></option>
										</select>
										<br />
										<label>Harga Per (M<sup>2</sup>)</label>
										<input id="price" name="price" value="<?php echo format_rupiah($price); ?>" type="text" class="form-control" disabled />
										<br />
										<label>Masa Pakai</label>
										<input class="form-control" id="dur" name="dur" type="text" value="<?php echo $duration; ?> Tahun" disabled />
										<br />
										<label>Harga Total</label>
										<input id="total" name="total" value="<?php echo format_rupiah($total); ?>" type="text" class="form-control" disabled />
									</div>
								</div>
								<div class="col-lg-4" style="padding:10px; margin-top:-20px; margin-bottom:-10px;">
									<div class="form-group" style="padding:10px; margin-right:10px;">
										<label>Uang Muka</label>
										<input id="dp" name="dp" placeholder="Uang Muka Lapak" type="number" class="form-control" required />
										<br />
										<div class="row" style="margin-top:-10px;">
											<div class="col-md-6" style="padding:10px;">
												<label>Cicilan</label>
												<select class="form-control" name="ins" id="ins" required>
													<option value="">- Pilih Cicilan -</option>
													<?php 
														$sql1 = mysql_query("select * from instalment order by instalment_name");
														while($d1 = mysql_fetch_array($sql1)){
														?>
														<option value="<?php echo $d1['instalment_id'];?>"><?php echo $d1['instalment_name'].' / '.$d1['instalment_count'].'x';?></option>
													<?php } ?>
												</select>
											</div>
											<div class="col-md-6" style="padding:10px;">
												<label>Bunga Pertahun (%)</label>
												<input class="form-control" id="interest" name="interest" type="number" value="0" required />
											</div>
										</div>
										<div class="form-group" style="padding:10px;">
											<label>Tanggal Masuk</label>
											<input id="datein" name="datein" type="date" class="form-control" placeholder="Tanggal Masuk" required
											data-fv-notempty-message="Tanggal Belum Diisi"/>
										</div>
										<label>Kajian</label>
										<textarea cols="50" rows="3" id="ket" name="ket" placeholder="Alasan Mengapa Persetujuan diterbitkan ?"></textarea>
									</div>
								</div>
								<center>
									<button style="margin-top:-10px;" type="submit" class="btn btn-outline btn-block btn-primary">
										Setujui Permohonan <i class="fa fa-angle-double-right fa-lg"></i>
									</button>
								</center>
								</fieldset>
							</form>
							<?php }?>
                        </div>
                    </div>
                </div>
			</div>
        </div>
    </div>

	<!-- Modal Ganti Password -->
	<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src='../assets/image/Delete.png' width='25' height='25'/></button>
					<h4 id="header_password">Ganti Password</h4>
				</div>
				<div class="modal-body">
					<div id="data_password" style="margin-bottom: 0px;">
						<div class="alert alert-info" onclick="clearNotif()"><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></div>
					</div>
					<input type="hidden" id="value_id" />
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
	
	<script>
    $(document).ready(function(){
			// Auto Refresh Page
			$("#notifArea").html(alertLoadProcess);
			$('#Area1').load("register_table2.php",function(){clearNotif();});
			setTimeout('$("html").removeClass("js")',1000); 
			
			//Modal Ganti Password
			$('#modalPassword').on('shown.bs.modal', function (e) {
				$("#notifArea").html(alertLoadProcess);
				$("#data_password").load("password.php",function(){clearNotif();});
			})
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
