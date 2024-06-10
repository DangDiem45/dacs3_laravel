<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseType;
use App\Models\Course;
 
class CourseTypeController extends Controller
{
    public function courseTypeList(){
        $result = CourseType::select('id', 'title', 'parent_id', 'description', 'order', 'created_at', 'updated_at')->get();
        return response()->json([
            'code' => 200,
            'msg' => 'Course type list is here',
            'data' => $result
        ], 200);
    }
    public function courseTypeFeature(Request $request){
        $id = $request->id;

        $result = Course::whereHas('courseType', function($query) use ($id) {
                $query->where('id', $id);
            })
            ->select('name', 'thumbnail', 'teacher', 'lesson_num', 'id', 'price', 'video_length')
            ->get();

        return response()->json([
            'code' => 200,
            'msg' => 'The courses recommended for you',
            'data' => $result
        ], 200);
    }


}
