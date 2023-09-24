let selector = document.querySelector("#r-value");
// let xInput = document.getElementById("x-value");
// let yInput = document.getElementById("y-value");

selector.addEventListener("change", function() {
    draw(0, 0, selector.value);
});