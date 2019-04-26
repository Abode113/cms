function assignValTomodel_User(CurrentUserObj, AllRoles){
    CurrentUserObj = jQuery.parseJSON(CurrentUserObj);
    AllRoles = jQuery.parseJSON(AllRoles);

    for(var i = 0; i < AllRoles.length; i++){
        var id = 'customCheck' + AllRoles[i].id;
        console.log(id);
        $('#' + id).prop('checked', false);
    }

    for(var i = 0; i < CurrentUserObj.Role_id.length; i++){
        if(CurrentUserObj.Role_id[i] != -1) {
            var id = 'customCheck' + CurrentUserObj.Role_id[i];
            $('#' + id).prop('checked', true);
        }
    }

    var action = $('#modalForm').attr('action');
    action = action + CurrentUserObj.id;
    $('#modalForm').attr('action', action);
}
