<table style="font-family:verdana; font-size:10pt;">
	<tr>
		<td width="50px"><? echo $drive; ?></td>
		<td>&raquo;</td>
		<td width="55px" align="right"><? echo to_readble_size($freespace); ?></td>
		<td width="20px" align="right">
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
		<td>of</td>
		<td width="55px" align="right"><? echo to_readble_size($total_space); ?></td>
		<td width="20px" align="right">
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
		<td><strong>[</td>
		<td width="115px" align="right"><? echo $percentage_free.' % <strong>] Free' ?></td>
		<td>&hArr;</td>
		<td width="55px" align="right"><? echo to_readble_size($used_space); ?></td>
		<td width="20px" align="right">
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
		<td ><strong>[</td>
		<td width="115px" align="right"><? echo $percentage_used.' % <strong>] Used' ?></td>	          			
	</tr>
</table>