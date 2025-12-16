<?php

namespace App\Http\Controllers;

use App\Models\Invdesc;
use App\Models\Invowner;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InvdescController extends Controller
{
    public function store(Request $request)
    {


        $this->validate($request, [
            // 'note' => 'required|max:100',
            // 'type' => 'required|gt:0',
            'amount' => 'required|gt:0',
            'user_id' => 'required|gt:0',
            'inv_id' => 'required|gt:0',
        ]);

        $invdesc = new Invdesc();
        $invdesc->note = $request->note;
        $invdesc->type = $request->type;
        $invdesc->amount = $request->amount;
        $invdesc->user_id = $request->user_id;
        $invdesc->inv_id = $request->inv_id;
        $invdesc->save();

        // เบิกเกิน


        //save owner 
        $invowner = Invowner::where('user_id', $request->user_id)
            ->where('inv_id', $request->inv_id)
            ->get();

        if (count($invowner) > 0) {
            $invowner = $invowner->first();
            if ($request->type == '0') {
                $invowner->amount = $invowner->amount + $request->amount;
            } else {
                if ($invowner->amount < $request->amount) {
                    Alert::error('เบิกเกินจากจำนวนที่มี', 'Error Message');
                    return redirect()->route('inv.index', $request->inv_id);
                } else {
                    $invowner->amount = $invowner->amount - $request->amount;
                }

            }

            $invowner->save();

        } else {
            if ($request->type == '0') {
                $invowner = new Invowner();
                $invowner->user_id = $request->user_id;
                $invowner->inv_id = $request->inv_id;
                $invowner->amount = $request->amount;
                $invowner->save();
            } else {
                Alert::error('เบิกเกินจากจำนวนที่มี', 'Error Message');
                return redirect()->route('inv.index', $request->inv_id);
            }


        }






        Alert::success('บันทึกสำเร็จ', 'Success Message');
        return redirect()->route('inv.index', $request->inv_id);
    }
}
