<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Product;
use App\Models\Profit;
use App\Models\Service_item;
use App\Models\Service_order;
use App\Models\Systemupdate;
use App\Models\Transferstore;
use Exception;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysqli;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use ZipArchive;

//use Datatables;
//use DB;

class AdminController extends Controller
{
    //
    protected $serviceItemService;

    public function __construct(Service_item $serviceItemService)
    {
        $this->middleware('auth');
        $this->serviceItemService = $serviceItemService;
    }


function store_profit()
{

$month = request("month");

$type = request("type");

$year = request("year");

$optional = request("optional");
$profitmonthlySales = DB::table('orders')->where('order_status','success')->where('month',$month)->Where('year', $year)->sum('total_price');
$profitmonthlyCost =  DB::table('orders')->where('order_status','success')->where('month',$month)->Where('year', $year)->sum('Cost');
$profitmonthlyExpense= DB::table('expenses')->where('month',$month)->Where('year', $year)->sum('amount');
$check = DB::table('profits')->get();
if( $type== "Sales")
{
 $getAmountProfit =$profitmonthlySales- $profitmonthlyCost;

 if(count($check) > 0)
 {
    DB::table('profits')->update(['month'=>$month,'month'=>$month,'type'=>$type,'year'=>$year,'optional'=>$optional,'Profit'=>$getAmountProfit,'totalSales'=> $profitmonthlyCost,'totalCost'=>$profitmonthlySales,'totalExpense'=>$profitmonthlyExpense]);

}else
 {
    $input = new Profit();
    $input->month = request("month");
    $input->type  = request("type");
    $input->year  = request("year");
    $input->totalSales  = $profitmonthlyCost;
    $input->totalCost  = $profitmonthlySales;
    $input->totalExpense  = $profitmonthlyExpense;
    $input->optional   = request("optional");
    $input->Profit = $getAmountProfit;
    $input->save();
 }

}
else if($type== "Sales"  &&  $optional == "Expense")
{
$getAmountProfit =  $profitmonthlyCost -  $profitmonthlySales - $profitmonthlyExpense;

if(count($check) > 0)
{
    DB::table('profits')->update(['month'=>$month,'month'=>$month,'type'=>$type,'year'=>$year,'optional'=>$optional,'Profit'=>$getAmountProfit,'totalSales'=> $profitmonthlyCost,'totalCost'=>$profitmonthlySales,'totalExpense'=>$profitmonthlyExpense]);
}else
{
   $input = new Profit();
   $input->month = request("month");
   $input->type  = request("type");
   $input->year  = request("year");
   $input->totalSales  = $profitmonthlyCost;
   $input->totalCost  = $profitmonthlySales;
   $input->totalExpense  = $profitmonthlyExpense;
   $input->optional   = request("optional");
   $input->Profit = $getAmountProfit;
   $input->save();
}

}
return back();
}

public function sync(Request $request){
    try {
    ini_set('max_execution_time', 3600); // 3600 seconds = 60 minutes
set_time_limit(3600);

    /*............... Offline database connection...........................*/
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "mavenvet";

 /*.............. Offline SQL connection............................*/
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $db);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}



 /*..............Online database connection...........................*/
$con = mysqli_connect('131.153.147.34', 'mavenvet_midwifery', 'mavenvet_midwifery', 'mavenvet_midwifery');
if ($con === false) {
    die("Online database connection error: " . mysqli_connect_error());
}


 /*..............Admission start from here...........................*/
 $offline = "SELECT `pet_id`, `diagnosis`, `amount`, `date`, `payment`, `mode`, `user_id`, `month`, `year`, `staus`, `created_at`, `updated_at`, `location`, `syn_flag` FROM `admissions`  WHERE syn_flag = '0'";
 $resOffline = $mysqli->query($offline);
 if($resOffline->num_rows > 0){
    while ($detorRow = $resOffline->fetch_assoc()) {
        $pet_id   = $detorRow['pet_id'];
        $diagnosis  = $detorRow['diagnosis'];
        $amount  = $detorRow['amount'];
        $date = $detorRow['date'];
        $payment  = $detorRow['payment'];
        $mode  = $detorRow['mode'];
        $user_id  = $detorRow['user_id'];
        $month = $detorRow['month'];
        $year  = $detorRow['year'];
        $location = $detorRow['location'];
        $syn_flag =1;
        $pet_id = isset($detorRow['pet_id']) ? mysqli_real_escape_string($mysqli, $detorRow['pet_id']) : null;
$diagnosis = isset($detorRow['diagnosis']) ? mysqli_real_escape_string($mysqli, $detorRow['diagnosis']) : null;
$amount = isset($detorRow['amount']) ? mysqli_real_escape_string($mysqli, $detorRow['amount']) : null;
$date = isset($detorRow['date']) ? mysqli_real_escape_string($mysqli, $detorRow['date']) : null;
$payment = isset($detorRow['payment']) ? mysqli_real_escape_string($mysqli, $detorRow['payment']) : null;
$mode = isset($detorRow['mode']) ? mysqli_real_escape_string($mysqli, $detorRow['mode']) : null;
$user_id = isset($detorRow['user_id']) ? mysqli_real_escape_string($mysqli, $detorRow['user_id']) : null;
$month = isset($detorRow['month']) ? mysqli_real_escape_string($mysqli, $detorRow['month']) : null;
$year = isset($detorRow['year']) ? mysqli_real_escape_string($mysqli, $detorRow['year']) : null;
$location = isset($detorRow['location']) ? mysqli_real_escape_string($mysqli, $detorRow['location']) : null;

        $selectOnlineProduct = "SELECT 'pet_id' FROM admissions WHERE pet_id  = '".$pet_id."' AND syn_flag = '1'";
         $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);

         if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
            /*...............Loop through online service types.................*/
          while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
            $Onlinepet_id= $resonlineServiceRow['pet_id'];

                $onlineProductUpdate = "UPDATE admissions SET amount = '$amount' WHERE pet_id = '$Onlinepet_id'";
                $resUpdate = mysqli_query($con, $onlineProductUpdate);

                if ($resUpdate === false) {
                    die("Error updating record: " . mysqli_error($con));
                }

                $offlineUpdateSyn = "UPDATE admissions SET syn_flag = '1' WHERE pet_id = '$pet_id'";
                $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);

