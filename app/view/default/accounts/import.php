<div class="row error"><?php display_message(); ?></div>
<h1>Import Accounts</h1>
<p>
    Upload a .csv file or an xml file or an excel file.
</p>
<form action="/<?php echo get_site_lang(); ?>/application/processimport" method="post" enctype="multipart/form-data">
    <div class="row">
        <label for="accountsfile">Accounts File:</label><input type="file" id="accountsfile" name="accountsfile" />
    </div>
    <div class="row">
        <label for="submit"> </label>
        <input id="submit" type="submit" class="submitbutton" value="Upload" />
    </div>
</form>
<br /><br />
<p>
	<i>Download files examples :</i>
	<ul>
		<li><a href="/public/docs/example.csv">CSV</a></li>
		<li><a href="/public/docs/example.json">JSON</a></li>
		<li><a href="/public/docs/example.xls">Excel</a></li>
		<li><a href="/public/docs/example.xml">XML</a></li>
	</ul>
</p>
