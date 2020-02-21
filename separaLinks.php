<?php
`rm *.jpg`;
`reset;`;

if(isset($argv[1])){
	$data = $argv[1];
}
else{
	$data = date('Ymd');
}

$veiculo = 918;
$extensao = 'jpg';
$tudo = "";

$ponteiro = fopen ("/home/romario.arruda/flip/{$veiculo}/links.txt","r");
while (!feof ($ponteiro)) {
	$tudo .= fgets($ponteiro,4096);
}
fclose ($ponteiro);



preg_match_all("#http://www.asemana.com.br/wp-content/pageflip/images/i[\w_]+\.jpg#is", $tudo, $link);

$arr_final = array_unique($link[0]);
$i = 1;
$links = "";
foreach ($arr_final as $k => $v) {
	$url = ": <img src='".$v."' width='150' alt='".str_pad($i, 2, "0", STR_PAD_LEFT)."'>\n";
	// $link = "\n".$v;
	// echo $url;
	$links .="$url";
	$i++;
}

$fp = fopen("/home/romario.arruda/flip/{$veiculo}/paginas.html", 'w+');
$escreve = fwrite($fp, $links);
fclose($fp);
`firefox paginas.html`;
