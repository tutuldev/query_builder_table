<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    // public function showStudents(){
    //     $students = DB::table('students')
    //     ->join('cities','students.city','=','cities.id')
    //     // ->select('students.*','cities.city_name')
    //     // ->select(DB::row('count(*) as student_count'))
    //     ->select(DB::raw('count(*) as student_count'),'cities.city_name')
    //     // ->select(DB::row('count(*) as student_count'),'age')
    //     ->groupBy('city_name')
    //     //groupBy('age)
    //     //groupBy('age','student_name')
    //     //orderBy('students_count','DESC')

    //     // if use group by then must use having not where
    //     // ->where('students.email','=','salman@gmail.com')
    //     // ->having('students.email','=','salman@gmail.com')
    //     // ->having('student_count','>',1)
    //     ->havingBetween('student_count',[1,2])

    //     // ->where('students.name','like','s%')
    //     // ->where('cities.city_name','=','goa')
    //     ->get();
    //     return $students;
    //     // return view('welcome',compact('students'));

    // }
    // public function showStudents(){
    //     $students = DB::table('students')
    //     ->leftJoin('cities','students.city','=','cities.id')
    //     //->select(DB::raw('count(*) as student_count'),'cities.city_name')
    //     ->get();
    //     return $students;
    //     // return view('welcome',compact('students'));

    // }

    // join with On method
    public function showStudents(){
        $students = DB::table('students')
        ->leftJoin('cities',function(JoinClause $join){
            $join->on('students.city','=','cities.id')
            ->where('students.name','like','a%');
            //if use on method must used where method

        })
        ->select('students.*','cities.city_name')
        ->get();
        // return $students;
        return view('welcome',compact('students'));

    }
}
