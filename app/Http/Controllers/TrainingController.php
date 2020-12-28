<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrainingRequest;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Models\Training;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class TrainingController extends Controller
{
    public function index(Request $request)
    {
        // $trainings = Training::paginate();
        // dd($trainings);
        if ($request->keyword) {
            $search = $request->keyword;

//            $trainings = Training::where('title', 'LIKE', '%' . $search .'%')
//                ->OrWhere('description', 'LIKE', '%' . $search .'%')
//                ->paginate(10);
            $trainings = auth()->user()->trainings()->where('title', 'LIKE', '%' . $search .'%')
                ->OrWhere('description', 'LIKE', '%' . $search .'%')
                ->paginate(10);
        } else {

            $user = auth()->user();
            $trainings = $user->trainings()->paginate(15);
            // resources/views/trainings/index.blade.php
            }

        return view('trainings.index', compact('trainings'));
    }

    public function show($id)
    {
        $training = Training::find($id);

        return view('trainings.show', compact('training'));
    }

    public function edit($id)
    {
        $training = Training::find($id);

        return view('trainings.edit', compact('training'));
    }

    public function delete(Training $training)
    {
        if ($training->attachment) {
            Storage::disk('public')->delete($training->attachment);
        }
        $training->delete();

        return redirect()
            ->route('training:list')
            ->with([
                'alert-type' => 'alert-danger',
                'alert' => 'Your training has been deleted'
            ]);
    }

    public function update(Request $request, $id)
    {
        $training = Training::find($id);

        $training->update($request->only('title', 'decription', 'trainer'));

        return redirect()
            ->route('training:list')
            ->with([
                'alert-type' => 'alert-success',
                'alert' => 'Your training has been updated'
            ]);
    }

    public function create()
    {
        return view('trainings.create');
    }

    public function store(StoreTrainingRequest $request)
    {
//        validate request
//        $this->validate(
//            $request,
//            [
//                'title' => 'required|min:3',
//                'description' => 'required',
//            ]
//        );

        $training = new Training();
        $training->title = $request->title;
        $training->description = $request->description;
        $training->trainer = $request->trainer;
        $training->user_id = auth()->user()->id;
        $training->save();

        // store all data from form to trainings table
        //return to training index

        if($request->hasFile('attachment')) {
//            rename file
//            filename: id-2020-12-22.jpg
            $filename = $training->id.'-'.date('Y-m-d')
                . '.' . $request->attachment->getClientOriginalExtension();

//            store file in stroge
            Storage::disk('public')->put($filename, $request->attachment);

//            update row with filename
            $training->update(['attachment' => $filename]);
        }

//        send email to user
//        Mail::send('email.training-created',
//            ['title' => $training->title,
//              'description' => $training->description],
//            function ($message) {
//        $message->to('ghaz745@gmail.com');
//        $message->subject('Training created email using inline email');
//    });

//        send email using mailable
//        Mail::to('ghaz745@gmail.com')->send(new \App\Mail\TrainingCreated($training));

//        SendMail Queue
        SendEmailJob::dispatch($training);

        return redirect()
            ->route('training:list')
            ->with([
                'alert-type' => 'alert-primary',
                'alert' => "Your training has been created"
            ]);
    }
}
