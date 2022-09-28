<?php

namespace App\Http\Controllers;
use App\Models\Lembagasurvey;
use App\Imports\ImportTemplateGuru;
use App\Imports\ImportTemplateSantri;
use Illuminate\Http\Request;
use Excel;

class ImportCont extends Controller
{
    public function import_template_data_guru( Request $request )
    {
        $lembaga = Lembagasurvey::findOrFail($request->lembaga_id);
        $lembaga_id = $lembaga->id;

        $data = Excel::import(new ImportTemplateGuru($lembaga_id),request()->file('file'));
        
        return back()->withStatus('Data guru berhasil di perbarui. Untuk data yang tidak lengkap & tidak valid dilewati');
    }

    public function import_template_data_santri(Request $request)
    {
        $lembaga = Lembagasurvey::findOrFail($request->lembaga_id);
        $lembaga_id = $lembaga->id;

        $data = Excel::import(new ImportTemplateSantri($lembaga_id),request()->file('file'));
        return back()->withStatus('Data santri berhasil di perbarui. Untuk data yang tidak lengkap & tidak valid dilewati');
    }
}
