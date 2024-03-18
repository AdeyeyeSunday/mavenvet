<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Product;
use App\Models\Profit;
use App\Models\Service_item;
use App\Models\Service_order;
use App\Models\Transferstore;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
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
            $selectOnlineProduct = "SELECT 'name','accountNumber' FROM bank_lists WHERE name  = '".$s."' AND syn_flag = '1'";
             $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
             if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
                /*...............Loop through online service types.................*/
              while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
                $Onlinepet_id= $resonlineServiceRow['accountNumber'];
                    $onlineProductUpdate = "UPDATE bank_lists SET name = '$s',accountNumber ='$c' WHERE accountNumber = '$Onlinepet_id'";
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
                $insertOnline = "INSERT INTO bank_lists (`name`, `accountNumber`)
                VALUES ('".$s."', '".$c."', '".$syn_flag."')";
                $resOnlineUpdate = mysqli_query($con, $insertOnline);
                if ($resOnlineUpdate === false) {
                    die("Error checking for duplicate record: " . mysqli_error($con));
                }

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
                   $selectOnlineProduct = "SELECT 'name' FROM clinic_expenses WHERE name  = '".$s."' AND syn_flag = '1'";
                    $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
                    if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
                       /*...............Loop through online service types.................*/
                     while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
                       $Onlinepet_id= $resonlineServiceRow['name'];
                           $onlineProductUpdate = "UPDATE clinic_expenses SET name = '$s' WHERE name = '$Onlinepet_id'";
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



            /*..............clinic_expenses start from here...........................*/
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
                      $selectOnlineProduct = "SELECT 'name' FROM expenses WHERE name  = '".$s."' AND syn_flag = '1'";
                       $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);
                       if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
                          /*...............Loop through online service types.................*/
                        while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
                          $Onlinepet_id= $resonlineServiceRow['name'];
                              $onlineProductUpdate = "UPDATE expenses SET name = '$s' WHERE name = '$Onlinepet_id'";
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


              $offline = "SELECT `id`,`Name`, `Cost`, `Price`, `Quantity`, `new_supply`, `expiry_date`, `Quantity_level`, `description`, `month`, `year`, `new_date`, `location`, `syn_flag`, `user_id`, `Category`, `supplier` FROM newproducts WHERE syn_flag = '0'";
              $resOffline = $mysqli->query($offline);

              if ($resOffline === false) {
                  die("Error executing offline query: " . $mysqli->error);
              }

              if ($resOffline->num_rows > 0) {
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

                      // Insert online record using prepared statement
                      $insertOnline = "INSERT INTO `newproducts`(`Name`, `Cost`, `Price`, `Quantity`, `new_supply`, `expiry_date`, `Quantity_level`, `description`, `month`, `year`, `new_date`, `location`, `syn_flag`, `user_id`, `Category`, `supplier`)
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                      $stmt = $mysqli->prepare($insertOnline);
                      $stmt->bind_param("sssssssssssssssi", $name, $cost, $price, $quantity, $new_supply, $expiry_date, $quantity_level, $description, $month, $year, $new_date, $location, $syn_flag, $user_id, $Category, $supplier);

                      if (!$stmt->execute()) {
                          die("Error inserting online record: " . $stmt->error);
                      }

                      // Update offline record syn_flag to 1
                      $offlineUpdateSyn = "UPDATE newproducts SET syn_flag = '1' WHERE id = ?";
                      $stmt = $mysqli->prepare($offlineUpdateSyn);
                      $stmt->bind_param("i", $id);

                      if (!$stmt->execute()) {
                          die("Error updating offline record: " . $stmt->error);
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
                        $insertOnline = "INSERT INTO `new_vaccines`(`user_id`, `Name`, `Cost`, `Price`, `Quantity`, `minimum`, `Image`, `expiry_date`, `new_supply`, `supply_date`, `brand`, `supplier`, `syn_flag`, `location`)
                        VALUES ('$user_id', '$name', '$cost', '$price', '$quantity', '$minimum', '$Image', '$expiry_date', '$new_supply', '$supply_date', '$brand', '$supplier', '$syn_flag', '$location')";
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


                  $offline = "SELECT `user_id`, `fname`, `phone`, `address`, `total_price`, `discount`, `trackking_id`, `order_status`, `Mode_of_payment`, `pay`, `due`, `Payment_type`, `cash_transfer`, `cash_pos`, `date`, `month`, `year`, `syn_flag`, `location`, `new_mode_of_payment`, `new_date`, `new_payment_user_id`, `Cost`, `new_due`, `bankName` FROM `orders` WHERE syn_flag = '0'";
                    $resOffline = $mysqli->query($offline);

                    if ($resOffline === false) {
                        die("Error executing offline query: " . $mysqli->error);
                    }

                  if ($resOffline->num_rows > 0) {
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

                        $insertOnline = "INSERT INTO `orders` (
                            `user_id`, `fname`, `phone`, `address`, `total_price`, `discount`,
                            `trackking_id`, `order_status`, `Mode_of_payment`, `pay`, `due`,
                            `Payment_type`, `cash_transfer`, `cash_pos`, `date`, `month`, `year`,
                            `syn_flag`, `location`, `new_mode_of_payment`, `new_date`, `new_payment_user_id`,
                            `Cost`, `new_due`, `bankName`
                        ) VALUES ('".$user_id."', '".$fname."', '".$phone."', '".$address."', '".$total_price."',
                        '".$discount."', '".$trackking_id."', '".$order_status."', '".$Mode_of_payment."', '".$pay."'
                        ,'".$due."', '".$Payment_type."', '".$cash_transfer."', '".$cash_pos."','".$date."'
                        ,'".$month."', '".$year."', '".$syn_flag."', '".$location."','".$new_mode_of_payment."'
                        ,'".$new_date."', '".$new_payment_user_id."', '".$Cost."', '".$new_due."','".$bankName."')";

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

                    //    /*..............order_iteams start from here...........................*/
                    $offline = "SELECT `user_id`, `order_id`, `prod_id`, `qty`, `price`, `product_id`, `date`, `month`, `year`,`Cost` FROM `order_iteams` WHERE syn_flag = '0'";
                    $resOffline = $mysqli->query($offline);

                    if ($resOffline === false) {
                        die("Error executing offline query: " . $mysqli->error);
                    }

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

                            // Insert online record using prepared statement
                            $insertOnline = "INSERT INTO `order_iteams`(`user_id`, `order_id`, `prod_id`, `qty`, `price`, `product_id`, `date`, `month`, `year`, `Cost`)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                            $stmt = $mysqli->prepare($insertOnline);
                            $stmt->bind_param("ssssssssss", $user_id, $order_id, $prod_id, $qty, $price, $product_id, $date, $month, $year, $Cost);

                            if (!$stmt->execute()) {
                                die("Error inserting online record: " . $stmt->error);
                            }

                            // Update offline record syn_flag to 1
                            $offlineUpdateSyn = "UPDATE order_iteams SET syn_flag = '1' WHERE order_id = ?";
                            $stmt = $mysqli->prepare($offlineUpdateSyn);
                            $stmt->bind_param("s", $order_id);

                            if (!$stmt->execute()) {
                                die("Error updating offline record: " . $stmt->error);
                            }
                        }
                    }

 /*..............payment_dues start from here...........................*/
 $offline = "SELECT `Owner_name`, `total_price`, `Mode_of_payment`, `pay`, `due`, `Payment_type`, `date`, `month`, `year` FROM `payment_dues` WHERE syn_flag = '0'";
 $resOffline = $mysqli->query($offline);
 if($resOffline->num_rows > 0){
    while ($detorRow = $resOffline->fetch_assoc()) {
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
      $insertOnline = "INSERT INTO `payment_dues`(`Owner_name`, `total_price`, `Mode_of_payment`, `pay`, `due`, `Payment_type`, `date`, `month`, `year`, `syn_flag`)
      VALUES ('$Owner_name', '$total_price', '$Mode_of_payment', '$pay', '$due', '$Payment_type', '$date', '$month', '$year','$syn_flag')";

            $resOnlineUpdate = mysqli_query($con, $insertOnline);
            if ($resOnlineUpdate === false) {
                die("Error checking for duplicate record: " . mysqli_error($con));
            }
            $offlineUpdateSyn = "UPDATE payment_dues SET syn_flag = '1' WHERE Owner_name = '".$Owner_name."'";
            $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
            if ($resOfflineUpdate === false) {
             die("Error getting service_requests: " . $mysqli->error);

           }
    }
}




 /*..............payment_dues start from here...........................*/
 $offline = "SELECT  `fname`, `total_price`, `Mode_of_payment`, `pay`, `due`, `Payment_type`FROM `pos_deus` WHERE syn_flag = '0'";
 $resOffline = $mysqli->query($offline);
 if($resOffline->num_rows > 0){
    while ($detorRow = $resOffline->fetch_assoc()) {
      $fname = $detorRow['fname'];
      $total_price = $detorRow['total_price'];
      $Mode_of_payment = $detorRow['Mode_of_payment'];
      $pay = $detorRow['pay'];
      $due = $detorRow['due'];
      $Payment_type = $detorRow['Payment_type'];
      $syn_flag =1;
      $insertOnline = "INSERT INTO `pos_deus`(`fname`, `total_price`, `Mode_of_payment`, `pay`, `due`, `Payment_type`, `syn_flag`)
      VALUES ('$fname', '$total_price', '$Mode_of_payment', '$pay', '$due', '$Payment_type','$syn_flag')";
            $resOnlineUpdate = mysqli_query($con, $insertOnline);
            if ($resOnlineUpdate === false) {
                die("Error checking for duplicate record: " . mysqli_error($con));
            }
            $offlineUpdateSyn = "UPDATE pos_deus SET syn_flag = '1' WHERE fname = '".$fname."'";
            $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
            if ($resOfflineUpdate === false) {
             die("Error getting service_requests: " . $mysqli->error);

           }
    }
}


 $offline = "SELECT  `id`, `Name`, `Category`, `Cost`, `Price`, `Quantity`, `supplier`, `Quantity_level`, `Image`, `new_supply`, `Description`, `expiry_date`, `new_date`, `month`, `year`, `user_id` FROM `products` WHERE syn_flag = '0'";
