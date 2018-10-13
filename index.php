<?php
function generateRandomString($length = 10) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < strlen($chars); $i++) {
        $randomString .= $chars[rand(0, strlen($chars)-1)];
    }
    return $randomString;
}
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mein Abgeordneter hetzt!</title>
    <meta name="description" content="Die AfD möchte über Hetze informiert werden. Da helfen wir doch gerne! #meinabgeordneterhetzt #piraten">
    <link rel="shortcut icon" href="/favicon.ico" />
	<meta property="og:type"               content="website" />
	<meta property="og:title"              content="Mein Abgeordneter hetzt!" />
	<meta property="og:description"        content="Die AfD möchte über Hetze informiert werden. Da helfen wir doch gerne!" />
	<meta name="referrer" content="no-referrer">
	<meta name="twitter:card" content="summary_large_image"></meta>
	<meta property="twitter:description"        content="Die AfD möchte über Hetze informiert werden. Da helfen wir doch gerne!" />
    <style>
		@font-face {
			font-family: roboto;
			src: url(roboto/Roboto-Regular.ttf);
		}
		* {
			box-sizing: border-box;
		}
		html, body {
			background-color: white;
			text-align: center;
			color: white;
			font-family: roboto, sans-serif;
			font-size: 26px;
			padding: 0;
			margin: 0;
		}
		.main {
			background-color: #349ce0;
			padding: 10px;
			background: linear-gradient(to bottom, #349ce0, #67bdf5);
		}
		.sec {
			background-color: white;
			color: #333;
			padding: 10px;
			font-size: 75%;
		}
		
		.center {
			margin :auto;
			width: 90%;
			max-width: 800px;
		}
		input[type=text], textarea, button, input[type=submit] {
			border: none;
			background-color: white;
			color: black;
			font-size: 75%;;
			display: block;
			padding: 7px;
			margin: 5px;
			width: 100%;
			text-align: center;
			font-family: sans-serif;
		}
		button, input[type=submit] {
			border: none;
			margin: 5px;
			background-color: #da0023;
			color: white;
			border-radius: 5px;
		}
		h1 {
			border-bottom: 6px solid  #da0023;
			font-size: 200%;
		}
		.desc {
			font-size: 75%;
		}
		.smaller {
			font-size: 70%;
		}
		img.logo {
			margin: auto;
			width: 100%;
			max-width: 200px;
			margin: 8px;
		}
		a {
			color: white;
			text-decoration: underline;
		}
		.sec a {
			color: black;
		}
		label {
			font-weight: bold;
		}
		.succ {
			display: none;
		}
		.shariff ul {
			justify-content: center;
			padding: 8px;
		}
		.sec p {
			text-align: justify;
		}
		
    </style>
    <link href="shariff/shariff.complete.css" rel="stylesheet">
     <script src="jquery-3.3.1.min.js"></script> 
     <script src="autosize.min.js"></script> 
  </head>
  <body>
  <?php

  // Meldeportale laden
  $portale0 = file_get_contents("data/portale.json");
  $portale = json_decode($portale0, true);
  
  // Meldeportal zufällig auswählen
  $goon = true;
  while (true === $goon) {
	$nr = rand(0, count($portale)-1);
	$portal = $portale[$nr];
	if ($portal['active'] == 1) $goon = false;
  }
  
  // Zitate laden
  $zitate0 = file_get_contents("data/zitate.json");
  $zitate = json_decode($zitate0, true);
  
  $zitate_k = array_keys($zitate);
  $zitate_v = array_values($zitate);
  
  // Orte laden
  $orte0 = file_get_contents("data/orte.json");
  $orte = json_decode($orte0, true);
  
  // Domains laden
  $domains0 = file_get_contents("data/domains.json");
  $domains = json_decode($domains0, true);
  
  // Schulen laden
  $schulen0 = file_get_contents("data/schulen.json");
  $schulen = json_decode($schulen0, true);
    
  // Textvorlagen laden
  $texte0 = file_get_contents("data/texte.json");
  $texte = json_decode($texte0, true);
  
 
  $textnr = rand(0, (count($texte)-1));
  $zitatnr = rand(0, (count($zitate)-1));
  $schulenr = rand(0, (count($schulen)-1));
  $ortnr = rand(0, (count($orte)-1));
  $domainnr = rand(0, (count($domains)-1));
  
  $text = $texte[$textnr];
  
  $text = str_replace("[name]", $zitate_k[$zitatnr], $text);
  $text = str_replace("[zitat]", $zitate_v[$zitatnr], $text);
  
  $schule = $schulen[$schulenr];
  $ort = $orte[$ortnr];
  $domain = $domains[$domainnr];
  
  ?>
	<div class="main">
		<h1>Mein Abgeordneter hetzt!</h1>  
		<div class="center">
		<p>Die AfD möchte gerne über Hetze benachrichtigt werden. Da helfen wir doch gerne!</p>
		<form id="mainform" method="post" enctype="multipart/form-data" action="<?php echo $portal['url']; ?>" target="_blank">
		
		<p id="quote"><label for="Schule">Schule:</label>
		<input readonly id="Schule" name="<?php echo $portal['schule']; ?>" type="text" value="<?=$schule;?>"></p>
		
		<p id="quote"><label for="Ort">Ort:</label>
		<input readonly id="Ort" name="<?php echo $portal['ort']; ?>" type="text" value="<?=$ort;?>"></p>
		
		<p><label for="Lehrername">Name des Lehrers:</label>
		<input readonly type="text" id="Lehrername" name="<?php echo $portal['lehrername']; ?>" value="<?=$zitate_k[$zitatnr];?>"></p>
		
		<p><label for="your-message">Deine Nachricht:</label>
		<textarea readonly name="<?php echo $portal['text']; ?>"><?=$text;?></textarea></p>

		<p><label for="portal">wird gemeldet an:</label>
		<input readonly type="text" id="portal" name="" value="<?php echo $portal['name']; ?>"></p>
		
		<input type="hidden" name="<?php echo $portal['plz']; ?>" value="<?=rand(10000,99999);?>">
		<input type="hidden" name="<?php echo $portal['email']; ?>" value="<?php echo strtolower(generateRandomString(6)); ?>@<?php echo strtolower($domain); ?>">
		<input type="hidden" name="<?php echo $portal['telefon']; ?>" value="<?php echo rand(200,9999999); ?>">
		
		<?php
		if (is_array($portal['fixed']) && (count($portal['fixed']) > 0)) {
			foreach ($portal['fixed'] as $k => $v) {
				echo "<input type=\"hidden\" name=\"".$k."\" value=\"".$v."\">";
			}
		}
		?>
		
		<button type="submit" id="sendtoafd">Widerliche Hetze! Das will ich der AfD (<?php echo $portal['name'];  ?>) melden!<br><small>Du wirst auf die Seite der AfD weitergeleitet</small></button>
		</form>
		<form action="" id="reloadform">
		<button type="submit">Diesen Hetzer kannte ich schon. Neu würfeln!</button>
		</form>
		
		<p class="smaller">Hinweis: Wenn du auf "Das will ich der AfD melden!" klickst, wirst du auf die Seite der AfD weitergeleitet. Dadurch erfährt die AfD ggf. deine IP-Adresse. Abhilfe bietet z.B. der <a href="https://www.torproject.org/projects/torbrowser.html.en">Tor Browser</a>.</p>
		
		
		</form>
	
		
		</div>
		</div>
		<div class="sec" id="sec2">
				 <div class="succ center">
		 <p style="font-size: 25px;"><strong>Vielen Dank!</strong> Das Zitat wurde erfolgreich gemeldet.</p>
		 </div>
				 <div class="shariff" data-services="twitter,facebook,whatsapp,threema,telegram,diaspora,reddit,info" data-twitter-via="PiratenBW" data-title="Die AfD möchte über Hetze informiert werden. Da helfen wir doch gerne! #meinabgeordneterhetzt #piraten"></div>
		<div class="center desc" >
		<h2>Was ist das hier?</h2>
		<p>Die Piratenpartei stellt sich entschieden gegen eine Kultur der Denunziation. Mit diesem Tool bieten wir euch die Möglichkeit, die Melde-Portale der AfD mit Fakten, Zitaten und humorvollen Inhalten zu füllen und so ein Zeichen gegen Denunziation zu setzen.</p>
		
		
		<h2>Wie funktioniert das?</h2>
		<p>Per Klick auf den Button wird ein Zitat der AfD zufällig ausgewählt. Bist du damit zufrieden, kannst du es direkt an das Meldeportal der AfD per Klick auf den anderen Button senden.</p>
	
<h2>Was ist der Hintergrund?</h2>
<p>Wie in anderen Bundesländern bereits geschehen, fordert die AfD nun auch in Baden-Württemberg dazu auf, Lehrer und Professoren zu denunzieren, welche angeblich gegen die AfD gehetzt haben und so gegen ihre Neutralitätspflicht verstoßen haben sollen. Die Piratenpartei sieht darin neben enormen datenschutzrechtlichen Bedenken eine Form der Aufbringung der Gesellschaft gegeneinander. Denunziation gehört zu den Mitteln autoritärer Staaten, wir dagegen setzen auf einen starken Rechtsstaat. Anstelle von Denunziation setzt sich die Piratenpartei für das Prinzip der Aufklärung ein und fordert bereits seit Jahren eine stärkere politische Bildung der Schüler und Schülerinnen. Gemeinsam können wir ein Zeichen gegen die Denunziations-Kultur setzen. Die PIRATEN fordern hiermit alle auf, die Melde-Plattformen mit Zitaten der AfD und humorvollen Anfragen zu füllen. Dafür stellen wir diesen Generator zur Verfügung.</p>

<h2>Was ist das Neutralitätsgebot?</h2>
<p>Lehrer und auch Professoren sind beim Staat angestellt und zu politischer Neutralität in ihrer Funktion verpflichtet. Dies bedeutet, dass sie z.B. Parteien nicht in schlechtes Licht rücken oder Werbung für sie machen dürfen. Schüler und Studierende sollen nicht unter dem Einfluss der Lehrenden stehen. Lehrer und Professoren verpflichten sich allerdings auch dazu, für die freiheitlich demokratische Grundordnung einzustehen, also die Grundprinzipien unserer Demokratie zu achten. In diesem Rahmen gehört es auch zu ihrer Aufgabe, etwa über Parteien zu informieren die diese freiheitlich demokratische Grundordnung bedrohen. 
Das Neutralitätsgebot verbietet es Lehrenden aber nicht, in eine Partei einzutreten und ihre politische Meinung als Privatperson kundzutun.  </p>

<h2>PIRATEN? Gibt's die noch?</h2>
<p>Na klar! Wir sind immer noch da und kämpfen u.a. für Datenschutz und gegen Denunziation.<br>Mehr über uns: <a href="https://piratenpartei-bw.de">https://piratenpartei-bw.de</a><br>
Du möchtest mehr von uns sehen? <a href="https://piratenpartei-bw.de/eu-wahl-2019/">Dann unterstütze uns, damit wir wieder zur Europawahl antreten können!</a></p>
	
		</div>
		
		<hr>
		<div class="center smaller">
		<p style="text-align:center;">Entwickelt von der <a href="https://piratenpartei-bw.de">Piratenpartei Baden-Württemberg</a>.<br><img class="logo" src="logo_piratenbw.png" alt="Piratenpartei Baden-Württemberg"><br><a href="">Impressum</a> | <a href="">Datenschutz</a></p>
		
		</div>
		</div>
		<script type="text/javascript">
			$( document ).ready(function() {
				$("#reloadform").submit(function(e) {
					if ($(window).width() < 700) {
						window.location.hash = '#quote';
					} else {
						window.location.hash = '#';
					}
					window.location.reload(true);
					e.preventDefault();
				});
				autosize($('textarea'));
			});
		</script>
		<script src="shariff/shariff.min.js"></script>
  </body>
</html>


