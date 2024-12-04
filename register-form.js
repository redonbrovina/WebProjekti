let usernameEl = document.getElementById("username");
let passwordEl = document.getElementById("password");
let emailEl = document.getElementById("email");
let gender = document.getElementsByName("Gender");
let errorEl = document.getElementById("error-txt");
const url = "./index.html";

function enterData() {
    if(usernameEl.value != "" && passwordEl.value != "" && emailEl.value != "" && (gender[0].checked == true || gender[1].checked == true)){
        location.href = url;
    }else{
        errorEl.textContent = "Inputs may be empty or invalid!";
    }
}