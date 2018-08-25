
function hideit(id){
    var el = document.getElementById(id);

    if(el.style.display=='none')
        el.style.display='inherit';
    else
        el.style.display='none';
}


    var start = document.getElementsByName(Start);
    var end = document.getElementsByName(End);
    var total = end - start;
    var value = document.getElementsByName(Total)

    end.addEventListener("input", function() {
        value.innerText = total.value;
    }, false);
