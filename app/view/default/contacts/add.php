<div class="row error"><label></label><?php display_message(); ?></div>
<h2>Add Account</h2>
<form action="/<?php echo get_site_lang(); ?>/application/processadd" method="post" id="editform">
    <input type="hidden" name="id" value="3" />
    <div class="row">
		<label for="user_name">User Name:</label>
		<input type="text" name="user_name" id="user_name" value="" />
	</div>
    <div class="row">
		<label for="email">Email:</label>
		<input type="text" name="email" id="email" value="" />
	</div>
    <div class="row">
		<label for="password">password:</label>
		<input type="password" name="password" id="password" value="" />
	</div>
    <div class="row">
		<label for="firs_tname">First Name:</label>
		<input type="text" name="firs_tname" id="firs_tname" value="" />
	</div>
	<div class="row">
		<label for="las_tname">Last Name:</label>
		<input type="text" name="las_tname" id="las_tname" value="" />
	</div>
	<div class="row">
		<label>Info:</label>
		<?php get_projects(); ?>
	</div>
    <div><div class="row"><label for="submit"> </label>
         <input id="submit" type="submit" value="Edit Contact" class="submitbutton" />
    </div>
    </div>
</form>
