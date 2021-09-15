function menu() {
    document.querySelector(".nav").classList.toggle("hide");
    // prompt("clicked")
}


const cart = [];

function optionToggel($key1) {
    document.querySelector($key1).classList.toggle("hide");
    // prompt("clicked")
}

function sign() {
    document.querySelector("#signIn").classList.toggle("hide");
    document.querySelector("#signUp").classList.toggle("hide");
}

// form Validation
function errorMsg($msg) {
    document.querySelector(".validationMsg").innerHTML = $msg;
    document.querySelector(".validation").classList.add("hide");
    document.querySelector(".validation").classList.toggle("hide");
}
function formInput ($key1,$key2) {
    return document.forms[$key1][$key2].value;
    
}

function formValidation() {
  
    if (formInput("myForm", "userName").length <= 5) {
        errorMsg("name short");
        return false
    }
    if (!(formInput("myForm", "userMobNo").length === 10)) {
        errorMsg("enter a valid mobile number");
        return false
    }
    if ((formInput("myForm", "userPassword").length < 8 || formInput("myForm", "userPasswordConfirm").length > 16)) {
        errorMsg("password should be between 8 to 16 character");
        return false
    }
    if (!(formInput("myForm", "userPassword") === formInput("myForm", "userPasswordConfirm"))) {
        errorMsg("password didn't match");
        return false
    }
}