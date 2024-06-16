<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_request = Order::with(['user_buyer', 'user_freelancer.detail', 'service', 'status'])
                        ->where('buyer_id', Auth::user()->id)
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
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404);
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
                        // ->where('buyer_id', auth()->user()->id)
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
        return abort(404);
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
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(404);
    }

    public function approve($id)
    {
        $order = Order::where('id', $id)->first();
        $order_1 = Order::find($order->id);
        $order_1->order_status_id = 1;
        $order_1->save();

        toast()->success('Approval Success');
        return redirect()->route('member.request.index');
    }
}
