<div class="row dissmiss"><a id="cancel" class="cancel"><?php echo lang('form.cancel.delete'); ?><span id="count_num">3</span></a></div>
<div class="row"><?php display_message(); ?></div>
<h2><?php echo lang('title.edit.account'); ?></h2>
<form action="/<?php echo get_site_lang(); ?>/application/delete" method="post" id="deleteform">    
<div>
	<div class="row"><label for="submit"> </label>
         <input id="delete" type="button" value="<?php echo lang('form.delete.account'); ?>" class="deletebutton" />
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
		<label for="user_name"><?php echo lang('form.username'); ?>:</label>
		<input type="text" name="user_name" id="user_name" value="<?php echo print_post_text('user_name', $user->get_user_name()); ?>" readonly />
	</div>
    <div class="row">
		<label for="email"><?php echo lang('form.email'); ?>:</label>
		<input type="text" name="user_email" id="user_email" value="<?php echo print_post_text('user_email', $user->get_user_email()); ?>" data-validate="required" data-type="email" />
	</div>
    <div class="row">
		<label for="user_first_name"><?php echo lang('form.firstname'); ?>:</label>
		<input type="text" name="user_first_name" id="user_first_name" value="<?php echo print_post_text('user_first_name', $user->get_user_first_name()); ?>" data-validate="required" />
	</div>
	<div class="row">
		<label for="user_last_tname"><?php echo lang('form.lastname'); ?>:</label>
		<input type="text" name="user_last_name" id="user_last_name" value="<?php echo print_post_text('user_last_name', $user->get_user_last_name()); ?>" data-validate="required" />
	</div>
	<div class="row">
		<label><?php echo lang('form.hosts'); ?>:</label>
		<?php get_projects($user->get_user_vhost()); ?>
	</div>
	<div class="row">
		<label for="user_password"><?php echo lang('form.password'); ?>:</label>
		<input type="password" name="user_password" id="user_password" value="<?php echo print_post_text('user_password'); ?>" autocomplete="off" />
	</div>
    <div>
		<div class="row"><label for="submit"> </label>
			<input id="submitedit" type="button" value="<?php echo lang('title.edit.account'); ?>" class="submitbutton" />
		</div>
		<div class="row error_form_msg">
			<span class="error"><?php echo lang('form.check.required.fields'); ?></span>
		</div>
    </div>
</form>
