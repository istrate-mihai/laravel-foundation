<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class HomeSliderController extends Controller
{
    public function homeSlider() {
        $homeSlider = HomeSlider::find(1);
        return view('admin.home_slide.home_slide_all', compact('homeSlider'));
    }

    public function updateSlider(Request $request) {
        $id = $request->id;

        if ($request->file('home_slide')) {
            $file     = $request->file('home_slide');
            $nameGen  = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $filePath = 'upload/home_slide/' . $nameGen;

            $manager = new ImageManager(new Driver());

            $image = $manager->read($file);
            $image->scale(1024, 852);
            $image->save($filePath);

            HomeSlider::findOrFail($id)->update([
                'title'       => $request->title,
                'short_title' => $request->short_title,
                'home_slide'  => $filePath,
                'video_url'   => $request->video_url
            ]);

            $notification = [
                'message'    => 'Home Page Updated with Image Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        }
        else {
            HomeSlider::findOrFail($id)->update([
                'title'       => $request->title,
                'short_title' => $request->short_title,
                'video_url'   => $request->video_url
            ]);

            $notification = [
                'message'    => 'Home Page Updated without Image Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        }
    }
}
