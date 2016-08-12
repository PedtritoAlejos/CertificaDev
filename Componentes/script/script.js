
$(document).ready(function(){
        $('.log-btn').click(function(){
            $('.log-status').addClass('wrong-entry');
           $('.alert').fadeIn(500);
           setTimeout( "$('.alert').fadeOut(1500);",3000 );
        });
        $('.form-control').keypress(function(){
            $('.log-status').removeClass('wrong-entry');
        });

    });

function EstableceEstado1()
{
if (document.form1.radiob[1].checked)
{
document.form1.select1.disabled = true
}
else if (document.form1.radiob[0]) {
document.form1.select1.disabled = false
document.form1.select1.focus();
}
if (document.form1.radiob[0].checked) {
document.form1.select2.disabled = true
document.form1.select1.focus();
}
else if (document.form1.radiob[1]) {
document.form1.select2.disabled = false
document.form1.select2.focus();
}
if((document.form1.select1.disabled && document.form1.select2.value != "") || (document.form1.select2.disabled && document.form1.select1.value!=""))
document.form1.Submit.disabled = false
else
document.form1.Submit.disabled = true
}
function activar(formulario)
{
if((document.form1.select1.disabled && document.form1.select2.value != "") || (document.form1.select2.disabled && document.form1.select1.value!=""))
document.form1.Submit.disabled = false
else
document.form1.Submit.disabled = true
}
function desactivar(formulario) {
if(document.form1.radiob[0].checked){
formulario.Submit.disabled = true
}
if(document.form1.radiob[1].checked){
formulario.Submit.disabled = true
}
}
function QuitaFoco1() {
if(document.form1.radiob[0].checked)
document.form1.select2.blur()
if(document.form1.radiob[1].checked)
document.form1.select1.blur()
}
function Deshabilita1() {
if(document.form1.radiob[0]){
//document.form1.select1.selectedIndex = -1
document.form1.select1.disabled = true
}
if(document.form1.radiob[1]){
//document.form1.select2.selectedIndex = -1
document.form1.select2.disabled = true
}
}
window.onload = Deshabilita1;
if (document.captureEvents) { //N4 requiere invocar la funcion captureEvents
document.captureEvents(Event.LOAD)
}
