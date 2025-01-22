<?php

namespace Database\Seeders;

use App\Models\lecturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                 // with json
                 $json=File::get(path:'database/json/lecturers.json');
                 $lecturers=collect(json_decode($json));

                 $lecturers->each(function ($lecturer){
                         lecturer::create([
                             'name'=>$lecturer->name,
                             'email'=> $lecturer->email,
                             'age'=> $lecturer->age,
                             'city'=> $lecturer->city,
                         ]);
                 });
    }
}
