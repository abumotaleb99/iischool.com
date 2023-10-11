<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class LessonSubject extends Model
{
    use HasFactory;

    static public function getAllLessonSubjects() {
        $result = LessonSubject::select('lesson_subjects.*', 'lessons.name as lesson_name', 'subjects.name as subject_name', 'users.name as created_by_name')
                        ->join('lessons', 'lessons.id', 'lesson_subjects.lesson_id')
                        ->join('subjects', 'subjects.id', 'lesson_subjects.subject_id')
                        ->join('users', 'users.id', 'lesson_subjects.created_by');

                        if(!empty(Request::get('lesson_name'))) {
                            $result = $result->where('lessons.name', 'like', '%'. Request::get('lesson_name'). '%');
                        }

                        if(!empty(Request::get('subject_name'))) {
                            $result = $result->where('subjects.name', 'like', '%'. Request::get('subject_name'). '%');
                        }
                        if(!empty(Request::get('date'))) {
                            $result = $result->where('lesson_subjects.created_at', '=', Request::get('date'));
                        }

        $result = $result->orderBy('lesson_subjects.id', 'desc')
                        ->paginate(20);
        
        return $result;
    }

    static public function getAlreadyFirst($lesson_id, $subject_id) {
        return self::where('lesson_id', '=', $lesson_id)->where('subject_id', '=', $subject_id)->first();
    }

    static public function getSingleLessonSubjectById($id) {
        return LessonSubject::find($id);
    }

    static public function getAssignedLessonSubjectId($lesson_id) {
        return LessonSubject::where('lesson_id', '=', $lesson_id)->get();
    }

    static public function deleteAssignedLessonSubject($lesson_id) {
        return LessonSubject::where('lesson_id', '=', $lesson_id)->delete();
    }
}
