<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Vote;
use Illuminate\Support\Facades\Session;

class IdeaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ideas.index');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreIdeaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIdeaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Idea $idea
     * @return \Illuminate\Http\Response
     */
    public function show(Idea $idea)
    {
//        $queryStringParam = '?' . http_build_query([
//                'category' => Session::get('category'),
//                'filter' => Session::get('filter'),
//                'search' => Session::get('search'),
//                'status' => Session::get('status')
//            ]);
        $previousUrl = url()->previous();
        $url = $previousUrl === url()->current() ? route('ideas.index') : $previousUrl;
        return view('ideas.show', compact('idea', 'url'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Idea $idea
     * @return \Illuminate\Http\Response
     */
    public function edit(Idea $idea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateIdeaRequest $request
     * @param \App\Models\Idea $idea
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIdeaRequest $request, Idea $idea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Idea $idea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idea $idea)
    {
        //
    }
}
