<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\AnswerStoreRequest;
use App\Http\Requests\AnswerUpdateRequest;
use App\Http\Resources\Answer\AnswerCollection;
use App\Http\Resources\Answer\AnswerResource;
use App\Models\Answer;
use App\Models\Task;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Task $task)
    {
        $this->authorize('viewAny', Answer::class);

        $answers = $task->answers()->get();

        return new AnswerCollection($answers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnswerStoreRequest $request, Task $task)
    {
        $this->authorize('update', [Answer::class, $task]);

        $answer = $task->answers()->create($request->validated());

        if ($request->hasFile('images')) {
            $answer->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('images');
                });
        }
        if ($request->hasFile('files')) {
            $answer->addMultipleMediaFromRequest(['files'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('files');
                });
        }

        return new AnswerResource($answer);
    }
    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        $this->authorize('view', $answer);

        $answer->load(['student']);

        return new AnswerResource($answer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnswerUpdateRequest $request, Answer $answer)
    {
        $this->authorize('update', $answer);

        $answer->update($request->validated());

        if ($request->hasFile('images')) {
            $answer->clearMediaCollection('images');

            $answer->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('images');
                });
        }
        if ($request->hasFile('files')) {
            $answer->clearMediaCollection('files');

            $answer->addMultipleMediaFromRequest(['files'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('files');
                });
        }

        return new AnswerResource($answer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        $this->authorize('delete', $answer);
        $answer->delete();

        return response()->noContent();
    }
}
