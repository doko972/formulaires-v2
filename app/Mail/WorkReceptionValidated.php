<?php

namespace App\Mail;

use App\Models\WorkReception;
use App\Services\PdfGeneratorService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WorkReceptionValidated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public WorkReception $workReception)
    {
    }

    public function build()
    {
        $pdfContent = PdfGeneratorService::generate($this->workReception);
        $fileName = PdfGeneratorService::getFileName($this->workReception);

        return $this->subject('Procès-verbal de réception de travaux - ' . $this->workReception->client_name)
                    ->view('emails.work-reception-validated')
                    ->attachData($pdfContent, $fileName, ['mime' => 'application/pdf']);
    }
}