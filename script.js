var editbt = document.getElementById("edit_button");
var savebt = document.getElementById("save_button");



var editName = document.getElementById("user_name_profil_id");
var editBrith = document.getElementById("user_birthday_profil_id");
var editEmail = document.getElementById("user_email_profil_id");
var editPass = document.getElementById("user_password_edit");
var editRPass = document.getElementById("user_rpassword_edit");
var editRPhoto = document.getElementById("user_photo_edit");


var chLabelName  = document.getElementById("change_name_label");
var chLabelBirth = document.getElementById("change_birth_label");
var chLabelEmail = document.getElementById("change_email_label");
var chLabelPass1   = document.getElementById("change_pass_label")
var chLabelPass2 = document.getElementById("change_rpass_label")
var chLabelPhoto = document.getElementById("change_photo_label")


var labelName    = document.getElementById("user_name_label");
var labelBirth   = document.getElementById("user_birth_label");
var labelEmail   = document.getElementById("user_email_label");
var labelPass1   = document.getElementById("pass_label")
var labelPass2   = document.getElementById("rpass_label")


 
 

var userRang = document.getElementById("user_rangs");
var userPhoto = document.getElementById("user_photo_profil_id");
var userStatus = document.getElementById("user_status");

var nmlab = document.getElementById("name_lab")
var brilab = document.getElementById("birth_lab")
var emalab = document.getElementById("email_lab")


var user_online =false;


var clickmet = false;





editProfil();
changeStatusUser();


setInterval(changeStatusUser, 1000);

function changeUserRang() {
   if(userRangs = 0)
   {
 
      userRang.innerHTML = "User";
      userRang.style.color = "#069b06";
  

   }
   else if(userRangs = 1)
   {
  
      userRang.innerHTML = "Moderator";
      userRang.style.color = "#33c706";
      
   }
   else if(userRangs = 2)
   {
  
      userRang.innerHTML = "Administrator";
      userRang.style.color = "#f1380a";
      
   }
   else if(userRangs = 3)
   {
  
      userRang.innerHTML = "Head Administrator";
      userRang.style.color = "#6b1803";
      
   }
}

function changeStatusUser() {
   if(user_online == true)
   {
      userStatus.innerHTML ="On-Line"
      userStatus.style.color = "#069b06";
      userStatus.style.borderColor = "black"
  

   }
   else
   {
      userStatus.innerHTML ="Off-Line"
      userStatus.style.color = "#9c0b0b";
      
   }
}


function editProfil() {

   if(clickmet == true)
   {
    


    


      chLabelName.innerHTML = "Enter a new name:";
      chLabelBirth.innerHTML = "Your birthday:";
      chLabelEmail.innerHTML = "Enter a new e-mail:";
      chLabelPass1.innerHTML = "Enter a new password:";  
      chLabelPass2.innerHTML = "Repeat a new password:";
      chLabelPhoto.innerHTML = "Enter the path to the photo";


      labelName.innerHTML = " ";
      labelBirth.innerHTML = " ";
      labelEmail.innerHTML = " ";
      labelPass1.innerHTML = " ";
      labelPass2.innerHTML = " ";



      editName.type ="text";
      editBrith.type = "date";
      editEmail.type = "email";
      editPass.type = "password";
      editRPass.type = "password";

      editRPhoto.type = "file";
     

      savebt.type = "submit"
      editbt.type = "hidden"
      clickmet = false;

      
   }
   else{


      chLabelName.innerHTML =  "Your name:";
      chLabelBirth.innerHTML = "Your birthday:"
      chLabelEmail.innerHTML = "Your e-mail:";
      chLabelPass1.innerHTML = " ";
      chLabelPass2.innerHTML = " ";
      chLabelPhoto.innerHTML = " ";




      labelName.innerHTML =  " ";
      labelBirth.innerHTML = " ";
      labelEmail.innerHTML = " ";
      labelPass1.innerHTML = " ";
      labelPass2.innerHTML = " ";


      editName.type = 'hidden';
      editBrith.type = 'hidden';
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