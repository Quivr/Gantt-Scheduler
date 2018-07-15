<?php

use Illuminate\Database\Seeder;

use App\Department;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Frontend', 'Backend', 'Legal', 'Bestuur', 'Marketing', 'BD', 'Infrastructuur'];

        foreach($names as $name){
            $department = new Department;
            $department->name = $name;
            $department->save();
        }
    }
}
