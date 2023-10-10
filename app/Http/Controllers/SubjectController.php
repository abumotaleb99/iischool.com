<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function subjectList() {
        $data['header_title'] = 'Subject List';
        $data['subjects'] = Subject::getAllSubjects();

        return view('backend.admin.subject.list', $data);
    }

    public function add() {
        $data['header_title'] = 'Admin New Subject';

        return view('backend.admin.subject.add', $data);
    }

    public function insert(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);

        $subject = new Subject;
        
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->status = $request->status;
        $subject->created_by = Auth::user()->id;
        $subject->save();

        return redirect('admin/subject/list')->with("success", "Subject added successfully.");
    }

    public function edit($id) {
        $data['subject'] = Subject::getSingleSubjectById($id);

        if(!empty($data['subject'])) {
            $data['header_title'] = 'Edit Subject';

            return view('backend.admin.subject.edit', $data);
        }else {
            abort(404);
        }

    }

    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);

        $subject = Subject::getSingleSubjectById($request->id);
        
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->status = $request->status;

        $subject->save();

        return redirect('admin/subject/list')->with("success", "Subject updated successfully.");
    }

    public function delete($id) {
        $subject = Subject::getSingleSubjectById($id);

        if(!empty($subject)) {
            $subject->delete();
        }else {
            abort(404);
        }

        return redirect('admin/subject/list')->with("success", "Subject delete successfully.");

    }
}
