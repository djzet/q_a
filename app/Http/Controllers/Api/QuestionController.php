<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionStoreRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return QuestionResource::collection(Question::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionStoreRequest $request)
    {
        if (Auth::user()) {
            if ($request->validated()) {
                $created_question = Question::create([
                    'name' => $request->name,
                    'body' => $request->body,
                    'user_id' => Auth::id(),
                ]);
                return new QuestionResource($created_question);
            } else {
                abort(403, 'Unauthorized');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionStoreRequest $request, Question $question)
    {
        if (Auth::user()) {
            Gate::authorize('update-user-question', $question);
            if ($request->validated()) {
                $question->update([
                    'name' => $request->name,
                    'body' => $request->body,
                    'user_id' => Auth::id(),
                ]);
                return new QuestionResource($question);
            } else {
                abort(403, 'Unauthorized');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        if (Auth::user()) {
            Gate::authorize('delete-user-question', $question);
            $question->delete();
            return response(null, ResponseAlias::HTTP_NO_CONTENT);
        } else {
            abort(403, 'Unauthorized');
        }
    }
}
