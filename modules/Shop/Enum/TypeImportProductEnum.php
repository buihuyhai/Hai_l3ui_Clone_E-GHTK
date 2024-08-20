<?php declare(strict_types=1);

namespace Modules\Shop\Enum;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TypeImportProductEnum extends Enum
{
    const TYPE_DECREMENT = 0;
    const TYPE_INCREMENT = 1;
    const TYPE_DELETE_VARIANT = 2;
}
