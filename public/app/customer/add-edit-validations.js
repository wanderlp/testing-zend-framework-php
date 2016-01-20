$(document).ready(function() {
    clearErrors();
    $("input[name=zipcode]").ForceNumericOnly();
});

function clearErrors() {
    removeError("firstname", "required");
    removeError("lastname", "required");
    removeError("phone", "required");
    removeError("phone", "invalid");
    removeError("state", "required");
    removeError("zipcode", "required");
};

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
    clearErrors();
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
    
    // Lastname is required
    var lastname = $("input[name=lastname]").val();
    if (!lastname || lastname.trim() == "") {
        addError("lastname", "required");
        if (!focused) { tofocus = "lastname"; focused = true; }
        formIsValid = false;
    }
    
    // Phone is required
    var phone = $("input[name=phone]").val();
    if (!phone || phone.trim() == "") {
        addError("phone", "required");
        if (!focused) { tofocus = "phone"; focused = true; }
        formIsValid = false;
    }
    else {
        // Phone is valid
        if (!validatePhone(phone)) {
            addError("phone", "invalid");
            if (!focused) { tofocus = "phone"; focused = true; }
            formIsValid = false;
        }
    }
    
    // State and zip code are required when address is not empty
    var address = $("input[name=address]").val();
    var state = $("input[name=state]").val();
    var zipcode = $("input[name=zipcode]").val();
    if (address && address.trim() != "") {
        if (!state || state.trim() == "") {
            addError("state", "required");
            if (!focused) { tofocus = "state"; focused = true; }
            formIsValid = false;
        }
        
        if (!zipcode || zipcode.trim() == "") {
            addError("zipcode", "required");
            if (!focused) { tofocus = "zipcode"; focused = true; }
            formIsValid = false;
        }
    }
    
    // Zip code is required when state is not empty
    if (state && state.trim() != "") {
        if (!zipcode || zipcode.trim() == "") {
            addError("zipcode", "required");
            if (!focused) { tofocus = "zipcode"; focused = true; }
            formIsValid = false;
        }
    }
    
    // State is required when zip code is not empty
    if (zipcode && zipcode.trim() != "") {
        if (!state || state.trim() == "") {
            addError("state", "required");
            if (!focused) { tofocus = "state"; focused = true; }
            formIsValid = false;
        }
    }
    
    // State and zip code is required when when city is not empty
    var city = $("input[name=city]").val();
    if (city && city.trim() != "") {
        if (!state || state.trim() == "") {
            addError("state", "required");
            if (!focused) { tofocus = "state"; focused = true; }
            formIsValid = false;
        }
        
        if (!zipcode || zipcode.trim() == "") {
            addError("zipcode", "required");
            if (!focused) { tofocus = "zipcode"; focused = true; }
            formIsValid = false;
        }
    }
    
    // Set focus to the first field with error and return the error (if exists);
    setFocus(tofocus);
    return formIsValid;
};

function validatePhone(phoneNumber){
    var phoneNumberPattern = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;  
    return phoneNumberPattern.test(phoneNumber); 
}