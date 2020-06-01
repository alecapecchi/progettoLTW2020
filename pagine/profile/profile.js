function validForm(formsignup){
    //controlla che le 2 pw siano uguali
    if(formsignup.inputPass.value !=  formsignup.inputConf.value){
        alert("Passwords don't match. Check Password");
        return false;
    }
    return true;
}

