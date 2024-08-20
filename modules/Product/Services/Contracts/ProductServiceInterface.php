<?php
namespace Modules\Product\Services\Contracts;

interface ProductServiceInterface
{
    public function getBySlug(string $slug);
    public function getAll();
}