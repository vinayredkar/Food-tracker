var myInput = document.getElementById("password1");
var myNumber = document.getElementById("number");
var myLetter = document.getElementById("letter");
var myLength = document.getElementById("length");

myInput.onblur = function() {
    document.getElementById("verification").style.display = "none";
}

myInput.onfocus = function() {
    document.getElementById("verification").style.display = "block";
}

myInput.oninput = function () {
    var numbers = /\d/g;
    if(numbers.test(myInput.value)) {
        myNumber.classList.remove("invalid");
        myNumber.classList.add("valid");
    } else {
        myNumber.classList.remove("valid");
        myNumber.classList.add("invalid");
    }
    var letters = /([A-z])/g;
    if(letters.test(myInput.value)) {
        myLetter.classList.remove("invalid");
        myLetter.classList.add("valid");
    } else {
        myLetter.classList.remove("valid");
        myLetter.classList.add("invalid");
    }
    var length = /(?=.).{5,}/g;
    if(length.test(myInput.value)) {
        myLength.classList.remove("invalid");
        myLength.classList.add("valid");
    } else {
        myLength.classList.remove("valid");
        myLength.classList.add("invalid");
    }
}

