function validForm(formsignup){

    if(formsignup.inputPass.value !=  formsignup.inputConf.value){
        alert("Passwords don't match. Check Password");
        return false;
    }
    //alert('All good');
    return true;
    //return true;
}

