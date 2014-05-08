<div id="loginbox">
	<h1><?php echo lang('title.login'); ?></h1>
	<form action="/<?php echo get_site_lang(); ?>/login/process" method="post">
		<div class="row"><?php echo display_message(); ?></div>
		<div class="row"><label for="email"><?php echo lang('form.username'); ?>:</label><input type="text" name="email" id="email" value="<?php if (isset($email)) echo $email; ?>"/></div>
		<div class="row"><label for="password"><?php echo lang('form.password'); ?>:</label><input type="password" name="password" id="password" value="<?php if (isset($password)) echo $password; ?>"/></div>
		<div class="row"><label for="submit"> </label><input id="submit" type="submit" value="<?php echo lang('title.login'); ?>" class="submitbutton" /></div>
	</form>
</div>
