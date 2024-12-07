let usernameEl = document.getElementById("user");
let passwordEl = document.getElementById("password");
let errorEl = document.getElementById("error-txt");

const url = "./index.html";

function submit() {
    if(usernameEl.value == "user" && passwordEl.value == "password"){
        location.href = url;
    }else{
        errorEl.innerHTML = "Username or Password is incorrect";
    }
}