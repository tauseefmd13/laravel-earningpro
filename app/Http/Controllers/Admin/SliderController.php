<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySliderRequest;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Slider;
use App\Traits\MediaUploadTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SliderController extends Controller
{
    use MediaUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('slider_access'), Response::HTTP_FORBIDDEN);

        $sliders = Slider::all();

        if(request()->ajax()) {
            return datatables()->of($sliders)
                ->addIndexColumn()
                ->addColumn('checkAll', function($row) {
                    return '<input type="checkbox" class="sub-check" onclick="checkAllCheckbox();" data-id="'.$row->id.'">';
                })
                ->editColumn('image', function($row) {
                    if(!empty($row->image)) {
                        return '<img src="'.$row->image_url.'" alt="" class="img-responsive">';
                    }
                })
                ->editColumn('status', function($row) {
                    $checked = ($row->status == 1) ? 'checked' : '';
                    return '<div class="custom-control custom-switch custom-switch-lg"><input type="checkbox" name="status" data-url="'.route('admin.sliders.update.status').'" data-id="'.$row->id.'" class="custom-control-input js-switch" id="customSwitch'.$row->id.'" '.$checked.'><label class="custom-control-label" for="customSwitch'.$row->id.'"></label></div>';
                })
                ->editColumn('created_at', function($row) {
                    return Carbon::parse($row->created_at)->toDateTimeString();
                })
                ->addColumn('action', function($row) {
                    return view('admin.includes.datatablesActions', [
                        'crudRoutePart' => 'sliders',
                        'row' => $row,
                    ]);
                })
                ->rawColumns(['checkAll', 'image', 'status', 'action'])
                ->make(true);
        }

        return view('admin.sliders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('slider_create'), Response::HTTP_FORBIDDEN);

        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSliderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSliderRequest $request)
    {
        abort_unless(\Gate::allows('slider_create'), Response::HTTP_FORBIDDEN);

        $data = $request->all();
        
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $this->uploadMedia($file, 'sliders');
        }

        $slider = Slider::create($data);

        return redirect()->route('admin.sliders.index')->with('success','Slider added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        abort_unless(\Gate::allows('slider_show'), Response::HTTP_FORBIDDEN);

        return view('admin.sliders.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        abort_unless(\Gate::allows('slider_edit'), Response::HTTP_FORBIDDEN);

        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        abort_unless(\Gate::allows('slider_edit'), Response::HTTP_FORBIDDEN);

        $data = $request->all();

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $this->uploadMedia($file, 'sliders', $slider->image);
        }

        $slider->update($data);

        return redirect()->route('admin.sliders.index')->with('success','Slider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        abort_unless(\Gate::allows('slider_delete'), Response::HTTP_FORBIDDEN);

        $this->unlinkMedia('sliders', $slider->image);
        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success','Slider deleted successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        abort_unless(\Gate::allows('slider_edit'), Response::HTTP_FORBIDDEN);

        $slider = Slider::findOrFail($request->id);
        $slider->status = $request->status;
        $slider->save();

        return response()->json(['message' => 'Slider status updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\MassDestroySliderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(MassDestroySliderRequest $request)
    {
        abort_unless(\Gate::allows('slider_delete'), Response::HTTP_FORBIDDEN);

        Slider::whereIn('id', request('ids'))->get()->each(function ($slider) {
            $this->unlinkMedia('sliders', $slider->image);
            $slider->delete();
        });

        return response()->json(['message' => 'Slider deleted successfully.']);
    }
}
