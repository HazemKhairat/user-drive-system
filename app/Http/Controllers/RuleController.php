<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rules = Rule::paginate(5);
        return view('rules.index', compact('rules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = new Rule();
        $rule->title = $request->title;
        $rule->description = $request->description;
        $rule->save();
        return redirect()->back()->with('done', 'The Rule Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rule $rule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rule = Rule::find($id);
        return view('rules.edit', compact('rule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rule = Rule::find($id);
        $rule->title = $request->title;
        $rule->description = $request->description;
        $rule->save();
        return redirect()->back()->with('done', 'The Rule Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rule = Rule::find($id);
        $rule->delete();
        return redirect()->back()->with('done', 'The Rule Deleted Successfully');

    }
}
