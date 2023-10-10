<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function lessonList() {
        $data['header_title'] = 'Lesson List';
        $data['lessons'] = Lesson::getAllLessons();

        return view('backend.admin.lesson.list', $data);
    }

    public function add() {
        $data['header_title'] = 'Admin New Lesson';

        return view('backend.admin.lesson.add', $data);
    }

    public function insert(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
        ]);

        $lesson = new Lesson;
        
        $lesson->name = $request->name;
        $lesson->status = $request->status;
        $lesson->created_by = Auth::user()->id;
        $lesson->save();

        return redirect('admin/lesson/list')->with("success", "Lesson added successfully.");
    }

    public function edit($id) {
        $data['lesson'] = Lesson::getSingleLessonById($id);

        if(!empty($data['lesson'])) {
            $data['header_title'] = 'Edit Lesson';

            return view('backend.admin.lesson.edit', $data);
        }else {
            abort(404);
        }

    }

    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
        ]);

        $lesson = Lesson::getSingleLessonById($request->id);
        
        $lesson->name = $request->name;
        $lesson->status = $request->status;

        $lesson->save();

        return redirect('admin/lesson/list')->with("success", "Lesson updated successfully.");
    }

    public function delete($id) {
        $lesson = Lesson::getSingleLessonById($id);

        if(!empty($lesson)) {
            $lesson->delete();
        }else {
            abort(404);
        }

        return redirect('admin/lesson/list')->with("success", "Lesson delete successfully.");

    }

}
