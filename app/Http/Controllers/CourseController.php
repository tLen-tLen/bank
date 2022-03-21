<?php

namespace App\Http\Controllers;

use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class CourseController extends Controller
{
    /**
     * Изменить курс валют
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function changeCourse(Request $request)
    {
        try {
            CourseService::setNewCourse(
                $request->get('from'),
                $request->get('to'),
                $request->get('amount')
            );
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Throwable  $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
