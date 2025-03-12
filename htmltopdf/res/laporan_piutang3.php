<?php
	include "../connection.php";
	$year	= date('Y');
	$mtype	= $_POST['mtype'];
	if($mtype=='Semua'){
		$sql = "select m.merchant_id, m.merchant_name, l.lapak_name, 
		l.lapak_size, l.lapak_total, r.rent_dp, r.leftover, r.rent_date
		from rent r,  merchant m, lapak l
		where r.merchant_id = m.merchant_id and
		l.lapak_id = r.lapak_id and 
		m.merchant_status = 'Aktif'  and
		r.rent_sts != 'Batal' and
		r.rent_sts2 != 'Batal' and
		r.rent_sts2 != 'pindah'
		order by m.merchant_id";
		//r.rent_sts != 'Lunas' and
		//QUery Jumlah Total Pedagang
		$total = executeScalar("select count(distinct(m.merchant_id)) from merchant m, rent r
		where m.merchant_id = r.merchant_id and m.merchant_status = 'Aktif' and
		r.rent_sts != 'Batal' and
		r.rent_sts2 != 'Batal' and
		r.rent_sts2 != 'pindah'");
	}else{
		$sql = "select m.merchant_id, m.merchant_name, l.lapak_name, 
		l.lapak_size, l.lapak_total, r.rent_dp, r.leftover, r.rent_date
		from rent r,  merchant m, lapak l
		where r.merchant_id = m.merchant_id and
		l.lapak_id = r.lapak_id and 
		m.merchant_type = '".$mtype."' and
		m.merchant_status = 'Aktif'  and
		r.rent_sts != 'Batal' and
		r.rent_sts2 != 'Batal' and
		r.rent_sts2 != 'pindah'
		order by m.merchant_id";
		
		//QUery Jumlah Total Pedagang
		$total = executeScalar("select count(distinct(m.merchant_id)) from merchant m, rent r
		where m.merchant_id = r.merchant_id and m.merchant_status = 'Aktif' and
		m.merchant_type = '".$mtype."' and
		r.rent_sts != 'Batal' and
		r.rent_sts2 != 'Batal' and
		r.rent_sts2 != 'pindah'");
	}
	/*$total 	= executeScalar("select count(m.merchant_id) from merchant m, lapak l, rent r 
			where m.merchant_id = r.merchant_id and
			l.lapak_id = r.lapak_id and
			m.merchant_status = 'Aktif' and
			l.block_id = '".$_POST['block']."'");*/
?>
<page backtop="20mm" backbottom="10mm" backleft="5mm" backright="5mm">
    <page_header>
        <table style="width:95%; border:0px; margin-top:30px; margin-left:10px; margin-right:10px;">
            <tr>
                <td style="text-align: left; width: 33%">www.paskomnas.com</td>
                <td style="text-align: center; width: 34%"></td>
                <td style="text-align: right; width: 33%"><?php echo date("d M Y", strtotime($date_now)); ?></td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 95%; border: 0px black; margin-bottom:50px; margin-left:10px; margin-right:10px;">
            <tr>
                <td style="text-align: left;width: 33%">PIOS</td>
				<td style="text-align: left;width: 34%"></td>
                <td style="text-align: right;width: 33%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    <h3 style="text-align:center; margin-top: -30px;">Data Piutang Lapak PIOS</h3> 
	Jumlah Pedagang: <?php echo $total; ?> Orang <br />
	Jenis Pedagang: <?php echo $mtype; ?><br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:10pt; width:1050px; margin-top:10px;" id="merchant">
		<thead>
			<tr>
				<th style="width:4%; text-align: center; border: solid 1px black;">No</th>
				<th style="width:6%; text-align:center; border: solid 1px black;">NIP</th>
				<th style="width:24%; text-align:center; border: solid 1px black;">Nama Pedagang</th>
				<th style="width:8%; text-align:center; border: solid 1px black;">lapak</th>
				<th style="width:8%; text-align:center; border: solid 1px black;">Luas</th>
				<th style="width:10%; text-align:center; border: solid 1px black;">Tgl Sewa</th>
				<th style="width:10%; text-align:center; border: solid 1px black;">Total Harga</th>
				<th style="width:10%; text-align:center; border: solid 1px black;">Uang Muka</th>
				<th style="width:10%; text-align:center; border: solid 1px black;">Piutang</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$query 	= mysql_query($sql);
				$no		= 1;
				while($data = mysql_fetch_array($query)) {
					/*$sql3 	= mysql_query("select l.lapak_size as size, l.lapak_total as total,
					r.rent_dp as dp, r.leftover as lo
					from rent r, lapak l
					where r.lapak_id = l.lapak_id and 
					r.merchant_id = '".$data['merchant_id']."' and
					r.rent_sts2 != 'Pindah'");
					$counter= 0;
					while($row=mysql_fetch_array($sql3)){
						$size = $row['size'];
						$total = $row['total'];
						$dp = $row['dp'];
						$lo = $row['lo'];
						$counter++;
					}*/
			?>
			<tr>
				<td style="width:4%; text-align:center; vertical-align:top; border: solid 1px black;"><?php echo $no; ?></td>
				<td style="width:6%; text-align:left; vertical-align:top; border: solid 1px black;"><?php echo $data['merchant_id']; ?></td>
				<td style="width:24%; text-align:left; vertical-align:top; border: solid 1px black;"><?php echo $data['merchant_name']; ?></td>
				<td style="width:8%; text-align:left; vertical-align:top; border: solid 1px black;"><?php echo $data['lapak_name']; ?></td>
				<td style="width:8%; text-align:right; vertical-align:top; border: solid 1px black;"><?php echo $data['lapak_size']; ?> M<sup>2</sup></td>
				<td style="width:10%; text-align:center; vertical-align:top; border: solid 1px black;"><?php echo date("d-m-Y", strtotime($data['rent_date'])); ?></td>
				<td style="width:12%; text-align:right; vertical-align:top; border: solid 1px black;"><?php echo format_rupiah($data['lapak_total']); ?></td>
				<td style="width:12%; text-align:right; vertical-align:top; border: solid 1px black;"><?php echo format_rupiah($data['rent_dp']); ?></td>
				<td style="width:12%; text-align:right; vertical-align:top; border: solid 1px black;"><?php echo format_rupiah($data['leftover']); ?></td>
			</tr>
			<?php $no++;} ?>
		</tbody>
	</table>
</page>