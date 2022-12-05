@extends('backend.layouts.app')

@section('title')
    Admin Create
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 col-md-12 col-lg-12 d-flex justify-content-end">
                    <span class="badge bg-success"><a href="{{ route('admins.index') }}"> Admin Lists </a></span>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row  py-5">
                <div class="col-12 col-sm-6 col-md-12 mx-auto">
                    <div class=" p-3">
                        <form action="{{ route('admins.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <label for="first_name">First Name: </label>
                                        <input type="text" name="first_name" class="form-control"
                                            value="{{ old('first_name') }}" id="first_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <label for="last_name">Last Name: </label>
                                        <input type="text" name="last_name" class="form-control"
                                            value="{{ old('last_name') }}" id="last_name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <label for="email"> Email: </label>
                                        <input type="text" name="email" class="form-control"
                                            value="{{ old('email') }}" id="email">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <label for="password"> Password: </label>
                                        <input type="text" name="password" class="form-control"
                                            value="{{ old('password') }}" id="password">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <label for="password_confirmation"> Confirm Password: </label>
                                        <input type="text" name="password_confirmation" class="form-control"
                                            value="{{ old('password_confirmation') }}" id="password_confirmation">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <label for="password_confirmation"> Role: </label>
                                        <select class="multiple-select select2-hidden-accessible" multiple="" tabindex="-1" aria-hidden="true" name="roles[]">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}">{{ $role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <button type="submit" class="btn btn-success px-5"><i
                                                class="fa ">Submit</i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->

@endsection
