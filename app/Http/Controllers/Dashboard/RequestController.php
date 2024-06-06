<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class RequestController extends Controller
{

    public function approve($id)
    {
        # code...
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_request = Order::with(['user_buyer', 'user_freelancer.detail', 'service', 'status'])
                        ->where('buyer_id', auth()->user()->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('pages.dashboard.request.index', compact('order_request'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order_request = Order::with(['user_buyer', 'user_freelancer.detail', 'service', 'status'])
                        ->where('buyer_id', auth()->user()->id)
                        ->where('id', $id)
                        ->orderBy('created_at', 'desc')
                        ->first();
        return view('pages.dashboard.request.detail', compact('order_request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
