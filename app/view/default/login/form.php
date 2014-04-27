<div id="loginbox">
	<h1>Login</h1>
	<?php if ($message) : ?>
		<ul class="error"><li><?php echo $message; ?></li></ul>
	<?php endif; ?>
	<form action="/<?php echo get_site_lang(); ?>/login/process" method="post">
		<div class="row"><label for="username">Username:</label><input type="text" name="username" id="username" /></div>
		<div class="row"><label for="password">Password:</label><input type="password" name="password" id="password" /></div>
		<div class="row"><label for="submit"> </label><input id="submit" type="submit" value="login" class="submitbutton" /></div>
	</form>
</div>
