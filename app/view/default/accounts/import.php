<div class="row error"><?php display_message(); ?></div>
<h1>Import Accounts</h1>
<p>
    Upload a .csv file or an xml file or an excel file.
</p>
<form action="/<?php echo get_site_lang(); ?>/accounts/processimport" method="post" enctype="multipart/form-data">
    <input type="hidden" name="importtype" value="outlook" />
    <div class="row">
        <label for="contactsfile">Accounts File:</label><input type="file" id="contactsfile" name="contactsfile" />
    </div>
    <div class="row">
        <label for="submit"> </label>
        <input id="submit" type="submit" class="submitbutton" value="Upload" />
    </div>
</form>
