<div class="row error"><label></label><?php display_message(); ?></div>
<h2>Add Account</h2>
<form action="/<?php echo get_site_lang(); ?>/application/processadd" method="post" id="addform" name="addform">
    <div class="row">
		<label for="user_name">User Name:</label>
		<input type="text" name="user_name" id="user_name" value="<?php print_text($_POST['user_name']); ?>" readonly />
	</div>
	<div class="row">
		<label for="password">password:</label>
		<input type="password" name="password" id="password" value="" data-validate="required" />
	</div>
    <div class="row">
		<label for="email">Email:</label>
		<input type="text" name="email" id="email" value="<?php print_text($_POST['email']); ?>" data-validate="required" />
	</div>
    <div class="row">
		<label for="first_tname">First Name:</label>
		<input type="text" name="first_tname" id="first_tname" value="<?php print_text($_POST['first_tname']); ?>" data-validate="required"  />
	</div>
	<div class="row">
		<label for="last_tname">Last Name:</label>
		<input type="text" name="last_tname" id="last_tname" value="<?php print_text($_POST['last_tname']); ?>" data-validate="required" />
	</div>
	<div class="row">
		<label>Info:</label>
		<?php get_projects(); ?>
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
