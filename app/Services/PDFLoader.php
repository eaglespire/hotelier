<?php

namespace App\Services;
use PDF;
class PDFLoader
{
    public function generatePDF($view,$data,$fileName)
    {
        $pdf = PDF::loadView($view, $data);
        return $pdf->download($fileName);
    }
}
