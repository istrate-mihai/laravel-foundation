@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Change Password Page</h4>

                        <form method="POST" action="{{ route('update.password') }}">
                            @csrf

                            @if (count($errors))
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger alert-dismissible fade show" role="alert">{{ $error }}</p>
                                @endforeach
                            @endif

                            <div class="row mb-3">
                                <label for="old_password" class="col-sm-2 col-form-label">Old Password</label>

                                <div class="col-sm-10">
                                    <input class="form-control" id="old_password" name="old_password" type="password" placeholder="Old Password" />
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="new_password" class="col-sm-2 col-form-label">New Password</label>

                                <div class="col-sm-10">
                                    <input class="form-control" id="new_password" name="new_password" type="password" placeholder="New Password" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>

                                <div class="col-sm-10">
                                    <input class="form-control" id="confirm_password" name="confirm_password" type="password" placeholder="Confirm Password" />
                                </div>
                            </div>

                            <input class="btn btn-info waves-effect waves-light" type="submit" value="Change Password" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
