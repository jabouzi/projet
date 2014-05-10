<div class="row"><?php display_message(); ?></div>
<h2><?php echo lang('title.add.admin'); ?></h2>
<form action="/<?php echo get_site_lang(); ?>/admin/processadd" method="post" id="addform" name="addform">
	<div class="row">
        <input type="hidden" name="id" id="id" value=""/> 
    </div>
    <div class="row">
		<label for="email"><?php echo lang('form.email'); ?>:</label>
		<input type="text" name="email" id="email" value="<?php echo print_post_text('email'); ?>" data-validate="required" data-type="email" />
	</div>
    <div class="row">
		<label for="first_name"><?php echo lang('form.firstname'); ?>:</label>
		<input type="text" name="first_name" id="first_name" value="<?php echo print_post_text('first_name'); ?>" data-validate="required"  />
	</div>
	<div class="row">
		<label for="last_tname"><?php echo lang('form.lastname'); ?>:</label>
		<input type="text" name="last_name" id="last_name" value="<?php echo print_post_text('last_name'); ?>" data-validate="required" />
	</div>
	<div class="row">
		<label for="password"><?php echo lang('form.password'); ?>:</label>
		<input type="password" name="password" id="password" value="<?php echo print_post_text('password'); ?>" data-validate="required" autocomplete="off"/>
	</div>
	<div class="row">
		<label for="admin"><?php echo lang('form.is.admin'); ?>:</label>
		<input type="checkbox" name="admin" id="admin" value="1" <?php if (intval(print_post_text('admin')) == 1) echo 'checked'; ?> >
    </div>
	<div class="row">
		<label for="status"><?php echo lang('form.active'); ?>:</label>
		<input type="checkbox" name="status" id="status" value="1" <?php if (intval(print_post_text('status')) == 1) echo 'checked'; ?>>
    </div>
    <div>
		<div class="row"><label for="submit"> </label>
			<input id="submitadd" type="button" value="<?php echo lang('title.add.admin'); ?>" class="submitbutton"/>
		</div>
		<div class="row error_form_msg">
			<span class="error"><?php echo lang('form.check.required.fields'); ?></span>
		</div>
    </div>
</form>
