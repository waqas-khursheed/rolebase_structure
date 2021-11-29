
@extends('layouts.app4')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Promotion Banner Add</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item btn btn-warning"><a href="{{ url('/promotion/banner')}}">Promotion Banner List</a></li>
                </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Create Promotion Banner</h3>
                      @if(Session::has('success'))
                          <div class="alert alert-success">
                              {{ Session::get('success') }}
                              @php
                                  Session::forget('success');
                              @endphp
                          </div>
                      @endif
                </div>
                <!-- /.card-header -->

              <!-- form start -->
              <form role="form" id="quickForm" method="POST" action="{{URL::to('/employee/addrole')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group form-float">
                        <input type="text" class="form-control" placeholder="Enter Role" name="role" required="" autofocus>
                        @if ($errors->has('role'))
                            <label id="role-error" class="error" for="role">{{ $errors->first('role') }}</label>
                        @endif
                    </div>
                    <button class="btn btn-raised btn-primary waves-effect" type="submit">Add Role</button>
              </form>

                <!-- /.card-header -->
                <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                        <tr>
                            <th>Employee Roles</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Employee Roles</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($employeeroles as $item)
                            <tr>
                                <td>{{$item->role}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
          </div>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
        
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
  </div>
@endsection
