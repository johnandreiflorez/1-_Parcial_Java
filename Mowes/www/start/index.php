<?php


include("include.inc.php");

$query = getenv("QUERY_STRING");
parse_url($query);


if($p == "") {
	$p = "start";
}
if($lang == "") $lang = "en";

$file = $p . ".inc";
if(file_exists($file)) {
	include($file);
}else{
	include("error.inc");
}






	$mntmpl = "layout.tmpl";

$cnts = start();



if($lang == "de") {
	echo mkpage($cnts,$cnts["links"],$cnts["titel_de"],$mntmpl,$cnts["image"],"de");

}else{
	echo mkpage($cnts,$cnts["links"],$cnts["titel_en"],$mntmpl,$cnts["image"],"en");

}




function getfile($n) {
	$fp = @fopen($n,"r");
	$str = @fread($fp,filesize($n));
	@fclose($fp);
	return $str;
}

function mkpage($cnt,$links,$titel,$template,$img,$lang) {
	global $url,$imgurl,$cssfile,$current_path,$current_page;

	$layout = getfile($template);
	$layout = str_replace("#url",$url,$layout);


	$layout = str_replace("#t",$titel,$layout);
	$layout = str_replace("#year","2003-".date("Y"),$layout);
	$layout = str_replace("#lang",$lang,$layout);
	$query = getenv("QUERY_STRING");






	if($lang == "de") { $cnt = $cnt["cnt_de"]; }else{ $cnt = $cnt["cnt_en"]; }


	$cnt = str_replace('#url',$url,$cnt);
	$layout = str_replace("#c",$cnt,$layout);
	for($x=0;$x<sizeof($links);$x++) {

		if($links[$x]["text_en"] == "") { $links[$x]["text_en"] = $links[$x]["text_de"]; }
		$tlink =  $links[$x]["link"];
		if($links[$x]["target"] != "") {
			if($lang == "de") {
				$lnk.= '<p><a href="'.$tlink.'" target="'.$links[$x]["target"].'"><img src="images/list.gif" alt="" width="15" height="8" border="0">'.$links[$x]["text_de"].'</a></p>';
			}else{
				$lnk.= '<p><a href="'.$tlink.'" target="'.$links[$x]["target"].'"><img src="images/list.gif" alt="" width="15" height="8" border="0">'.$links[$x]["text_en"].'</a></p>';
			}
		}else{
			if($lang == "de") {
				$lnk.= '<p><a href="'.$tlink.'"><img src="images/list.gif" alt="" width="15" height="8" border="0">'.$links[$x]["text_de"].'</a></p>';
			}else{
				$lnk.= '<p><a href="'.$tlink.'"><img src="images/list.gif" alt="" width="15" height="8" border="0">'.$links[$x]["text_en"].'</a></p>';
			}
		}
	}
	$layout = str_replace("#l",$lnk	,$layout);
	







	$imgs = '<img src="images/icons/'.$img.'" width="150"><br><br><img src="images/people/01.jpg" width="150"><br><br><img src="images/objects/01.jpg" width="150">';
	$layout = str_replace("#i",$imgs	,$layout);

	return $layout;
}






?>