<div class="row"><?php display_message(); ?></div>
<h2><?php echo lang('title.profile'); ?></h2>
<form action="/<?php echo get_site_lang(); ?>/admin/processprofile" method="post" id="editform">	
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
    <div>
		<div class="row"><label for="submit"> </label>
			<input id="submitedit" type="button" value="<?php echo lang('title.edit.profile'); ?>" class="submitbutton" />
		</div>
		<div class="row error_form_msg">
			<span class="error"><?php echo lang('form.check.required.fields'); ?></span>
		</div>
    </div>
</form>
