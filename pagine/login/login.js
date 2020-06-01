window.onload = function(){
   //se il localstorage non è vuoto, prendi i valori dal local storage 
    if(window.localStorage != null){
        this.getremember();
    }
}

function rememberme(){
    if((document.login.checkbox.checked)){
    //prende i valori di username e password inseriti e li inserisce nel localstorage
    var user = document.getElementById("user").value;
    var passw = document.getElementById("password").value;

    localStorage.setItem("username",user);
    localStorage.setItem("password",passw);}
    else{
    //se non checked li rimuove
    localStorage.removeItem("username");
    localStorage.removeItem("password");

    }
}

function getremember(){//prende i valori dal local storage e li inserisce nei campi nella pagina
    if(window.localStorage.getItem("username") != null){
        var user = localStorage.getItem("username");
        var passw = localStorage.getItem("password");

        document.getElementById("user").value = user;
        document.getElementById("password").value =passw;
        document.getElementById("rem").checked = true;
    }

}
function validLogin(){
    rememberme();//controlla se rememberme è spuntatao
    if(grecaptcha && grecaptcha.getResponse().length > 0){//controlla il recaptcha
        return true;}
    
    else{//recaptcha non è spuntato
        //da errore
    alert('Oops, recaptcha is not checked!');
    return false;}
}