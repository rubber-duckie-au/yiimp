<?php

$api = file_get_contents("https://api.coingecko.com/api/v3/simple/price?ids=digitalnote&vs_currencies=usd%2Cbtc&include_market_cap=true&include_24hr_vol=true&include_24hr_change=true");
//json fucntion
$data= json_decode($api, true); 
//split array data
$split= $data['digitalnote'];
$btc_price=number_format((float)$split['btc'], 8, '.', '');
$usd_price=number_format((float)$split['usd'], 8, '.', '');
$usd_market_cap=number_format((float)$split['usd_market_cap'], 2, '.', '');
$usd_24h_vol=number_format((float)$split['usd_24h_vol'], 2, '.', '');
$usd_24h_change=number_format((float)$split['usd_24h_change'], 2, '.', '');
if ($usd_24h_change < "0") {
$colour="red";
} else {
$colour="green";
}
$api2=file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=digitalnote&order=market_cap_desc&per_page=100&page=1&sparkline=false");
$api2=str_replace("[","",$api2);
$api2=str_replace("]","",$api2);
$data2= json_decode($api2, true); 
$market_cap_rank=$data2['market_cap_rank'];


echo <<<END
<ul>
<center>
<h2>DigitalNote - XDN<font color='grey'> (#$market_cap_rank)</font></h2>
<br>
<table style="width:10%;display:inline-block">
<tr>
<td rowspan="6"><img src="/images/DN_updated_2019.png" width="64" height="64"/></td>
</tr>
</table>
<table style="width:10%;display:inline-block">
</table>
<table border="0" style="display:inline-block">
<tr>
<td><font size=3><b>USD: </b>$usd_price (<font color=$colour>$usd_24h_change%</font>)</font></td>
</tr>
<tr>
<td><i><font color='grey'><b>(BTC: </b>$btc_price)</font></i></td>
</tr>
<tr>
<td><b>Volume (24h): </b>$$usd_24h_vol</td>
</tr>
<td><b>Market Cap: </b>$$usd_market_cap</td>
</tr>
</table>
<p><i><font size = 1.75><b>Powered by CoinGecko's FREE API</b></font><i></p>
</center>
END;
?>


