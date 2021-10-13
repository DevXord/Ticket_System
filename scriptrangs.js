var showbt = document.getElementById('rangs_button');

var showRatioUser = document.getElementById('radio_user');
var showRatioMod = document.getElementById('radio_mod');
var showRatioAdmin = document.getElementById('radio_admin');
var showRatioHAdmin = document.getElementById('radio_hadmin');

 
var showLabelUser = document.getElementById('user_label');
var showLabelMod = document.getElementById('mod_label');
var showLabelAdmin = document.getElementById('admin_label');
var showLabelHAdmin = document.getElementById('hadmin_label');
 
var clickmet = false;


showRangs();

function showRangs() {

   if(clickmet == true)
   {

        showLabelUser.innerHTML = "User";
        showLabelMod.innerHTML = "Moderator";
        showLabelAdmin.innerHTML = "Administrator";
        showLabelHAdmin.innerHTML = "Head Admin";
        showRatioUser.type = "radio";
        showRatioMod.type = "radio";
        showRatioAdmin.type = "radio";
        showRatioHAdmin.type = "radio";
        showbt.type ="submit";
     
        clickmet= false;
   }
   else
   {
        showLabelUser.innerHTML = "";
        showLabelMod.innerHTML = "";
        showLabelAdmin.innerHTML = "";
        showLabelHAdmin.innerHTML = "";
        showRatioUser.type = "hidden";
        showRatioMod.type = "hidden";
        showRatioAdmin.type = "hidden";
        showRatioHAdmin.type = "hidden";
        showbt.type ="hidden";

        clickmet= true;
   }

}