                if ($resOfflineUpdate === false) {
                    die("Error updating syn_flag: " . mysqli_error($mysqli));
                }
          }
        }
        else
        {
            $insertOnline = "INSERT INTO admissions (`pet_id`, `diagnosis`, `amount`, `date`, `payment`, `mode`, `user_id`, `month`, `year`,`location`,syn_flag)
            VALUES ('".$pet_id."', '".$diagnosis."', '".$amount."', '".$date."', '".$payment."', '".$mode."', '".$user_id."', '".$month."', '".$year."', '".$location."','".$syn_flag."')";
            $resOnlineUpdate = mysqli_query($con, $insertOnline);
            if ($resOnlineUpdate === false) {
                die("Error checking for duplicate record: " . mysqli_error($con));
            }

            $offlineUpdateSyn = "UPDATE admissions SET syn_flag = '1' WHERE pet_id = '".$pet_id."'";
            $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
            if ($resOfflineUpdate === false) {
             die("Error getting service_requests: " . $mysqli->error);
         }
       }

    }

}



 /*..............attendance start from here...........................*/
 $offline = "SELECT `staff_name`, `clockin`, `clockout`, `Timeout`, `Time`, `date`, `month`, `year` FROM `attendances` WHERE syn_flag = '0'";
 $resOffline = $mysqli->query($offline);
 if($resOffline->num_rows > 0){
    while ($detorRow = $resOffline->fetch_assoc()) {
        $s   = $detorRow['staff_name'];
        $c  = $detorRow['clockin'];
        $d  = $detorRow['clockout'];
        $e = $detorRow['Timeout'];
        $f  = $detorRow['Time'];
        $g  = $detorRow['date'];
        $h = $detorRow['month'];
        $i = $detorRow['year'];
        $syn_flag =1;

        $s = isset($detorRow['staff_name']) ? mysqli_real_escape_string($mysqli, $detorRow['staff_name']) : null;
$c = isset($detorRow['clockin']) ? mysqli_real_escape_string($mysqli, $detorRow['clockin']) : null;
$d = isset($detorRow['clockout']) ? mysqli_real_escape_string($mysqli, $detorRow['clockout']) : null;
$e = isset($detorRow['Timeout']) ? mysqli_real_escape_string($mysqli, $detorRow['Timeout']) : null;
$f = isset($detorRow['Time']) ? mysqli_real_escape_string($mysqli, $detorRow['Time']) : null;
$g = isset($detorRow['date']) ? mysqli_real_escape_string($mysqli, $detorRow['date']) : null;
$h = isset($detorRow['month']) ? mysqli_real_escape_string($mysqli, $detorRow['month']) : null;
$i = isset($detorRow['year']) ? mysqli_real_escape_string($mysqli, $detorRow['year']) : null;


         $insertOnline = "INSERT INTO `attendances`(`staff_name`, `clockin`, `clockout`, `Timeout`, `Time`, `date`, `month`, `year`)
         VALUES ('$s', '$c', '$d', '$e', '$f', '$g', '$h', '$i')";
            $resOnlineUpdate = mysqli_query($con, $insertOnline);
            if ($resOnlineUpdate === false) {
                die("Error checking for duplicate record: " . mysqli_error($con));
            }
            $offlineUpdateSyn = "UPDATE attendances SET syn_flag = '1' WHERE staff_name = '$s'";

            $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
            if ($resOfflineUpdate === false) {
             die("Error getting service_requests: " . $mysqli->error);
         }
    }
}

     /*..............bank_lists start from here...........................*/
     $offline = "SELECT `name`, `accountNumber` FROM `bank_lists` WHERE syn_flag = '0'";
     $resOffline = $mysqli->query($offline);
     if($resOffline->num_rows > 0){
        while ($detorRow = $resOffline->fetch_assoc()) {
            $s   = $detorRow['name'];
            $c  = $detorRow['accountNumber'];
            $syn_flag =1;
            $selectOnlineProduct = "SELECT name, accountNumber FROM bank_lists WHERE name = '".$s."' AND syn_flag = '1'";
             $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
             if($resOnlineUpdate->num_rows > 0){
                /*...............Loop through online service types.................*/
              while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
                $Onlinepet_id = $s;
                    $onlineProductUpdate = "UPDATE bank_lists SET name = '$s',accountNumber ='$c' WHERE name = '$Onlinepet_id'";
                    $resUpdate = mysqli_query($con, $onlineProductUpdate);
                    if ($resUpdate === false) {
                        die("Error updating record: " . mysqli_error($con));
                    }
                    $offlineUpdateSyn = "UPDATE bank_lists SET syn_flag = '1' WHERE accountNumber = '$c'";
                    $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                    if ($resOfflineUpdate === false) {
                        die("Error updating syn_flag: " . mysqli_error($mysqli));
                    }
              }
            }
            else
            {
                $insertOnline = "INSERT INTO bank_lists (`name`, `accountNumber`, `syn_flag`)
                VALUES ('".$s."', '".$c."', '".$syn_flag."')";
                 mysqli_query($con, $insertOnline);
                $offlineUpdateSyn = "UPDATE bank_lists SET syn_flag = '1' WHERE name = '".$s."'";
                $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                if ($resOfflineUpdate === false) {
                 die("Error getting service_requests: " . $mysqli->error);
             }
           }
        }
    }

         /*..............brand start from here...........................*/
         $offline = "SELECT `brand` FROM `brands` WHERE syn_flag = '0'";
         $resOffline = $mysqli->query($offline);
         if($resOffline->num_rows > 0){
            while ($detorRow = $resOffline->fetch_assoc()) {
                $s   = $detorRow['brand'];
                $syn_flag =1;
                $selectOnlineProduct = "SELECT 'brand' FROM brands WHERE brand  = '".$s."' AND syn_flag = '1'";
                 $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
                 if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
                    /*...............Loop through online service types.................*/
                  while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
                    $Onlinepet_id= $resonlineServiceRow['brand'];
                        $onlineProductUpdate = "UPDATE brands SET brand = '$s' WHERE brand = '$Onlinepet_id'";
                        $resUpdate = mysqli_query($con, $onlineProductUpdate);

                        if ($resUpdate === false) {
                            die("Error updating record: " . mysqli_error($con));
                        }
                        $offlineUpdateSyn = "UPDATE brands SET syn_flag = '1' WHERE brand = '$s'";
                        $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);

                        if ($resOfflineUpdate === false) {
                            die("Error updating syn_flag: " . mysqli_error($mysqli));
                        }
                  }
                }
                else
                {
                    $insertOnline = "INSERT INTO brands (`brand`,`syn_flag`)
                    VALUES ('".$s."','".$syn_flag."')";
                    $resOnlineUpdate = mysqli_query($con, $insertOnline);
                    if ($resOnlineUpdate === false) {
                        die("Error checking for duplicate record: " . mysqli_error($con));
                    }
                    $offlineUpdateSyn = "UPDATE brands SET syn_flag = '1' WHERE brand = '".$s."'";
                    $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                    if ($resOfflineUpdate === false) {
                     die("Error getting service_requests: " . $mysqli->error);
                 }
               }

            }
        }

            /*..............cashes start from here...........................*/
            $offline = "SELECT `customer_name`, `mode`, `amount`, `name`, `date`, `month`, `year`,`location` FROM `cashes` WHERE syn_flag = '0'";
            $resOffline = $mysqli->query($offline);
            if($resOffline->num_rows > 0){
               while ($detorRow = $resOffline->fetch_assoc()) {
                $s   = $detorRow['customer_name'];
                $c  = $detorRow['mode'];
                $d  = $detorRow['amount'];
                $e = $detorRow['name'];
                $g  = $detorRow['date'];
                $h = $detorRow['month'];
                $i = $detorRow['year'];
                $l = $detorRow['location'];
                $syn_flag =1;

                $s = isset($detorRow['customer_name']) ? mysqli_real_escape_string($mysqli, $detorRow['customer_name']) : null;
$c = isset($detorRow['mode']) ? mysqli_real_escape_string($mysqli, $detorRow['mode']) : null;
$d = isset($detorRow['amount']) ? mysqli_real_escape_string($mysqli, $detorRow['amount']) : null;
$e = isset($detorRow['name']) ? mysqli_real_escape_string($mysqli, $detorRow['name']) : null;
$g = isset($detorRow['date']) ? mysqli_real_escape_string($mysqli, $detorRow['date']) : null;
$h = isset($detorRow['month']) ? mysqli_real_escape_string($mysqli, $detorRow['month']) : null;
$i = isset($detorRow['year']) ? mysqli_real_escape_string($mysqli, $detorRow['year']) : null;
$l = isset($detorRow['location']) ? mysqli_real_escape_string($mysqli, $detorRow['location']) : null;

                   $selectOnlineProduct = "SELECT 'customer_name' FROM cashes WHERE customer_name  = '".$s."' AND syn_flag = '1'";
                    $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
                    if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
                       /*...............Loop through online service types.................*/
                     while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
                       $Onlinepet_id= $resonlineServiceRow['customer_name'];
                           $onlineProductUpdate = "UPDATE cashes SET customer_name='$s',amount='$d',date ='$g' WHERE customer_name = '$Onlinepet_id'";
                           $resUpdate = mysqli_query($con, $onlineProductUpdate);

                           if ($resUpdate === false) {
                               die("Error updating record: " . mysqli_error($con));
                           }
                           $offlineUpdateSyn = "UPDATE cashes SET syn_flag = '1' WHERE customer_name = '$s'";
                           $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                           if ($resOfflineUpdate === false) {
                               die("Error updating syn_flag: " . mysqli_error($mysqli));
                           }
                     }
                   }
                   else
                   {
                    $insertOnline = "INSERT INTO `cashes`(`customer_name`, `mode`, `amount`, `name`, `date`, `month`, `year`, `location`, `syn_flag`)
                    VALUES ('$s', '$c', '$d', '$e', '$g', '$h', '$i', '$l', '$syn_flag')";
                       $resOnlineUpdate = mysqli_query($con, $insertOnline);
                       if ($resOnlineUpdate === false) {
                           die("Error checking for duplicate record: " . mysqli_error($con));
                       }
                       $offlineUpdateSyn = "UPDATE cashes SET syn_flag = '1' WHERE customer_name = '".$s."'";
                       $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                       if ($resOfflineUpdate === false) {
                        die("Error getting service_requests: " . $mysqli->error);
                    }
                  }

               }
           }
              /*..............categories start from here...........................*/
              $offline = "SELECT `Category` FROM `categories` WHERE syn_flag = '0'";
              $resOffline = $mysqli->query($offline);
              if($resOffline->num_rows > 0){
                 while ($detorRow = $resOffline->fetch_assoc()) {
                  $s   = $detorRow['Category'];
                  $syn_flag =1;
                     $selectOnlineProduct = "SELECT 'Category' FROM categories WHERE Category  = '".$s."' AND syn_flag = '1'";
                      $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
                      if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
                         /*...............Loop through online service types.................*/
                       while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
                         $Onlinepet_id= $resonlineServiceRow['Category'];
                             $onlineProductUpdate = "UPDATE categories SET Category='$s WHERE Category = '$Onlinepet_id'";
                             $resUpdate = mysqli_query($con, $onlineProductUpdate);

                             if ($resUpdate === false) {
                                 die("Error updating record: " . mysqli_error($con));
                             }
                             $offlineUpdateSyn = "UPDATE categories SET syn_flag = '1' WHERE Category = '$s'";
                             $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                             if ($resOfflineUpdate === false) {
                                 die("Error updating syn_flag: " . mysqli_error($mysqli));
                             }
                       }
                     }
                     else
                     {
                        $insertOnline = "INSERT INTO `categories`(`Category`, `syn_flag`) VALUES ('$s', '$syn_flag')";
                         $resOnlineUpdate = mysqli_query($con, $insertOnline);
                         if ($resOnlineUpdate === false) {
                             die("Error checking for duplicate record: " . mysqli_error($con));
                         }
                         $offlineUpdateSyn = "UPDATE categories SET syn_flag = '1' WHERE Category = '".$s."'";
                         $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                         if ($resOfflineUpdate === false) {
                          die("Error getting service_requests: " . $mysqli->error);
                      }
                    }

                 }
             }



              /*..............clinic_expenses start from here...........................*/
            $offline = "SELECT `name`, `description`, `amount`, `date`, `month`, `year`, `syn_flag`,'location' FROM `clinic_expenses` WHERE syn_flag = '0'";
            $resOffline = $mysqli->query($offline);
            if($resOffline->num_rows > 0){
               while ($detorRow = $resOffline->fetch_assoc()) {
                $s   = $detorRow['name'];
                $c  = $detorRow['description'];
                $d  = $detorRow['amount'];
                $g  = $detorRow['date'];
                $h = $detorRow['month'];
                $i = $detorRow['year'];
                $l = $detorRow['location'];
                $syn_flag =1;

                $s = isset($detorRow['name']) ? mysqli_real_escape_string($mysqli, $detorRow['name']) : null;
$c = isset($detorRow['description']) ? mysqli_real_escape_string($mysqli, $detorRow['description']) : null;
$d = isset($detorRow['amount']) ? mysqli_real_escape_string($mysqli, $detorRow['amount']) : null;
$g = isset($detorRow['date']) ? mysqli_real_escape_string($mysqli, $detorRow['date']) : null;
$h = isset($detorRow['month']) ? mysqli_real_escape_string($mysqli, $detorRow['month']) : null;
$i = isset($detorRow['year']) ? mysqli_real_escape_string($mysqli, $detorRow['year']) : null;
$l = isset($detorRow['location']) ? mysqli_real_escape_string($mysqli, $detorRow['location']) : null;

                   $selectOnlineProduct = "SELECT 'name' FROM clinic_expenses WHERE name  = '".$s."' AND syn_flag = '1'";
                    $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
                    if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
                       /*...............Loop through online service types.................*/
                     while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
                       $Onlinepet_id= $s;
                           $onlineProductUpdate = "UPDATE clinic_expenses SET amount = '$d' WHERE name = '$Onlinepet_id'";
                           $resUpdate = mysqli_query($con, $onlineProductUpdate);

                           if ($resUpdate === false) {
                               die("Error updating record: " . mysqli_error($con));
                           }
                           $offlineUpdateSyn = "UPDATE clinic_expenses SET syn_flag = '1' WHERE name = '$s'";
                           $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                           if ($resOfflineUpdate === false) {
                               die("Error updating syn_flag: " . mysqli_error($mysqli));
                           }
                     }
                   }
                   else
                   {
                    $insertOnline = "INSERT INTO `clinic_expenses`(`name`, `description`, `amount`, `date`, `month`, `year`, `syn_flag`, `location`)
                    VALUES ('$s', '$c', '$d', '$g', '$h', '$i', '$syn_flag', '$l')";
                       $resOnlineUpdate = mysqli_query($con, $insertOnline);
                       if ($resOnlineUpdate === false) {
                           die("Error checking for duplicate record: " . mysqli_error($con));
                       }
                       $offlineUpdateSyn = "UPDATE clinic_expenses SET syn_flag = '1' WHERE name = '".$s."'";
                       $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                       if ($resOfflineUpdate === false) {
                        die("Error getting service_requests: " . $mysqli->error);
                    }
                  }

               }
           }




            /*..............employees start from here...........................*/
            $offline = "SELECT `user_id`, `Title`, `name_id`, `email`, `number`, `gst_number`, `address`, `city`, `state`, `country`, `image`, `gender`, `position`, `staff_no` FROM `employees` WHERE syn_flag = '0'";
            $resOffline = $mysqli->query($offline);
            if($resOffline->num_rows > 0){
               while ($detorRow = $resOffline->fetch_assoc()) {
                $user_id = $detorRow['user_id'];
                $title = $detorRow['Title'];
                $name_id = $detorRow['name_id'];
                $email = $detorRow['email'];
                $number = $detorRow['number'];
                $gst_number = $detorRow['gst_number'];
                $address = $detorRow['address'];
                $city = $detorRow['city'];
                $state = $detorRow['state'];
                $country = $detorRow['country'];
                $image = $detorRow['image'];
                $gender = $detorRow['gender'];
                $position = $detorRow['position'];
                $staff_no = $detorRow['staff_no'];
                $syn_flag =1;

                $user_id = isset($detorRow['user_id']) ? mysqli_real_escape_string($mysqli, $detorRow['user_id']) : null;
                $title = isset($detorRow['Title']) ? mysqli_real_escape_string($mysqli, $detorRow['Title']) : null;
                $name_id = isset($detorRow['name_id']) ? mysqli_real_escape_string($mysqli, $detorRow['name_id']) : null;
                $email = isset($detorRow['email']) ? mysqli_real_escape_string($mysqli, $detorRow['email']) : null;
                $number = isset($detorRow['number']) ? mysqli_real_escape_string($mysqli, $detorRow['number']) : null;
                $gst_number = isset($detorRow['gst_number']) ? mysqli_real_escape_string($mysqli, $detorRow['gst_number']) : null;
                $address = isset($detorRow['address']) ? mysqli_real_escape_string($mysqli, $detorRow['address']) : null;
                $city = isset($detorRow['city']) ? mysqli_real_escape_string($mysqli, $detorRow['city']) : null;
                $state = isset($detorRow['state']) ? mysqli_real_escape_string($mysqli, $detorRow['state']) : null;
                $country = isset($detorRow['country']) ? mysqli_real_escape_string($mysqli, $detorRow['country']) : null;
                $image = isset($detorRow['image']) ? mysqli_real_escape_string($mysqli, $detorRow['image']) : null;
                $gender = isset($detorRow['gender']) ? mysqli_real_escape_string($mysqli, $detorRow['gender']) : null;
                $position = isset($detorRow['position']) ? mysqli_real_escape_string($mysqli, $detorRow['position']) : null;
                $staff_no = isset($detorRow['staff_no']) ? mysqli_real_escape_string($mysqli, $detorRow['staff_no']) : null;

                   $selectOnlineProduct = "SELECT 'user_id' FROM employees WHERE user_id  = '".$user_id."' AND syn_flag = '1'";
                    $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
                    if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
                       /*...............Loop through online service types.................*/
                     while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
                       $Onlinepet_id= $resonlineServiceRow['user_id'];
                           $onlineProductUpdate = "UPDATE employees SET user_id = '$user_id' WHERE user_id = '$Onlinepet_id'";
                           $resUpdate = mysqli_query($con, $onlineProductUpdate);

                           if ($resUpdate === false) {
                               die("Error updating record: " . mysqli_error($con));
                           }
                           $offlineUpdateSyn = "UPDATE employees SET syn_flag = '1' WHERE user_id = '$user_id'";
                           $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                           if ($resOfflineUpdate === false) {
                               die("Error updating syn_flag: " . mysqli_error($mysqli));
                           }
                     }
                   }
                   else
                   {
                    $insertOnline  = "INSERT INTO `employees`(`user_id`, `Title`, `name_id`, `email`, `number`, `gst_number`, `address`, `city`, `state`, `country`, `image`, `gender`, `position`, `staff_no`, `syn_flag`)
                    VALUES ('$user_id','$title','$name_id','$email','$number','$gst_number','$address','$city','$state','$country','$image','$gender','$position','$staff_no','$syn_flag')";
                       $resOnlineUpdate = mysqli_query($con, $insertOnline);
                       if ($resOnlineUpdate === false) {
                           die("Error checking for duplicate record: " . mysqli_error($con));
                       }
                       $offlineUpdateSyn = "UPDATE employees SET syn_flag = '1' WHERE user_id = '".$user_id."'";
                       $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                       if ($resOfflineUpdate === false) {
                        die("Error getting service_requests: " . $mysqli->error);
                    }
                  }

               }
           }




               /*..............clinic_expenses start from here...........................*/
               $offline = "SELECT `name`, `description`, `amount`, `date`, `month`, `year`, `location`FROM `expenses` WHERE syn_flag = '0'";
               $resOffline = $mysqli->query($offline);
               if($resOffline->num_rows > 0){
                  while ($detorRow = $resOffline->fetch_assoc()) {
                   $s   = $detorRow['name'];
                   $c  = $detorRow['description'];
                   $d  = $detorRow['amount'];
                   $g  = $detorRow['date'];
                   $h = $detorRow['month'];
                   $i = $detorRow['year'];
                   $l = $detorRow['location'];
                   $syn_flag =1;

                   $s = isset($detorRow['name']) ? mysqli_real_escape_string($mysqli, $detorRow['name']) : null;
                   $c = isset($detorRow['description']) ? mysqli_real_escape_string($mysqli, $detorRow['description']) : null;
                   $d = isset($detorRow['amount']) ? mysqli_real_escape_string($mysqli, $detorRow['amount']) : null;
                   $g = isset($detorRow['date']) ? mysqli_real_escape_string($mysqli, $detorRow['date']) : null;
                   $h = isset($detorRow['month']) ? mysqli_real_escape_string($mysqli, $detorRow['month']) : null;
                   $i = isset($detorRow['year']) ? mysqli_real_escape_string($mysqli, $detorRow['year']) : null;
                   $l = isset($detorRow['location']) ? mysqli_real_escape_string($mysqli, $detorRow['location']) : null;


                      $selectOnlineProduct = "SELECT 'name','description' FROM expenses WHERE description  = '".$c."' AND syn_flag = '1'";
                       $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
                       if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
                          /*...............Loop through online service types.................*/
                        while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
                          $Onlinepet_id= $c;
                              $onlineProductUpdate = "UPDATE expenses SET amount = '$d' WHERE description = '$Onlinepet_id'";
                              $resUpdate = mysqli_query($con, $onlineProductUpdate);

                              if ($resUpdate === false) {
                                  die("Error updating record: " . mysqli_error($con));
                              }
                              $offlineUpdateSyn = "UPDATE expenses SET syn_flag = '1' WHERE name = '$s'";
                              $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                              if ($resOfflineUpdate === false) {
                                  die("Error updating syn_flag: " . mysqli_error($mysqli));
                              }
                        }
                      }
                      else
                      {
                       $insertOnline = "INSERT INTO `expenses`(`name`, `description`, `amount`, `date`, `month`, `year`, `syn_flag`, `location`)
                       VALUES ('$s', '$c', '$d', '$g', '$h', '$i', '$syn_flag', '$l')";
                          $resOnlineUpdate = mysqli_query($con, $insertOnline);
                          if ($resOnlineUpdate === false) {
                              die("Error checking for duplicate record: " . mysqli_error($con));
                          }
                          $offlineUpdateSyn = "UPDATE expenses SET syn_flag = '1' WHERE name = '".$s."'";
                          $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                          if ($resOfflineUpdate === false) {
                           die("Error getting service_requests: " . $mysqli->error);
                       }
                     }

                  }
              }

    /*..............newproducts start from here...........................*/


    $offline = "SELECT `id`,`Name`, `Cost`, `Price`, `Quantity`, `new_supply`, `expiry_date`, `Quantity_level`, `description`, `month`, `year`, `new_date`, `location`, `syn_flag`, `user_id`, `Category`, `supplier` FROM newproducts WHERE syn_flag = '0'";
    $resOffline = $mysqli->query($offline);
    if($resOffline->num_rows > 0){
       while ($detorRow = $resOffline->fetch_assoc()) {
          $id = $detorRow['id'];
          $name = $detorRow['Name'];
          $cost = $detorRow['Cost'];
          $price = $detorRow['Price'];
          $quantity = $detorRow['Quantity'];
          $new_supply = $detorRow['new_supply'];
          $expiry_date = $detorRow['expiry_date'];
          $quantity_level = $detorRow['Quantity_level'];
          $description = $detorRow['description'];
          $month = $detorRow['month'];
          $year = $detorRow['year'];
          $new_date = $detorRow['new_date'];
          $location = $detorRow['location'];
          $Category = $detorRow['Category'];
          $supplier = $detorRow['supplier'];
          $syn_flag = 1;
          $user_id = $detorRow['user_id'];

        $syn_flag =1;
        $id = isset($detorRow['id']) ? mysqli_real_escape_string($mysqli, $detorRow['id']) : '';
        $name = isset($detorRow['Name']) ? mysqli_real_escape_string($mysqli, $detorRow['Name']) : '';
        $cost = isset($detorRow['Cost']) ? mysqli_real_escape_string($mysqli, $detorRow['Cost']) : '';
        $price = isset($detorRow['Price']) ? mysqli_real_escape_string($mysqli, $detorRow['Price']) : '';
        $quantity = isset($detorRow['Quantity']) ? mysqli_real_escape_string($mysqli, $detorRow['Quantity']) : '';
        $new_supply = isset($detorRow['new_supply']) ? mysqli_real_escape_string($mysqli, $detorRow['new_supply']) : '';
        $expiry_date = isset($detorRow['expiry_date']) ? mysqli_real_escape_string($mysqli, $detorRow['expiry_date']) : '';
        $quantity_level = isset($detorRow['Quantity_level']) ? mysqli_real_escape_string($mysqli, $detorRow['Quantity_level']) : '';
        $description = isset($detorRow['description']) ? mysqli_real_escape_string($mysqli, $detorRow['description']) : '';
        $month = isset($detorRow['month']) ? mysqli_real_escape_string($mysqli, $detorRow['month']) : '';
        $year = isset($detorRow['year']) ? mysqli_real_escape_string($mysqli, $detorRow['year']) : '';
        $new_date = isset($detorRow['new_date']) ? mysqli_real_escape_string($mysqli, $detorRow['new_date']) : '';
        $location = isset($detorRow['location']) ? mysqli_real_escape_string($mysqli, $detorRow['location']) : '';
        $Category = isset($detorRow['Category']) ? mysqli_real_escape_string($mysqli, $detorRow['Category']) : '';
        $supplier = isset($detorRow['supplier']) ? mysqli_real_escape_string($mysqli, $detorRow['supplier']) : '';
        $user_id = isset($detorRow['user_id']) ? mysqli_real_escape_string($mysqli, $detorRow['user_id']) : '';


           $selectOnlineProduct = "SELECT 'Name' FROM newproducts WHERE Name  = '".$name."' AND syn_flag = '1'";
            $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
            if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
               /*...............Loop through online service types.................*/
             while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
               $Onlinepet_id= $name;
                   $onlineProductUpdate = "UPDATE newproducts SET Price = '$price', Quantity= '$quantity',Cost = '$cost' WHERE Name = '$Onlinepet_id'";
                   $resUpdate = mysqli_query($con, $onlineProductUpdate);

                   if ($resUpdate === false) {
                       die("Error updating record: " . mysqli_error($con));
                   }
                   $offlineUpdateSyn = "UPDATE newproducts SET syn_flag = '1' WHERE Name = '$name'";
                   $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                   if ($resOfflineUpdate === false) {
                       die("Error updating syn_flag: " . mysqli_error($mysqli));
                   }
             }
           }
           else
           {
            $insertOnline = "INSERT INTO newproducts (Name, Cost, Price, Quantity, new_supply, expiry_date, Quantity_level, description, month, year, new_date, location, Category, supplier, syn_flag, user_id)
            VALUES ('$name', '$cost', '$price', '$quantity', '$new_supply', '$expiry_date', '$quantity_level', '$description', '$month', '$year', '$new_date', '$location', '$Category', '$supplier', '$syn_flag', '$user_id')";
               $resOnlineUpdate = mysqli_query($con, $insertOnline);
               if ($resOnlineUpdate === false) {
                   die("Error checking for duplicate record: " . mysqli_error($con));
               }
               $offlineUpdateSyn = "UPDATE newproducts SET syn_flag = '1' WHERE Name = '".$name."'";
               $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
               if ($resOfflineUpdate === false) {
                die("Error getting service_requests: " . $mysqli->error);
            }
          }

       }
   }

   /*..............new_vaccines start from here...........................*/
   $offline = "SELECT  `user_id`, `Name`, `Cost`, `Price`, `Quantity`, `minimum`, `Image`, `expiry_date`, `new_supply`, `supply_date`, `brand`, `supplier`, `location` FROM `new_vaccines`  WHERE syn_flag = '0'";
              $resOffline = $mysqli->query($offline);
              if($resOffline->num_rows > 0){
                 while ($detorRow = $resOffline->fetch_assoc()) {
                    $user_id = $detorRow['user_id'];
                    $name = $detorRow['Name'];
                    $cost = $detorRow['Cost'];
                    $price = $detorRow['Price'];
                    $quantity = $detorRow['Quantity'];
                    $minimum = $detorRow['minimum'];
                    $Image = $detorRow['Image'];
                    $expiry_date = $detorRow['expiry_date'];
                    $new_supply = $detorRow['new_supply'];
                    $supply_date = $detorRow['supply_date'];
                    $brand = $detorRow['brand'];
                    $location = $detorRow['location'];
                    $supplier = $detorRow['supplier'];
                    $syn_flag = 1;
                    $user_id = isset($detorRow['user_id']) ? mysqli_real_escape_string($mysqli, $detorRow['user_id']) : '';
                    $name = isset($detorRow['Name']) ? mysqli_real_escape_string($mysqli, $detorRow['Name']) : '';
                    $cost = isset($detorRow['Cost']) ? mysqli_real_escape_string($mysqli, $detorRow['Cost']) : '';
                    $price = isset($detorRow['Price']) ? mysqli_real_escape_string($mysqli, $detorRow['Price']) : '';
                    $quantity = isset($detorRow['Quantity']) ? mysqli_real_escape_string($mysqli, $detorRow['Quantity']) : '';
                    $minimum = isset($detorRow['minimum']) ? mysqli_real_escape_string($mysqli, $detorRow['minimum']) : '';
                    $Image = isset($detorRow['Image']) ? mysqli_real_escape_string($mysqli, $detorRow['Image']) : '';
                    $expiry_date = isset($detorRow['expiry_date']) ? mysqli_real_escape_string($mysqli, $detorRow['expiry_date']) : '';
                    $new_supply = isset($detorRow['new_supply']) ? mysqli_real_escape_string($mysqli, $detorRow['new_supply']) : '';
                    $supply_date = isset($detorRow['supply_date']) ? mysqli_real_escape_string($mysqli, $detorRow['supply_date']) : '';
                    $brand = isset($detorRow['brand']) ? mysqli_real_escape_string($mysqli, $detorRow['brand']) : '';
                    $location = isset($detorRow['location']) ? mysqli_real_escape_string($mysqli, $detorRow['location']) : '';
                    $supplier = isset($detorRow['supplier']) ? mysqli_real_escape_string($mysqli, $detorRow['supplier']) : '';


                     $selectOnlineProduct = "SELECT 'Name' FROM new_vaccines WHERE Name  = '".$name."' AND syn_flag = '1'";
                      $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
                      if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
                         /*...............Loop through online service types.................*/
                       while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
                         $Onlinepet_id= $name;
                             $onlineProductUpdate = "UPDATE new_vaccines SET Price = '$price',Quantity = '$quantity',Cost = '$cost'  WHERE Name = '$Onlinepet_id'";
                             $resUpdate = mysqli_query($con, $onlineProductUpdate);

                             if ($resUpdate === false) {
                                 die("Error updating record: " . mysqli_error($con));
                             }
                             $offlineUpdateSyn = "UPDATE new_vaccines SET syn_flag = '1' WHERE Name = '$name'";
                             $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                             if ($resOfflineUpdate === false) {
                                 die("Error updating syn_flag: " . mysqli_error($mysqli));
                             }
                       }
                     }
                     else
                     {
                        $insertOnline = "INSERT INTO new_vaccines
                        (`user_id`, `Name`, `Cost`, `Price`, `Quantity`, `minimum`, `Image`, `expiry_date`, `new_supply`, `supply_date`, `brand`, `location`, `supplier`)
                        VALUES
                        ('$user_id', '$name', '$cost', '$price', '$quantity', '$minimum', '$Image', '$expiry_date', '$new_supply', '$supply_date', '$brand', '$location', '$supplier')";
                         $resOnlineUpdate = mysqli_query($con, $insertOnline);
                         if ($resOnlineUpdate === false) {
                             die("Error checking for duplicate record: " . mysqli_error($con));
                         }
                         $offlineUpdateSyn = "UPDATE new_vaccines SET syn_flag = '1' WHERE Name = '".$name."'";
                         $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                         if ($resOfflineUpdate === false) {
                          die("Error getting service_requests: " . $mysqli->error);
                      }
                    }

                 }
             }



 /*..............orders start from here...........................*/
