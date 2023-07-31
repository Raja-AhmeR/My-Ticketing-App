<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agentUsers = Role::where('id', 2)->first();
        $users = $agentUsers->users;
        return view('admin.agent.agent-view', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.agent.new-agent');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request->password);
        $agent = Role::find($request->role_id);   // Finding role id coming from agent form
        $user->save();

        // Assigning Role to new Agent that is created by admin only!
        $user->role()->attach($agent->id);
        // dd($user);
        return redirect(route('admin.view-agent'));
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
        $agentUser = User::find($id);
        $users = DB::table('role_user')->where('user_id', $id)->delete();
        if(!is_null($agentUser)) {
            $agentUser->delete();
        }
        return redirect(route('admin.view-agent'));
    }
}
