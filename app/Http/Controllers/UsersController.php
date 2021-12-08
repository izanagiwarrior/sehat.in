<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Rules\MatchOldPassword;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . action('UsersController@update_view', $data->id) . '" type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<a data-toggle="confirmation" data-singleton="true" data-popout="true" href="' . action('UsersController@delete', $data->id) . '" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"' . "onclick='return'" . '>Delete</a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('cms.user.user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_view()
    {
        return view('cms.user.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_process(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return redirect()->route('user')->withSuccess('User created successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_view($id)
    {
        $data = User::find($id);
        return view('cms.user.update', compact('data'));
    }

    public function update_process(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'min:11', 'email', Rule::unique('users', 'email')->ignore($user)],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('user')->withSuccess('User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $category = User::find($id);
        $category->delete();

        return redirect()->route('user');
    }

    public function change_password(Request $request,$id) {
        $request->validate([
            'new_password' => ['required', 'string', 'min:8'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find($id)->update(['password' => Hash::make($request->new_password)]);
        return redirect()->route('user')->withSuccess('User password updated successfully.');
    }
}