$offline = "SELECT `user_id`, `fname`, `phone`, `address`, `total_price`, `discount`, `trackking_id`, `order_status`, `Mode_of_payment`, `pay`, `due`, `Payment_type`, `cash_transfer`, `cash_pos`, `date`, `month`, `year`, `syn_flag`, `location`, `new_mode_of_payment`, `new_date`, `new_payment_user_id`, `Cost`, `new_due`, `bankName` FROM `orders` WHERE syn_flag = '0'";
   $resOffline = $mysqli->query($offline);
   if($resOffline->num_rows > 0){
      while ($detorRow = $resOffline->fetch_assoc()) {
        $user_id = $detorRow['user_id'];
        $fname = $detorRow['fname'];
        $phone = $detorRow['phone'];
        $address = $detorRow['address'];
        $total_price = $detorRow['total_price'];
        $discount = $detorRow['discount'];
        $trackking_id = $detorRow['trackking_id'];
        $order_status = $detorRow['order_status'];
        $Mode_of_payment = $detorRow['Mode_of_payment'];
        $pay = $detorRow['pay'];
        $due = $detorRow['due'];
        $Payment_type = $detorRow['Payment_type'];
        $cash_transfer = $detorRow['cash_transfer'];
        $cash_pos = $detorRow['cash_pos'];
        $date = $detorRow['date'];
        $month = $detorRow['month'];
        $year = $detorRow['year'];
        $syn_flag = 1;
        $location = $detorRow['location'];
        $new_mode_of_payment = $detorRow['new_mode_of_payment'];
        $new_date = $detorRow['new_date'];
        $new_payment_user_id = $detorRow['new_payment_user_id'];
        $new_due = $detorRow['new_due'];
        $bankName = $detorRow['bankName'];
        $Cost = $detorRow['Cost'];

        $user_id = isset($detorRow['user_id']) ? mysqli_real_escape_string($mysqli, $detorRow['user_id']) : '';
$fname = isset($detorRow['fname']) ? mysqli_real_escape_string($mysqli, $detorRow['fname']) : '';
$phone = isset($detorRow['phone']) ? mysqli_real_escape_string($mysqli, $detorRow['phone']) : '';
$address = isset($detorRow['address']) ? mysqli_real_escape_string($mysqli, $detorRow['address']) : '';
$total_price = isset($detorRow['total_price']) ? mysqli_real_escape_string($mysqli, $detorRow['total_price']) : '';
$discount = isset($detorRow['discount']) ? mysqli_real_escape_string($mysqli, $detorRow['discount']) : '';
$trackking_id = isset($detorRow['trackking_id']) ? mysqli_real_escape_string($mysqli, $detorRow['trackking_id']) : '';
$order_status = isset($detorRow['order_status']) ? mysqli_real_escape_string($mysqli, $detorRow['order_status']) : '';
$Mode_of_payment = isset($detorRow['Mode_of_payment']) ? mysqli_real_escape_string($mysqli, $detorRow['Mode_of_payment']) : '';
$pay = isset($detorRow['pay']) ? mysqli_real_escape_string($mysqli, $detorRow['pay']) : '';
$due = isset($detorRow['due']) ? mysqli_real_escape_string($mysqli, $detorRow['due']) : '';
$Payment_type = isset($detorRow['Payment_type']) ? mysqli_real_escape_string($mysqli, $detorRow['Payment_type']) : '';
$cash_transfer = isset($detorRow['cash_transfer']) ? mysqli_real_escape_string($mysqli, $detorRow['cash_transfer']) : '';
$cash_pos = isset($detorRow['cash_pos']) ? mysqli_real_escape_string($mysqli, $detorRow['cash_pos']) : '';
$date = isset($detorRow['date']) ? mysqli_real_escape_string($mysqli, $detorRow['date']) : '';
$month = isset($detorRow['month']) ? mysqli_real_escape_string($mysqli, $detorRow['month']) : '';
$year = isset($detorRow['year']) ? mysqli_real_escape_string($mysqli, $detorRow['year']) : '';
$location = isset($detorRow['location']) ? mysqli_real_escape_string($mysqli, $detorRow['location']) : '';
$new_mode_of_payment = isset($detorRow['new_mode_of_payment']) ? mysqli_real_escape_string($mysqli, $detorRow['new_mode_of_payment']) : '';
$new_date = isset($detorRow['new_date']) ? mysqli_real_escape_string($mysqli, $detorRow['new_date']) : '';
$new_payment_user_id = isset($detorRow['new_payment_user_id']) ? mysqli_real_escape_string($mysqli, $detorRow['new_payment_user_id']) : '';
$new_due = isset($detorRow['new_due']) ? mysqli_real_escape_string($mysqli, $detorRow['new_due']) : '';
$bankName = isset($detorRow['bankName']) ? mysqli_real_escape_string($mysqli, $detorRow['bankName']) : '';
$Cost = isset($detorRow['Cost']) ? mysqli_real_escape_string($mysqli, $detorRow['Cost']) : '';


          $selectOnlineProduct = "SELECT 'trackking_id' FROM orders WHERE trackking_id  = '".$trackking_id."' AND syn_flag = '1'";
           $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
           if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
              /*...............Loop through online service types.................*/
            while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
              $Onlinepet_id= $trackking_id;
              $onlineProductUpdate = "UPDATE orders
              SET
              total_price = '$total_price',
              discount = '$discount',
              order_status = '$order_status',
              Mode_of_payment = '$Mode_of_payment',
              pay = '$pay',
              due = '$due',
              Payment_type = '$Payment_type',
              cash_transfer = '$cash_transfer',
              cash_pos = '$cash_pos',
              date = '$date',
              month = '$month',
              year = '$year',
              syn_flag = '1',
              location = '$location',
              new_mode_of_payment = '$new_mode_of_payment',
              new_date = '$new_date',
              new_payment_user_id = '$new_payment_user_id',
              new_due = '$new_due',
              bankName = '$bankName',
              Cost = '$Cost'
              WHERE trackking_id = '$trackking_id'";
                  $resUpdate = mysqli_query($con, $onlineProductUpdate);

                  if ($resUpdate === false) {
                      die("Error updating record: " . mysqli_error($con));
                  }
                  $offlineUpdateSyn = "UPDATE orders SET syn_flag = '1' WHERE trackking_id = '$trackking_id'";
                  $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                  if ($resOfflineUpdate === false) {
                      die("Error updating syn_flag: " . mysqli_error($mysqli));
                  }
            }
          }
          else
          {
            $insertOnline = "INSERT INTO orders
            (`user_id`, `fname`, `phone`, `address`, `total_price`, `discount`, `trackking_id`, `order_status`, `Mode_of_payment`, `pay`, `due`, `Payment_type`, `cash_transfer`, `cash_pos`, `date`, `month`, `year`, `syn_flag`, `location`, `new_mode_of_payment`, `new_date`, `new_payment_user_id`, `new_due`, `bankName`, `Cost`)
            VALUES
            ('$user_id', '$fname', '$phone', '$address', '$total_price', '$discount', '$trackking_id', '$order_status', '$Mode_of_payment', '$pay', '$due', '$Payment_type', '$cash_transfer', '$cash_pos', '$date', '$month', '$year', '$syn_flag', '$location', '$new_mode_of_payment', '$new_date', '$new_payment_user_id', '$new_due', '$bankName', '$Cost')";
              $resOnlineUpdate = mysqli_query($con, $insertOnline);
              if ($resOnlineUpdate === false) {
                  die("Error checking for duplicate record: " . mysqli_error($con));
              }
              $offlineUpdateSyn = "UPDATE orders SET syn_flag = '1' WHERE trackking_id = '".$trackking_id."'";
              $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
              if ($resOfflineUpdate === false) {
               die("Error getting service_requests: " . $mysqli->error);
           }
         }
      }
  }


  $offline = "SELECT `user_id`, `order_id`, `prod_id`, `qty`, `price`, `product_id`, `date`, `month`, `year`, `Cost` FROM `order_iteams` WHERE syn_flag = '0'";
  $resOffline = $mysqli->query($offline);

  if ($resOffline->num_rows > 0) {
      while ($detorRow = $resOffline->fetch_assoc()) {
          $user_id = $detorRow['user_id'];
          $prod_id = $detorRow['prod_id'];
          $order_id = $detorRow['order_id'];
          $qty = $detorRow['qty'];
          $price = $detorRow['price'];
          $product_id = $detorRow['product_id'];
          $date = $detorRow['date'];
          $month = $detorRow['month'];
          $year = $detorRow['year'];
          $Cost = $detorRow['Cost'];
          $syn_flag = 1;

          // Escape values and ensure they are safe to use in the SQL query
          $user_id = isset($user_id) ? mysqli_real_escape_string($mysqli, $user_id) : '';
          $prod_id = isset($prod_id) ? mysqli_real_escape_string($mysqli, $prod_id) : '';
          $order_id = isset($order_id) ? mysqli_real_escape_string($mysqli, $order_id) : '';
          $qty = isset($qty) ? mysqli_real_escape_string($mysqli, $qty) : '';
          $price = isset($price) ? mysqli_real_escape_string($mysqli, $price) : '';
          $product_id = isset($product_id) ? mysqli_real_escape_string($mysqli, $product_id) : '';
          $date = isset($date) ? mysqli_real_escape_string($mysqli, $date) : '';
          $month = isset($month) ? mysqli_real_escape_string($mysqli, $month) : '';
          $year = isset($year) ? mysqli_real_escape_string($mysqli, $year) : '';
          $Cost = isset($Cost) ? mysqli_real_escape_string($mysqli, $Cost) : '';

          // Insert data into the online table
          $insertOnline = "INSERT INTO order_iteams (`user_id`, `prod_id`, `order_id`, `qty`, `price`, `product_id`, `date`, `month`, `year`, `Cost`, `syn_flag`)
                           VALUES ('$user_id', '$prod_id', '$order_id', '$qty', '$price', '$product_id', '$date', '$month', '$year', '$Cost', '$syn_flag')";
             $resOnlineUpdate = mysqli_query($con, $insertOnline);
          if (!$mysqli->query($insertOnline)) {
              die("Error inserting data: " . $mysqli->error);
          }

          // Update syn_flag in the offline table
          $offlineUpdateSyn = "UPDATE order_iteams SET syn_flag = '1' WHERE order_id = '$order_id'";
          if (!$mysqli->query($offlineUpdateSyn)) {
              die("Error updating syn_flag: " . $mysqli->error);
          }
      }
  }






 /*..............payment_dues start from here...........................*/
 $offline = "SELECT `id`, `Owner_name`, `total_price`, `Mode_of_payment`, `pay`, `due`, `Payment_type`, `date`, `month`, `year` FROM `payment_dues` WHERE syn_flag = '0'";
  $resOffline = $mysqli->query($offline);
   if($resOffline->num_rows > 0){
      while ($detorRow = $resOffline->fetch_assoc()) {
        $id = $detorRow['id'];
        $Owner_name = $detorRow['Owner_name'];
        $total_price = $detorRow['total_price'];
        $Mode_of_payment = $detorRow['Mode_of_payment'];
        $pay = $detorRow['pay'];
        $due = $detorRow['due'];
        $Payment_type = $detorRow['Payment_type'];
        $date = $detorRow['date'];
        $month = $detorRow['month'];
        $year = $detorRow['year'];
        $syn_flag =1;

        $id = isset($id) ? mysqli_real_escape_string($mysqli, $id) : '';
        $Owner_name = isset($Owner_name) ? mysqli_real_escape_string($mysqli, $Owner_name) : '';
        $total_price = isset($total_price) ? mysqli_real_escape_string($mysqli, $total_price) : '';
        $Mode_of_payment = isset($Mode_of_payment) ? mysqli_real_escape_string($mysqli, $Mode_of_payment) : '';
        $pay = isset($pay) ? mysqli_real_escape_string($mysqli, $pay) : '';
        $due = isset($due) ? mysqli_real_escape_string($mysqli, $due) : '';
        $Payment_type = isset($Payment_type) ? mysqli_real_escape_string($mysqli, $Payment_type) : '';
        $date = isset($date) ? mysqli_real_escape_string($mysqli, $date) : '';
        $month = isset($month) ? mysqli_real_escape_string($mysqli, $month) : '';
        $year = isset($year) ? mysqli_real_escape_string($mysqli, $year) : '';


          $selectOnlineProduct = "SELECT 'id' FROM payment_dues WHERE id  = '".$id."' AND syn_flag = '1'";
           $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
           if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
              /*...............Loop through online service types.................*/
            while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
                $Onlinepet_id= $Owner_name;
                $onlineProductUpdate = "UPDATE payment_dues
                                        SET
                                        total_price = '$total_price',
                                        Mode_of_payment = '$Mode_of_payment',
                                        pay = '$pay',
                                        due = '$due',
                                        Payment_type = '$Payment_type',
                                        date = '$date',
                                        month = '$month',
                                        year = '$year',
                                        syn_flag = '$syn_flag'
                                        WHERE id = '$id' AND `date` = '$date'";

                  $resUpdate = mysqli_query($con, $onlineProductUpdate);

                  if ($resUpdate === false) {
                      die("Error updating record: " . mysqli_error($con));
                  }
                  $offlineUpdateSyn = "UPDATE payment_dues SET syn_flag = '1' WHERE id = '$id'";

                  $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                  if ($resOfflineUpdate === false) {
                      die("Error updating syn_flag: " . mysqli_error($mysqli));
                  }
            }
          }
          else
          {
            $insertOnline = "INSERT INTO payment_dues
            (`Owner_name`, `total_price`, `Mode_of_payment`, `pay`, `due`, `Payment_type`, `date`, `month`, `year`, `syn_flag`)
            VALUES
            ('$Owner_name', '$total_price', '$Mode_of_payment', '$pay', '$due', '$Payment_type', '$date', '$month', '$year', '$syn_flag')";

              $resOnlineUpdate = mysqli_query($con, $insertOnline);
              if ($resOnlineUpdate === false) {
                  die("Error checking for duplicate record: " . mysqli_error($con));
              }
              $offlineUpdateSyn = "UPDATE payment_dues SET syn_flag = '1' WHERE  Owner_name = '$Owner_name'";
              $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
              if ($resOfflineUpdate === false) {
               die("Error getting service_requests: " . $mysqli->error);
           }
         }
      }
  }






 /*..............payment_dues start from here...........................*/
 $offline = "SELECT  `id`,`fname`, `total_price`, `Mode_of_payment`, `pay`, `due`, `Payment_type`FROM `pos_deus` WHERE syn_flag = '0'";
  $resOffline = $mysqli->query($offline);
   if($resOffline->num_rows > 0){
      while ($detorRow = $resOffline->fetch_assoc()) {
        $id = $detorRow['id'];
        $fname = $detorRow['fname'];
      $total_price = $detorRow['total_price'];
      $Mode_of_payment = $detorRow['Mode_of_payment'];
      $pay = $detorRow['pay'];
      $due = $detorRow['due'];
      $Payment_type = $detorRow['Payment_type'];
      $syn_flag =1;

      $id = isset($id) ? mysqli_real_escape_string($mysqli, $id) : '';
      $fname = isset($fname) ? mysqli_real_escape_string($mysqli, $fname) : '';
      $total_price = isset($total_price) ? mysqli_real_escape_string($mysqli, $total_price) : '';
      $Mode_of_payment = isset($Mode_of_payment) ? mysqli_real_escape_string($mysqli, $Mode_of_payment) : '';
      $pay = isset($pay) ? mysqli_real_escape_string($mysqli, $pay) : '';
      $due = isset($due) ? mysqli_real_escape_string($mysqli, $due) : '';
      $Payment_type = isset($Payment_type) ? mysqli_real_escape_string($mysqli, $Payment_type) : '';



          $selectOnlineProduct = "SELECT 'id' FROM pos_deus WHERE id  = '".$id."' AND syn_flag = '1'";
           $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
           if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
              /*...............Loop through online service types.................*/
            while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
                $onlineProductUpdate = "UPDATE pos_deus
                SET
                total_price = '$total_price',
                Mode_of_payment = '$Mode_of_payment',
                pay = '$pay',
                due = '$due',
                Payment_type = '$Payment_type',
                syn_flag = '$syn_flag'
                WHERE id = '$id'";
                  $resUpdate = mysqli_query($con, $onlineProductUpdate);
                  if ($resUpdate === false) {
                      die("Error updating record: " . mysqli_error($con));
                  }
                  $offlineUpdateSyn = "UPDATE pos_deus SET syn_flag = '1' WHERE id = '$id'";

                  $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                  if ($resOfflineUpdate === false) {
                      die("Error updating syn_flag: " . mysqli_error($mysqli));
                  }
            }
          }
          else
          {
            $insertOnline = "INSERT INTO pos_deus (id,fname, total_price, Mode_of_payment, pay, due, Payment_type)
                        VALUES ('$id', '$fname', '$total_price', '$Mode_of_payment', '$pay', '$due', '$Payment_type')";
              $resOnlineUpdate = mysqli_query($con, $insertOnline);
              if ($resOnlineUpdate === false) {
                  die("Error checking for duplicate record: " . mysqli_error($con));
              }
              $offlineUpdateSyn = "UPDATE payment_dues SET syn_flag = '1' WHERE  id = '$id'";
              $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
              if ($resOfflineUpdate === false) {
               die("Error getting service_requests: " . $mysqli->error);
           }
         }
      }
  }









 /*..............products start from here...........................*/

 $offline = "SELECT  `id`, `Name`, `Category`, `Cost`, `Price`, `Quantity`, `supplier`, `Quantity_level`, `Image`, `new_supply`, `Description`, `expiry_date`, `new_date`, `month`, `year`, `user_id` FROM `products` WHERE syn_flag = '0'";
  $resOffline = $mysqli->query($offline);
   if($resOffline->num_rows > 0){
      while ($detorRow = $resOffline->fetch_assoc()) {
        $id = $detorRow['id'];
        $Name = $detorRow['Name'];
        $Category = $detorRow['Category'];
        $Cost = $detorRow['Cost'];
        $Price = $detorRow['Price'];
        $Quantity = $detorRow['Quantity'];
        $supplier = $detorRow['supplier'];
        $Quantity_level = $detorRow['Quantity_level'];
        $Image = $detorRow['Image'];
        $new_supply = $detorRow['new_supply'];
        $Description = $detorRow['Description'];
        $expiry_date = $detorRow['expiry_date'];
        $new_date = $detorRow['new_date'];
        $month = $detorRow['month'];
        $year = $detorRow['year'];
        $user_id = $detorRow['user_id'];
        $syn_flag = 1;


        $id = isset($id) ? mysqli_real_escape_string($mysqli, $id) : '';
        $Name = isset($Name) ? mysqli_real_escape_string($mysqli, $Name) : '';
        $Category = isset($Category) ? mysqli_real_escape_string($mysqli, $Category) : '';
        $Cost = isset($Cost) ? mysqli_real_escape_string($mysqli, $Cost) : '';
        $Price = isset($Price) ? mysqli_real_escape_string($mysqli, $Price) : '';
        $Quantity = isset($Quantity) ? mysqli_real_escape_string($mysqli, $Quantity) : '';
        $supplier = isset($supplier) ? mysqli_real_escape_string($mysqli, $supplier) : '';
        $Quantity_level = isset($Quantity_level) ? mysqli_real_escape_string($mysqli, $Quantity_level) : '';
        $Image = isset($Image) ? mysqli_real_escape_string($mysqli, $Image) : '';
        $new_supply = isset($new_supply) ? mysqli_real_escape_string($mysqli, $new_supply) : '';
        $Description = isset($Description) ? mysqli_real_escape_string($mysqli, $Description) : '';
        $expiry_date = isset($expiry_date) ? mysqli_real_escape_string($mysqli, $expiry_date) : '';
        $new_date = isset($new_date) ? mysqli_real_escape_string($mysqli, $new_date) : '';
        $month = isset($month) ? mysqli_real_escape_string($mysqli, $month) : '';
        $year = isset($year) ? mysqli_real_escape_string($mysqli, $year) : '';
        $user_id = isset($user_id) ? mysqli_real_escape_string($mysqli, $user_id) : '';


          $selectOnlineProduct = "SELECT 'id' FROM products WHERE id  = '".$id."' AND syn_flag = '1'";
           $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
           if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
              /*...............Loop through online service types.................*/
            while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
                $onlineProductUpdate = "UPDATE products
                        SET
                        Name = '$Name',
                        Category = '$Category',
                        Cost = '$Cost',
                        Price = '$Price',
                        Quantity = '$Quantity',
                        supplier = '$supplier',
                        Quantity_level = '$Quantity_level',
                        Image = '$Image',
                        new_supply = '$new_supply',
                        Description = '$Description',
                        expiry_date = '$expiry_date',
                        new_date = '$new_date',
                        month = '$month',
                        year = '$year',
                        user_id = '$user_id',
                        syn_flag = '$syn_flag'
                        WHERE id = '$id'";
                  $resUpdate = mysqli_query($con, $onlineProductUpdate);
                  if ($resUpdate === false) {
                      die("Error updating record: " . mysqli_error($con));
                  }
                  $offlineUpdateSyn = "UPDATE products SET syn_flag = '1' WHERE id = '$id'";

                  $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                  if ($resOfflineUpdate === false) {
                      die("Error updating syn_flag: " . mysqli_error($mysqli));
                  }
            }
          }
          else
          {
            $insertOnline = "INSERT INTO products (Name, Category, Cost, Price, Quantity, supplier, Quantity_level, Image, new_supply, Description, expiry_date, new_date, month, year, user_id, syn_flag)
                                    VALUES ('$Name', '$Category', '$Cost', '$Price', '$Quantity', '$supplier', '$Quantity_level', '$Image', '$new_supply', '$Description', '$expiry_date', '$new_date', '$month', '$year', '$user_id', '$syn_flag')";

              $resOnlineUpdate = mysqli_query($con, $insertOnline);
              if ($resOnlineUpdate === false) {
                  die("Error checking for duplicate record: " . mysqli_error($con));
              }
              $offlineUpdateSyn = "UPDATE products SET syn_flag = '1' WHERE  id = '$id'";
              $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
              if ($resOfflineUpdate === false) {
               die("Error getting service_requests: " . $mysqli->error);
           }
         }
      }
  }







  /*..............service_items start from here...........................*/
  $offline = "SELECT `id`,`user_id`, `order_id`, `prod_name`, `pro_id`, `qty`, `price`, `total_vaccine_amount`, `subtotal`, `service`, `service_id`, `Amount`, `date`, `month`, `year` FROM `service_items` WHERE syn_flag = '0'";
 $resOffline = $mysqli->query($offline);
  if($resOffline->num_rows > 0){
     while ($detorRow = $resOffline->fetch_assoc()) {
        $id = $detorRow['id'];
        $user_id = $detorRow['user_id'];
        $order_id = $detorRow['order_id'];
        $prod_name = $detorRow['prod_name'];
        $pro_id = $detorRow['pro_id'];
        $qty = $detorRow['qty'];
        $price = $detorRow['price'];
        $total_vaccine_amount = $detorRow['total_vaccine_amount'];
        $subtotal = $detorRow['subtotal'];
        $service = $detorRow['service'];
        $service_id = $detorRow['service_id'];
        $Amount = $detorRow['Amount'];
        $date = $detorRow['date'];
        $month = $detorRow['month'];
        $year = $detorRow['year'];
        $syn_flag = 1;

        $id = isset($detorRow['id']) ? mysqli_real_escape_string($mysqli, $detorRow['id']) : '';
        $user_id = isset($detorRow['user_id']) ? mysqli_real_escape_string($mysqli, $detorRow['user_id']) : '';
        $order_id = isset($detorRow['order_id']) ? mysqli_real_escape_string($mysqli, $detorRow['order_id']) : '';
        $prod_name = isset($detorRow['prod_name']) ? mysqli_real_escape_string($mysqli, $detorRow['prod_name']) : '';
        $pro_id = isset($detorRow['pro_id']) ? mysqli_real_escape_string($mysqli, $detorRow['pro_id']) : '';
        $qty = isset($detorRow['qty']) ? mysqli_real_escape_string($mysqli, $detorRow['qty']) : '';
        $price = isset($detorRow['price']) ? mysqli_real_escape_string($mysqli, $detorRow['price']) : '';
        $total_vaccine_amount = isset($detorRow['total_vaccine_amount']) ? mysqli_real_escape_string($mysqli, $detorRow['total_vaccine_amount']) : '';
        $subtotal = isset($detorRow['subtotal']) ? mysqli_real_escape_string($mysqli, $detorRow['subtotal']) : '';
        $service = isset($detorRow['service']) ? mysqli_real_escape_string($mysqli, $detorRow['service']) : '';
        $service_id = isset($detorRow['service_id']) ? mysqli_real_escape_string($mysqli, $detorRow['service_id']) : '';
        $Amount = isset($detorRow['Amount']) ? mysqli_real_escape_string($mysqli, $detorRow['Amount']) : '';
        $date = isset($detorRow['date']) ? mysqli_real_escape_string($mysqli, $detorRow['date']) : '';
        $month = isset($detorRow['month']) ? mysqli_real_escape_string($mysqli, $detorRow['month']) : '';
        $year = isset($detorRow['year']) ? mysqli_real_escape_string($mysqli, $detorRow['year']) : '';


         $selectOnlineProduct = "SELECT 'id' FROM service_items WHERE id  = '".$id."' AND syn_flag = '1'";
          $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
          if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
             /*...............Loop through online service types.................*/
           while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
            $onlineProductUpdate = "UPDATE service_items
            SET
            user_id = '$user_id',
            order_id = '$order_id',
            prod_name = '$prod_name',
            pro_id = '$pro_id',
            qty = '$qty',
            price = '$price',
            total_vaccine_amount = '$total_vaccine_amount',
            subtotal = '$subtotal',
            service = '$service',
            service_id = '$service_id',
            Amount = '$Amount',
            date = '$date',
            month = '$month',
            year = '$year',
            syn_flag = '$syn_flag'
            WHERE id = '$id'";
                 $resUpdate = mysqli_query($con, $onlineProductUpdate);
                 if ($resUpdate === false) {
                     die("Error updating record: " . mysqli_error($con));
                 }
                 $offlineUpdateSyn = "UPDATE service_items SET syn_flag = '1' WHERE id = '$id'";

                 $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                 if ($resOfflineUpdate === false) {
                     die("Error updating syn_flag: " . mysqli_error($mysqli));
                 }
           }
         }
         else
         {
            $insertOnline = "INSERT INTO service_items (user_id, order_id, prod_name, pro_id, qty, price, total_vaccine_amount, subtotal, service, service_id, Amount, date, month, year, syn_flag)
            VALUES ('$user_id', '$order_id', '$prod_name', '$pro_id', '$qty', '$price', '$total_vaccine_amount', '$subtotal', '$service', '$service_id', '$Amount', '$date', '$month', '$year', '$syn_flag')";
             $resOnlineUpdate = mysqli_query($con, $insertOnline);
             if ($resOnlineUpdate === false) {
                 die("Error checking for duplicate record: " . mysqli_error($con));
             }
             $offlineUpdateSyn = "UPDATE service_items SET syn_flag = '1' WHERE  id = '$id'";
             $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
             if ($resOfflineUpdate === false) {
              die("Error getting service_requests: " . $mysqli->error);
          }
        }
     }
 }


 /*..............service_orders start from here...........................*/
 $offline = "SELECT  `id`, `user_id`, `Pet_name`, `Unregister`, `Owner_name`, `Phone`, `Next_vaccination_appointment`, `Next_appointments`, `total_price`, `order_status`, `Mode_of_payment`, `pay`, `due`, `Payment_type`, `cash_transfer`, `cash_pos`, `date`, `month`, `year`,`new_mode_of_payment`, `new_date`, `new_payment_user_id`, `new_due`, `bankName` FROM `service_orders` WHERE syn_flag = '0'";


 $resOffline = $mysqli->query($offline);
  if($resOffline->num_rows > 0){
     while ($detorRow = $resOffline->fetch_assoc()) {
        $id = $detorRow['id'];
      $user_id = $detorRow['user_id'];
      $Pet_name = $detorRow['Pet_name'];
      $Unregister = $detorRow['Unregister'];
      $Owner_name = $detorRow['Owner_name'];
      $Phone = $detorRow['Phone'];
      $Next_vaccination_appointment = $detorRow['Next_vaccination_appointment'];
      $Next_appointments = $detorRow['Next_appointments'];
      $total_price = $detorRow['total_price'];
      $order_status = $detorRow['order_status'];
      $Mode_of_payment = $detorRow['Mode_of_payment'];
      $pay = $detorRow['pay'];
      $due = $detorRow['due'];
      $Payment_type = $detorRow['Payment_type'];
      $cash_transfer = $detorRow['cash_transfer'];
      $cash_pos = $detorRow['cash_pos'];
      $date = $detorRow['date'];
      $month = $detorRow['month'];
      $year = $detorRow['year'];
      $new_mode_of_payment = $detorRow['new_mode_of_payment'];
      $year = $detorRow['year'];
      $new_date = $detorRow['new_date'];
      $new_payment_user_id = $detorRow['new_payment_user_id'];
      $new_due = $detorRow['new_due'];
      $bankName =$detorRow['bankName'];
      $syn_flag =1;


      $id = isset($detorRow['id']) ? mysqli_real_escape_string($mysqli, $detorRow['id']) : '';
      $user_id = isset($detorRow['user_id']) ? mysqli_real_escape_string($mysqli, $detorRow['user_id']) : '';
      $Pet_name = isset($detorRow['Pet_name']) ? mysqli_real_escape_string($mysqli, $detorRow['Pet_name']) : '';
      $Unregister = isset($detorRow['Unregister']) ? mysqli_real_escape_string($mysqli, $detorRow['Unregister']) : '';
      $Owner_name = isset($detorRow['Owner_name']) ? mysqli_real_escape_string($mysqli, $detorRow['Owner_name']) : '';
      $Phone = isset($detorRow['Phone']) ? mysqli_real_escape_string($mysqli, $detorRow['Phone']) : '';
      $Next_vaccination_appointment = isset($detorRow['Next_vaccination_appointment']) ? mysqli_real_escape_string($mysqli, $detorRow['Next_vaccination_appointment']) : '';
      $Next_appointments = isset($detorRow['Next_appointments']) ? mysqli_real_escape_string($mysqli, $detorRow['Next_appointments']) : '';
      $total_price = isset($detorRow['total_price']) ? mysqli_real_escape_string($mysqli, $detorRow['total_price']) : '';
      $order_status = isset($detorRow['order_status']) ? mysqli_real_escape_string($mysqli, $detorRow['order_status']) : '';
      $Mode_of_payment = isset($detorRow['Mode_of_payment']) ? mysqli_real_escape_string($mysqli, $detorRow['Mode_of_payment']) : '';
      $pay = isset($detorRow['pay']) ? mysqli_real_escape_string($mysqli, $detorRow['pay']) : '';
      $due = isset($detorRow['due']) ? mysqli_real_escape_string($mysqli, $detorRow['due']) : '';
      $Payment_type = isset($detorRow['Payment_type']) ? mysqli_real_escape_string($mysqli, $detorRow['Payment_type']) : '';
      $cash_transfer = isset($detorRow['cash_transfer']) ? mysqli_real_escape_string($mysqli, $detorRow['cash_transfer']) : '';
      $cash_pos = isset($detorRow['cash_pos']) ? mysqli_real_escape_string($mysqli, $detorRow['cash_pos']) : '';
      $date = isset($detorRow['date']) ? mysqli_real_escape_string($mysqli, $detorRow['date']) : '';
      $month = isset($detorRow['month']) ? mysqli_real_escape_string($mysqli, $detorRow['month']) : '';
      $year = isset($detorRow['year']) ? mysqli_real_escape_string($mysqli, $detorRow['year']) : '';
      $new_mode_of_payment = isset($detorRow['new_mode_of_payment']) ? mysqli_real_escape_string($mysqli, $detorRow['new_mode_of_payment']) : '';
      $new_date = isset($detorRow['new_date']) ? mysqli_real_escape_string($mysqli, $detorRow['new_date']) : '';
      $new_payment_user_id = isset($detorRow['new_payment_user_id']) ? mysqli_real_escape_string($mysqli, $detorRow['new_payment_user_id']) : '';
      $new_due = isset($detorRow['new_due']) ? mysqli_real_escape_string($mysqli, $detorRow['new_due']) : '';
      $bankName = isset($detorRow['bankName']) ? mysqli_real_escape_string($mysqli, $detorRow['bankName']) : '';



         $selectOnlineProduct = "SELECT 'id' FROM service_orders WHERE id  = '".$id."' AND syn_flag = '1'";

          $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
          if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
             /*...............Loop through online service types.................*/
           while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {

            $onlineProductUpdate = "UPDATE service_orders
                        SET
                        user_id = '$user_id',
                        Pet_name = '$Pet_name',
                        Unregister = '$Unregister',
                        Owner_name = '$Owner_name',
                        Phone = '$Phone',
                        Next_vaccination_appointment = '$Next_vaccination_appointment',
                        Next_appointments = '$Next_appointments',
                        total_price = '$total_price',
                        order_status = '$order_status',
                        Mode_of_payment = '$Mode_of_payment',
                        pay = '$pay',
                        due = '$due',
                        Payment_type = '$Payment_type',
                        cash_transfer = '$cash_transfer',
                        cash_pos = '$cash_pos',
                        date = '$date',
                        month = '$month',
                        year = '$year',
                        new_mode_of_payment = '$new_mode_of_payment',
                        new_date = '$new_date',
                        new_payment_user_id = '$new_payment_user_id',
                        new_due = '$new_due',
                        bankName = '$bankName',
                        syn_flag = '$syn_flag'
                        WHERE id = '$id'";
                 $resUpdate = mysqli_query($con, $onlineProductUpdate);
                 if ($resUpdate === false) {
                     die("Error updating record: " . mysqli_error($con));
                 }
                 $offlineUpdateSyn = "UPDATE service_orders SET syn_flag = '1' WHERE id = '$id'";

                 $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                 if ($resOfflineUpdate === false) {
                     die("Error updating syn_flag: " . mysqli_error($mysqli));
                 }
           }
         }
         else
         {
            $insertOnline = "INSERT INTO service_orders (user_id, Pet_name, Unregister, Owner_name, Phone, Next_vaccination_appointment, Next_appointments, total_price, order_status, Mode_of_payment, pay, due, Payment_type, cash_transfer, cash_pos, date, month, year, new_mode_of_payment, new_date, new_payment_user_id, new_due, bankName, syn_flag)
            VALUES ('$user_id', '$Pet_name', '$Unregister', '$Owner_name', '$Phone', '$Next_vaccination_appointment', '$Next_appointments', '$total_price', '$order_status', '$Mode_of_payment', '$pay', '$due', '$Payment_type', '$cash_transfer', '$cash_pos', '$date', '$month', '$year', '$new_mode_of_payment', '$new_date', '$new_payment_user_id', '$new_due', '$bankName', '$syn_flag')";

             $resOnlineUpdate = mysqli_query($con, $insertOnline);
             if ($resOnlineUpdate === false) {
                 die("Error checking for duplicate record: " . mysqli_error($con));
             }
             $offlineUpdateSyn = "UPDATE service_orders SET syn_flag = '1' WHERE  id = '$id'";
             $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
             if ($resOfflineUpdate === false) {
              die("Error getting service_requests: " . $mysqli->error);
          }
        }
     }
 }




