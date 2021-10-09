var editbt = document.getElementById("edit_button");
var savebt = document.getElementById("save_button");



var editName = document.getElementById("user_name_profil_id");
var editSName = document.getElementById("user_surname_profil_id");
var editEmail = document.getElementById("user_email_profil_id");
var editPass = document.getElementById("user_password_edit");
var editRPass = document.getElementById("user_rpassword_edit");
var editRPhoto = document.getElementById("user_photo_edit");


var chLabelName  = document.getElementById("change_name_label");
var chLabelSName = document.getElementById("change_surname_label");
var chLabelEmail = document.getElementById("change_email_label");
var chLabelPass1 = document.getElementById("change_pass_label")
var chLabelPass2 = document.getElementById("change_rpass_label")
var chLabelPhoto = document.getElementById("change_photo_label")


var labelName    = document.getElementById("user_name_label");
var labelSName    = document.getElementById("user_surname_label");
var labelEmail   = document.getElementById("user_email_label");
 

 

var userRang = document.getElementById("user_rangs");
var userPhoto = document.getElementById("user_photo_profil_id");
var userStatus = document.getElementById("user_status");

var nmlab = document.getElementById("name_lab")
var brilab = document.getElementById("birth_lab")
var emalab = document.getElementById("email_lab")



var clickmet = false;


editProfil();

function editProfil() {

   if(clickmet == true)
   {
    
      chLabelName.innerHTML = "Enter a new name:";
      chLabelSName.innerHTML = "Your a new surname:";
      chLabelEmail.innerHTML = "Enter a new e-mail:";
      chLabelPass1.innerHTML = "Enter a new password:";  
      chLabelPass2.innerHTML = "Repeat a new password:";
      chLabelPhoto.innerHTML = "Enter the path to the photo";


      labelName.style.visibility = "hidden";
      labelSName.style.visibility = "hidden";
      labelEmail.style.visibility = "hidden";
  



      editName.type ="text";
      editEmail.type = "email";
      editPass.type = "password";
      editRPass.type = "password";
      editSName.type = 'text';
      editRPhoto.type = "file";
     

      savebt.type = "submit"
      editbt.type = "hidden"
      clickmet = false;

      
   }
   else{


      chLabelName.innerHTML =  "Your name:";
      chLabelSName.innerHTML = "Your surname:";
      chLabelEmail.innerHTML = "Your e-mail:";
      chLabelPass1.innerHTML = "";
      chLabelPass2.innerHTML = "";
      chLabelPhoto.innerHTML = "";




      
      labelName.style.visibility = "visible";
      labelSName.style.visibility = "visible";
      labelEmail.style.visibility = "visible";
  

      editName.type = 'hidden';
      editSName.type = 'hidden';
      editEmail.type = 'hidden';
      editPass.type = "hidden";
      editRPass.type = "hidden";
      editRPhoto.type = "hidden";


      savebt.type = "hidden"
      editbt.type = "button"
     
      editbt.value = "Edit Profil";
      clickmet = true;
   }
   
}  