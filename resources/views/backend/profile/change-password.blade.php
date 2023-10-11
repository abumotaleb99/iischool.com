@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @include('backend.message')
            <div class="card">
              <form action="" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" class="form-control" name="current_password" value="{{ old('current_password') }}" placeholder="Current Password">
                    <span class="text-danger">{{ $errors->has('current_password') ? $errors->first('current_password') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control" name="new_password" value="{{ old('new_password') }}" placeholder="New Password">
                    <span class="text-danger">{{ $errors->has('new_password') ? $errors->first('new_password') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" class="form-control" name="confirm_new_password" value="{{ old('confirm_new_password') }}" placeholder="Confirm New Password">
                    <span class="text-danger">{{ $errors->has('confirm_new_password') ? $errors->first('confirm_new_password') : "" }}</span>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Change</button>
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