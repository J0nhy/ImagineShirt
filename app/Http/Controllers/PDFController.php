<?php

namespace App\Http\Controllers;

use App\Models\order_items;
use Illuminate\Http\Request;
use PDF;
use App\Models\orders;
use App\Models\tshirt_images;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class PDFController extends Controller
{

    public function generateInvoicePDF($orderId)
    {
        // Recupere os dados da encomenda e seus itens das tabelas do banco de dados
    $encomenda = orders::find($orderId);
    $itens = order_items::where('order_id', $orderId)->get();

    foreach ($itens as $item) {
        $item->load('tshirtImage'); // Carregar a relação com a tabela tshirt_images
    }

    // Gerar o conteúdo do PDF usando uma view
    $pdf = PDF::loadView('pdf.invoice', compact('encomenda', 'itens'));

    // Retornar o PDF para download ou visualização
    // Definir o nome do arquivo
    $nomeArquivo = 'Encomenda.pdf';

    // Salvar o PDF com o nome especificado
    return $pdf->download($nomeArquivo);

    }
}
