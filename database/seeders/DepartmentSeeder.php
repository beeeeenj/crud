<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = ['Accounting','Finance','Human Resource','Purchase','Sales'];
        
        foreach($departments as $department) {
            $data = new Department;
            $data->name = $department;
            $data->save();
        }
    }
}
