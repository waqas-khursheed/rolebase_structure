@extends('layouts.app4')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Add Provider</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item btn btn-warning"><a href="{{ url('/provider')}}">Provider List</a></li>
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
                  <h3 class="card-title">Create Provider</h3>
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
              <form role="form" id="quickForm" method="POST" action="{{URL::to('/provider')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                     <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter Rider Name" name="provider_name" required="" >
                        @if ($errors->has('provider_name'))
                            <label id="provider_name-error" class="error" for="provider_name">{{ $errors->first('provider_name') }}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Enter Rider Phone" name="provider_phone" >
                        @if ($errors->has('provider_phone'))
                            <label id="provider_phone-error" class="error" for="provider_phone">{{ $errors->first('provider_phone') }}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter Rider Address" name="provider_address" required="" >
                        @if ($errors->has('provider_address'))
                        <label id="provider_address-error" class="error" for="provider_address">{{ $errors->first('provider_address') }}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter Rider Email" name="provider_email" required="" >
                        @if ($errors->has('provider_email'))
                            <label id="provider_email-error" class="error" for="provider_email">{{ $errors->first('provider_email') }}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="******" name="provider_password" required="" >
                        @if ($errors->has('provider_password'))
                        <label id="provider_password-error" class="error" for="provider_password">{{ $errors->first('provider_password') }}</label>
                        @endif
                    </div>
                    <div>
                        <input type="file" class="dropify" name="provider_image" required="">
                        @if ($errors->has('provider_image'))
                        <label id="provider_image-error" class="error text-danger" for="provider_image">{{ $errors->first('provider_image') }}</label>
                        @endif
                    </div>


                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
