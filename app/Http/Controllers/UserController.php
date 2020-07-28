<?php

namespace App\Http\Controllers;

use App\Level;
use App\Menu;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->level_id !=1) {
            abort(403);
        }
        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);
        $user = User::all()->where('row_status','1');
        // dd($user->level);
        return view('user.index',compact('user','menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->level_id !=1) {
            abort(403);
        }
        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);
        $level = Level::all();
        return view('user.add',compact('level','menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'unique:App\User,username|required',
            'password' => 'required|same:password_confirmation',
            'password_confirmation' => 'same:password',
            'level' => 'required'
        ]);
        //encrypt
        $encrypt = Hash::make($request->password);
            $user = new User;
            // dd($user);
            $user->username = $request->username;
            $user->password = $encrypt;
            $user->level_id = $request->level;
            $user->input_by = Auth::user()->username;
            $user->input_at = now();
            $user->row_status = '1';

            $user->save();
            Alert::success('Berhasil!',"Data user berhasil disimpan.")->persistent('Close');
        return redirect('user');
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
    public function edit(User $user)
    {
        if (Auth::user()->level_id !=1) {
            abort(403);
        }
        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);
        $level = Level::all();
        return view('user.edit', compact('user','level','menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        
        $request->validate([
            'username' => 'required',
            'level' => 'required'
        ]);
        if ($request->valid ==1) {
            $request->validate([
                'password' => 'required|same:password_confirmation',
            'password_confirmation' => 'same:password'
            ]);
        }
        if ($request->valid == 1) {
            // encrypt
            $encrypt = hash::make($request->password);
            User::where('id', $user->id)
              ->update([
                  'username' => $request->username,
                  'password' => $encrypt,
                  'level_id'   =>$request->level,
                  'modified_by' => Auth::user()->username,
                  'modified_at' => now()
              ]);
            // return 1;
        }else{
            User::where('id', $user->id)
              ->update([
                  'username' => $request->username,
                  'level_id'   =>$request->level,
                  'modified_by' => Auth::user()->username,
                  'modified_at' => now()
              ]);
        }
            Alert::success('Berhasil!',"Data user berhasil diubah.")->persistent('Close');
            return redirect('user');
        // return 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::user()->level_id !=1) {
            abort(403);
        }

        if (Auth::user()->id==$user->id) {
            Alert::error('Gagal!',"User sedang digunakan. Tidak bisa dihapus")->persistent('Close');
            return redirect('user');
        }else{
            User::where('id', $user->id)
              ->update([
                  'modified_by' => Auth::user()->username,
                  'modified_at' => now(),
                  'row_status' => '-1'
                  ]);
            Alert::success('Berhasil!',"Data user berhasil dihapus.")->persistent('Close');
            return redirect('user');
        }
    }
}