/*..............shop_items start from here...........................*/

$offline = "SELECT `id`,`user_id`, `prod_name`, `pro_id`, `qty`, `price`, `status`, `subtotal`, `date`, `month`, `year`, `moved`, `location_transfer` FROM `shop_items` WHERE syn_flag = '0'";
$resOffline = $mysqli->query($offline);
 if($resOffline->num_rows > 0){
    while ($detorRow = $resOffline->fetch_assoc()) {
        $id = $detorRow['id'];
        $user_id = $detorRow['user_id'];
        $prod_name = $detorRow['prod_name'];
        $pro_id = $detorRow['pro_id'];
        $qty = $detorRow['qty'];
        $price = $detorRow['price'];
        $status = $detorRow['status'];
        $subtotal = $detorRow['subtotal'];
        $date = $detorRow['date'];
        $month = $detorRow['month'];
        $year = $detorRow['year'];
        $moved = $detorRow['moved'];
        $location_transfer = $detorRow['location_transfer'];
        $syn_flag = 1;

        $id = isset($detorRow['id']) ? mysqli_real_escape_string($mysqli, $detorRow['id']) : '';
        $user_id = isset($detorRow['user_id']) ? mysqli_real_escape_string($mysqli, $detorRow['user_id']) : '';
        $prod_name = isset($detorRow['prod_name']) ? mysqli_real_escape_string($mysqli, $detorRow['prod_name']) : '';
        $pro_id = isset($detorRow['pro_id']) ? mysqli_real_escape_string($mysqli, $detorRow['pro_id']) : '';
        $qty = isset($detorRow['qty']) ? mysqli_real_escape_string($mysqli, $detorRow['qty']) : '';
        $price = isset($detorRow['price']) ? mysqli_real_escape_string($mysqli, $detorRow['price']) : '';
        $status = isset($detorRow['status']) ? mysqli_real_escape_string($mysqli, $detorRow['status']) : '';
        $subtotal = isset($detorRow['subtotal']) ? mysqli_real_escape_string($mysqli, $detorRow['subtotal']) : '';
        $date = isset($detorRow['date']) ? mysqli_real_escape_string($mysqli, $detorRow['date']) : '';
        $month = isset($detorRow['month']) ? mysqli_real_escape_string($mysqli, $detorRow['month']) : '';
        $year = isset($detorRow['year']) ? mysqli_real_escape_string($mysqli, $detorRow['year']) : '';
        $moved = isset($detorRow['moved']) ? mysqli_real_escape_string($mysqli, $detorRow['moved']) : '';
        $location_transfer = isset($detorRow['location_transfer']) ? mysqli_real_escape_string($mysqli, $detorRow['location_transfer']) : '';


        $selectOnlineProduct = "SELECT 'id' FROM shop_items WHERE id  = '".$id."' AND syn_flag = '1'";
         $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
         if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
            /*...............Loop through online service types.................*/
          while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
            $onlineProductUpdate = "UPDATE shop_items
            SET
            user_id = '$user_id',
            prod_name = '$prod_name',
            pro_id = '$pro_id',
            qty = '$qty',
            price = '$price',
            status = '$status',
            subtotal = '$subtotal',
            date = '$date',
            month = '$month',
            year = '$year',
            moved = '$moved',
            location_transfer = '$location_transfer',
            syn_flag = '$syn_flag'
            WHERE id = '$id'";

                $resUpdate = mysqli_query($con, $onlineProductUpdate);
                if ($resUpdate === false) {
                    die("Error updating record: " . mysqli_error($con));
                }
                $offlineUpdateSyn = "UPDATE shop_items SET syn_flag = '1' WHERE id = '$id'";

                $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                if ($resOfflineUpdate === false) {
                    die("Error updating syn_flag: " . mysqli_error($mysqli));
                }
          }
        }
        else
        {
            $insertOnline = "INSERT INTO shop_items (id, user_id, prod_name, pro_id, qty, price, status, subtotal, date, month, year, moved, location_transfer, syn_flag)
            VALUES ('$id', '$user_id', '$prod_name', '$pro_id', '$qty', '$price', '$status', '$subtotal', '$date', '$month', '$year', '$moved', '$location_transfer', '$syn_flag')";
            $resOnlineUpdate = mysqli_query($con, $insertOnline);
            if ($resOnlineUpdate === false) {
                die("Error checking for duplicate record: " . mysqli_error($con));
            }
            $offlineUpdateSyn = "UPDATE shop_items SET syn_flag = '1' WHERE  id = '$id'";
            $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
            if ($resOfflineUpdate === false) {
             die("Error getting service_requests: " . $mysqli->error);
         }
       }
    }
}




