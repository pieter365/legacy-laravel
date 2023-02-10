<?php

namespace Legacy;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getRequestedFilePath()
 * @method static string getRequestedFile()
 * @method static string getFilePath(string $file)
 *
 * @see \Legacy\Factory
 */
class Legacy extends Facade
{

    protected static function getFacadeAccessor() {
        return 'legacy';
    }

}
