function validateForm() {
    // get values from page
    let x = parseFloat(document.forms[0]["x-value"].value);
    let y = parseFloat(document.forms[0]["y-value"].value);
    let r = parseFloat(document.forms[0]["r-value"].value);

    // check constraints
    let flag = true;
    let error_message = "";

    if (!(x > -5 && x < 3)) {
        flag = false;
        error_message += "You can use X only in range (-5 ... 3)<br>";
    }

    if (!(y > -3 && y < 3)) {
        flag = false;
        error_message += "You can use Y only in range (-3 ... 3)<br>";
    }

    if (!(r >= 1 && r <= 3)) {
        flag = false;
        error_message += "You can use R only in range (1 ... 3)<br>";
    }

    if (!flag) {
        showError(error_message);
        return false;
    }

    // return false to prevent updating the page
    return false;
}

