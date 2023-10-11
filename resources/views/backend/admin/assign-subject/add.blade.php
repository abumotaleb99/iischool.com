@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assign New Lesson Subjects</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <form action="{{ url('admin/assign-subject/add') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Lesson Name</label>
                    <select class="form-control" name="lesson_id" >
                      <option value="">Select Lesson</option>
                      @foreach($allActiveLessons as $allActiveLesson)
                        <option value="{{ $allActiveLesson->id }}">{{ $allActiveLesson->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('lesson_id') ? $errors->first('lesson_id') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Subject Name</label>
                    @foreach($allActiveSubjects as $allActiveSubject)
                      <div>
                        <label for="subject-{{ $allActiveSubject->id }}" style="margin: 0px">
                        <input type="checkbox" id="subject-{{ $allActiveSubject->id }}" name="subject_id[]" value="{{ $allActiveSubject->id }}">
                        <span class="cursor-pointer font-weight-normal" style="cursor: pointer;">{{ $allActiveSubject->name }}</span>
                        </label>
                      </div>
                    @endforeach
                    <span class="text-danger">{{ $errors->has('subject_id') ? $errors->first('subject_id') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" >
                      <option value="0">Active</option>
                      <option value="1">Inactive</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection