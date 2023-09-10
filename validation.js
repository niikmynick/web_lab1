function validateForm() {
    let x = document.forms[0]["x-value"].value;
    let y = document.forms[0]["y-value"].value;
    let r = document.forms[0]["r-value"].value;

    let error_message = "An error occurred: invalid input values.\nYou can use X only in range (-5 ... 3)\nYou can use Y only in range (-3 ... 3)\n";

    if (isNaN(x) || isNaN(y)) {
        alert(error_message);
        return false;
    }

    let n_x = parseFloat(x)
    let n_y = parseFloat(y)
    let n_r = parseFloat(r)

    if (isNaN(n_x) || n_x < -5 || n_x > 3 || isNaN(n_y) || n_y < -3 || n_y > 3) {
        alert(error_message);
        return false;
    }

    save_entry(n_x, n_y, n_r)

    return false;
}

function save_entry(x, y, r) {
    let resultsDiv = document.getElementById("results");
    let resultTable = document.getElementById("results-body");

    if (resultsDiv.style.display !== 'block') {
        resultsDiv.style.display = 'block';
    }

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "script.php?r-value=" + r + "&x-value=" + x + "&y-value=" + y, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            resultTable.innerHTML += xhr.responseText;
            draw(x, y, r)
        }
    };
    xhr.send();
}

function draw(x, y, r) {
    const circle = document.getElementById('point')

    const r_label = document.getElementsByClassName("r-label");
    const r_minus_label = document.getElementsByClassName("r-minus-label");
    const r_half_label = document.getElementsByClassName("r-half-label");
    const r_minus_half_label = document.getElementsByClassName("r-half-minus-label");


    const centerX = 200;
    const centerY = 200;
    const scaleFactor = 100 / r;

    const scaledX = (x * scaleFactor) + centerX;
    const scaledY = (y * -scaleFactor) + centerY;

    circle.setAttribute("cx", scaledX.toString());
    circle.setAttribute("cy", scaledY.toString());

    for (let label of r_label) {
        label.innerHTML = r.toString();
    }

    for (let label of r_minus_label) {
        label.innerHTML = (-r).toString();
    }

    for (let label of r_half_label) {
        label.innerHTML = (r/2).toString();
    }

    for (let label of r_minus_half_label) {
        label.innerHTML = (-r/2).toString();
    }

}
