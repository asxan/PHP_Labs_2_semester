document.onload = red();
;function red(){
    var clock = 3;
     var t1 = setInterval(function () {
        var text = document.getElementById("redirSpan");
        clock--;
        if (clock == -1) {
            clearInterval(t1);
            location.href = "index.php";
        }
        else {
            text.innerHTML = "Redirect in " + clock + " (sec)";
        }

    }, 1000);
}