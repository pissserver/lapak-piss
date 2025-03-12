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
<H3 style="text-align:center; margin-top:-10px;">Data Lapak PIOS</H3>
<table id="lapakView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="text-align:center; width: 5%;">No</th>
			<th style="text-align:center; width: 5%;">Lokasi</th>
			<th style="text-align:center; width: 5%;">P</th>
			<th style="text-align:center; width: 5%;">L</th>
			<th style="text-align:center; width: 5%;">(M<sup>2</sup>)</th>
			<th style="text-align:center; width: 8%;">Harga Per M<sup>2</sup></th>
			<th style="text-align:center; width: 8%;">Total Harga</th>
			<th style="text-align:center; width: 5%;">Durasi</th>
			<th style="text-align:center; width: 20%;">Pedagang</th>
			<th style="text-align:center; width: 7%;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql 	= mysql_query("select * from lapak where lapak_status = 'Terisi' order by block_id, lapak_no");
		$no		= 1;
			while($data=mysql_fetch_array($sql)){
			$mid 	= executeScalar("select merchant_id from rent where lapak_id = '".$data['lapak_id']."' and rent_sts2 != 'Batal' order by rent_id desc");
			$name 	= executeScalar("select merchant_name from merchant where merchant_id = '".$mid."'");
		?>
		<tr>
			<td style="text-align:center;"><?php echo $data['lapak_id']; ?></td>
			<td><?php echo $data['lapak_name']; ?></td>
			<td style="text-align:right"><?php echo $data['p']; ?></td>
			<td style="text-align:right"><?php echo $data['l']; ?></td>
			<td style="text-align:right"><?php echo $data['lapak_size']; ?></td>
			<td style="text-align:right"><?php echo format_rupiah($data['lapak_price']); ?></td>
			<td style="text-align:right"><?php echo format_rupiah($data['lapak_total']); ?></td>
			<td style="text-align:center"><?php echo $data['duration']; ?></td>
			<td style="text-align:left"><?php echo $name; ?></td>
			<td>
				<a href="modal_nonactive2.php?id=<?php echo $data['lapak_id']; ?>" data-toggle="modal" data-target="#modalNonaktif">
				<button class="btn btn-outline btn-block btn-primary btn-xs">NonAktifkan</button></a>
			</td>
		</tr>
		<?php
			$no++;
			}
		?>
	</tbody>
</table>