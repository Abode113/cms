function assignValTomodel_Role(Object){
    Object = jQuery.parseJSON(Object);
    console.log(Object.permissions);

    $('#name').val(Object.name);
    $('#display_name').val(Object.display_name);
    $('#description').val(Object.description);

    for(var i = 0; i < Object.permissions.length; i++){
        var id = '_customCheck' + Object.permissions[i];
        console.log(id);
        $('#' + id).prop('checked', true);
    }

    // for(var i = 0; i < Object.permissions.length; i++){
    //     if(Object.permissions[i] != -1) {
    //         var id = 'customCheck' + Object.permissions[i];
    //         $('#' + id).prop('checked', true);
    //     }
    // }

    var action = $('#modalForm').attr('action');
    action = action + Object.id;
    $('#modalForm').attr('action', action);
}
