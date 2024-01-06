@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Home Slide Page</h4>

                        <form method="POST" action="{{ route('update.slider') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $homeSlider->id }}" />

                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>

                                <div class="col-sm-10">
                                    <input class="form-control" id="title" name="title" type="text" value="{{ $homeSlider->title }}" placeholder="Title" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="short_title" class="col-sm-2 col-form-label">Short Title</label>

                                <div class="col-sm-10">
                                    <input class="form-control" id="short_title" name="short_title" type="text" value="{{ $homeSlider->short_title }}" placeholder="Short Title" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="video_url" class="col-sm-2 col-form-label">Video Url</label>

                                <div class="col-sm-10">
                                    <input class="form-control" id="video_url" name="video_url" type="text" value="{{ $homeSlider->video_url }}" placeholder="Video Url" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="home_slide" class="col-sm-2 col-form-label">Home Slide</label>

                                <div class="col-sm-10">
                                    <input class="form-control" id="home_slide" name="home_slide" type="file" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>

                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" id="home_slide_viewer"
                                        src="{{
                                            !empty($homeSlider->home_slide) ?
                                            url($homeSlider->home_slide) :
                                            url('upload/no_image.jpg')
                                        }}" alt ="Card image cap">
                                </div>
                            </div>

                            <input class="btn btn-info waves-effect waves-light" type="submit" value="Update Home Slide" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#home_slide').change(function(e) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#home_slide_viewer').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
@endsection
