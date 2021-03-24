<?php
namespace App\Services;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\DB;


class PDFDocumentService
{
    public function index($id)
    {
        $template = config(session()->get('company_id').'.invoice_template');
        $doc=DB::table('documents')->where('id', $id)->first();
        $items = DB::table('document_items')->where('document_id', $id)->get();
        switch($template){
            case 'plain':
                $this->plain($doc, $items);
                break;
        }

    }

    public function plain($doc, $items){

        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->setSourceFile('companies/plain.pdf');
        $tmpl = $pdf->importPage(1);
        $pdf->useTemplate($tmpl);
        $pdf->SetFont('Arial','',14);

        $pdf->Image('companies/1/logo.jpg',10,10,-200);

        $pdf->Cell(300,5, __('global.documents.'.$doc->document_type).'# '.$doc->document_number, 0,0,'C');
        $pdf->Ln();
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(150, 15);
        $pdf->MultiCell(0,7, __('global.date'), 0,'L', 0);
        $pdf->SetXY(170, 15);
        $pdf->MultiCell(0,7, ':'.$doc->action_date, 0,'L', 0);
        $pdf->SetXY(150, 20);
        $pdf->MultiCell(0,7, __('global.reference'), 0,'L', 0);
        $pdf->SetXY(170, 20);
        $pdf->MultiCell(0,7, ':'.$doc->reference_number, 0,'L', 0);
        $pdf->Output();
    }
}
