<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerStoreRequest;
use App\Http\Resources\AnswerResource;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
        if (Auth::user()) {
            if ($request->validated()) {
                $create_answer = Answer::create([
                    'body' => $request->body,
                    'user_id' => Auth::id(),
                    'question_id' => $request->question_id,
                ]);
                return new AnswerResource($create_answer);
            } else {
                abort(403, 'Unauthorized');
            }
        }
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
        if (Auth::user()) {
            Gate::authorize('update-user-answer', $answer);
            if ($request->validated()) {
                $answer->update([
                    'id' => $answer->id,
                    'body' => $request->body,
                    'user_id' => Auth::id(),
                    'question_id' => $request->question_id,
                ]);
                return new AnswerResource($answer);
            } else {
                abort(403, 'Unauthorized');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        if (Auth::user()) {
            $answer->delete();
            Gate::authorize('delete-user-answer', $answer);
            return response(null, ResponseAlias::HTTP_NO_CONTENT);
        } else {
            abort(403, 'Unauthorized');
        }
    }
}
