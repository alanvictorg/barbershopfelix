<?php

namespace App\Http\Controllers;

use App\Entities\RoleUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
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
        if (null !== $request->file('imagepath') ) {
            $image = Storage::disk('public')->put("/images", $request->file('imagepath'));
        }
        $data = $request->all();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt('123456'),
            'imagepath' => isset($image) ? $image : null
        ]);

        if (isset($data['type'])) {
            RoleUser::create([
                'role_id' => 2,
                'user_id' => $user->id
            ]);
        }

        $response = [
            'message' => 'Usuário cadastrado',
        ];

        if ($request->wantsJson()) {

            return response()->json($response);
        }

        return redirect()->route('users.index')->with('message', $response['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id',$id)->first();

        return view('users.edit',compact('user'));
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
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['updated_at'] = date('y-m-d');

        if ($request->file('imagepath')){
            $image = Storage::disk('public')->put("/images", $request->file('imagepath') );
            $data['imagepath'] = $image;
        }

        User::where('id',$id)->update($data);

        $response = [
            'message' => 'Usuário Atualizado',
        ];

        if ($request->wantsJson()) {

            return response()->json($response);
        }

        return redirect()->route('users.index')->with('message', $response['message']);
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
