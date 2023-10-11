<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class Subject extends Model
{
    use HasFactory;

    static public function getAllSubjects() {
        $result = Subject::select('subjects.*', 'users.name as created_by_name')
                        ->join('users', 'users.id', 'subjects.created_by');

                        if(!empty(Request::get('name'))) {
                            $result = $result->where('subjects.name', 'like', '%'. Request::get('name'). '%');
                        }

                        if(!empty(Request::get('type'))) {
                            $result = $result->where('subjects.type', 'like', '%'. Request::get('type'). '%');
                        }
                        if(!empty(Request::get('date'))) {
                            $result = $result->where('subjects.created_at', 'like', '%'. Request::get('date'). '%');
                        }

        $result = $result->orderBy('subjects.id', 'desc')
                        ->paginate(10);
        
        return $result;
    }

    static public function getAllActiveSubjects() {
        $result = Subject::select('subjects.*')
                        ->join('users', 'users.id', 'subjects.created_by')
                        ->where('subjects.status', '=', 0)
                        ->orderBy('subjects.name', 'asc')
                        ->get();
        
        return $result;
    }

    static public function getSingleSubjectById($id) {
        return Subject::find($id);
    }
}
