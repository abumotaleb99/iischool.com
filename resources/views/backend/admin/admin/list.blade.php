@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('admin/admin/add') }}" class="btn btn-primary">Add New Admin</a>
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
              <h3 class="card-title">Search Admin</h3>
             </div>
            <form action="" method="get">
                @csrf
                <div class="card-body row">
                  <div class="form-group col-12 col-md-3">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ Request::get('name') }}" placeholder="Name">
                  </div>
                  <div class="form-group col-12 col-md-3 float-left">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" value="{{ Request::get('email') }}" placeholder="Email">
                  </div>
                  <div class="form-group col-12 col-md-3 float-left">
                    <label>Date</label>
                    <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}" placeholder="Email">
                  </div>
                  <div class="form-group form-group col-12 col-md-3 mb-0 d-md-flex align-items-center pt-md-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ url('admin/admin/list') }}" class="btn btn-success ml-1">Clear</a>
                  </div>
                </div>
              </form>
            </div>

            @include('backend.message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Admin List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @php($i = 1)
                    @foreach($adminUsers as $adminUser)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $adminUser->name }}</td>
                      <td>{{ $adminUser->email }}</td>
                      <td>{{ date('d-m-Y', strtotime($adminUser->created_at)) }}</td>
                      <td>
                        <a href="{{ url('admin/admin/edit/'. $adminUser->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ url('admin/admin/delete/'. $adminUser->id) }}" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="d-flex justify-content-center pt-2">
                  {{ $adminUsers->onEachSide(1)->links() }}
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