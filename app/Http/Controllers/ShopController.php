<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductTracker;
use App\User;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $trackers = ProductTracker::where('user_id', auth()->user()->id)->get();

        return view('history', compact('trackers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $product = Product::where('type', 0)->get();

        $members = User::where('parent_id', auth()->user()->id)->get();
        $merchandise_flag = 0;
        $product_id = "";
        $url = $request->id;
        if ($url) {
            $client = new \GuzzleHttp\Client();
            try {
                $res = $client->request('POST', 'https://api.checknow.org/api/token', [
                    'json' => [
                        "username" => "edelsteenapi",
                        "password" => "9bAHKVsp!pLdhVxF",
                        "companyCode" => "MY4644",
                    ],
                ]);
                $token = json_decode($res->getBody()->getContents());
                $res = $client->request('GET', 'https://api.checknow.org/api/v1/SerialNumber?QrLink=' . $url, [
                    'headers' => [
                        "Authorization" => 'Bearer ' . $token,
                        "Accept" => 'application/json',
                    ],
                ]);
                $contents = json_decode($res->getBody()->getContents());
                $product_id = $contents->serialNumber;
            } catch (\Exception $e) {

            }
        }

        return view('shop', compact('members', 'product', 'merchandise_flag', 'product_id'));
    }

    public function getSerialNumber(Request $request)
    {
        $url = $request->url;
        if ($url) {
            $client = new \GuzzleHttp\Client();
            try {
                $res = $client->request('POST', 'https://api.checknow.org/api/token', [
                    'json' => [
                        "username" => "edelsteenapi",
                        "password" => "9bAHKVsp!pLdhVxF",
                        "companyCode" => "MY4644",
                    ],
                ]);
                $token = json_decode($res->getBody()->getContents());
                $res = $client->request('GET', 'https://api.checknow.org/api/v1/SerialNumber?QrLink=' . $url, [
                    'headers' => [
                        "Authorization" => 'Bearer ' . $token,
                        "Accept" => 'application/json',
                    ],
                ]);
                $contents = json_decode($res->getBody()->getContents());
                $product_id = $contents->serialNumber;
                return response()->json(
                    [
                        'status' => 'success',
                        'serial' => $product_id,
                    ], 200);

            } catch (\Exception $e) {
                return response()->json(
                    [
                        'status' => 'failed',
                        'message' => $e,
                    ], 500);

            }
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function merchandise()
    {
        //
        $product = Product::where('type', 1)->get();
        $members = User::where('parent_id', auth()->user()->id)->get();
        $merchandise_flag = 1;
        $product_id = '';

        return view('shop', compact('members', 'product', 'merchandise_flag', 'product_id'));
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
        $tracker = ProductTracker::create($request->all());
        $tracker_item = ProductTrackerItem::create($request->all());
        return redirect('/#!/success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductTracker $tracker)
    {
        //
        return view('details', compact('tracker'));
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