<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\LessonSubject;

class LessonSubjectController extends Controller
{
    public function assignSubjectList() {
        $data['header_title'] = 'Lesson Subject List';
        $data['lessonSubjects'] = LessonSubject::getAllLessonSubjects();

        return view('backend.admin.assign-subject.list', $data);
    }

    public function add() {
        $data['header_title'] = 'Assign New Subjects';
        $data['allActiveLessons'] = Lesson::getAllActiveLessons();
        $data['allActiveSubjects'] = Subject::getAllActiveSubjects();

        return view('backend.admin.assign-subject.add', $data);
    }

    public function insert(Request $request) {
        $this->validate($request, [
            'lesson_id' => 'required',
            'subject_id' => 'required',
            'status' => 'required',
        ]);

        if(!empty($request->subject_id)) {
            foreach($request->subject_id as $subject_id) {
                $getAlreadyFirst = LessonSubject::getAlreadyFirst($request->lesson_id, $subject_id);

                if(!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();

                }else {
                    $lessonSubject = new LessonSubject;
        
                    $lessonSubject->lesson_id = $request->lesson_id;
                    $lessonSubject->subject_id = $subject_id; //$subject_id from the loop
                    $lessonSubject->status = $request->status;
                    $lessonSubject->created_by = Auth::user()->id;
                    $lessonSubject->save();
                }

            }

            return redirect('admin/assign-subject/list')->with("success", "Assigned lesson subjects successfully.");

        }else {
            return redirect()->back()->with("error", "Please select at least one subject.");
        }

    }

    public function edit($id) {
        $lessonSubject = LessonSubject::getSingleLessonSubjectById($id);

        if(!empty($lessonSubject)) {
            $data['header_title'] = 'Edit Assigned Lesson Subject';
            $data['lessonSubject'] = LessonSubject::getSingleLessonSubjectById($id);
            $data['assignedLessonSubjectId'] = LessonSubject::getAssignedLessonSubjectId($lessonSubject->lesson_id);
            $data['allActiveLessons'] = Lesson::getAllActiveLessons();
            $data['allActiveSubjects'] = Subject::getAllActiveSubjects();

            return view('backend.admin.assign-subject.edit', $data);
        }else {
            abort(404);
        }

    }

    public function update(Request $request) {
        $this->validate($request, [
            'subject_id' => 'required',
        ]);

        LessonSubject::deleteAssignedLessonSubject($request->lesson_id);

        if(!empty($request->subject_id)) {
            foreach($request->subject_id as $subject_id) {
                $getAlreadyFirst = LessonSubject::getAlreadyFirst($request->lesson_id, $subject_id);

                if(!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();

                }else {
                    $lessonSubject = new LessonSubject;
        
                    $lessonSubject->lesson_id = $request->lesson_id;
                    $lessonSubject->subject_id = $subject_id; //$subject_id from the loop
                    $lessonSubject->status = $request->status;
                    $lessonSubject->created_by = Auth::user()->id;
                    $lessonSubject->save();
                }

            }
        }
        
        return redirect('admin/assign-subject/list')->with("success", "Assigned Subjects updated successfully.");
    }

    public function delete($id) {
        $lessonSubject = LessonSubject::getSingleLessonSubjectById($id);

        if(!empty($lessonSubject)) {
            $lessonSubject->delete();
        }else {
            abort(404);
        }

        return redirect()->back()->with("success", "Assigned Subject delete successfully.");

    }
}
