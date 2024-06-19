function search() {
    const input = document.getElementById("myInput");
    const filter = input.value.toLowerCase();
    console.log(filter);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("get", "../actions/action_search.php?q=" + filter, true);
    xmlhttp.send(); 

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("restaurants_index").innerHTML = this.responseText;
        }
    }
}