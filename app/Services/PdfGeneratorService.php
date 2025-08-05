<?php

namespace App\Services;

use App\Models\WorkReception;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfGeneratorService
{
    public static function generate(WorkReception $workReception): string
    {
        $workReception->load(['simCards', 'materials', 'user']);
        
        $pdf = Pdf::loadView('work-reception.pdf-template', compact('workReception'));
        
        return $pdf->output();
    }
    
    public static function getFileName(WorkReception $workReception): string
    {
        return 'reception_travaux_' . $workReception->id . '_' . now()->format('Y-m-d') . '.pdf';
    }
}