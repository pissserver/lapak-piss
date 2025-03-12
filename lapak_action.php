<?php
	session_start();
	include "connection.php";
	include "fungsi_thumb.php";
	
	$task	= $_GET['task'];
	//$id		= $_POST['id'];
	
	// Input 
	if ($task == 'insert'){
		if($_POST['block']==''){
			echo "<script>window.alert('Block Belum Dipilih');
			window.history.back()</script>";
			exit();
		}
		if($_POST['p']==0||$_POST['l']==0){
			echo "<script>window.alert('Mohon Isikan Panjang dan Lebar Lapak');
			window.history.back()</script>";
			exit();
		}
		if($_POST['price']==0){
			echo "<script>window.alert('Mohon Isikan Harga Lapak');
			window.history.back()</script>";
			exit();
		}
		if($_POST['dur']==0){
			echo "<script>window.alert('Mohon Isikan Masa Pakai Lapak');
			window.history.back()</script>";
			exit();
		}
		$no 	= executeScalar("select count(lapak_id) from lapak where block_id = '".$_POST['block']."' ");
		$no		= $no+1;
		$exist 	= executeScalar("select count(lapak_id) from lapak where block_id = '".$_POST['block']."' and lapak_no = '".$no."' ");
		
		if($exist>0){
			echo "<script>window.alert('Lokasi Lapak Sudah Ada, Mohon Dicek Lagi');
			window.history.back()</script>";
			exit();
		}
		else{
			$size	= 0;
			$total	= 0;
			$size	= $_POST['p']*$_POST['l'];
			$total	= $size*$_POST['price'];
			$name	= $_POST['block'].'-'.$no;
			$btype 	= executeScalar("select block_type from block where block_id = '".$_POST['block']."' ");
			if($btype=='Campuran'){
				$type = $_POST['type'];
			}
			elseif($btype=='Buah'||$btype=='Sayur'){
				if($_POST['type']!=$btype){
					echo "<script>window.alert('Tipe lapak berbeda dengan tipe block, Mohon Dicek Lagi');
					window.history.back()</script>";
					exit();
				}
				else{
					$type = $_POST['type'];
				}
			}
			$insert = mysql_query("INSERT INTO `lapak` (`lapak_id`, `lapak_type`, `block_id`, `lapak_no`,
			`lapak_name`, `p`, `l`, `lapak_size`, `lapak_price`, `lapak_total`, `duration`)
			VALUES ('', '".$type."', '".$_POST['block']."', '".$no."', '".$name."', '".$_POST['p']."', 
			'".$_POST['l']."', '".$size."', '".$_POST['price']."', '".$total."', '".$_POST['dur']."')");
			
			if($insert){
				$update	= mysql_query("update block set block_now = '".$no."' where block_id = '".$_POST['block']."'");
				if($update){
					echo "<script>window.location=('lapak.php')</script>";
					exit();
				}
				else{
					echo "<script>window.alert('Data Gagal Masuk');
					window.history.back()</script>";
					exit();
				}
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
		$size	= 0;
		$total	= 0;
		$size	= $_POST['p']*$_POST['l'];
		$total	= $size*$_POST['price'];
		//$name	= $_POST['block'].'-'.$_POST['no'];
		$update	= mysql_query("update lapak set lapak_type 	= '".$_POST['type']."',
											p				= '".$_POST['p']."',
											l 				= '".$_POST['l']."',
											lapak_size		= '".$size."',
											lapak_price 	= '".$_POST['price']."',
											lapak_total		= '".$total."',
											lapak_status 	= '".$_POST['status']."',
											duration 		= '".$_POST['dur']."'
											where lapak_id 	= '".$id."'");
		if($update){
			echo "<script>window.location=('lapak.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Update Data Gagal');
			window.history.back()</script>";
			exit();
		}
	}
	
	elseif ($task == 'delete'){
		//$delete = mysql_query("delete lapak where lapak_id = '".$id."'");
		if($delete){
			echo "<script>window.location=('lapak.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Delete Failled');
			window.location=('lapak.php')</script>";
			exit();
		}
	}
?>