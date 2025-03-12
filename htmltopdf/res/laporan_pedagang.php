<?php
	include "../connection.php";
	$year	= date('Y');
	$mtype	= $_POST['mtype'];
	$sts	= $_POST['sts'];
	
	//select tonase berdasarkan komoditi & Status
	if($sts=='Semua'){
		if($mtype=='Semua'){
			$sql 	= "select * from merchant order by merchant_id";
			$total 	= executeScalar("select count(merchant_id) from merchant");
		}
		else{
			$sql 	= "select * from merchant where merchant_type = '".$mtype."' order by merchant_id";
			$total 	= executeScalar("select count(merchant_id) from merchant 
			where merchant_type = '".$mtype."'");
		}
	}
	else{
		if($mtype=='Semua'){
			$sql 	= "select * from merchant where merchant_status = '".$sts."' order by merchant_id";
			$total 	= executeScalar("select count(merchant_id) from merchant where merchant_status = '".$sts."'");
		}
		else{
			$sql 	= "select * from merchant where merchant_type = '".$mtype."' and merchant_status = '".$sts."'
			order by merchant_id";
			$total 	= executeScalar("select count(merchant_id) from merchant 
			where merchant_type = '".$mtype."' and merchant_status = '".$sts."'");
		}
	}
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
        <table style="width: 95%; border: 0px black; margin-bottom:50px; margin-left:10px; margin-right:30px;">
            <tr>
                <td style="text-align: left;width: 33%">PIOS</td>
				<td style="text-align: left;width: 34%"></td>
                <td style="text-align: right;width: 33%">Halaman [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
	    <h3 style="text-align:center; margin-top: -30px;">Data Pedagang PIOS</h3> 
	Jumlah Pedagang: <?php echo $total; ?> Orang <br />
	Status Pedagang: <?php echo $sts; ?> <br />
	<table style="border: solid 1px black; border-collapse: collapse; margin-bottom: 5px;font-size:10pt; width:1050px; margin-top:10px;" id="merchant">
		<thead>
			<tr>
				<th style="width:4%; text-align: center; border: solid 1px black;">No</th>
				<th style="width:5%; text-align:center; border: solid 1px black;">ID</th>
				<th style="width:16%; text-align:center; border: solid 1px black;">Nama Pedagang</th>
				<th style="width:10%; text-align:center; border: solid 1px black;">Tlp Rumah</th>
				<th style="width:11%; text-align:center; border: solid 1px black;">Handphone</th>
				<th style="width:27%; text-align:center; border: solid 1px black;">Alamat</th>
				<th style="width:12%; text-align:center;  border: solid 1px black;">Lapak</th>
				<th style="width:6%; text-align:center; border: solid 1px black;">Jualan</th>
				<th style="width:7%; text-align:center;  border: solid 1px black;">Status</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$query 	= mysql_query($sql);
				$no		= 1;
				
				while($data=mysql_fetch_array($query)) {
					if($data['phone1']!=''){
						$p1 = $data['phone1'];
					}
					else{
						$p1 = '-';
					}
					if($data['phone2']!=''){
						$p2 = $data['phone2'];
					}
					else{
						$p2 = '-';
					}
					
					$sql2 	= mysql_query("select l.lapak_name from rent r, lapak l
							where r.lapak_id = l.lapak_id and 
							r.merchant_id = '".$data['merchant_id']."' and
							r.rent_sts2 != 'Pindah'
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
				<td style="width:4%; text-align:center; vertical-align:top; border: solid 1px black;"><?php echo $no; ?></td>
				<td style="width:5%; text-align:center; vertical-align:top; border: solid 1px black;"><?php echo $data['merchant_id']; ?></td>
				<td style="width:16%; text-align:left; vertical-align:top; border: solid 1px black;"><?php echo $data['merchant_name']; ?></td>
				<td style="width:10%; text-align:center; vertical-align:top; border: solid 1px black;"><?php echo $p1; ?></td>
				<td style="width:11%; text-align:center; vertical-align:top; border: solid 1px black;"><?php echo $p2; ?></td>
				<td style="width:27%; text-align:left; vertical-align:top; border: solid 1px black;"><?php echo $data['address1']; ?></td>
				<td style="width:12%; text-align:left; vertical-align:top; border: solid 1px black;"><?php echo $lapak ?></td>
				<td style="width:6%; text-align:left; vertical-align:top; border: solid 1px black;"><?php echo $data['merchant_type']; ?></td>
				<td style="width:7%; text-align:left; vertical-align:top; border: solid 1px black;"><?php echo $data['merchant_status']; ?></td>
			</tr>
			<?php $no++;} ?>
		</tbody>
	</table>
</page>