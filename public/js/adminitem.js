function hey(name){
    //console.log(name);debugger;

    //name = jQuery.parseJSON(name);

    //console.log(name);
    var action = $('#modalForm').attr('action');
    action = action + name[0].id;
    //console.log(action);
    $('#modalForm').attr('action', action);


    var _action = $('#customAttrForm').attr('action');
    _action = _action + name[0].id;
    $('#customAttrForm').attr('action', _action);


    for (var i = 0; i < name.length; i++){
        var id1 = 'title_lang_' + name[i].LanguageName;
        $('#' + id1).val(name[i].title);
        var id2 = 'desc_lang_' + name[i].LanguageName;
        $('#' + id2).val(name[i].desc);
        var id3 = 'info_lang_' + name[i].LanguageName;
        $('#' + id3).val(name[i].info);
    }

    var checkBox = document.getElementById("checboxvisibleitem");
    if(name[0].visible==0)
    {
        checkBox.checked =false;
    }
    else{
        checkBox.checked =true;
    }
    $('#image').val(name[0].image);
    $('#coverimage').val(name[0].coverimage);
    $('#parent').val(name[0].parent);
    $('#itemOrder').val(name[0].itemOrder);
    $('#visible').val(name[0].visible);
    $('#category_id').val(name[0].category_id);
    $('#event_id').val(name[0].event_id);

    //console.log(name);
    for(var i = 0; i < name.length; i++){
        for(var j = 0; j < name[i].value.length; j++){
            //console.log(name[i].value[j].key);
            //console.log(name[i].value[j].value);
            var HtmlTag = '\n' +
                '<div class="form-group row">\n' +
                '    <label class="col-md-4 col-form-label text-md-right">' + name[i].value[j].key + '</label>\n' +
                '    <div class="col-md-6">\n' +
                '        <input type="text" value="' + name[i].value[j].value + '" name="' + name[i].value[j].key + '_lang_' + name[i].LanguageId + '_dynamicValue_' + '" id="' + name[i].value[j].key + '_lang_' + name[i].LanguageId + '_dynamicValue" class="from-conrol" style="display: block">\n' +
                '    </div>\n' +
                '</div>';
            $('#dynamicFeilds_' + name[i].LanguageId).after(HtmlTag);
        }
    }

//console.log(name[0].itemCustomAttr.name[0]);
    //console.log("hey");
    for(var i = 0; i < name.length; i++){
        for(var j = 0; j < name[i].itemCustomAttr.name.length; j++){
            //console.log(name[i].itemCustomAttr.value[j]);
            var HtmlTag = '\n' +
                '<div class="form-group row">\n' +
                '    <label class="col-md-4 col-form-label text-md-right">' + name[0].itemCustomAttr.name[j] + '</label>\n' +
                '    <div class="col-md-6">\n' +
                '        <input type="text" value="' + name[i].itemCustomAttr.value[j]    + '" name="' + name[i].itemCustomAttr.name[j] + '_lang_' + name[i].LanguageId + '_dynamicItemCustomAttrValue_' + name[i].itemCustomAttr.id[j] + '" id="' + name[i].itemCustomAttr.name[j] + '_lang_' + name[i].LanguageId + '_dynamicItemCustomAttrValue" class="from-conrol" style="display: block">\n' +
                '    </div>\n' +
                '</div>';
            //                '        <input type="text" value="' + name[i].value[j].value + '" name="' + name[i].value[j].key + '_lang_' + name[i].LanguageId + '_dynamicValue" id="' + name[i].value[j].key + '_lang_' + name[i].LanguageId + '_dynamicValue" class="from-conrol" style="display: block">\n' +
            $('#dynamicCustomFeilds_' + name[i].LanguageId).after(HtmlTag);
        }
    }
    //Custom
    //$('#dynamicCustomFeilds_' + name[i].LanguageId).after(HtmlTag);

}
function assignValTomodelitem(name){
    //console.log(name);debugger;

    name = jQuery.parseJSON(name);

    console.log(name);
    var action = $('#modalForm').attr('action');
    action = action + name[0].id;
    console.log(action);
    $('#modalForm').attr('action', action);


    var _action = $('#customAttrForm').attr('action');
    _action = _action + name[0].id;
    $('#customAttrForm').attr('action', _action);


    for (var i = 0; i < name.length; i++){
        var id1 = 'title_lang_' + name[i].LanguageName;
        $('#' + id1).val(name[i].title);
        var id2 = 'desc_lang_' + name[i].LanguageName;
        $('#' + id2).val(name[i].desc);
        var id3 = 'info_lang_' + name[i].LanguageName;
        $('#' + id3).val(name[i].info);
    }

    var checkBox = document.getElementById("checboxvisibleitem");
    if(name[0].visible==0)
    {
        checkBox.checked =false;
    }
    else{
        checkBox.checked =true;
    }
    $('#image').val(name[0].image);
    $('#coverimage').val(name[0].coverimage);
    $('#parent').val(name[0].parent);
    $('#itemOrder').val(name[0].itemOrder);
    $('#visible').val(name[0].visible);
    $('#category_id').val(name[0].category_id);
    $('#event_id').val(name[0].event_id);

    //console.log(name);
    for(var i = 0; i < name.length; i++){
        for(var j = 0; j < name[i].value.length; j++){
            //console.log(name[i].value[j].key);
            //console.log(name[i].value[j].value);
            var HtmlTag = '\n' +
                '<div class="form-group row">\n' +
                '    <label class="col-md-4 col-form-label text-md-right">' + name[i].value[j].key + '</label>\n' +
                '    <div class="col-md-6">\n' +
                '        <input type="text" value="' + name[i].value[j].value + '" name="' + name[i].value[j].key + '_lang_' + name[i].LanguageId + '_dynamicValue_' + '" id="' + name[i].value[j].key + '_lang_' + name[i].LanguageId + '_dynamicValue" class="from-conrol" style="display: block">\n' +
                '    </div>\n' +
                '</div>';
            $('#dynamicFeilds_' + name[i].LanguageId).after(HtmlTag);
        }
    }


    for(var i = 0; i < name.length; i++){
        for(var j = 0; j < name[0].itemCustomAttr.name.length; j++){
            //console.log(name[0].itemCustomAttr);
            var HtmlTag = '\n' +
                '<div class="form-group row">\n' +
                '    <label class="col-md-4 col-form-label text-md-right">' + name[0].itemCustomAttr.name[j] + '</label>\n' +
                '    <div class="col-md-6">\n' +
                '        <input type="text" value="' + name[i].itemCustomAttr.value[j]    + '" name="' + name[0].itemCustomAttr.name[j] + '_lang_' + name[i].LanguageId + '_dynamicItemCustomAttrValue_' + name[0].itemCustomAttr.id[j] + '" id="' + name[0].itemCustomAttr.name[j] + '_lang_' + name[i].LanguageId + '_dynamicItemCustomAttrValue" class="from-conrol" style="display: block">\n' +
                '    </div>\n' +
                '</div>';
            //                '        <input type="text" value="' + name[i].value[j].value + '" name="' + name[i].value[j].key + '_lang_' + name[i].LanguageId + '_dynamicValue" id="' + name[i].value[j].key + '_lang_' + name[i].LanguageId + '_dynamicValue" class="from-conrol" style="display: block">\n' +
            $('#dynamicCustomFeilds_' + name[i].LanguageId).after(HtmlTag);
        }
    }
    //Custom
    //$('#dynamicCustomFeilds_' + name[i].LanguageId).after(HtmlTag);


}

function visiblefunctionitem(name) {
    var checkBox = document.getElementById("checboxvisibleitem");
    var text = document.getElementById("visible");

    if (checkBox.checked == true){
        text.value= "1";
    } else {
        text.value= "0";
    }


}
function visiblefunctioniteminstore(){
    var checkBox = document.getElementById("checboxvisibleitem");
    var text = document.getElementById("visible");

    if (checkBox.checked == true){
        text.value= "1";
    } else {
        text.value= "0";
    }

}

function refresh(categoryId){
    //alert(categoryId);
    var Url = window.location.href;
    newUrl = Url.split('/');
    newUrl[newUrl.length - 1] = categoryId;
    newUrl = newUrl.join('/');
    //alert(newUrl);
    //$('#categorySelect').val(categoryId);
    //alert($('#categorySelect').val());
    window.location.replace(newUrl);
    //location.reload();
}

