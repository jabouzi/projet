<?php display_message();?>
<h2>Edit Account</h2>
<form action="/<?php echo get_site_lang(); ?>/application/delete" method="post" id="deleteform">    
<div>
	<div class="row"><label for="submit"> </label>
         <input id="submit" type="submit" value="Delete Contact" class="deletebutton" />
    </div>
	<div class="row"><label for="submit"> </label>
        <input type="hidden" name="user_name" id="user_name" value="<?php echo $user->get_user_name(); ?>"/> 
    </div>
</div>

</form>
<form action="/<?php echo get_site_lang(); ?>/application/processedit" method="post" id="editform">
    <input type="hidden" name="id" value="3" />
    <div class="row">
		<label for="user_name">User Name:</label>
		<input type="text" name="user_name" id="user_name" value="<?php echo $user->get_user_name(); ?>" readonly />
	</div>
    <div class="row">
		<label for="email">Email:</label>
		<input type="text" name="email" id="email" value="<?php echo $user->get_email(); ?>" />
	</div>
    <div class="row">
		<label for="password">password:</label>
		<input type="password" name="password" id="password" value="<?php echo $user->get_password(); ?>" />
	</div>
    <div class="row">
		<label for="firs_tname">First Name:</label>
		<input type="text" name="firs_tname" id="firs_tname" value="<?php echo $user->get_first_name(); ?>" />
	</div>
	<div class="row">
		<label for="las_tname">Last Name:</label>
		<input type="text" name="las_tname" id="las_tname" value="<?php echo $user->get_last_name(); ?>" />
	</div>
	<div class="row">
		<label>Info:</label>
		<?php get_projects($user->get_user_vhosts()); ?>
	</div>
    <div>
		<div class="row"><label for="submit"> </label>
			<input id="submit" type="submit" value="Edit Contact" class="submitbutton" />
		</div>
    </div>
</form>
