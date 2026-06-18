<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CheckinController extends Controller
{
    public function index($date = '')
    {
        if ($date == '') {
            if (\Carbon\Carbon::now()->format('H') < 6) {
                $date = \Carbon\Carbon::yesterday()->format('Y-m-d');
            } else {
                $date = \Carbon\Carbon::now()->format('Y-m-d');
            }
            // $date = date('Y-m-d');
        } else {

        }

        $checkins = \App\Models\Checkin::where('checkin_date', 'like', "$date%")
            ->orderBy('checkin_date', 'desc')->get();

        return view("checkin.index", compact("checkins", "date"));
    }


    public function check($homenumber = 1, $date = '')
    {


        $homelist = \App\Models\User::where('slotactive', '1')
            ->orderBy('homenumber')
            ->get();

        $users = \App\Models\User::orderBy('fname')
            ->where('homenumber', $homenumber)
            ->get();



        if ($date == '') {

            if (\Carbon\Carbon::now()->format('H') < 6) {
                $date = \Carbon\Carbon::yesterday()->format('Y-m-d');
            } else {
                $date = \Carbon\Carbon::now()->format('Y-m-d');
            }


        } else {
            \Carbon\Carbon::parse($date)->format('Y-m-d');
        }
        // dd($date);

        // dd(\Carbon\Carbon::now()->format('Y-m-d'));


        $checkindesc21 = \App\Models\Checkin::where('checkin_date', $date . ' 21:00:00')
            ->get();
        if ($checkindesc21->count() > 0) {
            $checkindesc21 = $checkindesc21->first()->Checkindesc()->where('homenumber', $homenumber)->get();
        }


        // dd($checkindesc21);

        // dd($checkindesc21);

        // dd($checkindesc21->where('user_id', 21)->first()->check);

        $checkindesc00 = \App\Models\Checkin::where('checkin_date', $date . ' 00:00:00')
            ->get();
        if ($checkindesc00->count() > 0) {
            $checkindesc00 = $checkindesc00->first()->Checkindesc()->where('homenumber', $homenumber)->get();
        }


        $checkindesc22 = \App\Models\Checkin::where('checkin_date', $date . ' 22:00:00')
            ->get();
        if ($checkindesc22->count() > 0) {
            $checkindesc22 = $checkindesc22->first()->Checkindesc()->where('homenumber', $homenumber)->get();
        }



        $checkin21 = \App\Models\Checkin::where('checkin_date', $date . ' 21:00:00')
            ->get();
        $checkin00 = \App\Models\Checkin::where('checkin_date', $date . ' 00:00:00')
            ->get();
        $checkin22 = \App\Models\Checkin::where('checkin_date', $date . ' 22:00:00')
            ->get();

        $checkinothers = \App\Models\Checkin::where('checkin_desc', '!=', 'แอร์ดรอบ 21.00')
            ->where('checkin_desc', '!=', 'แอร์ดรอบ 00.00')
            ->where('checkin_desc', '!=', 'สกายฟอล 22.00')
            ->where('checkin_date', 'like', $date . '%')
            ->get();

        // dd($checkinothers);


        return view("checkin.check", compact(
            "homelist",
            'users',
            'homenumber',
            'date',
            'checkindesc21',
            'checkindesc00',
            'checkindesc22',
            'checkin21',
            'checkin00',
            'checkin22',
            'checkinothers'
        ));
    }

    public function checksave(Request $request, $homenumber, $date)
    {
        // $date = '2025-11-28';
        $checkpost = $request->post();
        // dd($date);

        // dd($checkpost);



        $date = date('Y-m-d', strtotime($date));

        $checkin21 = \App\Models\Checkin::where('checkin_date', $date . ' 21:00:00')
            ->get();
        $checkin00 = \App\Models\Checkin::where('checkin_date', $date . ' 00:00:00')
            ->get();
        $checkin22 = \App\Models\Checkin::where('checkin_date', $date . ' 22:00:00')
            ->get();







        // 21.00 #############################################################################
        if ($checkin21->count() == 0) {
            $checkin = new \App\Models\Checkin();
            $checkin->checkin_desc = 'แอร์ดรอบ 21.00';
            $checkin->checkin_date = $date . ' 21:00:00';
            $checkin->checkin_payment = '0';
            $checkin->checkin_itemdesc = '';
            $checkin->checkin_total = 0;
            $checkin->checkin_member = 0;
            $checkin->save();
            $checkin21 = $checkin;

        } else {
            $checkin21 = $checkin21->first();
        }

        foreach ($checkpost as $key => $value) {

            $item = explode('_', $key); // userid_21_0
            if ($item[0] == 'userid') {

                if ($item[2] == '0') { // if 0 is 21.00

                    $checkdesc = \App\Models\Checkindesc::where('checkin_id', $checkin21->id)
                        ->where('user_id', $item[1])
                        ->get();

                    if (count($checkdesc) == 0) {
                        // echo '0';
                        $user = \App\Models\User::where('id', $item[1])->get()->first();
                        $checkindesc = new \App\Models\Checkindesc();
                        $checkindesc->fname = $user->fname;
                        $checkindesc->lname = $user->lname;
                        $checkindesc->homenumber = $user->homenumber;
                        // $checkindesc->amount = 0;
                        $checkindesc->check = $value;
                        $checkindesc->user_id = $item[1];
                        $checkindesc->checkin_id = $checkin21->id;
                        $checkindesc->save();

                    } else {
                        // echo '1';
                        $checkdesc = \App\Models\Checkindesc::find($checkdesc->first()->id);
                        $checkdesc->check = $value;
                        $checkdesc->save();
                    }

                }

            }
        }



        // 21.00 #############################################################################

        // 22.00 #############################################################################
        if ($checkin22->count() == 0) {
            $checkin = new \App\Models\Checkin();
            $checkin->checkin_desc = 'สกายฟอล 22.00';
            $checkin->checkin_date = $date . ' 22:00:00';
            $checkin->checkin_payment = '0';
            $checkin->checkin_itemdesc = '';
            $checkin->checkin_total = 0;
            $checkin->checkin_member = 0;
            $checkin->save();
            $checkin22 = $checkin;

        } else {
            $checkin22 = $checkin22->first();
        }

        foreach ($checkpost as $key => $value) {

            $item = explode('_', $key); // userid_21_0
            if ($item[0] == 'userid') {

                if ($item[2] == '2') { // if 0 is 22.00

                    $checkdesc = \App\Models\Checkindesc::where('checkin_id', $checkin22->id)
                        ->where('user_id', $item[1])
                        ->get();

                    if (count($checkdesc) == 0) {
                        // echo '0';
                        $user = \App\Models\User::where('id', $item[1])->get()->first();
                        $checkindesc = new \App\Models\Checkindesc();
                        $checkindesc->fname = $user->fname;
                        $checkindesc->lname = $user->lname;
                        $checkindesc->homenumber = $user->homenumber;
                        // $checkindesc->amount = 0;
                        $checkindesc->check = $value;
                        $checkindesc->user_id = $item[1];
                        $checkindesc->checkin_id = $checkin22->id;
                        $checkindesc->save();

                    } else {
                        // echo '1';
                        $checkdesc = \App\Models\Checkindesc::find($checkdesc->first()->id);
                        $checkdesc->check = $value;
                        $checkdesc->save();
                    }
                }
            }
        }


        // 22.00 #############################################################################





        // 00.00 #############################################################################

        if ($checkin00->count() == 0) {
            $checkin = new \App\Models\Checkin();
            $checkin->checkin_desc = 'แอร์ดรอบ 00.00';
            $checkin->checkin_date = $date . ' 00:00:00';
            $checkin->checkin_payment = '0';
            $checkin->checkin_itemdesc = '';
            $checkin->checkin_total = 0;
            $checkin->checkin_member = 0;
            $checkin->save();
            $checkin00 = $checkin;
        } else {
            $checkin00 = $checkin00->first();
        }

        foreach ($checkpost as $key => $value) {

            $item = explode('_', $key); // userid_21_0
            if ($item[0] == 'userid') {

                if ($item[2] == '1') { // if 0 is 00.00

                    $checkdesc = \App\Models\Checkindesc::where('checkin_id', $checkin00->id)
                        ->where('user_id', $item[1])
                        ->get();

                    if (count($checkdesc) == 0) {
                        // echo '0';
                        $user = \App\Models\User::where('id', $item[1])->get()->first();
                        $checkindesc = new \App\Models\Checkindesc();
                        $checkindesc->fname = $user->fname;
                        $checkindesc->lname = $user->lname;
                        $checkindesc->homenumber = $user->homenumber;
                        // $checkindesc->amount = 0;
                        $checkindesc->check = $value;
                        $checkindesc->user_id = $item[1];
                        $checkindesc->checkin_id = $checkin00->id;
                        $checkindesc->save();

                    } else {
                        // echo '1';
                        $checkdesc = \App\Models\Checkindesc::find($checkdesc->first()->id);
                        $checkdesc->check = $value;
                        $checkdesc->save();
                    }

                }

            }
        }



        // #################################  save checkinothers
        foreach ($checkpost as $key => $value) {
            $item = explode('_', $key); // "checkinother_14_61" => null userid   checkinid
            if ($item[0] == 'checkinother') {

                $checkdesc = \App\Models\Checkindesc::where('checkin_id', $item[2])
                    ->where('user_id', $item[1])
                    ->get();

                if (count($checkdesc) == 0) {
                    $user = \App\Models\User::where('id', $item[1])->get()->first();
                    $checkindesc = new \App\Models\Checkindesc();
                    $checkindesc->fname = $user->fname;
                    $checkindesc->lname = $user->lname;
                    $checkindesc->homenumber = $user->homenumber;
                    // $checkindesc->amount = 0;
                    $checkindesc->check = $value;
                    $checkindesc->user_id = $item[1];
                    $checkindesc->checkin_id = $item[2];
                    $checkindesc->save();
                } else {
                    $checkdesc = \App\Models\Checkindesc::find($checkdesc->first()->id);
                    $checkdesc->check = $value;
                    $checkdesc->save();
                }


            }
        }


        // ################################# save checkinothers

        // dd($checkpost);

        Alert::success('บันทึกสำเร็จ', 'Success Message');
        return redirect()->route('checkin.check', [$homenumber, $date]);

        // if ($checkin00->count() == 0) {
        //     $checkin = new \App\Models\Checkin();
        //     $checkin->checkin_desc = 'แอร์ดรอบ 00.00';
        //     $checkin->checkin_date = $date . ' 00:00:00';
        //     $checkin->checkin_payment = '0';
        //     $checkin->checkin_itemdesc = 'กล่องปฐมพยาบาล 5 กล่องตี xx ';
        //     $checkin->checkin_total = 0;
        //     $checkin->checkin_member = 0;
        //     $checkin->save();
        //     $checkin00 = $checkin;

        // } else {

        //     foreach ($checkpost as $key => $value) {

        //         $item = explode('_', $key); // userid_21_0
        //         if ($item[0 != '_token']) {

        //             if ($item[2] == '1') { // if 0 is 21.00

        //                 $checkdesc = \App\Models\Checkindesc::where('checkin_id', $checkin00->first()->id)
        //                     ->where('user_id', $item[1])
        //                     ->get();

        //                 if ($checkdesc->count() == 0) {
        //                     $user = \App\Models\User::where('id', $item[1])->get()->first();
        //                     $checkindesc = new \App\Models\Checkindesc();
        //                     $checkindesc->fname = $user->fname;
        //                     $checkindesc->lname = $user->lname;
        //                     $checkindesc->homenumber = $user->homenumber;
        //                     // $checkindesc->amount = 0;
        //                     $checkindesc->check = $value;
        //                     $checkindesc->user_id = $item[1];
        //                     $checkindesc->checkin_id = $checkin00->first()->id;
        //                     $checkindesc->save();

        //                 } else {
        //                     $checkdesc = \App\Models\Checkindesc::find($checkdesc->first()->id);
        //                     $checkdesc->check = $value;
        //                     $checkdesc->save();
        //                 }

        //             }

        //         }
        //     }




        // }


        // 00.00 #############################################################################











        // array:13 [▼
//   "_token" => "CHVW64Zkh8yLDepa1ypyxpGkHJIcvzVhZvAxRih8"
//   "userid_21_0" => "0"
//   "userid_21_1" => "0"
//   "userid_25_0" => "0"
//   "userid_25_1" => "0"
//   "userid_20_0" => "0"
//   "userid_20_1" => "0"
//   "userid_12_0" => "0"
//   "userid_12_1" => "0"
//   "userid_14_0" => "0"
//   "userid_14_1" => "0"
//   "userid_4_0" => "0"
//   "userid_4_1" => "0"
// ]


        // dd($checkin21);




        // dd($check0);






    }

    public function payment($checkin_id, $date)
    {
        $checkin = \App\Models\Checkin::find($checkin_id);
        $users = \App\Models\User::orderBy('fname')->get();

        return View('checkin.payment', compact('checkin', 'users', 'date'));

    }

    public function paymentupdate($checkin_id, Request $request, $date)
    {
        // dd($request);
        if ($request->checkin_payment == '1') {


            if ($request->checkin_payerid == '0') {
                Alert::error('จำเป็นต้องระบุคนจ่ายเงิน', 'Error Message');
                return redirect()->route('checkin.payment', [$checkin_id, $date]);


            } else {

                if ($request->checkin_lock == '0') {
                    Alert::error('จำเป็นต้องปิดเช็คชื่อ', 'Error Message');
                    return redirect()->route('checkin.payment', [$checkin_id, $date]);
                } else {
                    $checkin = \App\Models\Checkin::find($checkin_id);





                    $checkin->checkin_payerid = $request->checkin_payerid;
                    $checkin->checkin_payment = $request->checkin_payment;
                    $checkin->checkin_win = $request->checkin_win;
                    $checkin->checkin_itemdesc = $request->checkin_itemdesc;
                    $checkin->checkin_lock = $request->checkin_lock;
                    $checkin->checkin_total = $request->checkin_total;
                    $checkin->save();


                    // 
                    $qty = $checkin->checkindesc->where('check', '1')->count();

                    if ($checkin->checkin_total > 0) {

                        $paid1 = $checkin->checkin_total / $qty;

                        $checkindescs = \App\Models\Checkindesc::where('checkin_id', $checkin->id)
                            ->where('check', '1')->get();
                        // dd($checkindescs);

                        foreach ($checkindescs as $checkindesc) {
                            $checkindesc->amount = number_format($paid1, 0, '.', '');
                            $checkindesc->save();
                        }





                    }
                    // dd($qty);




                    Alert::success('บันทึกสำเร็จ', 'Success Message');
                    return redirect()->route('checkin.payment', [$checkin_id, $date]);
                }


            }

        } else {

            $checkin = \App\Models\Checkin::find($checkin_id);

            $checkin->checkin_payerid = $request->checkin_payerid;
            $checkin->checkin_payment = $request->checkin_payment;
            $checkin->checkin_win = $request->checkin_win;
            $checkin->checkin_itemdesc = $request->checkin_itemdesc;
            $checkin->checkin_lock = $request->checkin_lock;
            $checkin->checkin_total = $request->checkin_total;
            $checkin->save();


            $checkindescs = \App\Models\Checkindesc::where('checkin_id', $checkin->id)
                ->get();
            // dd($checkindescs);

            foreach ($checkindescs as $checkindesc) {
                $checkindesc->amount = 0;
                $checkindesc->save();
            }




            Alert::success('บันทึกสำเร็จ', 'Success Message');
            return redirect()->route('checkin.payment', [$checkin_id, $date]);



        }

    }

    public function checksave2(Request $request)
    {


        $this->validate($request, [
            'checkin_desc' => 'required|max:100',
        ]);


        $checkin = new \App\Models\Checkin();
        $checkin->checkin_desc = $request->checkin_desc;
        $checkin->checkin_date = $request->checkin_date . ' ' . $request->checkin_datehh . ':' . $request->checkin_datemm . ':01';

        // dd( $checkin);
        $checkin->save();

        Alert::success('บันทึกสำเร็จ', 'Success Message');
        return redirect()->route('checkin.index');


    }

    public function destroy($checkin_id)
    {

        $checkin = \App\Models\Checkin::find($checkin_id);


        $checkindescs = \App\Models\Checkindesc::where('checkin_id', $checkin_id)->get();

        // dd($checkindescs);

        foreach ($checkindescs as $checkindesc) {
            $checkindesc->delete();
        }


        $checkin->delete();

        Alert::success('บันทึกสำเร็จ', 'Success Message');
        return redirect()->route('checkin.index')->with('success', '');

    }

}
