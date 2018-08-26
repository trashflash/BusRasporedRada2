function changeit(id, field, element){
    var newVal = $(element).val();
    $.post("getter.php",{
        "id": id,
        "field": field,
        "newVal": newVal
    }, function(result){
        if(result == 'success'){
            alert('id: '+ id);
            alert('column: '+ field);
            alert('what change: '+ newVal);
        }
    });
}

function izmena(id, field, element){
    var newVal = $(element).val();
    $.post("getter2.php",{
        "id": id,
        "field": field,
        "newVal": newVal
    }, function(result){
        if(result == 'success'){
            alert('id: '+ id);
            alert('column: '+ field);
            alert('what change: '+ newVal);
        }
    });
}