/*..............suppliers start from here...........................*/
$offline = "SELECT `id`,`Company_Name`, `Name`, `Email`, `Phone_Number`, `Address`, `City`, `State`, `Country`, `date` FROM `suppliers` WHERE syn_flag = '0'";
$resOffline = $mysqli->query($offline);
 if($resOffline->num_rows > 0){
    while ($detorRow = $resOffline->fetch_assoc()) {
        $id = $detorRow['id'];
        $Company_Name = $detorRow['Company_Name'];
        $Name = $detorRow['Name'];
        $Email = $detorRow['Email'];
        $Phone_Number = $detorRow['Phone_Number'];
        $Address = $detorRow['Address'];
        $City = $detorRow['City'];
        $State = $detorRow['State'];
        $date = $detorRow['date'];
        $syn_flag =1;

        $id = isset($detorRow['id']) ? mysqli_real_escape_string($mysqli, $detorRow['id']) : '';
        $Company_Name = isset($detorRow['Company_Name']) ? mysqli_real_escape_string($mysqli, $detorRow['Company_Name']) : '';
        $Name = isset($detorRow['Name']) ? mysqli_real_escape_string($mysqli, $detorRow['Name']) : '';
        $Email = isset($detorRow['Email']) ? mysqli_real_escape_string($mysqli, $detorRow['Email']) : '';
        $Phone_Number = isset($detorRow['Phone_Number']) ? mysqli_real_escape_string($mysqli, $detorRow['Phone_Number']) : '';
        $Address = isset($detorRow['Address']) ? mysqli_real_escape_string($mysqli, $detorRow['Address']) : '';
        $City = isset($detorRow['City']) ? mysqli_real_escape_string($mysqli, $detorRow['City']) : '';
        $State = isset($detorRow['State']) ? mysqli_real_escape_string($mysqli, $detorRow['State']) : '';
        $date = isset($detorRow['date']) ? mysqli_real_escape_string($mysqli, $detorRow['date']) : '';



        $selectOnlineProduct = "SELECT 'id' FROM suppliers WHERE id  = '".$id."' AND syn_flag = '1'";
         $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
         if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
            /*...............Loop through online service types.................*/
          while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
            $onlineProductUpdate  = "UPDATE suppliers
            SET
            Company_Name = '$Company_Name',
            Name = '$Name',
            Email = '$Email',
            Phone_Number = '$Phone_Number',
            Address = '$Address',
            City = '$City',
            State = '$State',
            date = '$date',
            syn_flag = '$syn_flag'
            WHERE id = '$id'";

                $resUpdate = mysqli_query($con, $onlineProductUpdate);
                if ($resUpdate === false) {
                    die("Error updating record: " . mysqli_error($con));
                }
                $offlineUpdateSyn = "UPDATE suppliers SET syn_flag = '1' WHERE id = '$id'";

                $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                if ($resOfflineUpdate === false) {
                    die("Error updating syn_flag: " . mysqli_error($mysqli));
                }
          }
        }
        else
        {
            $insertOnline = "INSERT INTO suppliers (Company_Name, Name, Email, Phone_Number, Address, City, State, date, syn_flag)
            VALUES ('$Company_Name', '$Name', '$Email', '$Phone_Number', '$Address', '$City', '$State', '$date', '$syn_flag')";
            $resOnlineUpdate = mysqli_query($con, $insertOnline);
            if ($resOnlineUpdate === false) {
                die("Error checking for duplicate record: " . mysqli_error($con));
            }
            $offlineUpdateSyn = "UPDATE suppliers SET syn_flag = '1' WHERE  id = '$id'";
            $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
            if ($resOfflineUpdate === false) {
             die("Error getting service_requests: " . $mysqli->error);
         }
       }
    }
}


