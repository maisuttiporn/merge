<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $datas = [

            ['Esso', 'Luvter', '0', '0', '1', '1', '1','4'],
            ['Betty', 'Westwood', '35622', '0', '2', '1', '1','2'],
            ['Zheps', 'Baancoke', '65211', '0', '3', '1', '1','2'],
            ['Snim', 'Croft', '75612', '0', '4', '1', '1','1'],
            ['Jxyson', 'Trillest', '24708', '1', '5', '1', '1','5'],
            ['Alvin', 'WatDaiTukTua', '13950', '0', '6', '1', '1','3'],
            ['Ro', 'TNP', '92248', '1', '7', '1', '1','3'],
            ['Coco', 'Voyage', '74638', '0', '8', '1', '1','2'],
            ['Kiwi', 'Targayen', '97616', '1', '9', '1', '1','4'],
            ['Tum', 'Ggez', '36747', '0', '10', '1', '1','3'],
            ['Yoyo', 'Trillest', '10748', '0', '11', '1', '1','5'],
            ['Poploy', 'Moset', '71221', '0', '12', '1', '1','1'],
            ['Beb', 'Raikaat', '81081', '0', '13', '1', '1','2'],
            ['Real', 'Hmeee', '82901', '0', '14', '1', '1','1'],
            ['Mary', 'Jxn', '36627', '0', '15', '1', '1','5'],
            ['Time', 'Trillest', '0', '0', '16', '1', '1','5'],
            ['Txrbo', 'Raikaat', '23343', '0', '17', '1', '1','2'],
            ['Aezen', 'Trillest', '47539', '0', '18', '1', '1','5'],
            ['Luna', 'Corleone', '98339', '0', '19', '1', '1','4'],
            ['Orty', 'Mangkornjaochu', '77812', '1', '20', '1', '1','1'],
            ['Eikq', 'Sirivaradeechtanakul', '52257', '0', '21', '1', '1','1'],
            ['Apex', 'Asewahemthenwankulwong', '33869', '0', '22', '1', '1','4'],
            ['Zenooo', 'Justwannaknow', '21236', '1', '23', '1', '1','2'],
            ['Mikey', 'Trillest', '0', '0', '24', '1', '1','5'],
            ['Moji', 'Wisejworawej', '47783', '0', '25', '1', '1','1'],
            ['PP', 'Spanser', '70322', '0', '26', '1', '1','3'],
            ['Muyu', 'Atreides', '19551', '0', '27', '1', '1','4'],
            ['Kraken', 'Aonglong', '0', '0', '28', '1', '1','3'],
            ['Childe', 'Atreides', '39484', '0', '29', '1', '1','4'],
            ['Verse', 'Certifiedredflag', '80266', '0', '30', '1', '1','3'],

        ];


        foreach ($datas as $data) {
            \DB::table('users')->insert([
                'fname' => $data[0],
                'lname' => $data[1],
                'phone' => $data[2],
                'homesup' => $data[3],
                'slotnumber' => $data[4],
                'slotactive' => $data[5],
                'status' => $data[6],
                'homenumber' => $data[7],


                'username' => $data[2],
                'password' => bcrypt($data[2]),

                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

    }
}
