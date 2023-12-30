@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Profile</h4>

                        <form method="POST" action="{{ route('store.profile') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>

                                <div class="col-sm-10">
                                    <input class="form-control" id="name" name="name" type="text" value="{{ $editData->name }}" placeholder="Name" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>

                                <div class="col-sm-10">
                                    <input class="form-control" id="email" name="email" type="email" value="{{ $editData->email }}" placeholder="Email" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="text" class="col-sm-2 col-form-label">User Name</label>

                                <div class="col-sm-10">
                                    <input class="form-control" id="username" name="username" type="text" value="{{ $editData->username }}" placeholder="User Name" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="profile_image" class="col-sm-2 col-form-label">Profile Image</label>

                                <div class="col-sm-10">
                                    <input class="form-control" id="profile_image" name="profile_image" type="file" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>

                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" id="profile_image_viewer"
                                        src="{{
                                            !empty($editData->profile_image) ?
                                            url('upload/admin_images/' . $editData->profile_image) :
                                            url('upload/no_image.jpg')
                                        }}" alt ="Card image cap">
                                </div>
                            </div>

                            <input class="btn btn-info waves-effect waves-light" type="submit" value="Update Profile" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#profile_image').change(function(e) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#profile_image_viewer').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
@endsection
