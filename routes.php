<?php

//Laravel route legacy work with Middleware
Route::middleware('legacy')
    ->any('/{path?}', ['as' => 'legacy', 'uses' => '\Legacy\Controller@index'])
    ->where('path', '.*');
