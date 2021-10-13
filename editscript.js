

var textEdit = document.getElementById('text_edit_message');
var labelValue = document.getElementById('label_thema_value');
var submitBT = document.getElementById('submit_edits_button');
var editBT = document.getElementById('edits_button');

var checkThema=false;
 
showeditthema()

function showeditthema()
{
    if(checkThema == false)
    {
        textEdit.style.display = "none";
        submitBT.type = "hidden";         
        labelValue.style.display = "block";

        checkThema = true;
    }
    else
    {
        textEdit.style.display = "block";
        submitBT.type = "submit";

        labelValue.style.display = "none";
        checkThema=false;
    }
}




var textEditmsq = document.getElementById('text_edit_message_msq');
var labelValuemsq = document.getElementById('label_message_value');
var submitBTmsq = document.getElementById('submit_edits_msg_button');
var editBTmsq = document.getElementById('edits_msq_button');



var buttons = document.getElementsByTagName('buttonedit');

var checkMessage=false;

 
function showeditmessage(editID)
{
    

}
 