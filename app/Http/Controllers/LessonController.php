<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Transformer\LessonTransformer;
use Illuminate\Http\Request;

class LessonController extends ApiController
{
    public function __construct(LessonTransformer $lessonTransformer)
    {
        $this->lessonTransformer = $lessonTransformer;
    }

    protected $lessonTransformer;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Response::json()区代替直接返回的$lessons,并且添加额外信息status，status_code
        //利用transformCollection()和transform()隐藏数据表的结构
        $lessons = Lesson::all();//bad
        return $this->response([
            'status' => 'success',
            'data' => $this->lessonTransformer->transformCollection($lessons->toArray())//隐藏字段
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);//404
        if (!$lesson) {
            return $this->responseNotFound();
            // return $this->setStatusCode(404)->responseNotFound();
        }
        return $this->response([
            'status' => 'success',
            'data' => $this->lessonTransformer->transform($lesson)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
