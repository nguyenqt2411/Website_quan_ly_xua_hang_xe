<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ImportExcel implements FromCollection, WithHeadings
{
    private $datas;
    public function __construct($datas)
    {
        $this->datas = $datas;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $datas = $this->datas;
        $reports = [];
        $i = 1;

    }

    public function headings(): array
    {
        return [
            "STT",
            "Đoàn/Xứ Đoàn",
            "Chiên Con",
            "Ấu Nhi",
            "Thiếu Nhi",
            "Nghĩa Sĩ",
            "Hiệp Sĩ",
            "Dự Trưởng",
            "Huynh Trưởng",
            "Trợ Tá",
            "Tổng Đoàn",
        ];
    }
}