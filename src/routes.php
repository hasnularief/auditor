<?php

Route::get('auditor', 'hasnularief\auditor\AuditorController@index');
Route::get('auditor/vue.js', 'hasnularief\auditor\AuditorController@vue');