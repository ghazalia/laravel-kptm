<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::all();

        // resources/views/trainings/index.blade.php
        return view('trainings.index', compact('trainings'));
    }
}
