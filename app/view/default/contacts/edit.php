<div class="row dissmiss"><label></label><a id="cancel">Cancel delete <span id="count_num">3</span></a></div>
<div class="row error"><?php display_message(); ?></div>
<h2>Edit Account</h2>
<form action="/<?php echo get_site_lang(); ?>/application/delete" method="post" id="deleteform">    
<div>
	<div class="row"><label for="submit"> </label>
         <input id="delete" type="button" value="Delete Contact" class="deletebutton" />
    </div>
	<div class="row"><label for="submit"> </label>
        <input type="hidden" name="user_name" id="user_name" value="<?php echo $user->get_user_name(); ?>"/> 
    </div>
</div>
</form>

<form action="/<?php echo get_site_lang(); ?>/application/processedit" method="post" id="editform">	
	<div class="row">
        <input type="hidden" name="user_group" id="user_group" value=""/> 
    </div>
    <div class="row">
		<label for="user_name">User Name:</label>
		<input type="text" name="user_name" id="user_name" value="<?php print_post_text('user_name', $user->get_user_name()); ?>" readonly />
	</div>
    <div class="row">
		<label for="email">Email:</label>
		<input type="text" name="user_email" id="user_email" value="<?php print_post_text('user_email', $user->get_user_email()); ?>" data-validate="required" />
	</div>
    <div class="row">
		<label for="user_first_name">First Name:</label>
		<input type="text" name="user_first_name" id="user_first_name" value="<?php print_post_text('user_first_name', $user->get_user_first_name()); ?>" data-validate="required"  />
	</div>
	<div class="row">
		<label for="user_last_tname">Last Name:</label>
		<input type="text" name="user_last_name" id="user_last_name" value="<?php print_post_text('user_last_name', $user->get_user_last_name()); ?>" data-validate="required" />
	</div>
	<div class="row">
		<label>Info:</label>
		<?php get_projects($user->get_user_vhosts()); ?>
	</div>
	<div class="row">
		<label for="user_password">password:</label>
		<input type="password" name="user_password" id="user_password" value="<?php print_post_text('user_password', $user->get_user_password()); ?>" />
	</div>
    <div>
		<div class="row"><label for="submit"> </label>
			<input id="submitedit" type="button" value="Edit Contact" class="submitbutton" />
		</div>
    </div>
</form>
