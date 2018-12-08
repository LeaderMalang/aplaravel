<?php







//Auth::routes();

Route::group(['prefix' => 'admin','namespace' => 'Auth'],function(){
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.token');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
});
//Home Controller
Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/new', 'HomeController@newUser')->name('new.user');
Route::get('/user/list', 'HomeController@listUser')->name('user.list');
Route::get('/user/update/{id}', 'HomeController@editUser')->name('update.user');
Route::get('/user/delete/{id}', 'HomeController@destory')->name('delete.user');
Route::post('/user/store', 'HomeController@store')->name('store.user');
Route::post('/user/edit', 'HomeController@updateUser')->name('edit.user');


//Profile Routes
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::post('/update', 'HomeController@update')->name('update');
//Role Route CRUD
Route::get('/role/list', 'RoleController@index')->name('role.list');
Route::get('/role/create', 'RoleController@create')->name('role.create');
Route::get('/role/delete/{id}', 'RoleController@destory')->name('role.delete');
Route::post('/role/store', 'RoleController@store')->name('role.store');
Route::post('/role/update', 'RoleController@update')->name('role.update');
Route::get('/role/edit/{id}', 'RoleController@edit')->name('role.edit');
//Permission Route CRUD
Route::get('/permission/list', 'PermissionController@index')->name('permission.list');
Route::get('/permission/create', 'PermissionController@create')->name('permission.create');
Route::get('/permission/delete/{id}', 'PermissionController@destory')->name('permission.delete');
Route::get('/permission/edit/{id}', 'PermissionController@edit')->name('permission.edit');
Route::post('/permission/store', 'PermissionController@store')->name('permission.store');
Route::post('/permission/update', 'PermissionController@update')->name('permission.update');
//Assign Role to Users
Route::get('role/assign/user','RoleController@roleforuser')->name('role.assign.user');
Route::get('role/roleuser/list','RoleController@roleuserlist')->name('role.user.list');
Route::get('role/roleuser/delete/{id}','RoleController@deleteroles')->name('role.user.delete');
Route::get('role/roleuser/edit/{id}','RoleController@editUserRole')->name('role.user.edit');
Route::post('/role/assignuser/store', 'RoleController@assignrole')->name('role.assignuser.store');
Route::post('/role/assignuser/update', 'RoleController@updateUserRole')->name('role.assignuser.update');
//Assign Permissions To Role or Users
Route::get('permission/assign/torole','PermissionController@assignpermission')->name('permission.assign.torole');
Route::post('permission/assigntorole/store','PermissionController@storeassignpermission')->name('permission.assigntorole.store');
Route::get('permission/assigntorole/list','PermissionController@listpermissions')->name('permission.assigntorole.list');
Route::get('permission/assigntorole/edit/{role}','PermissionController@editAssignPermission')->name('permission.assigntorole.edit');
Route::get('permission/assigntorole/delete/{role}','PermissionController@deleteAssignPermission')->name('permission.assigntorole.delete');
Route::post('permission/assigntorole/update','PermissionController@updateAssignPermission')->name('permission.assigntorole.update');

//create seeder
Route::get('seeder/create','AutoSeedCreator@create')->name('seeder.creator');
Route::post('seeder/store','AutoSeedCreator@store')->name('seeder.store');

//Mapper routes
Route::get('currencies/get','MapData@currencies')->name('currencies.get');
Route::get('currencies/test','MapData@test')->name('currencies.test');

//Fiat Currencies
Route::get('currencies/fiat','FiatCurrencyController@index')->name("currencies.fiat");
Route::get('currencies/fiat/changeStatus','FiatCurrencyController@changeStatus')->name("currencies.fiat.chanageStatus");
Route::get('currencies/fiat/create','FiatCurrencyController@create')->name("currencies.fiat.create");
Route::post('currencies/fiat/store','FiatCurrencyController@store')->name("currencies.fiat.store");
Route::get('currencies/fiat/edit','FiatCurrencyController@edit')->name("currencies.fiat.edit");
Route::post('currencies/fiat/update','FiatCurrencyController@update')->name("currencies.fiat.update");
Route::get('currencies/fiat/destory','FiatCurrencyController@destory')->name("currencies.fiat.destory");
Route::get('currencies/fiat/destory','FiatCurrencyController@destory')->name("currencies.fiat.destory");
Route::get('currencies/fiat/updateExchangeRate','FiatCurrencyController@updateExchangeRate')->name("currencies.fiat.updateExchangeRate");

