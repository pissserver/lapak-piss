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
	$('#moveView').dataTable( {
			dom: "<'row'<'col-sm-7'l><'col-sm-5'f>>" +  
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-6'i><'col-sm-6'p>>",
			renderer: 'bootstrap',
			/*/*"tableTools": {
				"sSwfPath": "dataTables/tableTools/swf/copy_csv_xls_pdf.swf",
				"aButtons": ["xls", "pdf", "print"]
			},*/
			"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
		} );
	});
</script>

<!-- <h3 style="text-align:center;">Histori Perpindahan Lapak</h3> -->
<table id="moveView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="text-align: center; width:10%;">NO</th>
			<th style="text-align: center; width:10%;">KODE</th>
			<th style="text-align: center; width:20%;">NAMA PEDAGANG</th>
			<th style="text-align: center; width:20%;">LAPAK AWAL</th>
			<th style="text-align: center; width:20%;">LAPAK AKHIR</th>
			<th style="text-align: center; width:20%;">TANGGAL PINDAH</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no		= 1;
			$sql 	= mysql_query("select * from move_log order by move_date desc");
			while($data=mysql_fetch_array($sql)) {
				$name 	= executeScalar("select merchant_name from merchant where merchant_id = '".$data['merchant_id']."' ");
				$awal 	= executeScalar("select lapak_name from lapak where lapak_id='".$data['move_start']."' ");
				$akhir	= executeScalar("select lapak_name from lapak where lapak_id='".$data['move_end']."' ");
		?>
		<tr>
			<td style="text-align:center;"><?php echo $no; ?></td>
			<td style="text-align:center;"><?php echo $data['merchant_id']; ?></td>
			<td style="text-align:left;"><?php echo $name; ?></td>
			<td style="text-align:center;"><?php echo $awal; ?></td>
			<td style="text-align:center;"><?php echo $akhir; ?></td>
			<td style="text-align:center;"><?php echo date("d M Y", strtotime($data['move_date'])); ?></td>
		</tr>
		<?php
			$no++;
			}
		?>
	</tbody>
</table>