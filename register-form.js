const usernameEl = document.getElementById("username");
const passwordEl = document.getElementById("password");
const emailEl = document.getElementById("email");
let checked_gender = document.getElementsByName("gender");
const phone = document.getElementById("phone");
const errorEl = document.getElementById("error-txt");
const url = "./index.html";

const emailValid = (email) => {
    const emailCheck = /^([A-Za-z0-9_\-.])+@([A-Za-z0-9_\-.])+\.([A-Za-z]{2,4})$/;
    return emailCheck.test(email.toLowerCase());
}

function isChecked() {
    for(let radio of checked_gender){
        if(radio.checked){
            return true;
        }
    }
    return false;
}

function enterData() {
    if(usernameEl.value == ""){
        errorEl.textContent = "Please write a valid username";
        usernameEl.focus();
    }else if(passwordEl.value == ""){
        errorEl.textContent = "Please write a valid password";
        passwordEl.focus();
    }else if(!emailValid(emailEl.value)){
        errorEl.textContent = "Please write a valid Email!";
        emailEl.focus();
    }else if(!isChecked()){
        errorEl.textContent = "Please check a gender";
    }else{
        location.href = url;
    }
}