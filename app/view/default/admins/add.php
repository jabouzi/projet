<div class="row error"><label></label><?php display_message(); ?></div>
<h2>Add Account</h2>
<form action="/<?php echo get_site_lang(); ?>/admin/processadd" method="post" id="addform" name="addform">
	<div class="row">
        <input type="hidden" name="id" id="id" value=""/> 
    </div>
    <div class="row">
		<label for="email">Email:</label>
		<input type="text" name="email" id="email" value="<?php echo print_post_text('email'); ?>" data-validate="required" data-type="email" />
	</div>
    <div class="row">
		<label for="first_name">First Name:</label>
		<input type="text" name="first_name" id="first_name" value="<?php echo print_post_text('first_name'); ?>" data-validate="required"  />
	</div>
	<div class="row">
		<label for="last_tname">Last Name:</label>
		<input type="text" name="last_name" id="last_name" value="<?php echo print_post_text('last_name'); ?>" data-validate="required" />
	</div>
	<div class="row">
		<label for="password">password:</label>
		<input type="password" name="password" id="password" value="<?php echo print_post_text('password'); ?>" data-validate="required"/>
	</div>
	<div class="row">
		<label for="password">Is Admin:</label>
		<input type="checkbox" name="admin" value="1" <?php if (intval(print_post_text('admin')) == 1) echo 'checked'; ?> >
    </div>
	<div class="row">
		<label for="password">Active:</label>
		<input type="checkbox" name="status" value="1" <?php if (intval(print_post_text('status')) == 1) echo 'checked'; ?>>
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
