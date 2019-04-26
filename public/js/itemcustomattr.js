function assignValTomodel_itemcustomattr(Object){
    Object = jQuery.parseJSON(Object);
    console.log(Object.name);
    $('#_name').val(Object.name);
    $('#_type').val(Object.type);
    $('#itemName').text(Object.ItemName);

    var action = $('#_customAttrForm').attr('action');
    action = action + Object.id;
    $('#_customAttrForm').attr('action', action);
}
