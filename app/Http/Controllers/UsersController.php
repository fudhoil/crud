<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        // datatables
        if (request()->ajax()) {
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                        <div style="display: flex; justify-content: center;">
                            <button type="button" data-id="' . $row->id . '" data-name="' . $row->name . '" onclick="editUser(this)" style="margin-right: 5px; background-color: #4CAF50; border: none; color: white; padding: 5px 10px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px;">
                                Edit
                            </button>
                            <form action="' . route('users.destroy', $row->id) . '" method="POST">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" style="background-color: #f44336; border: none; color: white; padding: 5px 10px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px;">
                                    Delete
                                </button>
                            </form>
                        </div>
                    ';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users.index', compact('users'));
    }

    // crud

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
        ]);

        User::create($request->all());

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // public function show(User $user)
    // {
    //     return view('users.show', compact('user'));
    // }

    public function edit(User $user)
    {
        // get user
        $user = User::find($user->id);
        return response()->json($user);
    }

    public function update(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255|unique:users,name,' . $user->id,
        // ]);

        $user = User::find($request->id);

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
