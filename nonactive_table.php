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
	$('#nonactiveView').dataTable( {
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

<h3 style="text-align:center;">Histori NonAktif</h3>
<table id="nonactiveView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:5%;">No</th>
			<th style="width:15%;">Nama SPV</th>
			<th style="width:20%;">Pedagang</th>
			<th style="width:10%;">Lapak</th>
			<th style="width:25%;">Alasan</th>
			<th style="width:15%;">Tgl & Jam</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no		= 1;
			$sql 	= mysql_query("select * from nonactive_log order by nonactive_date desc limit 100");
			while($data=mysql_fetch_array($sql)) {
				$name 	= executeScalar("select merchant_name from merchant where merchant_id = '".$data['merchant_id']."'");
				$lapak 	= executeScalar("select lapak_name from lapak where lapak_id='".$data['lapak_id']."' ");
		?>
		<tr>
			<td style="text-align:center;"><?php echo $no; ?></td>
			<td><?php echo $data['spv_name']; ?></td>
			<td><?php echo $name; ?></td>
			<td><?php if($lapak!=null){echo $lapak;}else{echo ' - ';} ?></td>
			<td><?php echo $data['nonactive_reason']; ?></td>
			<td><?php echo date("d-m-Y H:i:s", strtotime($data['nonactive_date'])); ?></td>
		</tr>
		<?php
			$no++;
			}
		?>
	</tbody>
</table>