@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Assigned Lesson Subject</h1>
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
              <form action="{{ url('admin/assign-subject/edit-single') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="id" value="{{ $lessonSubject->id }}">
                  </div>
                  <div class="form-group">
                    <label>Lesson Name</label>
                    <select class="form-control" name="lesson_id" >
                      @foreach($allActiveLessons as $activeLesson)
                        <option {{ ($lessonSubject->lesson_id == $activeLesson->id ? 'selected' : '') }} value="{{ $activeLesson->id }}">{{ $activeLesson->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Subject Name</label>
                    <select class="form-control" name="subject_id" >
                      @foreach($allActiveSubjects as $activeSubject)
                        <option {{ ($lessonSubject->subject_id == $activeSubject->id ? 'selected' : '') }} value="{{ $activeSubject->id }}">{{ $activeSubject->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" >
                      <option {{ ($lessonSubject->status == 0 ? 'selected' : '') }} value="0">Active</option>
                      <option {{ ($lessonSubject->status == 1 ? 'selected' : '') }} value="1">Inactive</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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