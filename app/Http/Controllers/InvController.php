<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inv;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class InvController extends Controller
{
    public function index($inv_id = '')
    {


        $invs = Inv::all();
        $users = User::all();

        $inv = null;


        if ($inv_id == '') {
            $inv = $invs->first();
        } else {
            $inv = Inv::find($inv_id);
        }

        // dd($inv);

        return View('inv.index', compact('invs', 'users', 'inv'));
    }

    public function create()
    {

        return View('inv.create');
    }

    public function edit($inv_id)
    {

        $inv = Inv::find($inv_id);
        return View('inv.edit', compact('inv'));
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'desc' => 'required|max:100',
        ]);


        $inv = new Inv();
        $inv->desc = $request->desc;



        if ($request->hasFile('imgpath')) {
            $image = $request->file('imgpath');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/items'), $imageName); // Store in public/images folder
            // You can also store the path in your database if needed
            // e.g., Auth::user()->update(['profile_picture' => $imageName]);

            $inv->imgpath = $imageName;
        }

        $inv->save();


        Alert::success('บันทึกสำเร็จ', 'Success Message');
        return redirect()->route('inv.index');
    }

    public function update(Request $request, $inv_id)
    {

        $this->validate($request, [
            'desc' => 'required|max:100',
        ]);

        $inv = Inv::find($inv_id);
        $inv->desc = $request->desc;

        if ($request->hasFile('imgpath')) {
            $image = $request->file('imgpath');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/items'), $imageName);

            $inv->imgpath = $imageName;
        }

        $inv->save();

        Alert::success('บันทึกสำเร็จ', 'Success Message');
        return redirect()->route('inv.index');

    }


}
