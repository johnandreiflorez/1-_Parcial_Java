<?php 


function start() {
global $action,$lang;
settype($vars,"array");
if($action == "") {


$vars["cnt_de"] = '
<h3>Bedingungen f�r die Benutzung von Useware</h3>
<p>Die Usewarebedingungen entsprechen der GNU GPL: <a href="http://www.gnu.org/licenses/gpl.txt" target="_blank">http://www.gnu.org/licenses/gpl.txt</a></p>
<p>Mehr Informationen finden Sie unter "�ber" in der Software</p>
<p>Setzen Sie die Programme aber f�r kommerzielle Zwecke ein, so bitte wir um eine Spende!</p>
';

$vars["cnt_en"] = '
<h3>Conditions for the use of useware</h3>
<p>These conditions comply to the GNU GPL: <a href="http://www.gnu.org/licenses/gpl.txt" target="_blank">http://www.gnu.org/licenses/gpl.txt</a></p>
<p>More information under "About" in the software.</p>
<p>If you use the programms for commercial purpose, we will ask for donations!</p>

'; 

$vars["image"] = "useware.jpg";
}

$vars["titel_de"] = "Bedingungen";
$vars["titel_en"] = "Conditions";

$vars["links"][0]["text_de"] = "Spenden";
$vars["links"][0]["text_en"] = "Donate";
$vars["links"][0]["link"] = "http://www.chsoftware.net/".$lang."/useware/donation/donation.htm";

$vars["links"][1]["text_de"] = "Zur�ck";
$vars["links"][1]["text_en"] = "Back";
$vars["links"][1]["link"] = "index.php?lang=".$lang;


return $vars;
}


?>