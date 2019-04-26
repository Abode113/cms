function assignValTomodel(name, num, objid, objtitle){

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

        var id = 'desc_' + name[i].LanguageName;
        $('#' + id).val(name[i].desc);

        var id = 'info_' + name[i].LanguageName;
        $('#' + id).val(name[i].info);
    }
    $('#id').val(name[0].id);
    $('#image').val(name[0].image);
    $('#coverimage').val(name[0].coverimage);
    console.log(name[0]);
    console.log(name[0].parent);
    $('#parent').val(name[0].parent);//category_id

    $('#categoryOrder').val(name[0].categoryOrder);
    $('#event_id').val(name[0].event_id);

    var action = $('#modalForm').attr('action');
    action = action + name[0].id;
    $('#modalForm').attr('action', action);
    //var action1 = $('#modalForm').attr('action');
    //console.log(action1);

    //console.log(name.title);
    //alert(name['title']);
}
function test(num, objid, objtitle) {

    // objtitle = jQuery.parseJSON(objtitle);
    // objid = jQuery.parseJSON(objid);
    //
    // console.log(objid.length);
    // for (var i = 0; i < objid.length; i++){
    //     if(objid[i] != num){
    //         var id = 'opt' + objid[i];
    //         $('#' + id).text(objtitle[i]);
    //     }
    // }

}
