<!-- Checkbox zum Passwort anzeigen -->
function machText(chk,frm){
    var p=frm.newpass;
    try{
        var val=p.value;
        p.type=chk?'text':'password';
        p.value=val;//benötigt z. B. in Opera
    }
    catch(e){
        var neuInp=document.createElement('input');
        neuInp.type=chk?'text':'password';
        neuInp.value=p.value;
        neuInp.name=neuInp.id='newpass';
        p.parentNode.replaceChild(neuInp,p);
    }
}
