<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class Lesson extends Model
{
    use HasFactory;

    
    static public function getAllLessons() {
        $result = Lesson::select('lessons.*', 'users.name as created_by_name')
                        ->join('users', 'users.id', 'lessons.created_by');

                        if(!empty(Request::get('name'))) {
                            $result = $result->where('lessons.name', 'like', '%'. Request::get('name'). '%');
                        }
                        if(!empty(Request::get('date'))) {
                            $result = $result->where('lessons.created_at', 'like', '%'. Request::get('date'). '%');
                        }

        $result = $result->orderBy('lessons.id', 'desc')
                        ->paginate(10);
        
        return $result;
    }

    static public function getSingleLessonById($id) {
        return Lesson::find($id);
    }
}
