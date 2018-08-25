
function hideit(id){
    var el = document.getElementById(id);

    if(el.style.display=='none')
        el.style.display='inherit';
    else
        el.style.display='none';
}