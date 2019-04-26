<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});


Route::get('/template1', function () {
    return view('template1.index');
});

Route::get('/template2', function () {
    return view('template2.index');
});


////////////////////////////////////////////////////////////////////////////////////
                                ////End User////
////////////////////////////////////////////////////////////////////////////////////
//Route::resource('/home',                        'homePageController');
//Route::group(['middleware' => 'checkval'], function() {
Route::get('/home/',                            'homePageController@index');
Route::get('/home/{langid}',                    'homePageController@indexByLang');
//});
Route::get('/listofallitem',                    'itemcontroller@getallitem');
Route::get('/listofitembycategory/{id}/{langid}','itemcontroller@getitembycategoy');
Route::get('/listofcategory',                   'categorycontroller@getallcategories');
Route::get('/getallcategoriesByParentId/{id}/{langid}',  'categorycontroller@getallcategoriesByParentId');
Route::post('/Language/setdefaultLanguage',     'LanguageController@setdefaultLanguage');
////////////////////////////////////////////////////////////////////////////////////
                                ////Menu Item////
////////////////////////////////////////////////////////////////////////////////////
Route::post('/menuitem/store',                  'menuitemcontroller@store');
Route::get('/menuitem/edit/{ID}',               'menuitemcontroller@edit')->name('menuitem');
Route::post('/menuitem/update/{ID}',            'menuitemcontroller@update')->name('menuitemupdate');
Route::post('/menuitem/delete/{ID}',            'menuitemcontroller@destroy')->name('menuitemdelete');
Route::get('/menuitem/store',                   'menuitemcontroller@storeview');//storemenuitem
////////////////////////////////////////////////////////////////////////////////////
                                 ////category rout////
 ////////////////////////////////////////////////////////////////////////////////////
Route::post('/category/store',                  'categorycontroller@store')->name('categorystore');
Route::get('/category/edit/{ID}',               'categorycontroller@edit')->name('categoryedit');
Route::post('/category/update/{ID}',            'categorycontroller@update')->name('categoryupdate');
Route::post('/category/delete/{ID}',            'categorycontroller@destroy')->name('categorydelete');
Route::get('/category/store',                   'categorycontroller@storeview');//storecategory
////////////////////////////////////////////////////////////////////////////////////
                                ////item rout////
////////////////////////////////////////////////////////////////////////////////////
Route::post('/item/store',                      'itemcontroller@store')->name('itemstore');
Route::get('/item/edit/{ID}',                   'itemcontroller@edit')->name('itemedit');
Route::post('/item/update/{ID}',                'itemcontroller@update')->name('itemupdate');
Route::post('/item/delete/{ID}',                'itemcontroller@destroy')->name('itemdelete');
Route::get('/item/store/{CatDefId}',            'itemcontroller@storeview');//storeitem
Route::get('/item/{id}/{langid}',               'itemcontroller@getitembyid');


////////////////////////////////////////////////////////////////////////////////////
                                //// Admin ////
////////////////////////////////////////////////////////////////////////////////////
Route::get('/admin/home',                       'admincontroller@homepage');
Route::get('/admin/home/menuitem',              'adminmenuitemcontroller@homepage');
Route::get('/admin/home/item',                  'adminitemcontroller@homepage');
Route::get('/admin/home/category',              'admincategorycontroller@homepage');
Route::get('/admin/home/Language',              'LanguageController@homepage');
Route::get('/admin/home/Attribute',             'CatCustomAttrController@homepage');
Route::get('/admin/home/Role',                  'rolecontroller@homepage');
Route::get('/admin/home/User',                  'UserController@homepage');
Route::get('/admin/home/Dictionary',            'DictionaryController@homepage');
Route::get('/admin/home/itemCustomAttribute',   'itemcustomattrcontroller@homepage');
Route::get('/admin/home/Permission',            'PermissionController@homepage');
////////////////////////////////////////////////////////////////////////////////////
                                //// Language ////
////////////////////////////////////////////////////////////////////////////////////
Route::post('/Language/store',                  'LanguageController@store')->name('Languagestore');
Route::post('/Language/delete/{ID}',            'LanguageController@destroy')->name('Languagedelete');
Route::post('/Language/update/{ID}',            'LanguageController@update')->name('Languageupdate');
////////////////////////////////////////////////////////////////////////////////////
                                //// CatCustomAttr ////
////////////////////////////////////////////////////////////////////////////////////
Route::post('/CatCustomAttr/store',              'CatCustomAttrController@store')->name('CatCustomAttrstore');
Route::get('/CatCustomAttr/store/',              'CatCustomAttrController@storeview');//storeitem
Route::post('/CatCustomAttr/delete/{ID}',        'CatCustomAttrController@destroy')->name('CatCustomAttrdelete');
Route::post('/CatCustomAttr/update/{ID}',        'CatCustomAttrController@update')->name('CatCustomAttrupdate');
////////////////////////////////////////////////////////////////////////////////////
                                //// Role ////
////////////////////////////////////////////////////////////////////////////////////
Route::post('/Role/store',                       'rolecontroller@store')->name('Rolestore');
Route::post('/Role/delete/{ID}',                 'rolecontroller@destroy')->name('Roledelete');
Route::post('/Role/update/{ID}',                 'rolecontroller@update')->name('Roleupdate');
////////////////////////////////////////////////////////////////////////////////////
//                                //// User ////
//////////////////////////////////////////////////////////////////////////////////////
Route::post('/User/delete/{ID}',                 'UserController@destroy')->name('Userdelete');
Route::post('/User/AddRole/{UserID}',            'UserController@AddRole')->name('AddRole');
//////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
                                //// Language ////
////////////////////////////////////////////////////////////////////////////////////
Route::post('/Dictionary/store',                  'DictionaryController@store')->name('Dictionarystore');
Route::post('/Dictionary/delete/{ID}',            'DictionaryController@destroy')->name('Dictionarydelete');
Route::post('/Dictionary/update/{ID}',            'DictionaryController@update')->name('Dictionaryupdate');
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
                            //// ItemCustomAttribute ////
/// ////////////////////////////////////////////////////////////////////////////////////
Route::post('/ItemCustomAttribute/store',                  'itemcustomattrcontroller@store')->name('ItemCustomAttributestore');
Route::post('/ItemCustomAttribute/delete/{ID}',            'itemcustomattrcontroller@destroy')->name('ItemCustomAttributedelete');
Route::post('/ItemCustomAttribute/update/{ID}',            'itemcustomattrcontroller@update')->name('ItemCustomAttributeupdate');
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
                                //// Permission ////
/// ////////////////////////////////////////////////////////////////////////////////////
Route::post('/Permission/store',                  'PermissionController@store')->name('Permissionstore');
Route::post('/Permission/delete/{ID}',            'PermissionController@destroy')->name('Permissiondelete');
Route::post('/Permission/update/{ID}',            'PermissionController@update')->name('Permissionupdate');
////////////////////////////////////////////////////////////////////////////////////
Route::get('/hey', function () {
    return view('welcome');
});
Route::get('/hey1', function () {
    return view('test');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
