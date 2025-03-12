<?php
	session_start();
	include "connection.php";
	date_default_timezone_set('Asia/Jakarta');
	$dt_now	= date("Y-m-d H:i:s");
	$task	= $_GET['task'];
	
	if($task=='nonactive'){
		//Ambil Lapak ID
		$lid	= $_GET['id'];
		//Update Status lapak Jd Kosong
		$updt1 = mysql_query("update lapak set lapak_status = NULL where lapak_id = '".$lid."'");
		if($updt1){
			$mid 	= executeScalar("select merchant_id from rent where lapak_id = '".$lid."'");
			$updt2 	= mysql_query("update rent set rent_sts2 = 'Batal' where lapak_id = '".$lid."' and merchant_id = '".$mid."'");
			$spv	= $_SESSION['username'];
			$reason	= $_POST['reason'];
			$insert = mysql_query("insert into nonactive_log (nonactive_id, spv_name, merchant_id, lapak_id, nonactive_reason, nonactive_date) 
			value('', '".$spv."', '".$mid."', '".$lid."', '".$reason."', '".$dt_now."')");
			if($insert){
				echo "<script>window.location=('nonactive_lapak.php')</script>";
				exit();
			}else{
				echo "<script>window.alert('PenonAktifan Gagal');
				window.history.back()</script>";
				exit();
			}
		}
	}
?>