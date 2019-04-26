function assignValTomodel(name,num, objid, objtitle){
    name = jQuery.parseJSON(name);
    objtitle = jQuery.parseJSON(objtitle);
    objid = jQuery.parseJSON(objid);

    for (var i = 0; i < objid.length; i++){
        if(objid[i] != num){
            var id = 'opt' + objid[i];
            $('#' + id).text(objtitle[i]);
        }else{
            var id = 'opt' + objid[i];
            $('#' + id).text('First');
            $('#' + id).val(0);
        }
    }
    for (var i = 0; i < name.length; i++){
        var id = 'title_' + name[i].LanguageName;
        $('#' + id).val(name[i].title);
    }
    var checkBox = document.getElementById("checboxvisible");
    if(name[0].visible==0)
    {
        checkBox.checked =false;
    }
    else{
        checkBox.checked =true;
    }
    $('#parent').val(name[0].parent);
    $('#navOrder').val(name[0].navOrder);
    $('#event_id').val(name[0].event_id);

    var action = $('#modalForm').attr('action');
    action = action + name[0].id;
    $('#modalForm').attr('action', action);
}

function visiblefunction(name) {
    var checkBox = document.getElementById("checboxvisible");
    var text = document.getElementById("visible");

    if (checkBox.checked == true){
        text.value= "1";
    } else {
        text.value= "0";
    }


}
function visiblefunctioninstore() {
    var checkBox = document.getElementById("checboxvisible");
    var text = document.getElementById("visible");

    if (checkBox.checked == true){
        text.value= "1";
    } else {
        text.value= "0";
    }
    
}
function test(){

}


function test1(){
    $("#Element1").before($("#Element2"));
}

function test2(){
    var itemOrder = $('#sortableContainer').siblings().closest('div');
    console.log(itemOrder);
}

