<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Question;
use App\Services\QuestionService;

class QuestionController extends BaseController
{
    private $questionService;

    public function __construct(QuestionService  $questionService) {
        $this->questionService = $questionService;
    }

    /** 
     * get all question lecture id.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllQuestionByLectureId($lectureId)
    {
        $question = $this->questionService->getAllQuestion($lectureId);

        return $this->success($question);
    }
    public function getQuestionCountByLecture($lectureId)
    {
        $questionCount = Question::where('lecture_id', $lectureId)->count();
        return response()->json(['question_count' => $questionCount]);
    }

    
}
