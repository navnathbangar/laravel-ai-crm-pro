<?php

namespace App\Exports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class LeadsExport implements FromCollection, WithHeadings
{

    protected $search;


    public function __construct($search = null)
    {
        $this->search = $search;
    }


    public function collection()
    {

        return Lead::query()

            ->when($this->search,function($query){

                $query->where('lead_code','like','%'.$this->search.'%')
                ->orWhere('lead_name','like','%'.$this->search.'%')
                ->orWhere('company_name','like','%'.$this->search.'%')
                ->orWhere('email','like','%'.$this->search.'%')
                ->orWhere('phone','like','%'.$this->search.'%');

            })

            ->select(

                'lead_code',
                'lead_name',
                'company_name',
                'email',
                'phone',
                'source',
                'status',
                'expected_value'

            )

            ->get();

    }


    public function headings(): array
    {
        return [

            'Lead Code',
            'Lead Name',
            'Company',
            'Email',
            'Phone',
            'Source',
            'Status',
            'Expected Value'

        ];
    }

}