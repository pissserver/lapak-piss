<?php
	session_start();
	include "connection.php";
	include "fungsi_thumb.php";
	
	$task	= $_GET['task'];
	//$id		= $_POST['id'];
	// Input 
	if ($task == 'insert'){
		$exist 	= executeScalar("select count(instalment_id) from instalment where instalment_name = '".$_POST['ins_val']."' ");
		
		if($exist>0){
			echo "<script>window.alert('Nama Cicilan Sudah Ada, Mohon Dicek Lagi');
			window.history.back()</script>";
			exit();
		}
		if($_POST['ins']==''||$_POST['ins_val']==''){
			echo "<script>window.alert('Data Belum Lengkap, Mohon Dicek Lagi');
			window.history.back()</script>";
			exit();
		}
		else{
			$insert = mysql_query("INSERT INTO `instalment` (`instalment_id`, `instalment_name`, `instalment_count`) 
			VALUES ('', '".$_POST['ins']."', '".$_POST['ins_val']."')");
			
			if($insert){
				echo "<script>window.location=('instalment.php')</script>";
				exit();
			}
			else{
				echo "<script>window.alert('Data Gagal Masuk');
				window.history.back()</script>";
				exit();
			}
		}
	}

	// Update
	elseif ($task == 'update'){
		$id		= $_GET['id'];
		$update	= mysql_query("update instalment set instalment_name	= '".$_POST['ins']."',
													instalment_count 	= '".$_POST['ins_val']."'
												where instalment_id 	= '".$id."'");
		if($update){
			echo "<script>window.location=('instalment.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Update Data Gagal');
			window.history.back()</script>";
			exit();
		}
	}
	
	elseif ($task == 'delete'){
		//$delete = mysql_query("delete block where block_id = '".$id."'");
		if($delete){
			echo "<script>window.location=('instalment.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Delete Failled');
			window.location=('instalment.php')</script>";
			exit();
		}
	}
?>