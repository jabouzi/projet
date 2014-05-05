<div class="row error"><label></label><?php display_message(); ?></div>
<h2>Add Account</h2>
<form action="/<?php echo get_site_lang(); ?>/application/processadd" method="post" id="addform" name="addform">
	<div class="row">
        <input type="hidden" name="user_group" id="user_group" value=""/> 
    </div>
    <div class="row">
		<label for="user_name">User Name:</label>
		<input type="text" name="user_name" id="user_name" value="<?php echo print_post_text('user_name'); ?>" data-validate="required" />
	</div>
	<div class="row">
		<label for="user_password">password:</label>
		<input type="password" name="user_password" id="user_password" value="" data-validate="required" />
	</div>
    <div class="row">
		<label for="email">Email:</label>
		<input type="text" name="user_email" id="user_email" value="<?php echo print_post_text('user_email'); ?>" data-validate="required" />
	</div>
    <div class="row">
		<label for="first_name">First Name:</label>
		<input type="text" name="user_first_name" id="user_first_name" value="<?php echo print_post_text('user_first_name'); ?>" data-validate="required"  />
	</div>
	<div class="row">
		<label for="last_name">Last Name:</label>
		<input type="text" name="user_last_name" id="user_last_name" value="<?php echo print_post_text('user_last_name'); ?>" data-validate="required" />
	</div>
	<div class="row">
		<input type="checkbox" name="admin" value="1" <?php if (intval(print_post_text('admin')) == 1)) echo 'checked'; ?> >
		<label for="password">Is Admin:</label>
    </div>
	<div class="row">
		<input type="checkbox" name="status" value="1" <?php if (intval(print_post_text('status')) == 1) echo 'checked'; ?>>
		<label for="password">Active:</label>
    </div>
    <div>
		<div class="row"><label for="submit"> </label>
			<input id="submitadd" type="button" value="Add Contact" class="submitbutton"/>
		</div>
		<div class="row error error_form_msg"><label></label>
			Check required fields
		</div>
    </div>
</form>
