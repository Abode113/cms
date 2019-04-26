function assignValTomodel_dictionaries(Current_id, AllData){
    Current_id = jQuery.parseJSON(Current_id);
    AllData = jQuery.parseJSON(AllData);

    for(var i = 0; i < AllData.length; i++){
        if(AllData[i].id == Current_id){
            for(var j = 0; j < AllData[i].Data.length; j++){
                var id = 'word_lang_' + AllData[i].Data[j].Language_id;
                $('#' + id).val(AllData[i].Data[j].word);
            }


        }
    }

    // $('#name').val(Object.name);
    // $('#display_name').val(Object.display_name);
    // $('#description').val(Object.description);

    var action = $('#modalForm').attr('action');
    action = action + Current_id;
    $('#modalForm').attr('action', action);
}
