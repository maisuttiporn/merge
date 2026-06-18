<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByRaw('CONVERT(slotnumber, SIGNED)')->get();
        return View('user.index', compact('users'));
    }

    public function create()
    {
        return View('user.create');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return View('user.edit', compact('user'));
    }

    public function store(Request $request)
    {
        // dd($request->status);


        $this->validate($request, [
            'fname' => 'required|max:100',
            'lname' => 'required|max:100',
            'phone' => 'required|max:100',
            // 'homenumber' => 'required|gt:0',
        ]);
        $status = 0;
        if($request->status == 1) {
            $status = 1;
        }

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'phone' => $request->phone,
            'homesup' => $request->homesup,
            'homenumber' => $request->homenumber,
            'slotnumber' => $request->slotnumber,
            'slotactive' => $request->slotactive,
            'status' => $status,
            'gun' => $request->gun,

            'username' => $request->phone,
            'password' => bcrypt($request->phone),
        ]);

        Alert::success('บันทึกสำเร็จ', 'Success Message');
        return redirect()->route('user.index')->with('success', '');
    }


    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'fname' => 'required|max:100',
            'lname' => 'required|max:100',
            'phone' => 'required|max:100',
            // 'homenumber' => 'required|gt:0',
        ]);

        $user = User::find($id);

        $status = 0;
        if($request->status == 1) {
            $status = 1;
        }

        

        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->phone = $request->phone;
        $user->homesup = $request->homesup;
        $user->homenumber = $request->homenumber;
        $user->slotnumber = $request->slotnumber;
        $user->slotactive = $request->slotactive;
        $user->status = $status;
        $user->gun = $request->gun;

        $user->username = $request->phone;
        $user->password = bcrypt($request->phone);


        $user->save();

        Alert::success('บันทึกสำเร็จ', 'Success Message');
        return redirect()->route('user.edit', $id)->with('success', '');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', '');
    }
}
