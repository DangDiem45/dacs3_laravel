<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function courseList(){
        $result = Course::select('name','teacher' ,'thumbnail', 'lesson_num', 'price', 'id', 'video_length')->get();
        return response()->json([
            'code' => 200,
            'msg' => 'My course list is here',
            'data' => $result
        ], 200);
    }

    public function courseDetail(Request $request){
        $id = $request->id;
        try{
            $result = Course::where('id', '=', $id)->select(
                'id',
                'name',
                'teacher',
                'description',
                'thumbnail', 
                'lesson_num', 
                'video_length',
                'price',
            )->first();
            return response()->json(
                [
                    'code'=>200,
                    'msg'=>'My course detail is here',
                    'data'=>$result
                ], 200
            );
        }catch(\Throwable $e){
            return response()->json(
                [
                    'code'=>200,
                    'msg'=>'Server internal error',
                    'data'=>$result
                ], 500
            );
        }
    
    }

    public function courseFeature(Request $request){
        $user = $request->user();

        $result = Course::where('recommended','=', 1)
        ->select('name', 'thumbnail', 'teacher', 'lesson_num', 'id', 'price', 'video_length')->get();

        return response()->json([
            'code' => 200,
            'msg' => 'The courses recommended for you',
            'data' => $result
        ], 200);
    }

    public function courseSearchDefault(Request $request){
        $user = $request->user();

        $result = Course::where('recommended','=', 1)
        ->select('name', 'thumbnail', 'teacher', 'lesson_num', 'id', 'price', 'video_length')->get();

        return response()->json([
            'code' => 200,
            'msg' => 'The courses recommended for you',
            'data' => $result
        ], 200);
    }

    public function courseSearch(Request $request){
        $user = $request->user();
        $search = $request->search;

        $result = Course::where("name", "like", "%" .$search. "%")
        ->select('name', 'thumbnail', 'teacher', 'lesson_num', 'id', 'price', 'video_length')->get();

        return response()->json([
            'code' => 200,
            'msg' => 'The courses you searched',
            'data' => $result
        ], 200);
    }
}
