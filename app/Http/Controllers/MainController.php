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

        $category = DB::select('select distinct category from products WHERE is_drop = 0');
        $name = DB::select('select distinct name from products WHERE is_drop = 0');
        $brand = DB::select('select distinct brand from products WHERE is_drop = 0');
        $init_size = DB::select('select distinct size from products WHERE is_drop = 0');
        $init_color = DB::select('select distinct color from products WHERE is_drop = 0');
        $init_for_crowd = DB::select('select distinct forcrowd from products WHERE is_drop = 0');
        $init_date = DB::select('select distinct date from products WHERE is_drop = 0');
        $init_place = DB::select('select distinct place from products WHERE is_drop = 0');

        //去除空的值
        $size = [];
        $item = 0;
        foreach ($init_size as $value){
            if ($value -> size){
                $size[$item] = $value;
                $item++;
            }
            continue;
        }

        $color = [];
        $item = 0;
        foreach ($init_color as $value){
            if ($value -> color){
                $color[$item] = $value;
                $item++;
            }
            continue;
        }

        $for_crowd = [];
        $item = 0;
        foreach ($init_for_crowd as $value){
            if ($value -> forcrowd){
                $for_crowd[$item] = $value;
                $item++;
            }
            continue;
        }

        $date = [];
        $item = 0;
        foreach ($init_date as $value){
            if ($value -> date){
                $date[$item] = $value;
                $item++;
            }
            continue;
        }

        $place = [];
        $item = 0;
        foreach ($init_place as $value){
            if ($value -> place){
                $place[$item] = $value;
                $item++;
            }
            continue;
        }

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

        $category = DB::select('select distinct category from products WHERE is_drop = 0');
        $name = DB::select('select distinct name from products WHERE is_drop = 0');
        $brand = DB::select('select distinct brand from products WHERE is_drop = 0');
        $init_size = DB::select('select distinct size from products WHERE is_drop = 0');
        $init_color = DB::select('select distinct color from products WHERE is_drop = 0');
        $init_for_crowd = DB::select('select distinct forcrowd from products WHERE is_drop = 0');
        $init_date = DB::select('select distinct date from products WHERE is_drop = 0');
        $init_place = DB::select('select distinct place from products WHERE is_drop = 0');

        //去除空的值
        $size = [];
        $item = 0;
        foreach ($init_size as $value){
            if ($value -> size){
                $size[$item] = $value;
                $item++;
            }
            continue;
        }

        $color = [];
        $item = 0;
        foreach ($init_color as $value){
            if ($value -> color){
                $color[$item] = $value;
                $item++;
            }
            continue;
        }

        $for_crowd = [];
        $item = 0;
        foreach ($init_for_crowd as $value){
            if ($value -> forcrowd){
                $for_crowd[$item] = $value;
                $item++;
            }
            continue;
        }

        $date = [];
        $item = 0;
        foreach ($init_date as $value){
            if ($value -> date){
                $date[$item] = $value;
                $item++;
            }
            continue;
        }

        $place = [];
        $item = 0;
        foreach ($init_place as $value){
            if ($value -> place){
                $place[$item] = $value;
                $item++;
            }
            continue;
        }

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
                    WHERE category = \'服装\'
                    AND (name = ? OR ? IS NULL ) 
                    AND (brand = ? OR ? IS NULL) 
                    AND (size = ? OR ? IS NULL ) 
                    AND (color = ? OR ? IS NULL ) 
                    AND (forcrowd = ? OR ? IS NULL )
                    AND is_drop = 0',
                [$name, $name, $brand, $brand, $size, $size, $color, $color,$for_crowd ,$for_crowd]);
        }
        elseif ($category == '食品'){
            $result = DB::select('SELECT * FROM products 
                    WHERE category = \'食品\'
                    AND (name = ? OR ? IS NULL ) 
                    AND (brand = ? OR ? IS NULL ) 
                    AND (date = ? OR ? IS NULL ) 
                    AND (place = ? OR ? IS NULL )
                    AND is_drop = 0',
                [$name, $name, $brand, $brand, $date, $date, $place, $place]);
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
                    WHERE category = \'服装\'
                    AND (name = ? OR ? IS NULL ) 
                    AND (brand = ? OR ? IS NULL) 
                    AND (size = ? OR ? IS NULL ) 
                    AND (color = ? OR ? IS NULL ) 
                    AND (forcrowd = ? OR ? IS NULL )
                    AND is_drop = 0',
                [$name, $name, $brand, $brand, $size, $size, $color, $color,$for_crowd ,$for_crowd]);
        }
        elseif ($category == '食品'){
            $id = DB::select('SELECT id FROM products 
                    WHERE category = \'食品\'
                    AND (name = ? OR ? IS NULL ) 
                    AND (brand = ? OR ? IS NULL ) 
                    AND (date = ? OR ? IS NULL ) 
                    AND (place = ? OR ? IS NULL )
                    AND is_drop = 0',
                [$name, $name, $brand, $brand, $date, $date, $place, $place]);
        }


        $result = [];
        foreach ($id as $item => $value){
            $product_id = $value->id;
            $result[$item] = DB::select('SELECT * FROM sales_records 
                JOIN products ON sales_records.pid = products.id
                WHERE sales_records.pid = ? AND sales_records.time > ? AND sales_records.time < ?' ,
                [$product_id, $start_date, $end_date]);
        }
