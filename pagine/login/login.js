window.onload = function(){
    if(window.localStorage != null){
        this.getremember();
    }
}

function rememberme(){
    var user = document.getElementById("user").value;
    var passw = document.getElementById("password").value;

    localStorage.setItem("username",user);
    localStorage.setItem("password",passw);
}

function getremember(){
    if(window.localStorage != null){
        var user = localStorage.getItem("username");
        var passw = localStorage.getItem("password");

        document.getElementById("user").value = user;
        document.getElementById("password").value =passw;
    }

}
function validLogin(){
    if(grecaptcha && grecaptcha.getResponse().length > 0){

        return true;}
    
    else{//The recaptcha is not cheched
    alert('Oops, recaptcha is not checked!');
    return false;}
}