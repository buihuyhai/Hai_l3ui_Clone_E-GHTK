<?php
namespace Modules\Product\Services\Contracts;

interface SlugServiceInterface
{
    public function makeProductSlug(string $name): string;
}