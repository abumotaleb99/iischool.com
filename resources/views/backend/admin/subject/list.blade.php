@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1>Subject List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('admin/subject/add') }}" class="btn btn-primary">Add New Subject</a>
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
            <div class="card-header">
              <h3 class="card-title">Search Subject</h3>
             </div>
            <form action="" method="get">
                @csrf
                <div class="card-body row">
                  <div class="form-group col-12 col-md-3">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ Request::get('name') }}" placeholder="Name">
                  </div>
                  <div class="form-group col-12 col-md-3">
                    <label>Type</label>
                    <select class="form-control" name="type" >
                      <option value="">Select Type</option>
                      <option {{ (Request::get("type") == "Theory") ? "selected" : "" }} value="Theory">Theory</option>
                      <option {{ (Request::get("type") == "Practical") ? "selected" : "" }}  value="Practical">Practical</option>
                    </select>
                  </div>
                  <div class="form-group col-12 col-md-3 float-left">
                    <label>Date</label>
                    <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}">
                  </div>
                  <div class="form-group form-group col-12 col-md-3 mb-0 d-md-flex align-items-center pt-md-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ url('admin/subject/list') }}" class="btn btn-success ml-1">Clear</a>
                  </div>
                </div>
            </div>

            @include('backend.message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Subject List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Type</th>
                      <th>Status</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($subjects) > 0)

                    @php($i = 1)
                    @foreach($subjects as $subject)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $subject->name }}</td>
                      <td>{{ $subject->type }}</td>
                      <td>
                        @if($subject->status == 0)
                         Active
                        @else
                          Inactive
                        @endif
                      </td>
                      <td>{{ $subject->created_by_name }}</td>
                      <td>{{ date('d-m-Y H:i A', strtotime($subject->created_at)) }}</td>
                      <td>
                        <a href="{{ url('admin/subject/edit/'. $subject->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ url('admin/subject/delete/'. $subject->id) }}" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
                    @endforeach

                  @else
                    <tr>
                      <td colspan="6" class="text-center">No data found.</td>
                    </tr>
                  @endif
                  </tbody>
                </table>
                <div class="d-flex justify-content-center pt-2">
                  {{ $subjects->onEachSide(1)->links() }}
                </div>
              </div>
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