//        dd($result);
        $new_result = [];
        $item = 0;
        foreach ($result as $value1){
            foreach ($value1 as $value2){
                $new_result[$item] = $value2;
                $item++;
            }
        }
//        dd($new_result);

        return view('selectSales', ['user' => $user, 'result' => $new_result]);
    }

    public function dropOffPage(){
        $user = Auth::user();
        $products = DB::select('SELECT * FROM products WHERE is_drop = 0');
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

            DB::update('UPDATE products SET is_drop = 1 WHERE id = ?', [$pid[$i]]);
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

    public function dropOffSelect(){
        $user = Auth::user();
        $result = DB::select('SELECT * FROM drop_off_products 
              JOIN products ON drop_off_products.pid = products.id');
//        dd($result);

        return view('dropOffSelect', ['user' => $user, 'result' => $result]);
    }


    public function statisticsDay(){
        $user = Auth::user();

        $result = DB::select('SELECT S.pid, P.name, P.brand,SUM(S.pamount) AS allamount, S.unitprice, (SUM(S.pamount) * S.unitprice) AS allprice, DATE_FORMAT(S.time, \'%Y-%m-%d\') AS new_time
            FROM sales_records S
            JOIN products P ON S.pid = P.id
            WHERE S.time = to_days(now())
            AND is_drop = 0
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
            AND is_drop = 0
            GROUP BY S.pid, P.name, P.brand,  S.unitprice, new_time' );

        return view('statistics', ['user' => $user, 'result' => $result, 'type' => 'week']);
    }

    public function statisticsMonth(){
        $user = Auth::user();

        $result = DB::select('SELECT S.pid, P.name, P.brand,SUM(S.pamount) AS allamount, S.unitprice, (SUM(S.pamount) * S.unitprice) AS allprice, DATE_FORMAT(S.time, \'%Y-%m月\') AS new_time
            FROM sales_records S
            JOIN products P ON S.pid = P.id
            WHERE DATE_FORMAT(S.time,\'%Y%m\') = DATE_FORMAT( CURDATE() , \'%Y%m\' )
            AND is_drop = 0
            GROUP BY S.pid, P.name, P.brand,  S.unitprice, new_time' );

        return view('statistics', ['user' => $user, 'result' => $result, 'type' => 'month']);
    }

    public function statisticsSeason(){
        $user = Auth::user();

        $result = DB::select('SELECT S.pid, P.name, P.brand,SUM(S.pamount) AS allamount, S.unitprice, (SUM(S.pamount) * S.unitprice) AS allprice, concat(date_format(S.time, \'%Y-季度\'),FLOOR((date_format(time, \'%m\')+2)/3)) AS new_time
            FROM sales_records S
            JOIN products P ON S.pid = P.id
            WHERE QUARTER(S.time)=QUARTER(now())
            AND is_drop = 0
            GROUP BY S.pid, P.name, P.brand,  S.unitprice, new_time' );

        return view('statistics', ['user' => $user, 'result' => $result, 'type' => 'season']);
    }

    public function statisticsYear(){
        $user = Auth::user();

        $result = DB::select('SELECT S.pid, P.name, P.brand,SUM(S.pamount) AS allamount, S.unitprice, (SUM(S.pamount) * S.unitprice) AS allprice, DATE_FORMAT(S.time, \'%Y\') AS new_time
            FROM sales_records S
            JOIN products P ON S.pid = P.id
            WHERE YEAR(S.time)=YEAR(NOW())
            AND is_drop = 0
            GROUP BY S.pid, P.name, P.brand,  S.unitprice, new_time' );

        return view('statistics', ['user' => $user, 'result' => $result, 'type' => 'year']);
    }

    public function excelExport(Request $request){
        $pid = $request->input('pid');
        $name = $request->input('name');
        $brand = $request->input('brand');
        $allamount = $request->input('allamount');
        $unitprice = $request->input('unitprice');
        $allprice = $request->input('allprice');
        $new_time = $request->input('new_time');

        $fileName = "商品销售信息".$new_time[0];

        $title = [
            ['商品编号','商品名称','商品品牌', '价格', '销售数量', '销售金额', '销售时间']
        ];

        $cellData = [];
        for ($i = 0; $i < count($pid); $i++){
            $cellData[$i] = [$pid[$i], $name[$i], $brand[$i], $unitprice[$i], $allamount[$i], $allprice[$i], $new_time[$i]];
        }

        $finalData = array_merge($title, $cellData);

        Excel::create($fileName, function($excel) use ($finalData){
            $excel->sheet('sales_record', function($sheet) use ($finalData){
                $sheet->rows($finalData);
            });
        })->export('xls');
    }

//    public function test(){
////        $filename = "document.txt";
////        header('Content-Type: application/octet-stream');
////        header('Content-Disposition: attachment; filename=' . $filename);
////        print "Hello!";
//
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

    public function purchaseNewPage(){
        $user = Auth::user();
        return view('purchaseNewPage', ['user' => $user]);
    }

    public function purchaseNew(Request $request){
        $user = Auth::user();

        $category = $request->input('category');
        $name = $request->input('name');
        $brand = $request->input('brand');
        $price = $request->input('price');
        $purchase_price = $request->input('purchase_price');
        $amount = $request->input('amount');
        $size = $request->input('size');
        $color = $request->input('color');
        $for_crowd = $request->input('for_crowd');
        $date = $request->input('date');
        $place = $request->input('place');

        date_default_timezone_set('Asia/Shanghai');
        $current_time = date('Y-m-d');

        if ($category == '服装'){
            DB::transaction(function () use ($category, $name, $brand, $price, $amount, $size, $color, $for_crowd, $purchase_price, $current_time){
                DB::insert('INSERT INTO products(category, name, brand, price, amount, size, color, forcrowd ) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
                    [$category, $name, $brand, $price, $amount, $size, $color, $for_crowd]);

                $pid = DB::select('SELECT MAX(id) AS max_id FROM products');
                $pid = $pid[0]->max_id;

                $total_price = $purchase_price * $amount;
                DB::insert('INSERT INTO purchase_records(time, pid, pamount, unitprice, totalprice) VALUES (?, ?, ?, ?, ?)',
                    [$current_time, $pid, $amount, $purchase_price, $total_price]);
            });

        }elseif ($category == '食品'){
            DB::transaction(function () use ($category, $name, $brand, $price, $amount, $date, $place, $purchase_price, $current_time){
                DB::insert('INSERT INTO products(category, name, brand, price, amount, date, place ) 
                      VALUES (?, ?, ?, ?, ?, ?, ?)',
                    [$category, $name, $brand, $price, $amount, $date, $place]);

                $pid = DB::select('SELECT MAX(id) FROM products');
                $pid = $pid[0]->max_id;

                $total_price = $purchase_price * $amount;
                DB::insert('INSERT INTO purchase_records(time, pid, pamount, unitprice, totalprice) VALUES (?, ?, ?, ?, ?)',
                    [$current_time, $pid, $amount, $purchase_price, $total_price]);
            });
        }
        $viewData = [
            'user' => $user,
            'title' => '提示信息',
            'message' => '恭喜，进货成功!',
            'url' => url('/purchase-new-page'),
            'url_message' => '继续进货'
        ];

        return view('CommitSuccessfully', $viewData);
    }


    public function salePage(){
        $user = Auth::user();
        $products = DB::select('SELECT * FROM products WHERE amount > 0 AND is_drop = 0');
        return view('salePage', ['user' => $user, 'products' => $products]);
    }
    
    public function sale(Request $request){
        $user = Auth::user();
        $pid = $request->input('id');
        $shen_amount = $request->input('shen_amount');
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
            if ($s_amount[$j] > $shen_amount[$j]){
                $viewData = [
                    'user' => $user,
                    'title' => '提示信息：购买失败',
                    'message' => '不好意思，您购买的数量超过了现有库存',
                    'url' => url('/sale-page'),
                    'url_message' => '继续购买'
                ];
                return view('CommitSuccessfully', $viewData);
            }
//            date_default_timezone_set('Asia/Shanghai');
//            $current_time = date('Y-m-d');
//
//            $products = DB::select('SELECT price FROM products WHERE id = ?', [$pid[$j]]);
//            $unitprice = $products[0]->price;
//            $totalprice = $unitprice * $s_amount[$j];
//
//            DB::update('UPDATE products SET amount = amount - ? WHERE id = ?', [$s_amount[$j], $pid[$j]]);
//            DB::insert('INSERT INTO sales_records(time, pid, pamount, unitprice, totalprice) VALUES (?, ?, ?, ?, ?)',
//                [$current_time, $pid[$j], $s_amount[$j], $unitprice, $totalprice]);
//
//            $amount = DB::select('SELECT amount FROM products WHERE id = ?', [$pid[$j]])[0]->amount;
//            if ($amount < 5){
//                DB::update('UPDATE users SET receive_request = 1 WHERE role = 3');
//            }


            DB::transaction(function () use ($pid, $s_amount, $j ){
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
            });
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