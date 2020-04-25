function validForm(){

    if(document.formsignup.name.value=""){
        alert("Insert Name");
        return false;
    }
    if(document.formsignup.surname.value=""){
        alert("Insert Surname");
        return false;
    }
    if(document.formsignup.mail.value=""){
        alert("Insert e-mail");
        return false;
    }
    if(document.formsignup.password.value="" || 
        document.formsignup.password.size < 8){
        alert("Invalid Password");
        return false;
    }
    if(document.formsignup.confirmpassword.value="" ||  
    document.formsignup.password.value !=  document.formsignup.confirmpassword.value){
        alert("Invalid Password. Check Password");
        return false;
    }

    return true;
}

function showPassword(){
    var pass = document.getElementById("mypassword");
    if(pass.type === "password"){pass.type= "text";}
    else{pass.type="password";}
}