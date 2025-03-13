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
    <title>Pertukaran Lapak | PISS</title>

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
                            <i class="fa fa-retweet fa-fw"></i> Pertukaran Lapak PISS
                        </div>
                        <div class="panel-body">
                            <form action="move2.php" id="formMove2" name="formMove2" method="POST" class="form-horizontal">
								<div class="col-lg-4" style="padding:10px; margin-top:-20px; margin-bottom:-10px;">
									<div class="form-group" style="padding:10px;">
										<label>Pedagang 1</label>
										<select class="form-control chzn-select" name="m1" id="m1" autofocus="autofocus" required>
											<option value="">- Pilih Pedagang 1 -</option>
											<?php 
												$sql1 		= mysql_query("select merchant_id, merchant_name, merchant_nick, merchant_type from merchant order by merchant_name");
												while($d1 = mysql_fetch_array($sql1))
											{?>
												<option value="<?php echo $d1['merchant_id'];?>"><?php echo $d1['merchant_name'].' / '.$d1['merchant_nick'].' ('.$d1['merchant_type'].')';?></option>
											<?php } ?>
										</select>
										<br />
									</div>
								</div>
								<div class="col-lg-4" style="padding:10px; margin-top:-20px; margin-bottom:-10px;">
									<div class="form-group" style="padding:10px;">
										<label>Pedagang 2</label>
										<select class="form-control chzn-select" name="m2" id="m2" required>
											<option value="">- Pilih Pedagang 2 -</option>
											<?php 
												$sql1 		= mysql_query("select merchant_id, merchant_name, merchant_nick, merchant_type from merchant order by merchant_name");
												while($d1 = mysql_fetch_array($sql1))
											{?>
												<option value="<?php echo $d1['merchant_id'];?>"><?php echo $d1['merchant_name'].' / '.$d1['merchant_nick'].' ('.$d1['merchant_type'].')';?></option>
											<?php } ?>
										</select>
										<br />
									</div>
								</div>
								<div class="col-lg-4" style="padding:10px; margin-top:5px; margin-bottom:-10px;">
									<div class="form-group" style="padding:10px;">
										<center><button type="submit" class="btn btn-outline btn-block btn-primary">Berikutnya <i class="fa fa-angle-double-right fa-lg"></i></button></center>
									</div>
								</div>
							</form> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top:-10px;">
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
			$('#Area1').load("merchant_table.php",function(){clearNotif();});
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
	<!-- Search Dropdown -->
	<script src="js/plugins/chosen/chosen.jquery.js"></script>
	<script type="text/javascript">
    	$(".chzn-select").chosen({"search_contains": true,"width":"100%", "no_results_text":"Hasil tidak ditemukan !"});
    </script>
</body>
</html>