<div class="row"><?php display_message(); ?></div>
<h1><?php echo lang('title.import.accounts'); ?></h1>
<p>
    <?php echo lang('text.upload.types'); ?>
</p>
<form action="/<?php echo get_site_lang(); ?>/application/processimport" method="post" enctype="multipart/form-data">
    <div class="row">
        <label for="accountsfile"><?php echo lang('form.accounts.file'); ?>:</label><input type="file" id="accountsfile" name="accountsfile" value="Choose"/>
    </div>
    <div class="row">
        <label for="submit"> </label>
        <input id="submit" type="submit" class="submitbutton" value="Upload" />
    </div>
</form>
<br /><br />
<p>
	<h4><?php echo lang('text.file.examples'); ?>:</h4>
	<ul>
		<li><a href="/public/docs/example.csv">CSV</a></li>
		<li><a href="/public/docs/example.json">JSON</a></li>
		<li><a href="/public/docs/example.xls">Excel</a></li>
		<li><a href="/public/docs/example.xml">XML</a></li>
	</ul>
</p>
