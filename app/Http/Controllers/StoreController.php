<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user=auth()->user();
       $request->validate([
            'store_name' => 'required|string|max:255',
            'store_email' => 'required|string|email|max:255|unique:users,email',
            'country' => 'nullable|string|max:255',
            'full_address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'store_coverphoto' => 'nullable|string|max:255',
            'store_profilephoto' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'return_policy' => 'nullable|string',
            'shipping_policy' => 'nullable|string',
            'privacy_policy' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
            'business_hours' => 'nullable|json',

        ]);

        $user->role = 'seller';
       $store=$user->store()->create($request->all());

        $user->save();

        return response()->json(['message' => 'Store created successfully', 'store' => $store], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
