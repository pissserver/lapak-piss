<?php
	function isActive($pages) {
		// return basename($_SERVER['PHP_SELF']) == $pages ? 'active' : '';
		return in_array(basename($_SERVER['PHP_SELF']), $pages) ? 'active' : '';
	}

	function isParentActive($pages) {
		return in_array(basename($_SERVER['PHP_SELF']), $pages) ? 'active' : '';
	}

	function greeting() {
		$hour = date('H');
	
		if ($hour >= 5 && $hour < 12) {
			return "Selamat pagi, ";
		} elseif ($hour >= 12 && $hour < 18) {
			return "Selamat siang, ";
		} elseif ($hour >= 18 && $hour < 21) {
			return "Selamat sore, ";
		} else {
			return "Selamat malam, ";
		}
	}

	$greetingMessage = greeting();
?>

<style>
    .silhouette {
        font-weight: bold;
        font-size: 20px;
        background: linear-gradient(120deg, #ffffff 30%, #ec9841 50%, #ffffff 70%);
        background-size: 200% auto;
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        animation: silhouetteMove 5s linear infinite;
    }

    @keyframes silhouetteMove {
        0% { background-position: 200% center; }
        100% { background-position: -200% center; }
    }
</style>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0; background-color: #428bca;">
	<div class="navbar-header bg-primary">
    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="dashboard.php" style="color: #ffffff;"><i class="fa fa-building-o fa-fw silhouette"></i> <b class="silhouette">SPV PISS</b></a>
    </div>
			
	<ul class="nav navbar-top-links navbar-right">
		<?php include 'components/offcanvas_note.php'; ?>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#" 
			style="color: #ffffff !important; background-color: transparent !important;"
			onmouseover="this.style.backgroundColor='rgb(103, 165, 218)'" 
			onmouseout="this.style.backgroundColor='transparent'">
				<i class="fa fa-user fa-fw" style="color: #ffffff;"></i>
				<span style="color: #ffffff;"><?php echo $greetingMessage; ?></span>
				<b style="text-transform: capitalize; color: #ffffff;"><?php echo $name; ?>&nbsp;</b>
				<i id="dropdownIcon" class="fa fa-angle-down" style="color: #ffffff;"></i>
			</a>
			<ul class="dropdown-menu dropdown-user" style="width: 200px; margin-right: 10px; margin-top: 10px; border: 3px solid #ffffff; background-color: #428bca; border-radius: 10px;">
				<li>
					<a data-toggle="modal" data-target="#modalPassword" href="#" 
					style="color: #ffffff; font-size: 15px; display: block; padding: 10px; text-decoration: none;"
					onmouseover="this.style.backgroundColor='rgb(103, 165, 218)'; this.style.color='#ffffff';"
					onmouseout="this.style.backgroundColor='transparent'; this.style.color='#ffffff';">
						<div class="name" style="display: inline-block; padding-right: 30px; padding-left: 10px;">
							Ganti Password 
						</div>
						<div class="icon" style="display: inline-block;">
							<i class="fa fa-lock fa-fw" style="color: #ffffff; font-size: 15px;"></i>
						</div>
					</a>
				</li>
				<li class="divider"></li>
				<li>
					<a data-toggle="modal" data-target="#modalLogout" href="#" 
					style="color: #ffffff; font-size: 15px; display: block; padding: 10px; text-decoration: none;"
					onmouseover="this.style.backgroundColor='rgb(103, 165, 218)'; this.style.color='#ffffff';"
					onmouseout="this.style.backgroundColor='transparent'; this.style.color='#ffffff';">
						<div class="name" style="display: inline-block; padding-right: 95px; padding-left: 10px;">
							Keluar
						</div>
						<div class="icon" style="display: inline-block;">
							<i class="fa fa-sign-out fa-fw" style="color: #ffffff; font-size: 15px;"></i>
						</div>
					</a>
				</li>
			</ul>
		</li>
	</ul>

			<!-- Modal Password -->
			<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
				<div class="modal-dialog" >
					<div class="modal-content">
						<div class="modal-header bg-primary text-white" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
							<h4 id="header_password"><i class="fa fa-lock fa-fw"></i>&nbsp;Ganti Password</h4>
							<button style="margin-top: -35px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div id="data_password" style="margin-bottom: 0px;">
								<div class="alert alert-info" onclick="clearNotif()"><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></div>
							</div>
							<input type="hidden" id="value_id" />
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Logout -->
			<div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="modalLogoutLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header bg-primary text-white" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
							<h5 class="modal-title" id="modalLogoutLabel"><b>KONFIRMASI KELUAR</b></h5>
							<button style="margin-top: -20px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>Apakah Anda yakin ingin keluar?</p>
						</div>
						<div class="modal-footer d-flex justify-content-between">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
							<a href="logout.php" class="btn btn-primary">Keluar</a>
						</div>
					</div>
				</div>
			</div>
            
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li><a class="<?= isActive(['dashboard.php']); ?>" href="dashboard.php"><i class="fa fa-bar-chart fa-fw"></i> Dashboard</a></li>

                            <li class="<?= isParentActive(['lapak.php', 'lapak_edit.php', 'block.php', 'block_edit.php', 'instalment.php', 'instalment_edit.php']); ?>"> 
                                <a href="#"><i class="fa fa-building fa-fw"></i> Data Master<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a class="<?= isActive(['lapak.php', 'lapak_edit.php']); ?>" href="lapak.php"><i class="fa fa-building fa-fw"></i> Lapak</a></li>
                                    <li><a class="<?= isActive(['block.php', 'block_edit.php']); ?>" href="block.php"><i class="fa fa-sort-alpha-asc fa-fw"></i> Block</a></li>
                                    <li><a class="<?= isActive(['instalment.php', 'instalment_edit.php']); ?>" href="instalment.php"><i class="fa fa-clock-o fa-fw"></i> Jangka Waktu Cicilan</a></li>
                                </ul>
                            </li>

                            <li class="<?= isParentActive(['register.php', 'register_edit.php', 'register_acc.php', 'register2.php', 'register_edit2.php', 'register_view.php', 'register_acc_edit2.php', 'merchant.php', 'merchant_edit.php']); ?>">
                                <a href="#"><i class="fa fa-users fa-fw"></i> Pedagang<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a class="<?= isActive(['register.php', 'register_edit.php', 'register_acc.php']); ?>" href="register.php"><i class="fa fa-user-plus fa-fw"></i> Pendaftaran Lapak Baru</a></li>
                                    <li><a class="<?= isActive(['register2.php', 'register_edit2.php']); ?>" href="register2.php"><i class="fa fa-user-plus fa-fw"></i> Pendaftaran Tambah Lapak</a></li>
                                    <li><a class="<?= isActive(['register_view.php', 'register_acc_edit2.php']); ?>" href="register_view.php"><i class="fa fa-user-plus fa-fw"></i> Permohonan Yg Disetujui</a></li>
                                    <li><a class="<?= isActive(['merchant.php', 'merchant_edit.php']); ?>" href="merchant.php"><i class="fa fa-users fa-fw"></i> Data Pedagang</a></li>
                                </ul>
                            </li>

                            <li class="<?= isParentActive(['rent.php', 'rent2.php', 'rent_edit.php']); ?>">
                                <a href="#"><i class="fa fa-money fa-fw"></i> Angsuran Lapak<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a class="<?= isActive(['rent.php', 'rent_edit.php']); ?>" href="rent.php"><i class="fa fa-money fa-fw"></i> Pembayaran Angsuran</a></li>
                                    <li><a class="<?= isActive(['rent2.php']); ?>" href="rent2.php"><i class="fa fa-money fa-fw"></i> Angsuran Yg Terlambat</a></li>
                                </ul>
                            </li>

                            <li class="<?= isParentActive(['move_select.php', 'move.php', 'move_select2.php', 'move_log.php']); ?>">
                                <a href="#"><i class="fa fa-retweet fa-fw"></i> Perpindahan lapak<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a class="<?= isActive(['move_select.php', 'move.php']); ?>" href="move_select.php"><i class="fa fa-retweet fa-fw"></i> Pindah Ke Lapak Kosong</a></li>
                                    <li><a class="<?= isActive(['move_select2.php']); ?>" href="move_select2.php"><i class="fa fa-retweet fa-fw"></i> Tukar Lapak</a></li>
                                    <li><a class="<?= isActive(['move_log.php']); ?>" href="move_log.php"><i class="fa fa-book fa-fw"></i> Histori Perpindahan</a></li>
                                </ul>
                            </li>

                            <li class="<?= isParentActive(['nonactive_merchant.php', 'nonactive_lapak.php', 'nonactive_log.php']); ?>">
                                <a href="#"><i class="fa fa-window-close fa-fw"></i> NonAktif<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a class="<?= isActive(['nonactive_merchant.php']); ?>" href="nonactive_merchant.php"><i class="fa fa-user-times fa-fw"></i> NonAktif Pedagang</a></li>
                                    <li><a class="<?= isActive(['nonactive_lapak.php']); ?>" href="nonactive_lapak.php"><i class="fa fa-window-close-o fa-fw"></i> NonAktif Lapak</a></li>
                                    <li><a class="<?= isActive(['nonactive_log.php']); ?>" href="nonactive_log.php"><i class="fa fa-book fa-fw"></i> Histori NonAktif</a></li>
                                </ul>
                            </li>

                            <li class="<?= isParentActive(['report_merchant.php', 'report_credit.php']); ?>">
                                <a href="#"><i class="fa fa-book fa-fw"></i> Laporan<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a class="<?= isActive(['report_merchant.php', 'move.php']); ?>" href="report_merchant.php"><i class="fa fa-user fa-fw"></i> Data Pedagang</a></li>
                                    <li><a class="<?= isActive(['report_credit.php', 'move.php']); ?>" href="report_credit.php"><i class="fa fa-user fa-fw"></i> Piutang Lapak</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

<!-- <script>
    function formatTime(seconds) {
        const hours = Math.floor(seconds / 3600);
        const minutes = Math.floor((seconds % 3600) / 60);
        const remainingSeconds = seconds % 60;
        return `${hours}j ${minutes}m ${remainingSeconds}d`;
    }

    function startWorkTime() {
        let loginTime = localStorage.getItem('loginTime');

        if (!loginTime) {
            loginTime = new Date().getTime();
            localStorage.setItem('loginTime', loginTime);
        }

        setInterval(function() {
            const currentTime = new Date().getTime();
            const timeElapsed = Math.floor((currentTime - loginTime) / 1000);
            const formattedTime = formatTime(timeElapsed);
            document.getElementById('workHoursLink').innerHTML = `<i class="fa fa-clock-o fa-fw"></i> Jam Kerja : ${formattedTime}`;
        }, 1000);
    }

    function logout() {
        localStorage.removeItem('loginTime');
		localStorage.removeItem('notificationHidden');
    }

    startWorkTime();

    document.getElementById("logoutButton").addEventListener("click", function() {
        logout();
    });
</script> -->

<script>
	$(document).ready(function() {
		$(".dropdown").on("shown.bs.dropdown", function() {
			$("#dropdownIcon").removeClass("fa-angle-down").addClass("fa-angle-up");
		});

		$(".dropdown").on("hidden.bs.dropdown", function() {
			$("#dropdownIcon").removeClass("fa-angle-up").addClass("fa-angle-down");
		});
	});
</script>

