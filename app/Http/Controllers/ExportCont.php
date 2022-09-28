<?php

namespace App\Http\Controllers;
use App\Exports\ExportTemplateGuru;
use App\Exports\ExportTemplateSantri;
use Excel;
use Illuminate\Http\Request;

class ExportCont extends Controller
{
    public function export_template_guru()
    {
        return Excel::download(new ExportTemplateGuru, 'tempalte-guru.xlsx');
    }

    public function export_template_santri()
    {
        return Excel::download(new ExportTemplateSantri, 'template-santri.xlsx');
    }
}
