<?php
	include "connection.php";
?>
<!-- jquery -->
<script src="dataTables/jquery.dataTables.js"></script>
<script src="dataTables/dataTables.tableTools.js"></script>
<script src="dataTables/dataTables.bootstrap.js"></script>
<script>
	$(document).ready(function() {
	//data table
	$('#lapakView').dataTable({"aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]]});
	});
</script>
<H3 style="text-align:center; margin-top:-10px;">Jangka Waktu Angsuran Lapak Pasar Induk Surabaya Sidotopo</H3>
<table id="lapakView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="text-align:center;">No</th>
			<th style="text-align:right;">Nama Angsuran</th>
			<th style="text-align:right">Jumlah Angsuran</th>
			<th style="text-align:center">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql 	= mysql_query("select * from instalment order by instalment_id desc");
		$no		= 1;
			while($data=mysql_fetch_array($sql)) { 
		?>
		<tr>
			<td style="text-align:center;"><?php echo $no; ?></td>
			<td style="text-align:right;"><?php echo $data['instalment_name']; ?></td>
			<td style="text-align:right"><?php echo $data['instalment_count']; ?>x</td>
			<td><center>
				<a href="instalment_edit.php?id=<?php echo $data[0]; ?>">
					<button class="btn btn-outline btn-block btn-primary btn-xs">Edit</button>
				</a>
			</center></td>
		</tr>
		<?php
			$no++;
			}
		?>
	</tbody>
</table>