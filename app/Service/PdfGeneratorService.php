<?php

declare(strict_types=1);

namespace App\Service;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfGeneratorService
{
    /**
     * @param  string  $template
     * @param  array<string, mixed>  $data
     * @return void
     */
    public function execute(
        string $template,
        array $data = []
    ): void {
        $pdf = Pdf::loadView($template, $data);

        $pdf->save(
            filename: Storage::path('pdfs/post.pdf'),
        );
    }
}
