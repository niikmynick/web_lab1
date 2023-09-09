function validateForm() {
    let x = document.forms[0]["x-value"].value;
    let y = document.forms[0]["y-value"].value;

    let error_message = "An error occurred: invalid input values.\nYou can use X only in range (-5 ... 3)\nYou can use Y only in range (-3 ... 3)\n";

    if (isNaN(x) || isNaN(y)) {
        alert(error_message);
        return false;
    }

    let n_x = parseInt(x)
    let n_y = parseInt(y)

    if (isNaN(n_x) || n_x < -5 || n_x > 3 || isNaN(n_y) || n_y < -3 || n_y > 3) {
        alert(error_message);
        return false;
    }
    save_entry()

    return false;
}

function save_entry() {
    let rInput = document.getElementById("r-value");
    let xInput = document.getElementById("x-value");
    let yInput = document.getElementById("y-value");
    let resultTable = document.getElementById("results-body");

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "script.php?r-value=" + rInput.value + "&x-value=" + xInput.value + "&y-value=" + yInput.value, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            resultTable.innerHTML += xhr.responseText; // Обновляем таблицу с результатами
        }
    };
    xhr.send();
}
