<?php display_message(); var_dump($user);?>
<h2>Edit Account</h2>
<form action="/<?php echo get_site_lang(); ?>/application/processedit" method="post" id="editform">
    <input type="hidden" name="id" value="3" />
    <div class="row">
		<label for="firstname">First Name:</label>
		<input name="firstname" id="firstname" value="skander" />
	</div>
	<div class="row">
		<label for="middlename">Middle Name:</label>
		<input name="middlename" id="middlename" value="" />
	</div>
	<div class="row">
		<label for="lastname">Last Name:</label>
		<input name="lastname" id="lastname" value="Jabouzi" />
	</div>
	<div class="row">
		<label>Info:</label>
		<?php get_projects(); ?>
	</div>
    <div><div class="row"><label for="submit"> </label>
         <input id="submit" type="submit" value="Edit Contact" class="submitbutton" />
    </div>
    </div>
</form>
