<table style="font-family:verdana; font-size:10pt;">
	<tr>
		<td style="font-size:9pt;" width="85px"><? echo $drive; ?></td>
		<td style="font-size:9pt;" ><strong>[</strong></td>
		<td style="font-size:9pt;" width="50px"><? echo $mountpoint; ?></td>
		<td style="font-size:9pt;" ><strong>]</strong></td>
		<td style="font-size:9pt;" >&raquo;</td>
		<td style="font-size:9pt;" width="52px" align="right"><? echo to_readble_size($freespace); ?></td>
		<td style="font-size:9pt;" width="20px" align="right">
			<? 
				if($freespace > 1099511627776)
					{
					$suffix = 'TB';
					}
				elseif($freespace > 1073741824)
					{
					$suffix = 'GB';
					}
				elseif($freespace > 1048576)
					{
					$suffix = 'MB';
					}
				elseif($freespace > 1024)
					{
					$suffix = 'KB';
					}
				else
					{
					$suffix = 'B';
				};
				echo $suffix; 
			?>
		</td>
		<td style="font-size:9pt;" >of</td>
		<td style="font-size:9pt;" width="52px" align="right"><? echo to_readble_size($total_space); ?></td>
		<td style="font-size:9pt;" width="20px" align="right">
			<? 
				if($total_space > 1099511627776)
					{
					$suffix = 'TB';
					}
				elseif($total_space > 1073741824)
					{
					$suffix = 'GB';
					}
				elseif($total_space > 1048576)
					{
					$suffix = 'MB';
					}
				elseif($total_space > 1024)
					{
					$suffix = 'KB';
					}
				else
					{
					$suffix = 'B';
					};
				echo $suffix; 
			?>
		</td>
		<td style="font-size:9pt;"><strong>[</strong></td>
		<td style="font-size:9pt;" width="72px" align="right"><? echo $percentage_free.' % <strong>]</strong>' ?></td>
		<td style="font-size:9pt;"><strong>Free</strong></td>
		<td style="font-size:9pt;">&hArr;</td>
		<td style="font-size:9pt;" width="52px" align="right"><? echo to_readble_size($used_space); ?></td>
		<td style="font-size:9pt;" width="17px" align="right">
			<? 
				if($used_space > 1099511627776)
					{
					$suffix = 'TB';
					}
				elseif($used_space > 1073741824)
					{
					$suffix = 'GB';
					}
				elseif($used_space > 1048576)
					{
					$suffix = 'MB';
					}
				elseif($used_space > 1024)
					{
					$suffix = 'KB';
					}
				else
					{
					$suffix = 'B';
					};
				echo $suffix; 
			?>
		</td>
		<td style="font-size:9pt;" ><strong>[</strong></td>
		<td style="font-size:9pt;" width="72px" align="right"><? echo $percentage_used.' % <strong>]</strong>' ?></td>
		<td style="font-size:9pt;" ><strong>Used</strong></td>
	</tr>
</table>