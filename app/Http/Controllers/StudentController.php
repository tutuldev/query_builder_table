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

    // undiondata
    //column all data type must be match
    // public function unionData(){
    //     $lecturers = DB::table('lecturers')
    //     ->select('name','email');
    //     $students = DB::table('students')
    //     ->select('name','email')
    //     ->union($lecturers)
    //     ->get();
    //     return $students;
    // }

    public function unionData(){
        $lecturers = DB::table('lecturers')
        ->select('name','email','city_name')
        ->join('cities','lecturers.city','=','cities.id')
        ->where('city_name','=','delhi');

        $students = DB::table('students')
        ->union($lecturers)
        ->select('name','email','city_name')
        ->join('cities','students.city','=','cities.id')
        ->where('city_name','=','goe')
        // ->toSql();
        ->get();
        return $students;
    }

    // when data
// if false then all data show
    // public function whenData(){
    //     $students = DB::table('students')
    //             ->when(true,function($query){
    //                 $query->where('age','>',20);
    //             })
    //             ->get();
    //             return $students;
    // }

    // when true and when false
    public function whenData(){
        $cond=true;
            $students = DB::table('students')
                    ->when( $cond,function($query){
                        $query->where('age','>',20);
                    },function( $query){
                        $query->where('age','<',20);
                    })
                    ->get();
                    return $students;
        }

        // // chunk data
        // public function chunkData(){
        //     $students= DB::table('students')->orderBy('id')
        //     ->chunk(3,function($students){
        //         foreach($students as $student){
        //             echo $student->name . "<br>";
        //         }
        //     });
        // }

        // chunk check how to data come with 3
        public function chunkData(){
            $students= DB::table('students')->orderBy('id')
            ->chunk(3,function($students){
                echo "<div style='border:1px solid red;margin-bottom:15px;'>";
                    foreach($students as $student){
                        echo $student->name . "<br>";
                    }
                echo "</div>";
            });
        }

        // update with chunk
        public function chunkDataUpdate(){
            $students= DB::table('students')->orderBy('id')
            ->chunkById(3,function($students){
                    foreach($students as $student){
                       DB::table('students')
                       ->where('id',$student->id)
                       ->update(['status'=>true]);
                    //    ->update(['status'=>true], , , ,); //if need multicolumn
                    }
            });
        }
}
