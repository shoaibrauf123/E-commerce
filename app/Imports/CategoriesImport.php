<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoriesImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
           return new Category([
            'cat_name' => $row['cat_name'], 
            'status'  => $row['status'],
            'month_of_the_category' => $row['month_of_the_category'], 
            
        ]);
    }
}
