<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    public function __construct($headings)
    {
        $this->headings = $headings;
    }


    public function headings(): array
    {
        return $this->headings;
    }

    public function collection()
    {
        $users = DB::table('users')->select(
            'id',
            'first_name',
            'last_name',
            'email',
            'phone',
            'location',
            'type')
            ->where('deleted_at', null)
            ->orderBy('created_at', 'desc')
            ->get();


        return $users;
    }
}
