<?php
	include "../connection.php";
	$date_now 	= date("d-m-Y");
	$no			= date("my");
	$sql 		= mysql_query("select * from rent where rent_id = '".$_GET['id']."'");
	while($r = mysql_fetch_array($sql)){
	$name		= executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
	$lapak		= executeScalar("select lapak_name from lapak where lapak_id = '".$r['lapak_id']."'");
	$iid 		= executeScalar("select instalment_id from rent where lapak_id = '".$r['lapak_id']."'");
	$ins 		= executeScalar("select instalment_count from instalment where instalment_id = '".$iid."'");
	
	//ambil jml brp kali telah melakukan cicilan
	$ins_total	= executeScalar("select count(rent_detail_id) from rent_detail where rent_id = '".$r['rent_id']."'");
	if($ins_total==''){
		$ins_total=1;
	}else{
		$ins_total=$ins_total+1;
	}
	//generate tgl jatuh tempo
	/*$date_in 	= $r['rent_date'];
	$date_plus	= $r['instalment_no'].' month';
	$exp 		= strtotime($date_plus, strtotime($date_in));
	$dateline 	= date('Y-m-j' , $exp);*/
?>
<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm">
    <page_header>
        <table style="width:95%; border:0px; margin-top:30px; margin-left:10px; margin-right:10px;">
            <tr>
                <td style="text-align: left;width: 33%">www.paskomnas.com</td>
                <td style="text-align: center;width: 34%"></td>
                <td style="text-align: right;width: 33%">No: <?php echo $no.$r['merchant_id']; ?></td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 95%; border: 0px black; margin-bottom:50px; margin-left:10px; margin-right:30px;">
            <tr>
                <td style="text-align: left;width: 65%"></td>
                <td style="text-align: right;width: 35%"></td>
            </tr>
        </table>
    </page_footer>
	<br/>
    <div style="font-size: 18px; font-weight: bold; text-align: center; margin-top:30px;">
		Angsuran Lapak PIOS
	</div>
	<br/><br/>
	<table style="margin-bottom: 5px;font-size:12pt;" id="tableInstalment">
		<tr><td>ID Pedagang			</td><td> : <?php echo $r['merchant_id']; ?></td></tr>
		<tr><td>Nama       			</td><td> : <?php echo $name; ?> </td></tr>
		<tr><td>Lapak				</td><td> : <?php echo $lapak; ?></td></tr>
		<tr><td>Total Angsuran 		</td><td> : <?php echo format_rupiah($r['leftover2']); ?></td></tr>
		<tr><td>Angsuran Saat Ini	</td><td> : <?php echo $ins_total; ?></td></tr>
		<tr><td>Tanggal Masuk		</td><td> : <?php echo date("d-m-Y", strtotime($r['rent_date'])); ?></td></tr>
	</table>
    <br />
	<div style="font-size: 16px; font-weight: bold; text-align: center; margin-top:0px; margin-bottom:10px;">
		Tabel Angsuran Lapak <?php echo $lapak; ?>
	</div>
	<table style="width:95%;border:1px black;border-collapse: collapse; margin-left:100px; width:500px;font-size:12pt;">
		<tr>
			<th style="text-align: center;width: 10%; border: solid 1px black;">No</th>
			<th style="text-align: right;width: 45%; border: solid 1px black;">Jumlah Angsuran</th>
			<th style="text-align: right;width: 35%;border: solid 1px black;">Jatuh Tempo</th>
		</tr>
		<?php
			$date 	= $r['rent_dl'];
			
			$i	= 0;
			$x	= 0-1;
			while($i<$ins) {
			$i++;
			$x++;
			$date_plus 	= strtotime($x.' month', strtotime($date));
			$dateline 	= date('Y-m-j' , $date_plus);
		?>
		<tr>
			<td style="text-align: center;border: solid 1px black;"><?php echo $i; ?>.</td>
			<td style="text-align: right;border: solid 1px black;"><?php echo format_rupiah($r['rent_instalment']); ?></td>
			<td style="text-align: right;border: solid 1px black;"><?php echo date("d-m-Y", strtotime($dateline)); ?></td>
		</tr>
		<?php } ?>
	</table>
</page>
<?php } ?>