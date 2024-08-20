<?php
namespace Modules\Product\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CreateSlugService
{
    public function makeProductSlug(string $name): string
    {
        return Str::slug(trim($name)) . '-' . md5(Carbon::now());
    }
}