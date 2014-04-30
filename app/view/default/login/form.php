<div id="loginbox">
	<h1>Login</h1>
	<ul class="error"><li><?php display_message(); ?></li></ul>
	<form action="/<?php echo get_site_lang(); ?>/login/process" method="post">
		<div class="row"><label for="email">Username:</label><input type="text" name="email" id="email" value="<?php if (isset($email)) echo $email; ?>"/></div>
		<div class="row"><label for="password">Password:</label><input type="password" name="password" id="password" value="<?php if (isset($password)) echo $password; ?>"/></div>
		<div class="row"><label for="submit"> </label><input id="submit" type="submit" value="login" class="submitbutton" /></div>
	</form>
</div>
