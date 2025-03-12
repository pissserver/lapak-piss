<?php
	session_start();
	include "connection.php";
	//Validasi role
	if($_SESSION['role']==''){
		header("Location:logout.php");
	}
	$id = $_GET['id'];
?>
<div class="row" style="margin-top:20px;margin-bottom:10px;">
	<div class="col-md-8 col-md-offset-2">
		<form action="nonactive_action.php?task=active&id=<?php echo $id; ?>"  id="form_active" name="form_active" method="POST" class="form-horizontal">
			<div class="form-group" style="padding:10px; margin-top:10px; margin-right:0px;">
				<label>Alasan Pengaktifan</label>
				<input id="reason" name="reason" placeholder="Alasan Mengapa DiAktifkan" type="text" class="form-control" required>                  
			</div>
			<div class="form-group" style="padding:10px; margin-top:-10px; margin-right:0px;">
				<button type="submit" class="btn btn-outline btn-primary btn-block btn-sm">Simpan</button>               
			</div>
		</form>
	</div>
</div>