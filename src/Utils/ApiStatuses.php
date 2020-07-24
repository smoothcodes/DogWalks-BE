<?php

namespace App\Utils;

use MyCLabs\Enum\Enum;

/**
 * Class ApiStatuses
 * @package App\Utils
 *
 * @method static self ERROR()
 * @method static self SUCCESS()
 */
class ApiStatuses extends Enum
{
    private const ERROR = 'error';
    private const SUCCESS = 'success';
}
