<h2>Edit Contact</h2>
<form action="/contacts/processedit" method="post" id="editform">
    <input type="hidden" name="id" value="3" /><div class="row"><label for="firstname">First Name:</label><input name="firstname" id="firstname" value="skander" /></div><div class="row"><label for="middlename">Middle Name:</label><input name="middlename" id="middlename" value="" /></div><div class="row"><label for="lastname">Last Name:</label><input name="lastname" id="lastname" value="Jabouzi" /></div>
    
        <div class="contactgrouping">
        <div class="row"><label>Grouping:</label>
        <input name="type[1][label]" 
            value="" /></div>
        <div>
            <div class="row"><label>Info:</label>
          <select name="type[1][methodtype][]"><option value="" selected="selected">-Choose One-</option><option value="organization" >Organization</option><option value="title" >Title</option><option value="email" >Email</option><option value="website" >Website</option><option value="address" >Complete Address</option><option value="telephone" >Telephone</option><option value="mobilephone" >Mobile Phone</option><option value="socialnetwork" >Social Network URL</option><option value="im" >IM Name</option></select><span class="methodboxvaluebox "><input name="type[1][methodvalue][]" value="" /><a href="#" class="addcontactmethod">Add More Info</a></span></div>
            
        </div>

    <div><label for="submit"> </label>
         <input id="submit" type="submit" value="Edit Contact" class="submitbutton" />
    </div>
</form>
