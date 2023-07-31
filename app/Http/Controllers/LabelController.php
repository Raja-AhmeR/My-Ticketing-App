<?php

namespace App\Http\Controllers;
use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::all();
        return view('admin.label.view', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.label.create-new-label');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required | unique:labels',
            'description' => 'required'
        ]);
        // dd($request);
        $label = new Label();
        $label->name = $request['name'];
        $label->description = $request['description'];
        $label->save();

        return redirect('admin/label/view');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $label = Label::find($id);
        return view('admin.label.create-new-label', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->id);
        $label = Label::find($id);
        $label->name = $request['name'];
        $label->description = $request['description'];
        $label->update();
        return redirect('admin/label/view');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $label = Label::find($id);
        if (!is_null($label)){
            $label->delete();
        }
        return redirect('admin/label/view');
    }
}
