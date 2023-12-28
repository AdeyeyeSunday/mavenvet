<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Cart;
use App\Models\Casenote;
use App\Models\Category;
use App\Models\Clinic;
use App\Models\Customer;
use App\Models\Syn;
use App\Models\Employee;
use App\Models\OnlineOrder;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysqli;

class Syn_flatController extends Controller
{
    //



    // public function syn_receiver(){

    //         // Connect to live database
    //  $live_database = DB::connection('onlineorder');
    //  // Get table data from production
    //  foreach($live_database->table('users')->get() as $data){
    //     // Save data to staging database - default db connection
    //     DB::table('table_name')->insert((array) $data);
    //  }
    //  // Get table_2 data from production
    //  foreach($live_database->table('table_2_name')->get() as $data){
    //     // Save data to staging database - default db connection
    //     DB::table('table_2_name')->insert((array) $data);
    //  }



//         echo "I reach here";
//     }
    // }

        public function syn(){

$con = mysqli_connect('104.194.10.93','mavenvet_mavenvet_test','mavenvet_test','mavenvet_mavenvet_test');


if (mysqli_connect_errno()) {
    echo mysqli_connect_errno();

    die();
    # code...
}

$sql = 'select * from users';
$res =mysqli_query($con,$sql);
if (mysqli_num_rows($res)>0) {
    while($row = mysqli_fetch_assoc($res))
    print_r($row);
    # code...
}else{


    echo 'no data';
}
        }







    //         $syn = Category::where('syn_flag','0')->get();
    //         // dd($syn);


    //         $ch = curl_init();

    //         curl_setopt($ch, CURLOPT_URL,"https://www.mavenvetconsult.com/test/public/Admin/syn/syn_receiver");
    //         curl_setopt($ch, CURLOPT_USERPWD, "adeyeye@gmail.com
    //         123456789");
    //         curl_setopt($ch, CURLOPT_POST, 1);
    //         curl_setopt($ch, CURLOPT_POSTFIELDS,
    //                     "category=$syn");

    //         // In real life you should use something like:
    //         // curl_setopt($ch, CURLOPT_POSTFIELDS,
    //         //          http_build_query(array('postvar1' => 'value1')));

    //         // Receive server response ...
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //         $server_output = curl_exec($ch);

    //         curl_close ($ch);

    //         // Further processing ...
    //         // if ($server_output == "OK") { ... } else { ... };
    //             dd($server_output);


    // //    return view('Admin.syn.syn');
    // }

}
