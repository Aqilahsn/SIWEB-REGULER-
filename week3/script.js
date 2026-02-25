function clickCounter() {

    if (localStorage.clickcount) {
        localStorage.clickcount = Number(localStorage.clickcount) + 1;
    } else {
        localStorage.clickcount = 1;
    }

    document.getElementById("result").innerHTML =
        "You have clicked the button " + localStorage.clickcount + " time(s).";
}

window.onload = function() {

    if (localStorage.clickcount) {
        document.getElementById("result").innerHTML =
            "You have clicked the button " + localStorage.clickcount + " time(s).";
    } else {
        document.getElementById("result").innerHTML =
            "You have clicked the button 0 time(s).";
    }
}