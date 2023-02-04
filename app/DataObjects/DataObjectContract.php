<?php

declare(strict_types=1);

namespace App\DataObjects;

use Illuminate\Foundation\Http\FormRequest;

interface DataObjectContract
{
    public static function make(
        FormRequest $request,
    ): self;

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;
}
