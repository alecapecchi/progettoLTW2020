function validForm(formsignup){
    //controlla che tutti campi siano stati compilati e che le passwords siano uguali
    if(formsignup.inputName.value===""){
        alert("Insert Name");
        return false;
    }
    if(formsignup.inputLname.value===""){
        alert("Insert Surname");
        return false;
    }
    if(formsignup.inputEmail.value===""){
        alert("Insert e-mail");
        return false;
    }
    if(formsignup.inputpw.value==="" || formsignup.inputpw.value.size < 8){
        alert("Invalid Password");
        return false;
    }
    if(formsignup.inputpw.value !=  formsignup.confermaInputPw.value){
        alert("Passwords don't match. Check Password");
        return false;
    }
    if(!validaRecap()){
        alert('Oops, recaptcha is not checked!');
        return false;
    }
    return true;
}

function showPassword(){//se viene cliccata la casella, mostra la password
    var pass = document.getElementById("mypassword");
    var pass_conf = document.getElementById("confirmpassword");
    if(pass.type === "password"){
        pass.type= "text";
        pass_conf.type= "text";

}
    else{
        pass.type="password";
        pass_conf.type="password";
        }
}



function validaRecap(){
    if(grecaptcha && grecaptcha.getResponse().length > 0){

        return true;}
    
    else{
    return false;}
}