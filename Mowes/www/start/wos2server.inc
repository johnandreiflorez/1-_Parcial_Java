<?php 


function start() {
global $action;
settype($vars,"array");
if($action == "") {
$vars["cnt_de"] = '
<p>Irgendwann kommt der Zeitpunkt, an dem Sie Ihr WOS Paket auf einen Server umziehen wollen.</p>
<p>Leider ist der Umzug eines WOS Pakets auf einen "richtigen" Webserver oft nicht so einfach für Einsteiger.<br>
Deswegen bietet Ihnen unser WOS Partner <a href="http://www.beforesunrise.de" target="_blank">BeforeSunrise</a> einen Umzugsservice an.<br>
Sie schicken BeforeSunrise Ihr WOS Paket und der Rest wird Sie erledigt. Interessiert? Nehmen Sie doch einfach mit dem BeforeSunrise Team <a href="http://beforesunrise.de/go.php?flash=1&sprache=de&r=">Kontakt</a> auf.</p>
';


$vars["cnt_en"] = '
<p>The time you want to move your WOS package to a server will come.</p>
<p>Unfortunately installing software on a "real" webserver is not that easy as WOS is.<br>
This is why our WOS Partner <a href="http://www.beforesunrise.de" target="_blank">BeforeSunrise</a> offers a WOS 2 Server service for you.<br>
You send your WOS package and they do the rest. Interested? Just get in <a href="http://beforesunrise.de/go.php?flash=1&sprache=en&r=">contact</a> with the BeforeSunrise team</p>
';


$vars["image"] = "wos.jpg";
}

$vars["titel_de"] = "WOS2Server";
$vars["titel_en"] = "WOS2Server";


$vars["links"][0]["text_de"] = "Zurück";
$vars["links"][0]["text_en"] = "Back";
$vars["links"][0]["link"] = "index.php?lang=".$lang;


return $vars;
}


?>