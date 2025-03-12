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
	$('#merchantView3').dataTable( {
			dom: "<'row'<'col-sm-8'l><'col-sm-4'f>>" +  
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
<h3 style="text-align:center;">Daftar Pedagang</h3>
<table id="merchantView3" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:5%;">No</th>
			<th style="width:8%;">ID</th>
			<th style="width:14%;">Nama</th>
			<th style="width:25%;">Alamat</th>
			<th style="width:12%;">Lapak</th>
			<th style="width:8%;">Jualan</th>
			<th style="width:8%;">Status</th>
			<th style="width:8%;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql 	= "select * from merchant order by merchant_id desc";
		$query 	= mysql_query($sql);
		$no		= 1;
		while($data=mysql_fetch_array($query)) { 
		$sql2 	= mysql_query("select l.lapak_name from rent r, lapak l
				where r.lapak_id = l.lapak_id and 
				r.merchant_id = '".$data['merchant_id']."' and
				(r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal')
				order by l.lapak_name limit 7");
		$string="";
		$counter=0;
		while($row=mysql_fetch_array($sql2)){
			if($counter!=0){
				$string = ", ".$string;
			}
			$string = $row['lapak_name'].$string;
			$counter++;
		}
		$lapak = "".$string;
		?>
		<tr>
			<td style="text-align:center;"><?php echo $no; ?></td>
			<td><?php echo $data['merchant_id']; ?></td>
			<td><?php echo $data['merchant_name']; ?></td>
			<td><?php echo $data['address1']; ?></td>
			<td><?php echo $lapak; ?></td>
			<td><?php echo $data['merchant_type']; ?></td>
			<td><?php echo $data['merchant_status']; ?></td>
			<td>
			<?php
			if($data['merchant_status']=='Tidak Aktif'){
				echo '<a href="modal_active.php?id='.$data['merchant_id'].'" data-toggle="modal" data-target="#modalAktif">
				<button class="btn btn-outline btn-block btn-primary btn-xs">Aktifkan</button></a>';
			}else{
				echo '<a href="modal_nonactive.php?id='.$data['merchant_id'].'" data-toggle="modal" data-target="#modalNonaktif">
				<button class="btn btn-outline btn-block btn-primary btn-xs">NonAktifkan</button></a>';
			}
			?>
			</td>
		</tr>
		<?php $no++;} ?>
	</tbody>
</table>