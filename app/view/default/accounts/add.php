<div class="row"><?php display_message(); ?></div>
<h2><?php echo lang('title.add.account'); ?></h2>
<form action="/<?php echo get_site_lang(); ?>/application/processadd" method="post" id="addform" name="addform">
	<div class="row">
        <input type="hidden" name="user_group" id="user_group" value=""/> 
    </div>
    <div class="row">
		<label for="user_name"><?php echo lang('form.username'); ?>:</label>
		<input type="text" name="user_name" id="user_name" value="<?php echo print_post_text('user_name'); ?>" data-validate="required" />
	</div>
	<div class="row">
		<label for="user_password"><?php echo lang('form.password'); ?>:</label>
		<input type="password" name="user_password" id="user_password" value="" data-validate="required" autocomplete="off" />
	</div>
    <div class="row">
		<label for="email"><?php echo lang('form.email'); ?>:</label>
		<input type="text" name="user_email" id="user_email" value="<?php echo print_post_text('user_email'); ?>" data-validate="required" />
	</div>
    <div class="row">
		<label for="first_name"><?php echo lang('form.firstname'); ?>:</label>
		<input type="text" name="user_first_name" id="user_first_name" value="<?php echo print_post_text('user_first_name'); ?>" data-validate="required"  />
	</div>
	<div class="row">
		<label for="last_name"><?php echo lang('form.lastname'); ?>:</label>
		<input type="text" name="user_last_name" id="user_last_name" value="<?php echo print_post_text('user_last_name'); ?>" data-validate="required" />
	</div>
	<div class="row">
		<label><?php echo lang('form.hosts'); ?>:</label>
		<?php get_projects(); ?>
	</div>
    <div>
		<div class="row"><label for="submit"> </label>
			<input id="submitadd" type="button" value="<?php echo lang('title.add.account'); ?>" class="submitbutton"/>
		</div>
		<div class="row error_form_msg">
			<span class="error"><?php echo lang('form.check.required.fields'); ?></span>
		</div>
    </div>
</form>
