@extends('layouts.backend.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Vendor</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active">View Vendor</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              
              <!-- Horizontal Form -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">View Vendor</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('vendor.update', $data[0]->id) }}">
                  @csrf
                  <div class="card-body">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label for="name" class="col-sm-8 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" name="name" value="{{ $data[0]->name }}" placeholder="Name" disabled>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="address" class="col-sm-8 col-form-label">Address</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="address" name="address" value="{{ $data[0]->address }}" placeholder="Address" disabled>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="contactPerson" class="col-sm-8 col-form-label">Contact Person</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="contactPerson" name="contactPerson" value="{{ $data[0]->cp }}" placeholder="Contact Person" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                          <label for="phone" class="col-sm-8 col-form-label">Phone Number</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $data[0]->phone }}" placeholder="Phone Number" disabled>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label for="active" class="col-sm-8 col-form-label">Status</label>
                          <div class="col-sm-10">
                            <select class="form-control" id="status" name="status" disabled>
                                <option value="1" {{ $data[0]->active == 1 ? 'selected' : '' }} >Active</option>
                                <option value="0" {{ $data[0]->active == 0 ? 'selected' : '' }} >Inactive</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label for="user-modified" class="col-sm-8 col-form-label">Modified By:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="user-modified" name="userModify" value="{{ $data[0]->user_modify->name }}" placeholder="Modified By" disabled>
                          </div>
                        </div>
                        <div class="col-md-4">
                          
                      </div>
                    
                  </div>
                  <!-- /.card-body -->
                  <!-- /.card-footer -->
                </form>
              </div>
              <!-- /.card -->
  
            </div>
            <!--/.col (left) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

@endsection