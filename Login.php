<?php
//Whitelist prüfen, ob die Webseiten vorhanden und in der Whitelist sind
$availablePages = array('header_Login.php');
if (file_exists('header_Login.php') and in_array('header_Login.php', $availablePages)) {
	//Nachladen der Dateien
	require 'header_Login.php';
}
?>
<div class="login-page">
	<div class="form">
		<!-- Registrieren -->
		<form class="register-form" action="Login_Register.php" method="post">
			<input name="username" type="email" placeholder="username" required>
			<input name="password" type="password" placeholder="password" required>
			<p>
				<a>Gebe das aktuelle Datum ein:</a>
				<!-- Aktuelles Datum -->
				<input type="text" name="result" value="" required />
			</p>
			<!-- Captcha -->
			<img src="captcha.php?RELOAD=" alt="Captcha" title="Klicken, um das Captcha neu zu laden" onclick="this.src+=1;document.getElementById('captcha_code').value='';" width=140 height=40 />
			<input type="text" name="captcha_code" id="captcha_code" size=10 />
			<!-- Bot Test -->
			<input type="hidden" name="bot">
			<button>create</button>
			<p class="message">Schon regestriert <a href="#">Log In</a></p>
		</form>
		<!-- Login -->
		<form class="login-form" action="Login_Check.php" method="post">
			<input name="username" type="email" placeholder="Username" required>
			<input name="password" type="password" placeholder="password" required>
			<input name="einmalcode" type="text" placeholder="Einmal-Code" required>
			<!-- Aktuelles Datum -->
			<input type="text" name="result" value="" required placeholder="Aktuelles Datum" />
			<!-- Captcha -->
			<img src="captcha.php?RELOAD=" alt="Captcha" title="Klicken, um das Captcha neu zu laden" onclick="this.src+=1;document.getElementById('captcha_code').value='';" width=140 height=40 />
			<input type="text" name="captcha_code" id="captcha_code" size=10 />
			<!-- Bot Test -->
			<input type="hidden" name="bot">
			<button>login</button>
			<p class="message">Nicht regestriert? <a href="#">Erstelle einen Account</a></p>
		</form>
	</div>
</div>
</body>
</html>