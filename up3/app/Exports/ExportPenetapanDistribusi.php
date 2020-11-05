<?php

namespace App\Exports;

use App\Penetapan_Distribusi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPenetapanDistribusi implements FromView
{
    /**
     * melakukan format dokumen menggunakan html, maka package ini juga menyediakan fungsi lainnya agar dapat me-load data tersebut dari file html / blade di Laravel
     */
    use Exportable;

    public function view(): View
    {
        
        return view('penetapan_distribusi.penetapanDistribusiAllExcel',[
            'penetapan_distribusi' => Penetapan_Distribusi::all()
        ]);
    }
}
