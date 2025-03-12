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
<H3 style="text-align:center; margin-top:-10px;">Data Lapak Pasar Induk Surabaya Sidotopo</H3></br>
<table id="lapakView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th >No</th>
			<th>Lapak</th>
			<th style="text-align:center" >P <sup>( m )</sup></th>
			<th style="text-align:center" >L <sup>( m )</sup></th>
			<th style="text-align:center" >Luas <sup>( m<sup>2</sup> )</sup></th>
			<th style="text-align:center" >Harga <sup>( /m<sup>2</sup> )</sup></th>
			<th style="text-align:center" >Total</th>
			<th >Durasi <sup>( tahun )</sup></th>
			<th >Status</th>
			<th >Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql 	= mysql_query("select * from lapak order by block_id, lapak_no");
		$no		= 1;
			while($data=mysql_fetch_array($sql)) { 
			if($data['lapak_status']==''){
				$sts = 'Kosong';
			}else{$sts = $data['lapak_status'];}
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
			<td style="text-align:center"><?php echo $sts; ?></td>
			<td><?php 
				if($data['lapak_status']==''){
					echo '<a href="lapak_edit.php?id='.$data[0].'">
						<button class="btn btn-outline btn-block btn-primary btn-xs">Edit</button>
					</a>';
				}else{
					echo '<a href="lapak_edit.php?id='.$data[0].'">
						<button class="btn btn-outline btn-block btn-primary btn-xs">Edit</button>
					</a>';
				} ?></td>
		</tr>
		<?php
			$no++;
			}
		?>
	</tbody>
</table>