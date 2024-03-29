<?php

namespace App\Http\Controllers\Slideshow;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Slideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SlideshowController extends Controller
{
    public function index()
    {
        $slideshows = Slideshow::orderBy('created_at', 'desc')->with('media')->paginate(10);
        $totalSlideshows = Slideshow::count();
        return view('content.slideshow.list', compact('slideshows', 'totalSlideshows'));
    }
    public function create()
    {
        $media = Media::all();
        return view('content.slideshow.create', compact('media'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        Slideshow::store($request);
        DB::commit();
        return redirect('slideshow')->with('success', 'Slideshow has been created successfully.');
    }
    public function edit($id)
    {
        $slideshow = Slideshow::findOrFail($id);
        return view('content.slideshow.edit', compact('slideshow'));
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        Slideshow::store($request, $id);
        DB::commit();
        return redirect('/slideshow')->with('success', 'Slideshow has been updated successfully.');
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        // Find the slideshow by its ID and delete it
        $slideshow = Slideshow::find($id);
        if ($slideshow->media) {
            $slideshow->media->delete();
        }
        DB::commit();
        return redirect('/slideshow')->with('success', 'Slideshow has been deleted successfully.');
    }
    public function search(Request $request)
    {
        $searchSlideshow = Slideshow::where("heading", "like", "%" . $request->search . "%")->paginate(10);
        if ($request->ajax()) {
            return view('content.slideshow.table', ['slideshows' => $searchSlideshow])->render();
        } else {
            return view('content.slideshow.list', ['slideshows' => $searchSlideshow]);
        }
    }
}