/*..............vaccineiteams start from here...........................*/
$offline = "SELECT  `id`,`order_id`, `items_name`, `vaccine_id`, `qty`, `price` FROM `vaccineiteams` WHERE syn_flag = '0'";
$resOffline = $mysqli->query($offline);
 if($resOffline->num_rows > 0){
    while ($detorRow = $resOffline->fetch_assoc()) {
        $id = $detorRow['id'];
        $order_id = $detorRow['order_id'];
     $items_name = $detorRow['items_name'];
     $vaccine_id = $detorRow['vaccine_id'];
     $qty = $detorRow['qty'];
     $price = $detorRow['price'];
     $syn_flag =1;


$id = isset($detorRow['id']) ? mysqli_real_escape_string($mysqli, $detorRow['id']) : '';
$order_id = isset($detorRow['order_id']) ? mysqli_real_escape_string($mysqli, $detorRow['order_id']) : '';
$items_name = isset($detorRow['items_name']) ? mysqli_real_escape_string($mysqli, $detorRow['items_name']) : '';
$vaccine_id = isset($detorRow['vaccine_id']) ? mysqli_real_escape_string($mysqli, $detorRow['vaccine_id']) : '';
$qty = isset($detorRow['qty']) ? mysqli_real_escape_string($mysqli, $detorRow['qty']) : '';
$price = isset($detorRow['price']) ? mysqli_real_escape_string($mysqli, $detorRow['price']) : '';


        $selectOnlineProduct = "SELECT 'id' FROM vaccineiteams WHERE id  = '".$id."' AND syn_flag = '1'";
         $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
         if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
            /*...............Loop through online service types.................*/
          while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
            $onlineProductUpdate = "UPDATE vaccineiteams
            SET items_name = '$items_name',
                vaccine_id = '$vaccine_id',
                qty = '$qty',
                price = '$price',
                syn_flag = '$syn_flag'
            WHERE order_id = '$order_id'";

                $resUpdate = mysqli_query($con, $onlineProductUpdate);
                if ($resUpdate === false) {
                    die("Error updating record: " . mysqli_error($con));
                }
                $offlineUpdateSyn = "UPDATE vaccineiteams SET syn_flag = '1' WHERE id = '$id'";

                $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                if ($resOfflineUpdate === false) {
                    die("Error updating syn_flag: " . mysqli_error($mysqli));
                }
          }
        }
        else
        {
            $insertOnline = "INSERT INTO vaccineiteams (order_id, items_name, vaccine_id, qty, price, syn_flag)
            VALUES ('$order_id', '$items_name', '$vaccine_id', '$qty', '$price', '$syn_flag')";
            $resOnlineUpdate = mysqli_query($con, $insertOnline);
            if ($resOnlineUpdate === false) {
                die("Error checking for duplicate record: " . mysqli_error($con));
            }
            $offlineUpdateSyn = "UPDATE vaccineiteams SET syn_flag = '1' WHERE  id = '$id'";
            $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
            if ($resOfflineUpdate === false) {
             die("Error getting service_requests: " . $mysqli->error);
         }
       }
    }
}





/*..............vaccineorders start from here...........................*/

