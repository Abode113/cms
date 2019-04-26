function assignValTomodel_catcustomattr(CatCustomAttrObj, CurrentElemId){
    CatCustomAttrObj = jQuery.parseJSON(CatCustomAttrObj);

    for(var i = 0; i < CatCustomAttrObj.length; i++) {
        if (CatCustomAttrObj[i].id == CurrentElemId) {
            // console.log(CatCustomAttrObj[i].name);
            // console.log(CatCustomAttrObj[i].type);
            // console.log(CatCustomAttrObj[i].category_id);
            $('#name').val(CatCustomAttrObj[i].name);
            $('#type').val(CatCustomAttrObj[i].type);
            $('#category_id').val(CatCustomAttrObj[i].category_id);

            var action = $('#modalForm').attr('action');
            action = action + CatCustomAttrObj[i].id;
            $('#modalForm').attr('action', action);
            break;
        }
    }






    // name = jQuery.parseJSON(name);
    // objtitle = jQuery.parseJSON(objtitle);
    // objid = jQuery.parseJSON(objid);
    //
    // for (var i = 0; i < objid.length; i++){
    //     if(objid[i] != num){
    //         var id = 'opt' + objid[i];
    //         $('#' + id).text(objtitle[i]);
    //     }else{
    //         var id = 'opt' + objid[i];
    //         $('#' + id).text('First');
    //         $('#' + id).val(0);
    //     }
    // }
    // for (var i = 0; i < name.length; i++){
    //     var id = 'title_' + name[i].LanguageName;
    //     $('#' + id).val(name[i].title);
    // }
    // var checkBox = document.getElementById("checboxvisible");
    // if(name[0].visible==0)
    // {
    //     checkBox.checked =false;
    // }
    // else{
    //     checkBox.checked =true;
    // }
    // $('#parent').val(name[0].parent);
    // $('#navOrder').val(name[0].navOrder);
    // $('#event_id').val(name[0].event_id);
    //
    // var action = $('#modalForm').attr('action');
    // action = action + name[0].id;
    // $('#modalForm').attr('action', action);
}
