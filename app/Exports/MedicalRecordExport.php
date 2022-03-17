<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class MedicalRecordExport implements FromView, ShouldAutoSize, WithEvents
{
    public function __construct($med_rec, $title)
    {
        $this->med_recs = $med_rec;
        $this->title = $title;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('excel.medical-record', [
            'model' => $this->med_recs,
            'title' => $this->title
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $to = $event->sheet->getDelegate()->getHighestRowAndColumn();

                // $event->sheet->styleCells(
                //     'A1:C1',
                //     [
                //         'font' => [
                //             'name'  =>  'Calibri',
                //             'size'  =>  30,
                //             'bold' => true
                //         ]
                //     ]
                // );

                // $event->sheet->styleCells(
                //     'A2:C2',
                //     [
                //         'font' => [
                //             'name'  =>  'Calibri',
                //             'size'  =>  20,
                //             'bold' => true
                //         ]
                //     ]
                // );

                // $event->sheet->styleCells(
                //     'A2:'.$to['column'].$to['row'],
                //     [
                //         'font' => [
                //             'name'  =>  'Calibri',
                //             'size'  =>  15,
                //         ]
                //     ]
                // );

                // $event->sheet->getStyle('A1:C1')->getAlignment()->applyFromArray(
                //     array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS,)
                // );

                // $event->sheet->getStyle('A2:C2')->getAlignment()->applyFromArray(
                //     array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER_CONTINUOUS,)
                // );

                $event->sheet->styleCells(
                    'A1:E'.$to['row'],
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            ],
                        ]
                    ]
                );
            },
        ];
    }

}