$offline = "SELECT  `id`, `user_id`, `name`, `discount`, `phone`, `address`, `order_status`, `Mode_of_payment`, `cash_transfer`, `cash_pos`, `pay`, `due`, `total`, `Payment_type`, `date`, `month`, `year`, `new_mode_of_payment`, `new_date`, `new_payment_user_id`, `new_due`, `bankName` FROM `vaccineorders` WHERE syn_flag = '0'";
$resOffline = $mysqli->query($offline);
 if($resOffline->num_rows > 0){
    while ($detorRow = $resOffline->fetch_assoc()) {
        $id = $detorRow['id'];
        $user_id = $detorRow['user_id'];
        $name = $detorRow['name'];
        $discount = $detorRow['discount'];
        $phone = $detorRow['phone'];
        $address = $detorRow['address'];
        $order_status = $detorRow['order_status'];
        $Mode_of_payment = $detorRow['Mode_of_payment'];
        $cash_transfer = $detorRow['cash_transfer'];
        $cash_pos = $detorRow['cash_pos'];
        $pay = $detorRow['pay'];
        $due = $detorRow['due'];
        $total = $detorRow['total'];
        $Payment_type = $detorRow['Payment_type'];
        $date = $detorRow['date'];
        $month = $detorRow['month'];
        $year = $detorRow['year'];
        $new_mode_of_payment = $detorRow['new_mode_of_payment'];
        $new_date = $detorRow['new_date'];
        $bankName = $detorRow['bankName'];
        $new_due = $detorRow['new_due'];
        $new_payment_user_id =$detorRow['new_payment_user_id'];
        $syn_flag =1;


        $id = isset($detorRow['id']) ? mysqli_real_escape_string($mysqli, $detorRow['id']) : '';
        $user_id = isset($detorRow['user_id']) ? mysqli_real_escape_string($mysqli, $detorRow['user_id']) : '';
        $name = isset($detorRow['name']) ? mysqli_real_escape_string($mysqli, $detorRow['name']) : '';
        $discount = isset($detorRow['discount']) ? mysqli_real_escape_string($mysqli, $detorRow['discount']) : '';
        $phone = isset($detorRow['phone']) ? mysqli_real_escape_string($mysqli, $detorRow['phone']) : '';
        $address = isset($detorRow['address']) ? mysqli_real_escape_string($mysqli, $detorRow['address']) : '';
        $order_status = isset($detorRow['order_status']) ? mysqli_real_escape_string($mysqli, $detorRow['order_status']) : '';
        $Mode_of_payment = isset($detorRow['Mode_of_payment']) ? mysqli_real_escape_string($mysqli, $detorRow['Mode_of_payment']) : '';
        $cash_transfer = isset($detorRow['cash_transfer']) ? mysqli_real_escape_string($mysqli, $detorRow['cash_transfer']) : '';
        $cash_pos = isset($detorRow['cash_pos']) ? mysqli_real_escape_string($mysqli, $detorRow['cash_pos']) : '';
        $pay = isset($detorRow['pay']) ? mysqli_real_escape_string($mysqli, $detorRow['pay']) : '';
        $due = isset($detorRow['due']) ? mysqli_real_escape_string($mysqli, $detorRow['due']) : '';
        $total = isset($detorRow['total']) ? mysqli_real_escape_string($mysqli, $detorRow['total']) : '';
        $Payment_type = isset($detorRow['Payment_type']) ? mysqli_real_escape_string($mysqli, $detorRow['Payment_type']) : '';
        $date = isset($detorRow['date']) ? mysqli_real_escape_string($mysqli, $detorRow['date']) : '';
        $month = isset($detorRow['month']) ? mysqli_real_escape_string($mysqli, $detorRow['month']) : '';
        $year = isset($detorRow['year']) ? mysqli_real_escape_string($mysqli, $detorRow['year']) : '';
        $new_mode_of_payment = isset($detorRow['new_mode_of_payment']) ? mysqli_real_escape_string($mysqli, $detorRow['new_mode_of_payment']) : '';
        $new_date = isset($detorRow['new_date']) ? mysqli_real_escape_string($mysqli, $detorRow['new_date']) : '';
        $bankName = isset($detorRow['bankName']) ? mysqli_real_escape_string($mysqli, $detorRow['bankName']) : '';
        $new_due = isset($detorRow['new_due']) ? mysqli_real_escape_string($mysqli, $detorRow['new_due']) : '';
        $new_payment_user_id = isset($detorRow['new_payment_user_id']) ? mysqli_real_escape_string($mysqli, $detorRow['new_payment_user_id']) : '';

        $selectOnlineProduct = "SELECT 'id' FROM vaccineorders WHERE id  = '".$id."' AND syn_flag = '1'";
         $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
         if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
            /*...............Loop through online service types.................*/
          while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
            $onlineProductUpdate = "UPDATE vaccineorders
            SET name = '$name',
                discount = '$discount',
                phone = '$phone',
                address = '$address',
                order_status = '$order_status',
                Mode_of_payment = '$Mode_of_payment',
                cash_transfer = '$cash_transfer',
                cash_pos = '$cash_pos',
                pay = '$pay',
                due = '$due',
                total = '$total',
                Payment_type = '$Payment_type',
                date = '$date',
                month = '$month',
                year = '$year',
                new_mode_of_payment = '$new_mode_of_payment',
                new_date = '$new_date',
                bankName = '$bankName',
                new_due = '$new_due',
                new_payment_user_id = '$new_payment_user_id',
                syn_flag = '$syn_flag'
            WHERE user_id = '$user_id'";
                $resUpdate = mysqli_query($con, $onlineProductUpdate);
                if ($resUpdate === false) {
                    die("Error updating record: " . mysqli_error($con));
                }
                $offlineUpdateSyn = "UPDATE vaccineorders SET syn_flag = '1' WHERE id = '$id'";

                $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                if ($resOfflineUpdate === false) {
                    die("Error updating syn_flag: " . mysqli_error($mysqli));
                }
          }
        }
        else
        {
            $insertOnline = "INSERT INTO vaccineorders (user_id, name, discount, phone, address, order_status, Mode_of_payment, cash_transfer, cash_pos, pay, due, total, Payment_type, date, month, year, new_mode_of_payment, new_date, bankName, new_due, new_payment_user_id, syn_flag)
            VALUES ('$user_id', '$name', '$discount', '$phone', '$address', '$order_status', '$Mode_of_payment', '$cash_transfer', '$cash_pos', '$pay', '$due', '$total', '$Payment_type', '$date', '$month', '$year', '$new_mode_of_payment', '$new_date', '$bankName', '$new_due', '$new_payment_user_id', '$syn_flag')";
            $resOnlineUpdate = mysqli_query($con, $insertOnline);
            if ($resOnlineUpdate === false) {
                die("Error checking for duplicate record: " . mysqli_error($con));
            }
            $offlineUpdateSyn = "UPDATE vaccineorders SET syn_flag = '1' WHERE  id = '$id'";
            $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
            if ($resOfflineUpdate === false) {
             die("Error getting service_requests: " . $mysqli->error);
         }
       }
    }
}





/*..............vaccinestores start from here...........................*/

$offline = "SELECT `id`,`user_id`, `Name`, `Cost`, `Price`, `Quantity`, `minimum`, `Image`, `expiry_date`, `new_supply`, `supply_date`, `brand`, `supplier`FROM `vaccinestores` WHERE syn_flag = '0'";
$resOffline = $mysqli->query($offline);
 if($resOffline->num_rows > 0){
    while ($detorRow = $resOffline->fetch_assoc()) {
        $id = $detorRow['id'];
        $user_id   = $detorRow['user_id'];
        $Name   = $detorRow['Name'];
        $Cost  = $detorRow['Cost'];
        $Price = $detorRow['Price'];
        $Quantity  = $detorRow['Quantity'];
        $minimum  = $detorRow['minimum'];
        $Image = $detorRow['Image'];
        $expiry_date = $detorRow['expiry_date'];
        $new_supply = $detorRow['new_supply'];
        $supply_date = $detorRow['supply_date'];
        $brand = $detorRow['brand'];
        $supplier = $detorRow['supplier'];
        $syn_flag =1;

        $id = isset($detorRow['id']) ? mysqli_real_escape_string($mysqli, $detorRow['id']) : '';
        $user_id = isset($detorRow['user_id']) ? mysqli_real_escape_string($mysqli, $detorRow['user_id']) : '';
        $Name = isset($detorRow['Name']) ? mysqli_real_escape_string($mysqli, $detorRow['Name']) : '';
        $Cost = isset($detorRow['Cost']) ? mysqli_real_escape_string($mysqli, $detorRow['Cost']) : '';
        $Price = isset($detorRow['Price']) ? mysqli_real_escape_string($mysqli, $detorRow['Price']) : '';
        $Quantity = isset($detorRow['Quantity']) ? mysqli_real_escape_string($mysqli, $detorRow['Quantity']) : '';
        $minimum = isset($detorRow['minimum']) ? mysqli_real_escape_string($mysqli, $detorRow['minimum']) : '';
        $Image = isset($detorRow['Image']) ? mysqli_real_escape_string($mysqli, $detorRow['Image']) : '';
        $expiry_date = isset($detorRow['expiry_date']) ? mysqli_real_escape_string($mysqli, $detorRow['expiry_date']) : '';
        $new_supply = isset($detorRow['new_supply']) ? mysqli_real_escape_string($mysqli, $detorRow['new_supply']) : '';
        $supply_date = isset($detorRow['supply_date']) ? mysqli_real_escape_string($mysqli, $detorRow['supply_date']) : '';
        $brand = isset($detorRow['brand']) ? mysqli_real_escape_string($mysqli, $detorRow['brand']) : '';
        $supplier = isset($detorRow['supplier']) ? mysqli_real_escape_string($mysqli, $detorRow['supplier']) : '';


        $selectOnlineProduct = "SELECT 'id' FROM vaccinestores WHERE id  = '".$id."' AND syn_flag = '1'";
         $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
         if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
            /*...............Loop through online service types.................*/
          while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
            $onlineProductUpdate = "UPDATE vaccinestores
            SET user_id = '$user_id',
                Name = '$Name',
                Cost = '$Cost',
                Price = '$Price',
                Quantity = '$Quantity',
                minimum = '$minimum',
                Image = '$Image',
                expiry_date = '$expiry_date',
                new_supply = '$new_supply',
                supply_date = '$supply_date',
                brand = '$brand',
                supplier = '$supplier',
                syn_flag = '$syn_flag'
            WHERE id = '$id'";
                $resUpdate = mysqli_query($con, $onlineProductUpdate);
                if ($resUpdate === false) {
                    die("Error updating record: " . mysqli_error($con));
                }
                $offlineUpdateSyn = "UPDATE vaccinestores SET syn_flag = '1' WHERE id = '$id'";

                $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                if ($resOfflineUpdate === false) {
                    die("Error updating syn_flag: " . mysqli_error($mysqli));
                }
          }
        }
        else
        {
            $insertOnline = "INSERT INTO vaccinestores (user_id, Name, Cost, Price, Quantity, minimum, Image, expiry_date, new_supply, supply_date, brand, supplier, syn_flag)
            VALUES ('$user_id', '$Name', '$Cost', '$Price', '$Quantity', '$minimum', '$Image', '$expiry_date', '$new_supply', '$supply_date', '$brand', '$supplier', '$syn_flag')";
            $resOnlineUpdate = mysqli_query($con, $insertOnline);
            if ($resOnlineUpdate === false) {
                die("Error checking for duplicate record: " . mysqli_error($con));
            }
            $offlineUpdateSyn = "UPDATE vaccinestores SET syn_flag = '1' WHERE  id = '$id'";
            $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
            if ($resOfflineUpdate === false) {
             die("Error getting service_requests: " . $mysqli->error);
         }
       }
    }

}


/*..............User start from here...........................*/
$offline = "SELECT `id`,`name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `late_charge`, `salary`, `resumption_time`,`syn_flag` FROM `users` WHERE syn_flag = '0'";
$resOffline = $mysqli->query($offline);
 if($resOffline->num_rows > 0){
    while ($detorRow = $resOffline->fetch_assoc()) {
        $id = $detorRow['id'];
        $name = $detorRow['name'];
        $email = $detorRow['email'];
        $email_verified_at = $detorRow['email_verified_at'];
        $password = $detorRow['password'];
        $two_factor_secret = $detorRow['two_factor_secret'];
        $two_factor_recovery_codes = $detorRow['two_factor_recovery_codes'];
        $remember_token = $detorRow['remember_token'];
        $current_team_id = $detorRow['current_team_id'];
        $profile_photo_path = $detorRow['profile_photo_path'];
        $late_charge = $detorRow['late_charge'];
        $salary = $detorRow['salary'];
        $resumption_time = $detorRow['resumption_time'];
        $syn_flag = 1;

        $id = isset($detorRow['id']) ? mysqli_real_escape_string($mysqli, $detorRow['id']) : '';
        $name = isset($detorRow['name']) ? mysqli_real_escape_string($mysqli, $detorRow['name']) : '';
        $email = isset($detorRow['email']) ? mysqli_real_escape_string($mysqli, $detorRow['email']) : '';
        $email_verified_at = isset($detorRow['email_verified_at']) ? mysqli_real_escape_string($mysqli, $detorRow['email_verified_at']) : '';
        $password = isset($detorRow['password']) ? mysqli_real_escape_string($mysqli, $detorRow['password']) : '';
        $two_factor_secret = isset($detorRow['two_factor_secret']) ? mysqli_real_escape_string($mysqli, $detorRow['two_factor_secret']) : '';
        $two_factor_recovery_codes = isset($detorRow['two_factor_recovery_codes']) ? mysqli_real_escape_string($mysqli, $detorRow['two_factor_recovery_codes']) : '';
        $remember_token = isset($detorRow['remember_token']) ? mysqli_real_escape_string($mysqli, $detorRow['remember_token']) : '';
        $current_team_id = isset($detorRow['current_team_id']) ? mysqli_real_escape_string($mysqli, $detorRow['current_team_id']) : '';
        $profile_photo_path = isset($detorRow['profile_photo_path']) ? mysqli_real_escape_string($mysqli, $detorRow['profile_photo_path']) : '';
        $late_charge = isset($detorRow['late_charge']) ? mysqli_real_escape_string($mysqli, $detorRow['late_charge']) : '';
        $salary = isset($detorRow['salary']) ? mysqli_real_escape_string($mysqli, $detorRow['salary']) : '';
        $resumption_time = isset($detorRow['resumption_time']) ? mysqli_real_escape_string($mysqli, $detorRow['resumption_time']) : '';



        $selectOnlineProduct = "SELECT 'id' FROM users WHERE id = '$id' AND email = '$email'  AND syn_flag = '1'";
         $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
         if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
            /*...............Loop through online service types.................*/
          while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
            $onlineProductUpdate = "UPDATE users
            SET name = '$name',
                -- email = '$email',
                -- email_verified_at = '$email_verified_at',
                password = '$password',
                two_factor_secret = '$two_factor_secret',
                two_factor_recovery_codes = '$two_factor_recovery_codes',
                remember_token = '$remember_token',
                current_team_id = '$current_team_id',
                profile_photo_path = '$profile_photo_path',
                late_charge = '$late_charge',
                salary = '$salary',
                resumption_time = '$resumption_time',
                syn_flag = '$syn_flag'
            WHERE id = '$id' AND email = '$email'";
                $resUpdate = mysqli_query($con, $onlineProductUpdate);
                if ($resUpdate === false) {
                    die("Error updating record: " . mysqli_error($con));
                }
                $offlineUpdateSyn = "UPDATE users SET syn_flag = '1' WHERE id = '$id'";

                $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
                if ($resOfflineUpdate === false) {
                    die("Error updating syn_flag: " . mysqli_error($mysqli));
                }
          }
        }
        else
        {
            $insertOnline = "INSERT INTO `users` ( `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `late_charge`, `salary`, `resumption_time`, `syn_flag`)
            VALUES ('$name', '$email', '$email_verified_at', '$password', '$two_factor_secret', '$two_factor_recovery_codes', '$remember_token', '$current_team_id', '$profile_photo_path', '$late_charge', '$salary', '$resumption_time', '$syn_flag')";
            $resOnlineUpdate = mysqli_query($con, $insertOnline);
            if ($resOnlineUpdate === false) {
                die("Error checking for duplicate record: " . mysqli_error($con));
            }
            $offlineUpdateSyn = "UPDATE users SET syn_flag = '1' WHERE  id = '$id'";
            $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
            if ($resOfflineUpdate === false) {
             die("Error getting users: " . $mysqli->error);
         }
       }
    }
}

session()->flash('item', 'Synchronization successful. Your data is now up-to-date.');
return back();
} catch (\Throwable $th) {
    //throw $th;s
    session()->flash('item_not', 'Synchronization was not successful due to a weak network. Please try again later. Error: ' . $th->getMessage());
    return back();
}


}



