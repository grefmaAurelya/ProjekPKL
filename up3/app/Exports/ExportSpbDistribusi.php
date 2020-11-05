<?php

namespace App\Exports;

use App\Spb_Distribusi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ExportSpbDistribusi implements FromView
{
    /**
     * melakukan format dokumen menggunakan html, maka package ini juga menyediakan fungsi lainnya agar dapat me-load data tersebut dari file html / blade di Laravel
     */
    use Exportable;

    public function view(): View
    {
        
        return view('spb_distribusi.spbDistribusiAllExcel',[
            'spb_distribusi' => Spb_Distribusi::all()
        ]);
    }
}
