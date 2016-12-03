<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;

use Maatwebsite\Excel\Facades\Excel;

use App\GradeProject1;
use App\User;

class ImportGrade extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:grade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->info('start import student information.');
        $file_path = 'storage/app/public/project1.xls';
        Excel::load($file_path, function($reader) {
            // Select
            $reader = $reader->getSheet(1);//excel第一张sheet
            $results = $reader->toArray();
            $student_list = array();
            for($i = 3; $i < count($results); $i++){
                $row = $results[$i];
                $student = array();
                $student['student_id'] = $row[1];
                if($student['student_id'] == null) {
                    continue;
                }
                $student['student_name'] = $row[2];
                $student['grade_point']  = $row[17];
                $student['grade_comment'] = $row[18];
                // $this->info('finish read studnet '. $student['student_id']);
                $student_list[] = $student;
            }

            $this->info('start to record into mysql database');

            // save to database
            foreach ($student_list as $student) {
                $student_id = $student['student_id'];
                $user_base = User::where(['student_id' => $student_id])->first();
                $user_id = 0;

                // fetch user
                if($user_base == null){
                    // insert user and produce key
                    $user_data = array();
                    $user_data['user_name'] = $student['student_name'];
                    $user_data['student_id'] = $student_id;
                    $user_data['dsproject_key'] = $this->produceUserKey($student_id, $user_data['user_name']);
                    $res = User::insertGetId($user_data);
                    if($res == false){
                        $this->warn($student_id . " create user failed");
                    }
                    $user_id = $res;
                }
                else{
                    $user_id = $user_base['user_id'];
                }
                 // insert to grade_project1
                $grade_project1_data = array();
                $grade_project1_data['user_id'] = $user_id;
                $grade_project1_data['grade_point'] = $student['grade_point'];
                $grade_project1_data['grade_comment'] = $student['grade_comment'];
                $res = GradeProject1::insert($grade_project1_data);
                if($res == false){
                    $this->warn($student_id . " create project1 grade failed");
                }
            }
          
        });

        $this->info('finish import student information.');

    }

    // produce user key
    private function produceUserKey($student_id, $student_name){
        $str = $student_id . $student_name . "dsproject" . time();
        $str = md5($str);
        $str .= "Hello, world";
        $str = md5($str);
        return $str;
    }

}
