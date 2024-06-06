<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function explore()
    {
        return view('pages.Landing.explorer');
    }

    public function detail($id)
    {
        return view('pages.Landing.detail');
    }

    public function booking($id)
    {
        return view('pages.Landing.booking');
    }

    public function detail_booking($id)
    {
        # code...
    }

    // make crud resources

    public function index()
    {
        return view('pages.Landing.index');
    }

    public function store(Request $request)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
