<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Eform\eform_form;

class CandidateSearch extends Controller
{
    public function index()
    {
        return view('user.candidate.index',['data'=>eform_form::all()]);
    }

    public function search(Request $req)
    {
        return view('user.candidate.index',['data'=>[]]);
    }
}
