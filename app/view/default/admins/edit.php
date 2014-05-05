<div class="row dissmiss"><label></label><a id="cancel">Cancel delete <span id="count_num">3</span></a></div>
<div class="row error"><?php display_message(); ?></div>
<h2>Edit Account</h2>
<form action="/<?php echo get_site_lang(); ?>/admin/delete" method="post" id="deleteform">    
<div>
	<div class="row"><label for="submit"> </label>
         <input id="delete" type="button" value="Delete Admin" class="deletebutton" />
    </div>
	<div class="row"><label for="submit"> </label>
        <input type="hidden" name="email" id="email" value="<?php echo $user->get_email(); ?>"/> 
        <input type="hidden" name="id" id="id" value="<?php echo $user->get_id(); ?>"/> 
    </div>
</div>
</form>

<form action="/<?php echo get_site_lang(); ?>/admin/processedit" method="post" id="editform">	
	<div class="row">
        <input type="hidden" name="id" id="id" value="<?php echo $user->get_id(); ?>"/> 
    </div>
    <div class="row">
		<label for="email">Email:</label>
		<input type="text" name="email" id="email" value="<?php echo print_post_text('email', $user->get_email()); ?>" data-validate="required" data-type="email" />
	</div>
    <div class="row">
		<label for="first_name">First Name:</label>
		<input type="text" name="first_name" id="first_name" value="<?php echo print_post_text('first_name', $user->get_first_name()); ?>" data-validate="required"  />
	</div>
	<div class="row">
		<label for="last_tname">Last Name:</label>
		<input type="text" name="last_name" id="last_name" value="<?php echo print_post_text('last_name', $user->get_last_name()); ?>" data-validate="required" />
	</div>
	<div class="row">
		<label for="password">password:</label>
		<input type="password" name="password" id="password" value="<?php echo print_post_text('password'); ?>" />
	</div>
	<div class="row">
		<label for="password">Is Admin:</label>
		<input type="checkbox" name="admin" value="1" <?php if (intval(print_post_text('admin', $user->get_admin())) == 1) echo 'checked'; ?> >
    </div>
	<div class="row">
		<label for="password">Active:</label>
		<input type="checkbox" name="status" value="1" <?php if (intval(print_post_text('status', $user->get_status())) == 1) echo 'checked'; ?>>
    </div>
    <div>
		<div class="row"><label for="submit"> </label>
			<input id="submitedit" type="button" value="Edit Admin" class="submitbutton" />
		</div>
    </div>
</form>
