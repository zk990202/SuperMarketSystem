<?php
/**
 * Created by PhpStorm.
 * User: Kai.Z
 * Date: 2018/5/6
 * Time: 22:27
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Excel;

class MainController extends Controller
{

    public function selectPageProducts(){
        $user = Auth::user();

        $category = DB::select('select distinct category from products');
        $name = DB::select('select distinct name from products');
        $brand = DB::select('select distinct brand from products');
        $size = DB::select('select distinct size from products');
        $color = DB::select('select distinct color from products');
        $for_crowd = DB::select('select distinct forcrowd from products');
        $date = DB::select('select distinct date from products');
        $place = DB::select('select distinct place from products');

        $viewData = [
            'user' => $user,
            'category' => $category,
            'name' => $name,
            'brand' => $brand,
            'size' => $size,
            'color' => $color,
            'for_crowd' => $for_crowd,
            'date' => $date,
            'place' => $place
        ];

        return view('selectPageProducts-TEST', $viewData);
    }

    public function selectPageSales(){
        $user = Auth::user();

        $category = DB::select('select distinct category from products');
        $name = DB::select('select distinct name from products');
        $brand = DB::select('select distinct brand from products');
        $size = DB::select('select distinct size from products');
        $color = DB::select('select distinct color from products');
        $for_crowd = DB::select('select distinct forcrowd from products');
        $date = DB::select('select distinct date from products');
        $place = DB::select('select distinct place from products');

        $viewData = [
            'user' => $user,
            'category' => $category,
            'name' => $name,
            'brand' => $brand,
            'size' => $size,
            'color' => $color,
            'for_crowd' => $for_crowd,
            'date' => $date,
            'place' => $place
        ];

        return view('selectPageSales-TEST', $viewData);
    }

    public function selectProducts(Request $request){
        $user = Auth::user();

        $category = $request->input('category');
        $name = $request->input('name');
        $brand = $request->input('brand');
        $size = $request->input('size');
        $color = $request->input('color');
        $for_crowd = $request->input('for_crowd');
        $date = $request->input('date');
        $place = $request->input('place');

        $result = [];
        if ($category == '服装'){
            $result = DB::select('SELECT * FROM products 
                    WHERE name = ? AND brand = ? AND size = ? AND color = ? AND forcrowd = ?',
                [$name, $brand, $size, $color, $for_crowd]);
        }
        elseif ($category == '食品'){
            $result = DB::select('SELECT * FROM products 
                    WHERE name = ? AND brand = ? AND date = ? AND place = ?',
                [$name, $brand, $date, $place]);
        }
//        dd($result);
        return view('selectProducts', ['user' => $user, 'result' => $result]);
    }

    public function selectSales(Request $request){
        $user = Auth::user();

        $category = $request->input('category');
        $name = $request->input('name');
        $brand = $request->input('brand');
        $size = $request->input('size');
        $color = $request->input('color');
        $for_crowd = $request->input('for_crowd');
        $date = $request->input('date');
        $place = $request->input('place');
        $start_date = $request->input('startTime');
        $end_date = $request->input('endTime');
//        dd($start_date);

        $id = [];
        if ($category == '服装'){
            $id = DB::select('SELECT id FROM products 
                    WHERE name = ? AND brand = ? AND size = ? AND color = ? AND forcrowd = ?',
                [$name, $brand, $size, $color, $for_crowd]);
        }
        elseif ($category == '食品'){
            $id = DB::select('SELECT id FROM products 
                    WHERE name = ? AND brand = ? AND date = ? AND place = ?',
                [$name, $brand, $date, $place]);
        }

        $result = [];
        foreach ($id as $item => $value){
            $product_id = $value->id;
            $result = DB::select('SELECT * FROM sales_records 
                JOIN products ON sales_records.pid = products.id
                WHERE pid = ? AND time > ? AND time < ?' ,
                [$product_id, $start_date, $end_date]);
        }
        return view('selectSales', ['user' => $user, 'result' => $result]);
    }

    public function dropOffPage(){
        $user = Auth::user();
        $products = DB::select('SELECT * FROM products');
        return view('dropOffPage', ['user' => $user, 'products' => $products]);
    }

    public function dropOff(Request $request){
        $user = Auth::user();
        $pid = $request->input('id');
        $reason0 = $request->input('reason');
        $reason1 = array_filter($reason0); //去除空值
        $reason = [];
        //让新的数组下标连续
        $i = 0;
        foreach ($reason1 as $value){
            $reason[$i] = $value;
            $i++;
        }
        for ($i = 0; $i < count($pid); $i++){
            date_default_timezone_set('Asia/Shanghai');
            $current_time = date('Y-m-d H:i:s');

            DB::delete('DELETE FROM products WHERE id = ?', [$pid[$i]]);
            DB::insert('INSERT INTO drop_off_products(pid, drop_off_time, drop_off_reason) VALUES (?, ?, ?)',
                [$pid[$i], $current_time, $reason[$i]]);
        }

        $viewData = [
            'user' => $user,
            'title' => '提示信息',
            'message' => '恭喜，下架成功!',
            'url' => url('/drop-off-page'),
            'url_message' => '继续下架商品'
        ];

        return view('CommitSuccessfully', $viewData);
    }

    public function statisticsDay(){
        $user = Auth::user();

        $result = DB::select('SELECT S.pid, P.name, P.brand,SUM(S.pamount) AS allamount, S.unitprice, (SUM(S.pamount) * S.unitprice) AS allprice, DATE_FORMAT(S.time, \'%Y-%m-%d\') AS new_time
            FROM sales_records S
            JOIN products P ON S.pid = P.id
            WHERE S.time = to_days(now())
            GROUP BY S.pid, P.name, P.brand,  S.unitprice, new_time' );

//        $test = DB::select('select @@sql_mode');
        return view('statistics', ['user' => $user, 'result' => $result, 'type' => 'day']);
    }

    public function statisticsWeek(){
        $user = Auth::user();

        $result = DB::select('SELECT S.pid, P.name, P.brand,SUM(S.pamount) AS allamount, S.unitprice, (SUM(S.pamount) * S.unitprice) AS allprice, DATE_FORMAT(now(),\'%Y-%u周\') AS new_time
            FROM sales_records S
            JOIN products P ON S.pid = P.id
            WHERE YEARWEEK(date_format(S.time,\'%Y-%m-%d\')) = YEARWEEK(now())
            GROUP BY S.pid, P.name, P.brand,  S.unitprice, new_time' );

        return view('statistics', ['user' => $user, 'result' => $result, 'type' => 'week']);
    }

    public function statisticsMonth(){
        $user = Auth::user();

        $result = DB::select('SELECT S.pid, P.name, P.brand,SUM(S.pamount) AS allamount, S.unitprice, (SUM(S.pamount) * S.unitprice) AS allprice, DATE_FORMAT(S.time, \'%Y-%m月\') AS new_time
            FROM sales_records S
            JOIN products P ON S.pid = P.id
            WHERE DATE_FORMAT(S.time,\'%Y%m\') = DATE_FORMAT( CURDATE() , \'%Y%m\' )
            GROUP BY S.pid, P.name, P.brand,  S.unitprice, new_time' );

        return view('statistics', ['user' => $user, 'result' => $result, 'type' => 'month']);
    }

    public function statisticsSeason(){
        $user = Auth::user();

        $result = DB::select('SELECT S.pid, P.name, P.brand,SUM(S.pamount) AS allamount, S.unitprice, (SUM(S.pamount) * S.unitprice) AS allprice, concat(date_format(S.time, \'%Y-季度\'),FLOOR((date_format(time, \'%m\')+2)/3)) AS new_time
            FROM sales_records S
            JOIN products P ON S.pid = P.id
            WHERE QUARTER(S.time)=QUARTER(now())
            GROUP BY S.pid, P.name, P.brand,  S.unitprice, new_time' );

        return view('statistics', ['user' => $user, 'result' => $result, 'type' => 'season']);
    }

    public function statisticsYear(){
        $user = Auth::user();

        $result = DB::select('SELECT S.pid, P.name, P.brand,SUM(S.pamount) AS allamount, S.unitprice, (SUM(S.pamount) * S.unitprice) AS allprice, DATE_FORMAT(S.time, \'%Y\') AS new_time
            FROM sales_records S
            JOIN products P ON S.pid = P.id
            WHERE YEAR(S.time)=YEAR(NOW())
            GROUP BY S.pid, P.name, P.brand,  S.unitprice, new_time' );

        return view('statistics', ['user' => $user, 'result' => $result, 'type' => 'year']);
    }

    public function excelExport(Request $request){
        $pid = $request->input('pid');
        $allamount = $request->input('allamount');
        $unitprice = $request->input('unitprice');
        $allprice = $request->input('allprice');
        $timegroup = $request->input('timegroup');

        $cellData = [
            ['学号','姓名','成绩'],
            ['10001','AAAAA','99'],
            ['10002','BBBBB','92'],
            ['10003','CCCCC','95'],
            ['10004','DDDDD','89'],
            ['10005','EEEEE','96'],
        ];
        Excel::create('学生成绩',function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xls');
    }

//    public function test(){
//        $cellData = [
//            ['学号','姓名','成绩'],
//            ['10001','AAAAA','99'],
//            ['10002','BBBBB','92'],
//            ['10003','CCCCC','95'],
//            ['10004','DDDDD','89'],
//            ['10005','EEEEE','96'],
//        ];
//        Excel::create('学生成绩',function($excel) use ($cellData){
//            $excel->sheet('score', function($sheet) use ($cellData){
//                $sheet->rows($cellData);
//            });
//        })->export('xls');
//    }


    public function purchasePage(){
        $user = Auth::user();
        $products = DB::select('SELECT * FROM products WHERE amount < 10');
        return view('purchasePage', ['user' => $user, 'products' => $products]);
    }

    public function purchase(Request $request){
        $user = Auth::user();
        $pid = $request->input('id');
        $pamount0 = $request->input('pamount');
        $pamount1 = array_filter($pamount0); //去除空值
        $pamount = [];
        //让新的数组下标连续
        $i = 0;
        foreach ($pamount1 as $value){
            $pamount[$i] = $value;
            $i++;
        }
        for ($j = 0; $j < count($pid); $j++){
            date_default_timezone_set('Asia/Shanghai');
            $current_time = date('Y-m-d');

            $products = DB::select('SELECT price FROM products WHERE id = ?', [$pid[$j]]);
            $unitprice = $products[0]->price;
            $totalprice = $unitprice * $pamount[$j];

            DB::update('UPDATE products SET amount = amount + ? WHERE id = ?', [$pamount[$j], $pid[$j]]);
            DB::insert('INSERT INTO purchase_records(time, pid, pamount, unitprice, totalprice) VALUES (?, ?, ?, ?, ?)',
                [$current_time, $pid[$j], $pamount[$j], $unitprice, $totalprice]);
        }
        $viewData = [
            'user' => $user,
            'title' => '提示信息',
            'message' => '恭喜，进货成功!',
            'url' => url('/purchase-page'),
            'url_message' => '继续进货'
        ];

        return view('CommitSuccessfully', $viewData);
    }

    public function salePage(){
        $user = Auth::user();
        $products = DB::select('SELECT * FROM products WHERE amount > 0');
        return view('salePage', ['user' => $user, 'products' => $products]);
    }
    
    public function sale(Request $request){
        $user = Auth::user();
        $pid = $request->input('id');
        $s_amount0 = $request->input('s_amount');
        $s_amount1 = array_filter($s_amount0); //去除空值
        $s_amount = [];
        //让新的数组下标连续
        $i = 0;
        foreach ($s_amount1 as $value){
            $s_amount[$i] = $value;
            $i++;
        }
        for ($j = 0; $j < count($pid); $j++){
//            DB::transaction(function ($pid, $s_amount, $j) use ($pid, $s_amount, $j){
                date_default_timezone_set('Asia/Shanghai');
                $current_time = date('Y-m-d');

                $products = DB::select('SELECT price FROM products WHERE id = ?', [$pid[$j]]);
                $unitprice = $products[0]->price;
                $totalprice = $unitprice * $s_amount[$j];

                DB::update('UPDATE products SET amount = amount - ? WHERE id = ?', [$s_amount[$j], $pid[$j]]);
                DB::insert('INSERT INTO sales_records(time, pid, pamount, unitprice, totalprice) VALUES (?, ?, ?, ?, ?)',
                    [$current_time, $pid[$j], $s_amount[$j], $unitprice, $totalprice]);

                $amount = DB::select('SELECT amount FROM products WHERE id = ?', [$pid[$j]])[0]->amount;
                if ($amount < 5){
                    DB::update('UPDATE users SET receive_request = 1 WHERE role = 3');
                }
//            });
        }
        $viewData = [
            'user' => $user,
            'title' => '提示信息',
            'message' => '恭喜，购买成功!',
            'url' => url('/sale-page'),
            'url_message' => '继续购买'
        ];
        return view('CommitSuccessfully', $viewData);
    }


}