//Crypto Currencies
Route::get('currencies/crypto','CryptoCurrencyController@index')->name('currencies.crypto');
Route::get('currencies/crypto/create','CryptoCurrencyController@create')->name('currencies.crypto.create');
Route::post('currencies/crypto/store','CryptoCurrencyController@store')->name('currencies.crypto.store');
Route::get('currencies/crypto/thumbnail','CryptoCurrencyController@thumbnail')->name('currencies.crypto.thumbnail');
Route::get('currencies/crypto/destory','CryptoCurrencyController@destory')->name('currencies.crypto.destory');
Route::get('currencies/crypto/edit','CryptoCurrencyController@edit')->name('currencies.crypto.edit');
Route::post('currencies/crypto/update','CryptoCurrencyController@update')->name('currencies.crypto.update');
Route::get('currencies/crypto/changeStatus','CryptoCurrencyController@changeStatus')->name("currencies.crypto.chanageStatus");

//Crypto Currency Detail
Route::get('currencies/cryptoDetail','CryptoCurrencyController@currencyDetailList')->name('currencies.cryptoDetails');
Route::get('currencies/cryptoDetail/editDetals','CryptoCurrencyController@editDetals')->name('currencies.cryptoDetails.editDetals');
Route::get('currencies/cryptoDetail/createDetails','CryptoCurrencyController@createDetails')->name('currencies.cryptoDetails.createDetails');
Route::post('currencies/cryptoDetail/storeDetails','CryptoCurrencyController@storeDetails')->name('currencies.cryptoDetails.storeDetails');
Route::post('currencies/cryptoDetail/updateDetails','CryptoCurrencyController@updateDetails')->name('currencies.cryptoDetails.updateDetails');
Route::get('currencies/cryptoDetail/loadCurrency','CryptoCurrencyController@loadCurrency')->name('currencies.cryptoDetails.loadCurrency');
Route::get('currencies/cryptoDetail/destoryDetals','CryptoCurrencyController@destoryDetals')->name('currencies.cryptoDetails.destoryDetals');

//Exchanges Routes
Route::get("exchanges/list",'ExchangeController@index')->name('exchanges.list');
Route::get("exchanges/create",'ExchangeController@create')->name('exchanges.create');
Route::get("exchanges/list/destory",'ExchangeController@destory')->name('exchanges.destory');
Route::get("exchanges/list/edit",'ExchangeController@edit')->name('exchanges.edit');
Route::post("exchanges/store",'ExchangeController@store')->name('exchanges.store');
Route::post("exchanges/update",'ExchangeController@update')->name('exchanges.update');

//Currency Exchanges Pairs
Route::get("cepairs/list",'CePairsController@index')->name('cepairs.list');
Route::get("cepairs/list/create",'CePairsController@create')->name('cepairs.create');
Route::get("cepairs/changeStatus",'CePairsController@changeStatus')->name('cepairs.changeStatus');
Route::get("cepairs/list/loadCurrency",'CePairsController@loadCurrency')->name('cepairs.loadCurrency');
Route::get("cepairs/list/loadExchanges",'CePairsController@loadExchanges')->name('cepairs.loadExchanges');
Route::get("cepairs/list/loadCurrencyCode",'CePairsController@loadCurrencyCode')->name('cepairs.loadCurrencyCode');
Route::post("cepairs/list/store",'CePairsController@store')->name('cepairs.store');
Route::get("cepairs/list/destory",'CePairsController@destory')->name('cepairs.destory');
Route::get("cepairs/list/edit",'CePairsController@edit')->name('cepairs.edit');
Route::post("cepairs/list/update",'CePairsController@update')->name('cepairs.update');
//Currency Codes
Route::get('currencyCode/list','CurrencyCodeController@index')->name('currencyCode.list');
Route::get('currencyCode/create','CurrencyCodeController@create')->name('currencyCode.create');
Route::get("currencyCode/loadCurrency",'CurrencyCodeController@loadCurrency')->name('currencyCode.loadCurrency');
Route::get("currencyCode/loadExchanges",'CurrencyCodeController@loadExchanges')->name('currencyCode.loadExchanges');
Route::post("currencyCode/store",'CurrencyCodeController@store')->name('currencyCode.store');
Route::get('currencyCode/list/destory','CurrencyCodeController@destory')->name('currencyCode.destory');
Route::get('currencyCode/list/edit','CurrencyCodeController@edit')->name('currencyCode.edit');
Route::get("currencyCode/list/loadCurrency",'CurrencyCodeController@loadCurrency')->name('currencyCode.list.loadCurrency');
Route::get("currencyCode/list/loadExchanges",'CurrencyCodeController@loadExchanges')->name('currencyCode.list.loadExchanges');
Route::post("currencyCode/update",'CurrencyCodeController@update')->name('currencyCode.update');

