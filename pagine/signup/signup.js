function validForm(formsignup){

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
    }/*
    if(!validateEmail(formsignup.inputEmail.value)){

        alert("Insert valid e-mail");
        return false;
    }*/
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
    //alert('All good');
    return true;
    //return true;
}

function showPassword(){
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

function validateEmail(email) {
    var re ="^\S+@\S+$";
    return re.test(String(email).toLowerCase());
}

function validaRecap(){
    if(grecaptcha && grecaptcha.getResponse().length > 0){

        return true;}
    
    else{//The recaptcha is not cheched
    return false;}
}