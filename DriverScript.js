window.addEventListener('load',init);

function init()
{

    var buttons = document.querySelectorAll('input[type=button]');
    for (var i = 0; i < buttons.length; i++)
    {
        buttons[i].addEventListener('click',sendDriver);
    }
}

function sendDriver()
{
    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            console.log(xmlhttp.responseText);
            document.querySelector('.result').innerHTML=xmlhttp.responseText;
        }
    }
    var id = document.getElementsByName("driverID").innerHTML;
    var fname = document.getElementsByName("driverFName").innerHTML;
    var lname = document.getElementsByName("driverLName").innerHTML;
    var pass = document.getElementsByName("password").innerHTML;
    var upload = document.getElementsByName("upload").innerHTML;
    var digit=document.querySelector('#digitTach input[type="radio"]:checked').value;
    var area=document.querySelector('#area option:checked').value;
    var own=document.querySelector('#ownBus option:checked').value;

    xmlhttp.open("POST","EditDriver.php?driverID="+id+"&driverFName="+fname+"&driverLName="+lname+"&password="+pass+"&digitTach="+digit+"&area="+area+"&ownBus="+own+"&upload="+upload,true);
    xmlhttp.send();

}