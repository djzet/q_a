<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerStoreRequest;
use App\Http\Resources\AnswerResource;
use App\Models\Answer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnswerStoreRequest $request)
    {
        $create_answer = Answer::create($request->validated());

        return new AnswerResource($create_answer);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnswerStoreRequest $request, Answer $answer)
    {
        $answer->update($request->validated());

        return new AnswerResource($answer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();

        return response(null, ResponseAlias::HTTP_NO_CONTENT);
    }
}
