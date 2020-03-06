<?php

namespace App\Exports;

use App\Assets;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AssetsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        return collect(DB::Select('select asset_old, asset_new, status, serial_number, team, location, pic, label, ad_join, drm, antivirus, hw, power, remarks 
        from assets where flag = "Patrol" and deleted_at IS null'));
    }
    public function headings(): array
    {
        return [
            'Old Asset',
            'New Asset',
            'Status',
            'Serial Number',
            'Team',
            'Location',
            'PIC',
            'Label',
            'AD Join',
            'DRM',
            'Antivirus',
            'HW',
            'Power',
            'Remark',

        // etc


        ];
    }
}
