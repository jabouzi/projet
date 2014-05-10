<div class="row dissmiss"><a id="cancel" class="cancel"><?php echo lang('form.cancel.delete'); ?><span id="count_num">3</span></a></div>
<div class="row"><?php display_message(); ?></div>
<h2><?php echo lang('title.edit.admin'); ?></h2>
<form action="/<?php echo get_site_lang(); ?>/admin/delete" method="post" id="deleteform">    
<div>
	<div class="row"><label for="submit"> </label>
         <input id="delete" type="button" value="<?php echo lang('form.delete.admin'); ?>" class="deletebutton" />
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
		<label for="email"><?php echo lang('form.email'); ?>:</label>
		<input type="text" name="email" id="email" value="<?php echo print_post_text('email', $user->get_email()); ?>" data-validate="required" data-type="email" />
	</div>
    <div class="row">
		<label for="first_name"><?php echo lang('form.firstname'); ?>:</label>
		<input type="text" name="first_name" id="first_name" value="<?php echo print_post_text('first_name', $user->get_first_name()); ?>" data-validate="required"  />
	</div>
	<div class="row">
		<label for="last_tname"><?php echo lang('form.lastname'); ?>:</label>
		<input type="text" name="last_name" id="last_name" value="<?php echo print_post_text('last_name', $user->get_last_name()); ?>" data-validate="required" />
	</div>
	<div class="row">
		<label for="password"><?php echo lang('form.password'); ?>:</label>
		<input type="password" name="password" id="password" value="<?php echo print_post_text('password'); ?>" autocomplete="off" />
	</div>
	<div class="row">
		<label for="admin"><?php echo lang('form.is.admin'); ?>:</label>
		<input type="checkbox" name="admin" id="admin" value="1" <?php if (intval(print_post_text('admin', $user->get_admin())) == 1) echo 'checked'; ?> >
    </div>
	<div class="row">
		<label for="status"><?php echo lang('form.active'); ?>:</label>
		<input type="checkbox" name="status" id="status" value="1" <?php if (intval(print_post_text('status', $user->get_status())) == 1) echo 'checked'; ?>>
    </div>
    <div class="row">
		<div class="row"><label for="submit"> </label>
			<input id="submitedit" type="button" value="<?php echo lang('title.edit.admin'); ?>" class="submitbutton" />
		</div>
		<div class="row error_form_msg">
			<span class="error"><?php echo lang('form.check.required.fields'); ?></span>
		</div>
    </div>
</form>
