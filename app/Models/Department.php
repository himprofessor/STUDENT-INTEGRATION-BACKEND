<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_name',
        'department_cover',
    ];
    public static function store($request, $id = null)
    {
        // dd(request()->all());
        $department = $request->only(
            'department_name',
        );

        if ($request->hasFile('department_cover')) {
            $imagePath = $request->file('department_cover')->store('public/assets/img/imges');

            $department['department_cover'] = str_replace('public/', '', $imagePath);
        }
     
        if ($id) {
            // If $id is provided, it's an update operation
            self::where('id', $id)->update($department);
        } else {
            // If $id is null, it's an insert (create) operation
            $department = self::create($department);
        }

        return $department;
    }
}
