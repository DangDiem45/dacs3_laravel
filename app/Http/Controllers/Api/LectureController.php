<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Services\LectureService;
use Illuminate\Http\Request;

class LectureController extends BaseController
{
    private $lectureService;

    public function __construct(LectureService $lectureService) {
       $this->lectureService = $lectureService;
    }

    public function index($subjectId)
    {
        return $this->success($this->lectureService->getAllLecture($subjectId));
    }

    public function show($id)
    {
        return $this->success($this->lectureService->getLectureById($id));
    } 

    public function create(Request $request)
    {
        $data = $request->only('name', 'duration', 'subject_id');
        $lecture = Lecture::create($data);

        return response()->json([
            'message' => 'Bài thi đã được thêm mới',
            'lecture' => $lecture,
        ], 201);
    }

    public function delete($id)
    {
        $lecture = Lecture::find($id);
        if (!$lecture) {
            return response()->json(['message' => 'Không tìm thấy bài thi'], 404);
        }

        $lecture->delete();

        return response()->json(['message' => 'Bài thi đã được xóa'], 200);
    }

    public function update(Request $request, $id)
        {
            $lecture = Lecture::find($id);
            if (! $lecture) {
                return response()->json(['message' => 'Không tìm thấy bài thi'], 404);
            }

            $lecture->name = $request->input('name');
            $lecture->duration = $request->input('duration');
            $lecture->subject_id = $request->input('subject_id');

            $lecture->save();

            return response()->json(['message' => 'Thông tin bài thi đã được cập nhật'], 200);
        }
}