$resOffline = $mysqli->query($offline);

if ($resOffline === false) {
    die("Error executing offline query: " . $mysqli->error);
}

if ($resOffline->num_rows > 0) {
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

        // Check if the record exists online
        $selectOnlineProduct = "SELECT `id` FROM products WHERE id = ?";
        $stmt = $mysqli->prepare($selectOnlineProduct);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Update online record
            $onlineProductUpdate = "UPDATE products SET id = ? WHERE id = ?";
            $stmtUpdate = $mysqli->prepare($onlineProductUpdate);
            $stmtUpdate->bind_param("ii", $id, $id);
            $stmtUpdate->execute();

            if ($stmtUpdate === false) {
                die("Error updating record: " . $mysqli->error);
            }
        } else {
            // Insert online record
            $insertOnline = "INSERT INTO products (`Name`, `Category`, `Cost`, `Price`, `Quantity`, `supplier`, `Quantity_level`, `Image`, `new_supply`, `Description`, `expiry_date`, `new_date`, `month`, `year`, `syn_flag`, `user_id`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtInsert = $mysqli->prepare($insertOnline);
            $stmtInsert->bind_param("ssssssssssssssi", $Name, $Category, $Cost, $Price, $Quantity, $supplier, $Quantity_level, $Image, $new_supply, $Description, $expiry_date, $new_date, $month, $year, $syn_flag, $user_id);
            $stmtInsert->execute();

            if ($stmtInsert === false) {
                die("Error inserting record: " . $mysqli->error);
            }
        }

        // Update offline record syn_flag to 1
        $offlineUpdateSyn = "UPDATE products SET syn_flag = '1' WHERE id = ?";
        $stmtUpdateSyn = $mysqli->prepare($offlineUpdateSyn);
        $stmtUpdateSyn->bind_param("i", $id);
        $stmtUpdateSyn->execute();

        if ($stmtUpdateSyn === false) {
            die("Error updating syn_flag: " . $mysqli->error);
        }
    }
}
$offline = "SELECT `user_id`, `order_id`, `prod_name`, `pro_id`, `qty`, `price`, `total_vaccine_amount`, `subtotal`, `service`, `service_id`, `Amount`, `date`, `month`, `year` FROM `service_items` WHERE syn_flag = '0'";
$resOffline = $mysqli->query($offline);

