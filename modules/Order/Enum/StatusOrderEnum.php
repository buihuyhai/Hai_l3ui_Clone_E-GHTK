<?php declare(strict_types=1);

namespace Modules\Order\Enum;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusOrderEnum extends Enum
{
    const STATUS_REJECT = 0;
    const STATUS_PENDING = 1;
    const STATUS_CONFIRMED = 2;
}
