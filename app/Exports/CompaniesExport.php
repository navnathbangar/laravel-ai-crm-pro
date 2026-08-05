<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompaniesExport implements FromCollection, WithHeadings
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return Company::when($this->search, function ($query) {

                $query->where('company_name', 'like', '%' . $this->search . '%')
                      ->orWhere('company_code', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%');

            })
            ->select(
                'company_code',
                'company_name',
                'contact_person',
                'email',
                'phone',
                'website',
                'gst_number',
                'city',
                'state',
                'country',
                'status'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'Company Code',
            'Company Name',
            'Contact Person',
            'Email',
            'Phone',
            'Website',
            'GST Number',
            'City',
            'State',
            'Country',
            'Status',
        ];
    }
}