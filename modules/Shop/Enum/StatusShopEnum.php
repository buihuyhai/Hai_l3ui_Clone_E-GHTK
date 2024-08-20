<?php declare(strict_types=1);

namespace Modules\Shop\Enum;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusShopEnum extends Enum
{
    const STATUS_OPEN = 0;
    const STATUS_CLOSE = 1;
    const STATUS_LOCKED = 2;
}
