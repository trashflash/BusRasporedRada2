var jsonContainer = document.getElementById("jsona");
var btn = document.getElementById("btn");

btn.addEventListener("click", function (){
    var ourRequest = new XMLHttpRequest();
    ourRequest.open('GET','https://api.myjson.com/bins/15uh7c');
    ourRequest.onload = function () {
        var ourData = JSON.parse(ourRequest.responseText);
        renderHTML(ourData);
        btn.style.display='none';
    };
    ourRequest.send();
});

function renderHTML(data) {
    var htmlString = "";
    for (i=0;i<data.length;i++) {
        htmlString += "<p class='w3-text-deep-purple'>" + data[i].name + " - " + data[i].index + "</p>";
    }
    jsonContainer.insertAdjacentHTML('beforeend', htmlString);
}