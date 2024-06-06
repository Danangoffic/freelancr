<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class MyOrderController extends Controller
{

    public function accepted($id)
    {
        # code...
    }

    public function rejected($id)
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
        $order_request = Order::with(['user_buyer.detail_user', 'user_freelancer', 'service', 'status'])
                            ->where(function($query){
                                $query->where('freelancer_id', auth()->user()->id)
                                    ->orWhere('buyer_id', auth()->user()->id);
                            })
                            ->orderBy('created_at', 'desc')
                            ->get();
        return view('pages.Dashboard.order.index', compact('order_request'));
    }

    public function submit($id)
    {
        $order_request = Order::with(['user_buyer.detail_user', 'user_freelancer', 'service', 'status'])
                            ->where('freelancer_id', auth()->user()->id)
                            ->where('id', $id)
                            ->orderBy('created_at', 'desc')
                            ->first();
        return view('pages.Dashboard.order.submit', compact('order_request'));
    }

    public function submit_post(Request $request, $id)
    {
        $order_request = Order::with(['user_buyer.detail_user', 'user_freelancer', 'service', 'status'])
                            ->where('freelancer_id', auth()->user()->id)
                            ->where('id', $id)
                            ->orderBy('created_at', 'desc')
                            ->first();
        // validate the request



        return redirect();
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
        return view('pages.dashboard.order.detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order_request = Order::with(['user_buyer.detail_user', 'user_freelancer', 'service', 'status'])
                            ->where('freelancer_id', auth()->user()->id)
                            ->where('id', $id)
                            ->orderBy('created_at', 'desc')
                            ->first();
        return view('pages.Dashboard.order.submit', compact('order_request'));
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
