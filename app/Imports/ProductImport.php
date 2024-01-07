<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use App\Models\Department;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $row['department'] = Department::where('name', $row['department'])->first()->id;
        $row['category'] = Category::where('name', $row['category'])->first()->id;
        $row['creator'] = auth()->id();
        return new Product([
            'name'     => $row['name'],
            'description'    => $row['description'],
            'price'    => $row['price'],
            'quantity'    => $row['quantity'],
            'department_id'    => $row['department'],
            'category_id'    => $row['category'],
            'creator_id'    => $row['creator'],
        ]);
    }

    public function rules(): array
    {
        return [
            'Name' => 'required|string',
            'description' => 'string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'department' => function ($attribute, $value, $onFailure) {
                $department = Department::where('name', $value)->first();
                if (!$department) {
                    $onFailure('Department does not exist.');
                }
            },
            'category' => function ($attribute, $value, $onFailure) {
                $category = Category::where('name', $value)->first();
                if (!$category) {
                    $onFailure('Category does not exist.');
                }
            },
        ];
    }
}