if ($resOffline->num_rows > 0) {
    $insertOnline = "INSERT INTO `service_items`(`user_id`, `order_id`, `prod_name`, `pro_id`, `qty`, `price`, `total_vaccine_amount`, `subtotal`, `service`, `service_id`, `Amount`, `date`, `month`, `year`, `syn_flag`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtInsert = $mysqli->prepare($insertOnline);

    if ($stmtInsert === false) {
        die("Error preparing statement: " . $mysqli->error);
    }

    $stmtInsert->bind_param("isssssssssssssi", $user_id, $order_id, $prod_name, $pro_id, $qty, $price, $total_vaccine_amount, $subtotal, $service, $service_id, $Amount, $date, $month, $year, $syn_flag);

    while ($detorRow = $resOffline->fetch_assoc()) {
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

        $stmtInsert->execute();

        if ($stmtInsert === false) {
            die("Error inserting into online service_items: " . $stmtInsert->error);
        }

        // Update syn_flag to 1 in offline service_items
        $offlineUpdateSyn = "UPDATE service_items SET syn_flag = '1' WHERE order_id = ?";
        $stmtUpdateSyn = $mysqli->prepare($offlineUpdateSyn);
        $stmtUpdateSyn->bind_param("s", $order_id);
        $stmtUpdateSyn->execute();

        if ($stmtUpdateSyn === false) {
            die("Error updating syn_flag in offline service_items: " . $mysqli->error);
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

      $insertOnline = "INSERT INTO `service_orders`( `user_id`, `Pet_name`, `Unregister`, `Owner_name`, `Phone`, `Next_vaccination_appointment`, `Next_appointments`, `total_price`, `order_status`, `Mode_of_payment`, `pay`, `due`, `Payment_type`, `cash_transfer`, `cash_pos`, `date`, `month`, `year`, `syn_flag`, `new_mode_of_payment`, `new_date`, `new_payment_user_id`, `new_due`, `bankName`)
      VALUES ('$user_id', '$Pet_name', '$Unregister', '$Owner_name', '$Phone', '$Next_vaccination_appointment', '$Next_appointments', '$total_price', '$order_status', '$Mode_of_payment', '$pay', '$due', '$Payment_type', '$cash_transfer', '$cash_pos', '$date', '$month', '$year', '$syn_flag', '$new_mode_of_payment', '$new_date', '$new_payment_user_id', '$new_due', '$bankName')";
            $resOnlineUpdate = mysqli_query($con, $insertOnline);
            if ($resOnlineUpdate === false) {
                die("Error checking for duplicate record: " . mysqli_error($con));
            }

            $offlineUpdateSyn = "UPDATE service_orders SET syn_flag = '1' WHERE id = '".$id."'";
            $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
            if ($resOfflineUpdate === false) {
             die("Error getting service_requests: " . $mysqli->error);
           }
    }
}



/*..............shop_items start from here...........................*/
$offline = "SELECT `id`,`user_id`, `prod_name`, `pro_id`, `qty`, `price`, `status`, `subtotal`, `date`, `month`, `year`, `moved`, `location_transfer` FROM `shop_items` WHERE syn_flag = '0'";
$resOffline = $mysqli->query($offline);

if ($resOffline->num_rows > 0) {
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

        // Use prepared statement
        $insertOnline = "INSERT INTO `shop_items`(`user_id`,`prod_name`, `pro_id`, `qty`, `price`, `status`, `subtotal`, `date`, `month`, `year`, `moved`,`location_transfer`,`syn_flag`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmtInsert = $mysqli->prepare($insertOnline);
        $stmtInsert->bind_param("isssssssssisi", $user_id, $prod_name, $pro_id, $qty, $price, $status, $subtotal, $date, $month, $year, $moved, $location_transfer, $syn_flag);
        $stmtInsert->execute();

        if ($stmtInsert === false) {
            die("Error checking for duplicate record: " . $mysqli->error);
        }

        // Update syn_flag to 1 in offline shop_items
        $offlineUpdateSyn = "UPDATE shop_items SET syn_flag = '1' WHERE prod_name = ?";
        $stmtOfflineUpdate = $mysqli->prepare($offlineUpdateSyn);
        $stmtOfflineUpdate->bind_param("s", $prod_name);
        $stmtOfflineUpdate->execute();

        if ($stmtOfflineUpdate === false) {
            die("Error updating syn_flag in offline shop_items: " . $mysqli->error);
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

     $insertOnline = "INSERT INTO `suppliers`(`Company_Name`,`Name`, `Email`, `Phone_Number`, `Address`, `City`, `State`, `date`,`syn_flag`)
     VALUES ('$Company_Name','$Name', '$Email', '$Phone_Number', '$Address', '$City', '$State', '$date', '$syn_flag')";
           $resOnlineUpdate = mysqli_query($con, $insertOnline);
           if ($resOnlineUpdate === false) {
               die("Error checking for duplicate record: " . mysqli_error($con));
           }
           $offlineUpdateSyn = "UPDATE suppliers SET syn_flag = '1' WHERE id = '".$id."'";
           $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
           if ($resOfflineUpdate === false) {
            die("Error getting service_requests: " . $mysqli->error);
          }
   }
}





/*..............vaccineiteams start from here...........................*/
$offline = "SELECT  `order_id`, `items_name`, `vaccine_id`, `qty`, `price` FROM `vaccineiteams` WHERE syn_flag = '0'";
$resOffline = $mysqli->query($offline);
if($resOffline->num_rows > 0){
   while ($detorRow = $resOffline->fetch_assoc()) {
     $order_id = $detorRow['order_id'];
     $items_name = $detorRow['items_name'];
     $vaccine_id = $detorRow['vaccine_id'];
     $qty = $detorRow['qty'];
     $price = $detorRow['price'];
     $syn_flag =1;
     $insertOnline = "INSERT INTO `vaccineiteams`(`order_id`, `items_name`, `vaccine_id`, `qty`, `price`, `syn_flag`)
     VALUES ('$order_id','$items_name', '$vaccine_id', '$qty', '$price', '$syn_flag')";
           $resOnlineUpdate = mysqli_query($con, $insertOnline);
           if ($resOnlineUpdate === false) {
               die("Error checking for duplicate record: " . mysqli_error($con));
           }

           $offlineUpdateSyn = "UPDATE vaccineiteams SET syn_flag = '1' WHERE items_name = '$items_name'";
           $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
           if ($resOfflineUpdate === false) {
            die("Error getting service_requests: " . $mysqli->error);
          }
   }
}



/*..............vaccineorders start from here...........................*/
$offline = "SELECT  `user_id`, `name`, `discount`, `phone`, `address`, `order_status`, `Mode_of_payment`, `cash_transfer`, `cash_pos`, `pay`, `due`, `total`, `Payment_type`, `date`, `month`, `year`, `new_mode_of_payment`, `new_date`, `new_payment_user_id`, `new_due`, `bankName` FROM `vaccineorders` WHERE syn_flag = '0'";
$resOffline = $mysqli->query($offline);
if($resOffline->num_rows > 0){
   while ($detorRow = $resOffline->fetch_assoc()) {
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

    $insertOnline = "INSERT INTO `vaccineorders`(`user_id`, `name`, `discount`, `phone`, `address`, `order_status`, `Mode_of_payment`, `cash_transfer`, `cash_pos`, `pay`, `due`, `total`, `Payment_type`, `date`, `month`, `year`, `syn_flag`,`new_mode_of_payment`, `new_date`, `new_payment_user_id`, `new_due`, `bankName`)
     VALUES ('$user_id','$name', '$discount', '$phone', '$address', '$order_status','$Mode_of_payment', '$cash_transfer', '$cash_pos', '$pay', '$due','$total', '$Payment_type', '$date', '$month', '$year', '$syn_flag', '$new_mode_of_payment', '$new_date', '$new_payment_user_id', '$new_due','$bankName')";
           $resOnlineUpdate = mysqli_query($con, $insertOnline);
           if ($resOnlineUpdate === false) {
               die("Error checking for duplicate record: " . mysqli_error($con));
           }
           $offlineUpdateSyn = "UPDATE vaccineorders SET syn_flag = '1' WHERE name = '$name'";
           $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
           if ($resOfflineUpdate === false) {
            die("Error getting service_requests: " . $mysqli->error);
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

       $selectOnlineProduct = "SELECT 'id' FROM vaccinestores WHERE id  = '".$id."' AND syn_flag = '1'";
        $resOnlineUpdate = mysqli_query($con, $selectOnlineProduct);

        if($resOnlineUpdate !== false && $resOnlineUpdate->num_rows > 0){
           /*...............Loop through online service types.................*/
         while ($resonlineServiceRow = mysqli_fetch_assoc($resOnlineUpdate)) {
           $Onlinepet_id= $resonlineServiceRow['id'];

               $onlineProductUpdate = "UPDATE vaccinestores SET id = '$id' WHERE id = '$Onlinepet_id'";
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
           $insertOnline = "INSERT INTO `vaccinestores`(`user_id`, `Name`, `Cost`, `Price`, `Quantity`, `minimum`, `Image`, `expiry_date`, `new_supply`, `supply_date`, `brand`, `supplier`, `syn_flag`)
           VALUES ('".$user_id."', '".$Name."', '".$Cost."', '".$Price."', '".$Quantity."', '".$minimum."', '".$Image."', '".$expiry_date."', '".$new_supply."', '".$supply_date."','".$brand."','".$supplier."','".$syn_flag."')";
           $resOnlineUpdate = mysqli_query($con, $insertOnline);
           if ($resOnlineUpdate === false) {
               die("Error checking for duplicate record: " . mysqli_error($con));
           }

           $offlineUpdateSyn = "UPDATE vaccinestores SET syn_flag = '1' WHERE id = '".$id."'";
           $resOfflineUpdate = mysqli_query($mysqli, $offlineUpdateSyn);
           if ($resOfflineUpdate === false) {
            die("Error getting service_requests: " . $mysqli->error);
        }
      }

   }
}
session()->flash('item','Successfully synchronized');
return back();
}




// this update software from backend .....


public function update_software() {
    $repositoryUrl = 'https://github.com/AdeyeyeSunday/mavenvet/archive/main.zip';

    // Fetch the ZIP file from the repository
    $zipFile = file_get_contents($repositoryUrl);

    // Specify the path where you want to save the downloaded ZIP file
    $localZipPath = 'C:\xampp\htdocs\test\repo.zip';

    // Save the downloaded ZIP file to a local directory
    file_put_contents($localZipPath, $zipFile);

    // Specify the path where you want to extract the repository contents
    $extractPath = 'C:\xampp\htdocs\test';

    // Extract the contents of the ZIP file to the desired directory
    $zip = new ZipArchive;
    if ($zip->open($localZipPath) === TRUE) {
        $zip->extractTo($extractPath);
        $zip->close();
        unlink($localZipPath); // Remove the downloaded ZIP file after extraction

        // Rename the extracted folder if necessary
        $oldExtractedPath = $extractPath . DIRECTORY_SEPARATOR . 'mavenvet-main';
        $newExtractedPath = $extractPath . DIRECTORY_SEPARATOR . 'mavenvet'; // Change this to the desired new folder name
        if (file_exists($oldExtractedPath)) {
            rename($oldExtractedPath, $newExtractedPath);
        }

        return response()->json(['success' => true, 'item' => 'Code updated successfully']);
    } else {
        return response()->json(['success' => false, 'item' => 'Failed to extract ZIP file'], 500);
    }
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
        $service_amount =  Service_order::where('month', $month)->where('year',$year)->where('order_status', 'success')->sum('pay','cash_pos','cash_transfer');
        $serviceMonly =  Service_order::where('month', $monthclinic)->where('year', $yearclinic)->where('order_status', 'success')->sum('pay','cash_pos','cash_transfer');

         $clinicExpenditure = Db::table('clinic_expenses')->where('month', $month)->where('year',$year)->sum('amount');

        return view('Admin.dashboard',['registrationcount'=>$registrationcount,'pro'=>$pro,'attendance'=>$attendance, 'expenses'=>$expenses, 'employee'=>$employee,
        'clinics'=>$clinics,'items'=>$items,'items_amount'=>$items_amount,'items_due'=>$items_due,'items_pay'=>$items_pay,'items_pos'=>$items_pos,'items_transfer'=>$items_transfer,
        'items_transfer_cash'=>$items_transfer_cash,'items_items_transfer_pay'=>$items_items_transfer_pay,'items_cash_pos'=>$items_cash_pos,'items_cash_pos2'=>$items_cash_pos2,
        'admission'=>$admission,'admission2'=>$admission2,'profitmonthly'=>$profitmonthly,'profitmonthly2'=>$profitmonthly2,
         'new_pos'=>$new_pos,'new_transfer'=>$new_transfer,'new_cash'=>$new_cash,'profit'=>$profit,'service_amount'=>$service_amount,
         'clinicExpenditure'=>$clinicExpenditure,'serviceMonly'=>$serviceMonly,'tittle'=>$tittle]);
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
