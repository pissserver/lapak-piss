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
	$('#merchantView').dataTable({"aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]]});
	});
</script>
<h3>Data Pedagang PISS</h3>
<table id="merchantView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:5%;">No</th>
			<th style="width:5%;">ID</th>
			<th style="width:14%;">Nama</th>
			<th style="width:20%;">Alamat</th>
			<th style="width:9%;">Lapak</th>
			<th style="width:7%;">Jualan</th>
			<th style="width:7%;">Status</th>
			<th style="width:7%;">Status 2</th>
			<th style="width:7%;">Status Pedagang</th>
			<th style="width:8%;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql 	= "	select 		merchant_id, 
								merchant_name, 
								address1, 
								merchant_type, 
								merchant_status, 
								merchant_status2,
								kat_merchant
					from 		merchant 
					order by 	merchant_id desc";
		$query 	= mysql_query($sql);
		$no		= 1;
		while($data=mysql_fetch_array($query)) {
		$sql2 	= mysql_query("	select 	l.lapak_name 
								from 	rent r, lapak l
								where 	r.lapak_id = l.lapak_id and 
										r.merchant_id = '".$data['merchant_id']."' and
										(r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal')
								order by l.lapak_name limit 7");
		$string	= "";
		$counter= 0;
		while($row=mysql_fetch_array($sql2)){
			if($counter!=0){
				$string = ", ".$string;
			}
			$string = $row['lapak_name'].$string;
			$counter++;
		}
		$lapak 	= "".$string;
		?>
		<tr>
			<td style="text-align:center;"><?php echo $no; ?></td>
			<td><?php echo $data['merchant_id']; ?></td>
			<td><?php echo $data['merchant_name']; ?></td>
			<td><?php echo $data['address1']; ?></td>
			<td><?php echo $lapak; ?></td>
			<td><?php echo $data['merchant_type']; ?></td>
			<td><?php echo $data['merchant_status']; ?></td>
			<td><?php echo $data['merchant_status2']; ?></td>
			<td><center><?php echo $data['kat_merchant']; ?></center></td>
			<td>
				<center>
					<a href="merchant_edit.php?id=<?php echo $data['merchant_id']; ?>">
						<button class="btn btn-outline btn-block btn-primary btn-xs">Lihat Detail</button>
					</a>
				</center>
			</td>
		</tr>
		<?php $no++;} ?>
	</tbody>
</table>