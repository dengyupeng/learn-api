<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;

// use App\Http\Request;

class LessonController extends Controller
{
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
    return \Response::json([
        'status' => 'success',
        'status_code' => 200,//成功返回设置为200
        // 'data' => $lesson->toArray(),
        'data' => $this->transformCollection($lessons)//隐藏字段
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
        $lesson = Lesson::findOrFail($id);
        return \Response::json([
            'status' => 'success',
            'status_code' => 200,//成功返回设置为200
            'data' => $this->transform($lesson)
            // 'data' => $lesson
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

    private function transformCollection($lessons)
    {
        return array_map([$this, 'transform'], $lessons->toArray());
    }

    private function transform($lesson)
    {
        return [
            'title' => $lesson['title'],
            'content' => $lesson['body'],
            // 'is_free' => $lesson['free'],
            'is_free' => (boolean)$lesson['free'],
        ];
    }
}
