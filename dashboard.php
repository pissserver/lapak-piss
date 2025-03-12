<?php
	include "connection.php";
	//Validasi role
	session_start();
	if($_SESSION['role']!='admin'){
		if($_SESSION['role']!='super_admin'){
			header("Location:index.php");
		}
	}
	$merchant 	= executeScalar("select count(merchant_id) from merchant where merchant_status = 'Aktif'");
	$lapak 		= executeScalar("select count(lapak_id) from lapak");
	$move 		= executeScalar("select count(move_log_id) from move_log");
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
        <title>Dashboard | PISS</title>

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
        <link rel="stylesheet" href="css/colorbox.css" />
        
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
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="dashboard.php">Admin PISS</a>
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
                            <li><a class="active" href="dashboard.php"><i class="fa fa-bar-chart fa-fw"></i> Dashboard</a></li>
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
                            <li >
                                <a href="#"><i class="fa fa-retweet fa-fw"></i> Perpindahan lapak<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="move_select.php"><i class="fa fa-retweet fa-fw"></i> Pindah Ke Lapak Kosong</a></li>
                                    <li><a href="move_select2.php"><i class="fa fa-retweet fa-fw"></i> Tukar Lapak</a></li>
                                    <li><a href="move_log.php"><i class="fa fa-book fa-fw"></i> Histori Perpindahan</a></li>
                                </ul>
                            </li>
                            <li >
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
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-group fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $merchant; ?></div>
                                        <div>Pedagang</div>
                                    </div>
                                </div>
                            </div>
                            <a href="merchant.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-building fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $lapak; ?></div>
                                        <div>Lapak</div>
                                    </div>
                                </div>
                            </div>
                            <a href="lapak.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-retweet fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $move; ?></div>
                                        <div>Perpindahan</div>
                                    </div>
                                </div>
                            </div>
                            <a href="move_select.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-money fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">0</div>
                                        <div>Pembayaran</div>
                                    </div>
                                </div>
                            </div>
                            <a href="rent.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a data-toggle="tab" href="#block">Blok & Lapak</a></li>
                        <li><a data-toggle="tab" href="#merchant">Pedagang</a></li>
                        <li><a data-toggle="tab" href="#revenue">Pendapatan</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="block" class="tab-pane fade in active">
                                <br />
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div id="Area1"><div class="alert alert-info" onclick="clearNotif()"><center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center></div></div>
                                        <div id="Area2"><div class="alert alert-info" onclick="clearNotif()"><center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center></div></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div id="Area3"><div class="alert alert-info" onclick="clearNotif()"><center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center></div></div>
                                        <div id="Area4"><div class="alert alert-info" onclick="clearNotif()"><center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center></div></div>
                                        <!--<div id="Area5"><div class="alert alert-info" onclick="clearNotif()"><center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center></div></div>-->
                                    </div>
                                </div>
                            </div>
                            <div id="merchant" class="tab-pane fade">
                                <br />
                                <div id="Area7"><div class="alert alert-info" onclick="clearNotif()"><center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center></div></div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div id="Area6"><div class="alert alert-info" onclick="clearNotif()"><center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center></div></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div id="Area8"><div class="alert alert-info" onclick="clearNotif()"><center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center></div></div>
                                    </div>
                                </div>
                            </div>
                            <div id="revenue" class="tab-pane fade">
                                <br />
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div id="Area5"><div class="alert alert-info" onclick="clearNotif()"><center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center></div></div>
                                    </div>
                                    <div class="col-lg-6">
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal deadline -->
        <div class="modal fade" id="modaldl" name="modaldl" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src='../assets/image/Delete.png' width='25' height='25'/></button>
                        <h4 id="header_password">Batas Sewa 1 Bulan Terakhir</h4>
                    </div>
                    <div class="modal-body">
                        <div id="data_dl" style="margin-bottom: 0px;">
                            <div class="alert alert-info" onclick="clearNotif()"><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></div>
                        </div>
                        <input type="hidden" id="value_id" />
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- jQuery -->
        <script src="js/jquery.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.colorbox.js"></script>
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
            function openColorBox(){
                $.colorbox({iframe:true, width:"80%", height:"80%", href: "modal_deadline.php"});
            }
            setTimeout(openColorBox, 500);
            $(document).ready(function(){
                $("#notifArea").html(alertLoadProcess);
                setTimeout('$("html").removeClass("js")',1000); 
                loadChart();
                
            });
            //Meload Chart
            function loadChart(){
                $("#notifArea").html(alertLoadProcess);
                $("#Area1").load("line_block1.php",function(){clearNotif();});
                $("#Area2").load("line_block2.php",function(){clearNotif();});
                $("#Area3").load("line_block3.php",function(){clearNotif();});
                $("#Area4").load("line_block4.php",function(){clearNotif();});
                $("#Area5").load("line_revenue1.php",function(){clearNotif();});
                $("#Area6").load("line_merchant_type.php",function(){clearNotif();});
                $("#Area7").load("line_merchant_block.php",function(){clearNotif();});
                $("#Area8").load("line_merchant_sts.php",function(){clearNotif();});
                //$("#Area5").load("line_block5.php",function(){clearNotif();});
            }
            function clearNotif(){$("#notifArea").html("");}
        </script>
    </body>
</html>