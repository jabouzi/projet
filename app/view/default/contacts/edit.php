<?php display_message(); ?>
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
	<div>
	<div class="row">
		<table>
      <tr>
      	<td>
	        <select id="s5" multiple="multiple">
	            <option>Coffee Chip</option>
	            <option>Cookie Dough</option>
	            <option>Cookies 'n Cream</option>
	            <option>Dutch Chocolate</option>
	            <option>Fudgee Peanut Butter Cup</option>
	        </select>
	    </td>
      	<td id="returnS5">
	    </td>
	  </tr>
    </table>
	</div>
    <div><div class="row"><label for="submit"> </label>
         <input id="submit" type="submit" value="Edit Contact" class="submitbutton" />
    </div>
    </div>
</form>
