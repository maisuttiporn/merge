<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class PaymentController extends Controller
{
    public function index()
    {

        $users = \App\Models\User::orderBy('fname')->get();

        $checkindescs = \App\Models\Checkindesc::where('paidstat', '0')

            ->whereHas('checkin', function ($q) {
                $q->where('checkin_payment', '1');
                // $q->where('check', '1');
            })
            ->where('check', '1')
            ->get();

        // dd($checkindescs);

        $checkins = \App\Models\Checkin::where('checkin_payment', '1')
            ->whereHas('checkindesc', function ($q)  {
                $q->where('check', '1');
                $q->where('paidstat', '0');
            })
            ->orderBy('checkin_payerid')
            ->get();

        return view("payment.index", compact('users', 'checkindescs', 'checkins'));
    }

    public function desc($user_id)
    {

        $checkins = \App\Models\Checkin::where('checkin_payment', '1')
            ->whereHas('checkindesc', function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
                $q->where('check', '1');
                $q->where('paidstat', '0');
            })
            ->orderBy('checkin_payerid')
            ->get();


        $checkinpaids = \App\Models\Checkin::where('checkin_payment', '1')
            ->whereHas('checkindesc', function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
                $q->where('check', '1');
                $q->where('paidstat', '1');
            })
            ->orderBy('id')
            ->get();

        // dd($checkins);

        if (count($checkins) == 0) {
            $payerid = null;
        } else {
            $payerid = $checkins->first()->checkin_payerid;
        }



        $user = \App\Models\User::find($user_id);
        return view('payment.desc', compact('user', 'checkins', 'user_id', 'payerid', 'checkinpaids'));
    }

    public function update($user_id, $payerid)
    {
        $checkindescs = \App\Models\Checkindesc::where('user_id', $user_id)
            ->where('check', '1')
            ->where('paidstat', '0')
            ->whereHas('checkin', function ($q) use ($payerid) {
                $q->where('checkin_payment', '1');
                $q->where('checkin_payerid', $payerid);
            })
            ->get();

        foreach ($checkindescs as $checkindesc) {
            $checkindesc->paidstat = '1';
            $checkindesc->paid = $checkindesc->amount;
            $checkindesc->save();
        }

        Alert::success('บันทึกสำเร็จ', 'Success Message');
        return redirect()->route('payment.desc', $user_id);
    }


}
