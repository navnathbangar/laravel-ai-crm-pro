<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class CustomersExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Customer::query();

        if($this->request->search){

            $query->where('name','like','%'.$this->request->search.'%')
                  ->orWhere('email','like','%'.$this->request->search.'%')
                  ->orWhere('phone','like','%'.$this->request->search.'%');

        }

        if($this->request->status){

            $query->where('status',$this->request->status);

        }

        return $query->get([
            'customer_code',
            'name',
            'email',
            'phone',
            'status'
        ]);
    }

    public function headings():array
    {
        return [
            'Customer Code',
            'Name',
            'Email',
            'Phone',
            'Status'
        ];
    }
}