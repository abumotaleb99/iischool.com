@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Subject</h1>
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
              <form action="{{ url('admin/subject/edit') }}" method="post">
                @csrf
                <div class="card-body"> 
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $subject->name }}" placeholder="Name">
                    <input type="hidden" class="form-control" name="id" value="{{ $subject->id }}">
                    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Type</label>
                    <select class="form-control" name="type" >
                      <option {{ ($subject->type == 'Theory' ? 'selected' : '') }} value="Theory">Theory</option>
                      <option {{ ($subject->type == 'Practical' ? 'selected' : '') }} value="Practical">Practical</option>
                    </select>
                    <span class="text-danger">{{ $errors->has('type') ? $errors->first('type') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" >
                      <option {{ ($subject->status == 0 ? 'selected' : '') }} value="0">Active</option>
                      <option {{ ($subject->status == 1 ? 'selected' : '') }} value="1">Inactive</option>
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