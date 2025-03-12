<?php
	session_start();
	include "connection.php";
	date_default_timezone_set('Asia/Jakarta');
	$dt_now	= date("Y-m-d H:i:s");
	$task	= $_GET['task'];
	$reason	= $_POST['reason'];
	
	if($task=='active'){
		//Ambil ID Pedagang
		$mid	= $_GET['id'];
		
		//Update Status Pedagang
		$update = mysql_query("update merchant set merchant_status = 'Aktif' where merchant_id = '".$mid."'");
		if($update){
			$spv	= $_SESSION['username'];
			$insert = mysql_query("insert into nonactive_log (nonactive_id, spv_name, merchant_id, lapak_id, nonactive_reason, nonactive_date) 
			value('', '".$spv."', '".$mid."', '', '".$reason."', '".$dt_now."')");
			if($insert){
				echo "<script>window.location=('nonactive_merchant.php')</script>";
				exit();
			}else{
				echo "<script>window.alert('PengAktifan Gagal 1');
				window.history.back()</script>";
				exit();
			}
		}else{
			echo "<script>window.alert('PengAktifan Gagal 2');
			window.history.back()</script>";
			exit();
		}
	}
	
	if($task=='nonactive'){
		//Ambil ID Pedagang
		$mid	= $_GET['id'];
		
		//Update Status Pedagang
		$update = mysql_query("update merchant set merchant_status = 'Tidak Aktif' where merchant_id = '".$mid."'");
		if($update){
			$spv	= $_SESSION['username'];
			$insert = mysql_query("insert into nonactive_log (nonactive_id, spv_name, merchant_id, lapak_id, nonactive_reason, nonactive_date) 
			value('', '".$spv."', '".$mid."', '', '".$reason."', '".$dt_now."')");
			if($insert){
				echo "<script>window.location=('nonactive_merchant.php')</script>";
				exit();
			}else{
				echo "<script>window.alert('PenonAktifan Gagal 1');
				window.history.back()</script>";
				exit();
			}
		}else{
			echo "<script>window.alert('PenonAktifan Gagal 2');
			window.history.back()</script>";
			exit();
		}
	}
?>