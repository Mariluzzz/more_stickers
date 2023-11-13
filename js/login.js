function mostrarOcultar(){
    
    var senha =document.getElementById("senha");

    if(senha.type == "password"){
        senha.type = "text";
    }
    else{
        senha.type = "password";
    }

}