function update2(){

    try {
        // Set max execution time and time limit
        ini_set('max_execution_time', 3600); // 3600 seconds = 60 minutes
        set_time_limit(3600);

        // Offline database connection
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "mavenvet";
        $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $db);
        if ($mysqli->connect_error) {
            throw new Exception("Connection failed: " . $mysqli->connect_error);
        }

        // Online database connection
        $online_host = '131.153.147.34';
        $online_user = 'mavenvet_midwifery';
        $online_password = 'mavenvet_midwifery';
        $online_db = 'mavenvet_midwifery';
        $online_con = mysqli_connect($online_host, $online_user, $online_password, $online_db);
        if ($online_con === false) {
            throw new Exception("Online database connection error: " . mysqli_connect_error());
        }

        // Copy data from online table to offline table
        $selectQuery = "SELECT * FROM shop_items WHERE moved = 'moved' AND moved_status = 0 AND status = 'Head_Office_Breach_Office'";
        $result = mysqli_query($online_con, $selectQuery);
        if ($result === false) {
            throw new Exception("Error selecting data from online table: " . mysqli_error($online_con));
        }
        if ($result->num_rows > 0) {
            while ($detorRow = $result->fetch_assoc()) {
                // Fetch data from online table
                $id = $detorRow['id'];
                $user_id = $detorRow['user_id'];
                $prod_name = $detorRow['prod_name'];
                $pro_id = $detorRow['pro_id'];
                $qty = $detorRow['qty'];
                $price = $detorRow['price'];
                $status = $detorRow['status'];
                $subtotal = $detorRow['subtotal'];
                $date = $detorRow['date'];
                $month = $detorRow['month'];
                $year = $detorRow['year'];
                $moved = $detorRow['moved'];
                $location_transfer = $detorRow['location_transfer'];
                $created_at = $detorRow['created_at'];
                $syn_flag = 1;

                $id = isset($detorRow['id']) ? mysqli_real_escape_string($mysqli, $detorRow['id']) : '';
                $user_id = isset($detorRow['user_id']) ? mysqli_real_escape_string($mysqli, $detorRow['user_id']) : '';
                $prod_name = isset($detorRow['prod_name']) ? mysqli_real_escape_string($mysqli, $detorRow['prod_name']) : '';
                $pro_id = isset($detorRow['pro_id']) ? mysqli_real_escape_string($mysqli, $detorRow['pro_id']) : '';
                $qty = isset($detorRow['qty']) ? mysqli_real_escape_string($mysqli, $detorRow['qty']) : '';
                $price = isset($detorRow['price']) ? mysqli_real_escape_string($mysqli, $detorRow['price']) : '';
                $status = isset($detorRow['status']) ? mysqli_real_escape_string($mysqli, $detorRow['status']) : '';
                $subtotal = isset($detorRow['subtotal']) ? mysqli_real_escape_string($mysqli, $detorRow['subtotal']) : '';
                $date = isset($detorRow['current_team_id']) ? mysqli_real_escape_string($mysqli, $detorRow['date']) : '';
                $month = isset($detorRow['month']) ? mysqli_real_escape_string($mysqli, $detorRow['month']) : '';
                $year = isset($detorRow['year']) ? mysqli_real_escape_string($mysqli, $detorRow['year']) : '';
                $moved = isset($detorRow['moved']) ? mysqli_real_escape_string($mysqli, $detorRow['moved']) : '';
                $location_transfer = isset($detorRow['location_transfer']) ? mysqli_real_escape_string($mysqli, $detorRow['location_transfer']) : '';
                $created_at = isset($detorRow['created_at']) ? mysqli_real_escape_string($mysqli, $detorRow['created_at']) : '';
                // Insert data into offline table
                $insertQuery = "INSERT INTO transferstores ( user_id, prod_name, pro_id, qty, price, status, subtotal, date, month, year, moved, location_transfer, syn_flag,created_at) VALUES ('$user_id', '$prod_name', '$pro_id', '$qty', '$price', '$status', '$subtotal', '$date', '$month', '$year', '$moved', '$location_transfer', '$syn_flag', '$created_at')";
                $mysqli->query($insertQuery);

                // Update online table after successful insertzzz
                $updateQuery = "UPDATE shop_items SET syn_flag = '1', moved_status = '1' WHERE id = '$id'";
                $updateResult = mysqli_query($online_con, $updateQuery);
                if ($updateResult === false) {
                    throw new Exception("Error updating data in online table: " . mysqli_error($online_con));
                }
            }
        }

        // Success flash message
        session()->flash('item', 'Product synchronization successful');
        return back();
    } catch (\Throwable $th) {
        // Error flash message
        session()->flash('item_not', 'Product synchronization failed: ' . $th->getMessage());
        return back();
    }
}


// this update software from backend .....
public function update_software() {
    try {
        $repositoryUrl = 'https://github.com/AdeyeyeSunday/mavenvet/archive/main.zip';

        // Fetch the ZIP file from the repository
        $zipFile = file_get_contents($repositoryUrl);

        // Specify the path where you want to save the downloaded ZIP file
        $localZipPath = 'C:\xampp\htdocs\repo.zip';

        // Save the downloaded ZIP file to a local directory
        file_put_contents($localZipPath, $zipFile);

        // Specify the path where you want to extract the repository contents
        $extractPath = 'C:\xampp\htdocs\test';

        // Remove the existing mavenvet folder if it exists
        $existingFolderPath = $extractPath . DIRECTORY_SEPARATOR . 'mavenvet';
        if (is_dir($existingFolderPath)) {
            // Preserve the vendor directory and .env file if they exist
            $vendorExists = is_dir($existingFolderPath . DIRECTORY_SEPARATOR . 'vendor');
            $envExists = file_exists($existingFolderPath . DIRECTORY_SEPARATOR . '.env');

            if ($vendorExists) {
                rename($existingFolderPath . DIRECTORY_SEPARATOR . 'vendor', $existingFolderPath . '-vendor');
            }
            if ($envExists) {
                rename($existingFolderPath . DIRECTORY_SEPARATOR . '.env', $existingFolderPath . '-env');
            }

            // Remove the existing mavenvet folder
            $this->removeDirectory($existingFolderPath);
        }

        // Extract the contents of the ZIP file to the desired directory
        $zip = new ZipArchive;
        if ($zip->open($localZipPath) === TRUE) {
            $zip->extractTo($extractPath);
            $zip->close();
            unlink($localZipPath); // Remove the downloaded ZIP file after extraction

            // Rename the extracted folder to mavenvet
            $extractedPath = $extractPath . DIRECTORY_SEPARATOR . 'mavenvet-main';
            $newExtractedPath = $extractPath . DIRECTORY_SEPARATOR . 'mavenvet';
            if (is_dir($extractedPath)) {
                rename($extractedPath, $newExtractedPath);
            }

            // Restore the preserved vendor directory and .env file if they exist
            if ($vendorExists) {
                rename($existingFolderPath . '-vendor', $newExtractedPath . DIRECTORY_SEPARATOR . 'vendor');
            }
            if ($envExists) {
                rename($existingFolderPath . '-env', $newExtractedPath . DIRECTORY_SEPARATOR . '.env');
            }

            $checkCount = Systemupdate::count();
            $version = "2";
            if ($checkCount > 0) {
                $systemUpdate = Systemupdate::first();
                $systemUpdate->update([
                    'version' => $version,
                    'updated_at' => date("Y-m-d"),
                    'updated_by' => Auth::user()->id,
                ]);
            } else {
                // Create new record
                $inp = new Systemupdate();
                $inp->version = $version;
                $inp->updated_at = date("Y-m-d");
                $inp->updated_by = Auth::user()->id;
                $inp->save();
            }
            session()->flash('item', 'Software updated successfully');
            return back();
        }
    } catch (\Throwable $th) {
        session()->flash('item', 'Software Failed to update.');
        return back();
    }
}

private function removeDirectory($path) {
    // Check if the path exists and is a directory
    if (!is_dir($path)) {
        return;
    }

    // Open the directory
    $dirHandle = opendir($path);

    // Loop through each file/directory in the directory
    while (($file = readdir($dirHandle)) !== false) {
        if ($file != '.' && $file != '..') {
            // If it's a directory, call removeDirectory() recursively
            if (is_dir($path . DIRECTORY_SEPARATOR . $file)) {
                $this->removeDirectory($path . DIRECTORY_SEPARATOR . $file);
            } else {
                // If it's a file, delete it
                unlink($path . DIRECTORY_SEPARATOR . $file);
            }
        }
    }

    // Close the directory handle
    closedir($dirHandle);

    // Remove the directory itself
    rmdir($path);
}






function dashboard()
{
    $monthclinic = request('month');
    $yearclinic = request('year');
    $cat = request('category');
    if($cat == 'service'){
        $tittle = "Clinic Service Per Month :";
        $serviceMonly =  Service_order::where('month', $monthclinic)->
        where('year', $yearclinic)->where('order_status', 'success')->
        sum('pay','cash_pos','cash_transfer');

    }
    elseif($cat == 'expense'){
            $tittle = "Clinic Expense Per Month : ";
        $serviceMonly = Db::table('clinic_expenses')->where('month', $monthclinic) ->where('year', $yearclinic)->sum('amount');
    }
     // Retrieve the existing data from your index() method
     $existingData = $this->index()->getData();

     // Combine existing data with the new service amount
     $data = array_merge($existingData, ['serviceMonly' => $serviceMonly,'tittle'=>$tittle]);
     return view('Admin.dashboard', $data);

}




    public function index(){

        $registrationcount=DB::table('clinics')->count();
         $pro = Product::get();
         $date = date('Y-d-m');
         $month = date('F');
         $year = date('Y');
         $new_date = date('d/m/y');
         $new_pos = DB::table('orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Pos')->sum('new_due');
         $new_transfer= DB::table('orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Transfer')->sum('new_due');
         $new_cash = DB::table('orders')->where('new_date', $new_date)->where('order_status','success')->where('new_mode_of_payment','Cash')->sum('new_due');
         $items = DB::table('orders')->where('date',$date)->count();
          $profitmonthly = DB::table('orders')->where('order_status','success')->where('date',$date)->where('year',$year)->sum('total_price');
          $profitmonthly2 = DB::table('orders')->where('order_status','success')->where('date',$date)->where('year',$year)->sum('Cost');
        //   dd($profitmonthly - $profitmonthly2);
         $items_amount = DB::table('orders')->where('date',$date)->sum('total_price');
         $items_pay = DB::table('orders')->where('order_status','success')->where('date', $date)->where('Mode_of_payment','Cash')->sum('pay');

         $items_pos = DB::table('orders')->where('order_status','success')->where('date', $date)->where('Mode_of_payment','Pos')->sum('cash_pos');

         $items_transfer = DB::table('orders')->where('order_status','success')->where('date', $date)->where('Mode_of_payment','Transfer')->sum('cash_transfer');


         $items_transfer_cash = DB::table('orders')->where('order_status','success')->where('date', $date)->where('Mode_of_payment','cash_transfer')->sum('cash_transfer');
         $items_items_transfer_pay = DB::table('orders')->where('order_status','success')->where('date', $date)->where('Mode_of_payment','cash_transfer')->sum('pay');
         $items_cash_pos = DB::table('orders')->where('order_status','success')->where('date', $date)->where('Mode_of_payment','cash_pos')->sum('cash_pos');
         $items_cash_pos2 = DB::table('orders')->where('order_status','success')->where('date', $date)->where('Mode_of_payment','cash_pos')->sum('pay');
         $items_due = DB::table('orders')->where('Payment_type','Half Payment')->sum('due');
         $items_fullpayment = DB::table('orders')->where('Payment_type','Full Payment')->where('date', $date)->sum('pay');
         $date = date('d/m/y');
         $attendance = Attendance::where('date',$date)->get();
         $month = date('F');
         $expenses = DB::table('expenses')->where('month',$month)->sum('amount');
         $employee = DB::table('employees')->count();
         $admission = DB::table('admissions')->where('staus','On admission')->count();
         $admission2 = DB::table('admissions')->where('staus','Discharge')->count();
         $clinics = DB::table('clinics')->count();
        //  $service_amount =  Service_item::where('month', $month)->where('year',$year)->sum('total_vaccine_amount');
         $profit = DB::table('profits')->first();
         $monthclinic = request('month');
         $yearclinic = request('year');

         $tittle ="";

        //  $serviceMonly =  Service_item::where('month', $monthclinic)
        //  ->where('year', $yearclinic)
        //  ->sum('total_vaccine_amount');

       $userservice =Service_order::where('month', $month)->where('year',$year)->where('user_id', Auth::user()->id)->where('order_status', 'success')->sum('pay','cash_pos','cash_transfer');
        $service_amount =  Service_order::where('month', $month)->where('year',$year)->where('order_status', 'success')->sum('pay','cash_pos','cash_transfer');
        $serviceMonly =  Service_order::where('month', $monthclinic)->where('year', $yearclinic)->where('order_status', 'success')->sum('pay','cash_pos','cash_transfer');

         $clinicExpenditure = Db::table('clinic_expenses')->where('month', $month)->where('year',$year)->sum('amount');

        return view('Admin.dashboard',['registrationcount'=>$registrationcount,'pro'=>$pro,'attendance'=>$attendance, 'expenses'=>$expenses, 'employee'=>$employee,
        'clinics'=>$clinics,'items'=>$items,'items_amount'=>$items_amount,'items_due'=>$items_due,'items_pay'=>$items_pay,'items_pos'=>$items_pos,'items_transfer'=>$items_transfer,
        'items_transfer_cash'=>$items_transfer_cash,'items_items_transfer_pay'=>$items_items_transfer_pay,'items_cash_pos'=>$items_cash_pos,'items_cash_pos2'=>$items_cash_pos2,
        'admission'=>$admission,'admission2'=>$admission2,'profitmonthly'=>$profitmonthly,'profitmonthly2'=>$profitmonthly2,
         'new_pos'=>$new_pos,'new_transfer'=>$new_transfer,'new_cash'=>$new_cash,'profit'=>$profit,'service_amount'=>$service_amount,
         'clinicExpenditure'=>$clinicExpenditure,'serviceMonly'=>$serviceMonly,'tittle'=>$tittle,'userservice'=>$userservice]);
    }


    public function admin_dashboard(){
        $January= 'January';
        $items = DB::table('products')->sum('Cost');
        $price = DB::table('products')->sum('Price');
        $qty = DB::table('products')->sum('Quantity');
        // dd($qty);
         $pay = DB::table('orders')->where('month',$January)->sum('pay');
         $cash_pos = DB::table('orders')->where('month',$January)->sum('cash_pos');
         $cash_transfer = DB::table('orders')->where('month',$January)->sum('cash_transfer');
        return view('Admin.admin_dashboard',['items'=>$items,'pay'=>$pay,'cash_pos'=>$cash_pos,'cash_transfer'=>$cash_transfer,'price'=>$price,'qty'=>$qty]);
    }

}
