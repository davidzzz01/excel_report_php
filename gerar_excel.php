<?php
require 'vendor/autoload.php';
include_once("db/conection.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;





$conn = conectar();
$dados = getDados($conn);


if (!empty($dados)) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();


    $cabecalhos = ['ID', 'Nome', 'Descrição', 'Preço', 'Quantidade', 'Categoria' ,'Status']; 
    $colIndex = 'A';
    foreach ($cabecalhos as $cabecalho) {
        $sheet->setCellValue($colIndex . '1', $cabecalho);
        $colIndex++;
    }

    $linhaIndex = 2;
    
    foreach ($dados as $linha) {
        $colIndex = 'A'; 
        foreach ($linha as $valor) {
            $sheet->setCellValue($colIndex . $linhaIndex, $valor);
            $colIndex++;
        }
        $linhaIndex++;
    }


    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="produtos.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
} else {
    echo "Nenhum dado encontrado.";
}
?>
