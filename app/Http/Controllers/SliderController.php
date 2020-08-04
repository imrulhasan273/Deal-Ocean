<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function add()
    {
        return view('dashboard.sliders.add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'slider_img' => 'required',
        ]);

        $imageName = $this->storeNewImage($request->file('slider_img'));

        $addSlider = Slider::create([
            'title' => $request->input('title'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'slider_img' => $imageName
        ]);

        return Redirect::route('dashboard.sliders');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('dashboard.sliders.edit', compact(['slider']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        # When update with a new photo
        if ($request->hasFile('slider_img')) {

            $this->deleteOldImage($request->id);

            $imageName = $this->storeNewImage($request->file('slider_img'));

            $updatingSlider = Slider::where('id', $request->id)->first();
            if ($updatingSlider) {
                $updatingSlider->update([
                    'title' => $request->title,
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'slider_img' => $imageName,
                ]);
            }

            return Redirect::route('dashboard.sliders');
        }


        # When no photo is updated
        $updatingSlider = Slider::where('id', $request->id)->first();
        if ($updatingSlider) {
            $updatingSlider->update([
                'title' => $request->title,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
            ]);
        }

        return Redirect::route('dashboard.sliders');
    }

    protected function deleteOldImage($id)
    {
        $oldImg = DB::table('sliders')->where('id', $id)->pluck('slider_img')->toArray();
        $name = $oldImg[0];
        Storage::delete('/public/slider/' . $name);
    }

    protected function storeNewImage($file)
    {
        $filenameWithExt = $file->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        $file->storeAs('public/slider', $fileNameToStore);

        return $fileNameToStore;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $deleteSlider = DB::table('sliders')->where('id', $slider->id)->delete();

        return Redirect::route('dashboard.sliders');
    }
}
