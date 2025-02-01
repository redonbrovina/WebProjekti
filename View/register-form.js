const usernameEl = document.getElementById("username");
const passwordEl = document.getElementById("password");
const emailEl = document.getElementById("email");
let checked_gender = document.getElementsByName("gender");
const phone = document.getElementById("phone");
const errorEl = document.getElementById("error-txt");


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
        errorEl.textContent = "Please write a valid username!";
        usernameEl.focus();
        event.preventDefault();
    }else if(passwordEl.value.length < 8){
        errorEl.textContent = "Please write a valid password!";
        passwordEl.focus();
        event.preventDefault();
    }else if(!emailValid(emailEl.value)){
        errorEl.textContent = "Please write a valid Email!";
        emailEl.focus();
        event.preventDefault();
    }else if(!isChecked()){
        errorEl.textContent = "Please check a gender";
        event.preventDefault();
    }else{
        Swal.fire({
            title: "Registration Successful!",
            text: "You will now be redirected to the sign in page to login. Thank for joining us " + usernameEl.value  + " !",
            icon: "success",
            timer: 3000
          });
    }
}