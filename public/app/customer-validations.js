$(document).ready(function() {
    removeError("firstname", "required");
    removeError("lastname", "required");
    removeError("phone", "required");
    removeError("phone", "invalid");
});

function removeError(field, type) {
    var formgroup = "#" + field + "-group";
    var helpblock = "#" + field + "-" + type;
    $(formgroup).removeClass("has-error");
    $(helpblock).hide();
};

function addError(field, type) {
    var formgroup = "#" + field + "-group";
    var helpblock = "#" + field + "-" + type;
    $(formgroup).addClass("has-error");
    $(helpblock).show();
};

function setFocus(fieldname) {
    var field = $("input[name=" + fieldname + "]");
    field.focus();
};

function customer_onsubmit() {
    var formIsValid = true;
    var focused = false;
    var tofocus = "";
    
    // Firstname is required
    var firstname = $("input[name=firstname]").val();
    if (!firstname || firstname.trim() == "") {
        addError("firstname", "required");
        if (!focused) { tofocus = "firstname"; focused = true; }
        formIsValid = false;
    }
    else removeError("firstname", "required");
    
    // Lastname is required
    var lastname = $("input[name=lastname]").val();
    if (!lastname || lastname.trim() == "") {
        addError("lastname", "required");
        if (!focused) { tofocus = "lastname"; focused = true; }
        formIsValid = false;
    }
    else removeError("lastname", "required");
    
    // Phone is required
    var phone = $("input[name=phone]").val();
    if (!phone || phone.trim() == "") {
        addError("phone", "required");
        if (!focused) { tofocus = "phone"; focused = true; }
        formIsValid = false;
    }
    else {
        removeError("phone", "required");
        // Phone is valid
        if (!validatePhone(phone)) {
            addError("phone", "invalid");
            if (!focused) { tofocus = "phone"; focused = true; }
            formIsValid = false;
        }
        else removeError("phone", "invalid");
    }
    
    // State and zip code are required when address is not empty
    
    // Zip code is required when state is not empty
    
    // State is required when zip code is not empty
    
    // State and zip code is required when when city is not empty
    
    // Set focus to the first field with error and return the error (if exists);
    setFocus(tofocus);
    return formIsValid;
};

function validatePhone(phoneNumber){
    var phoneNumberPattern = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;  
    return phoneNumberPattern.test(phoneNumber); 
}