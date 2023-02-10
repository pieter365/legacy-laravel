<?php

Route::middleware('legacy')
    ->any('/{path?}', ['as' => 'legacy', 'uses' => '\Legacy\Controller@index'])
    ->where('path', '.*');
