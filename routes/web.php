<?php

use Illuminate\Mail\PendingMail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/Admin/dashboard', function () {
    return view('Admin.dashboard');
})->name('Admin.dashboard');

Route::middleware(['auth','auth:sanctum', 'verified'])->group(function () {
Route::get('/Admin/dashboard', 'AdminController@index')->name('Admin.dashboard');
Route::post('/Admin/store_profit', 'AdminController@store_profit')->name('Admin.store_profit');
Route::post('/Admin/dashboard', 'AdminController@dashboard')->name('Admin.dashboard');
Route::get('/Admin/admin_dashboard', 'AdminController@admin_dashboard')->name('Admin.admin_dashboard');
Route::get('/Admin/update_software', 'AdminController@update_software')->name('Admin.update_software');
//Product start from here
Route::get('/Admin/Product/Product', 'ProductController@Product')->name('Admin.Product.Product');
Route::get('/Admin/Product/Product_subtact', 'ProductController@Product_subtact')->name('Admin.Product.Product_subtact');
Route::get('/Admin/Product/Product_list', 'ProductController@Product_list')->name('Admin.Product.Product_list');
Route::get('/Admin/Product/add_product', 'ProductController@add_product')->name('Admin.Product.add_product');
Route::get('/Admin/Product/{id}/edit_product', 'ProductController@edit_product')->name('Admin.Product.edit_product');
Route::patch('/Admin/Product/{id}/update_product', 'ProductController@update_product')->name('Admin.Product.update_product');
Route::post('/Admin/Product/store_product', 'ProductController@store_product')->name('Admin.Product.store_product');
Route::get('/Admin/Product/{id}/store_product_destory', 'ProductController@store_product_destory')->name('Admin.Product.store_product_destory');
Route::get('/Admin/Store/transfer_details', 'StoreController@transfer_details')->name('Admin.Store.transfer_details');
// onlinesync orders function

Route::get('/order1', 'AdminController@order1')->name('order1');
Route::get('/product1', 'AdminController@product1')->name('product1');


//online product start from here
Route::get('/order', 'AdminController@order')->name('order');
//product 2 push
Route::get('/sync', 'AdminController@sync')->name('sync');



Route::post('add_cart', 'CartController@add_cart')->name('add_cart');
// Route::post('addToCart_cart', 'CartController@addToCart_cart')->name('addToCart_cart');
// pull offline to online/
Route::get('/update1', 'AdminController@update1')->name('update1');
Route::get('/update2', 'AdminController@update2')->name('update2');
Route::get('/updatesyn', 'AdminController@updatesyn')->name('updatesyn');
//new suplly
Route::get('/Admin/Product/new_supply', 'ProductController@new_supply')->name('Admin.Product.new_supply');
//Category start from here
Route::get('/Admin/Category/add_Category', 'CategoryController@Category')->name('Admin.Category.add_Category');
Route::get('/Admin/Category/{id}/edit_Category', 'CategoryController@edit_Category')->name('Admin.Category.edit_Category');
Route::get('/Admin/Category/{id}/destory', 'CategoryController@destory')->name('Admin.Category.destory');
Route::patch('/Admin/Category/{id}/update_Category', 'CategoryController@update_Category')->name('Admin.Category.update_Category');
Route::get('/Admin/Category/list_Category', 'CategoryController@list')->name('Admin.Category.list_Category');
Route::post('/Admin/Category/store_Category', 'CategoryController@store_Category')->name('Admin.Category.store_Category');
//Suppliers start from here
Route::get('/Admin/Supplier/add_Supplier', 'SupplierController@add_Supplier')->name('Admin.Supplier.add_Supplier');
Route::get('/Admin/Supplier/{id}/edit_Supplier', 'SupplierController@edit_Supplier')->name('Admin.Supplier.edit_Supplier');
Route::get('/Admin/Supplier/{id}/destory', 'SupplierController@destory')->name('Admin.Supplier.destory');
Route::patch('/Admin/Supplier/{id}/update_Supplier', 'SupplierController@update_Supplier')->name('Admin.Supplier.update_Supplier');
Route::get('/Admin/Supplier/list_Supplier', 'SupplierController@list_Supplier')->name('Admin.Supplier.list_Supplier');
Route::post('/Admin/Supplier/store_Supplier', 'SupplierController@store_Supplier')->name('Admin.Supplier.store_Supplier');
//sale start from here
Route::get('/Admin/Sale/Sale', 'SaleController@Sale')->name('Admin.Sale.Sale');
// Expense start from here
Route::get('/Admin/Expense/Expense', 'ExpenseController@Expense')->name('Admin.Expense.Expense');
Route::get('/Admin/Expense/Monthly', 'ExpenseController@Monthly')->name('Admin.Expense.Monthly');
Route::get('/Admin/Expense/{id}/Monthly_edit', 'ExpenseController@Monthly_edit')->name('Admin.Expense.Monthly_edit');
Route::patch('/Admin/Expense/{id}/Monthly_update', 'ExpenseController@Monthly_update')->name('Admin.Expense.Monthly_update');
Route::post('/Admin/Expense/Expense_store', 'ExpenseController@Expense_store')->name('Admin.Expense.Expense_store');
Route::get('/Admin/Expense/Expense_search', 'ExpenseController@Expense_search')->name('Admin.Expense.Expense_search');
Route::post('/Admin/Expense/search', 'ExpenseController@search')->name('Admin.Expense.search');

//Clinic start from here
Route::get('/Admin/Clinic/Clinic', 'ClinicController@Clinic')->name('Admin.Clinic.Clinic');
Route::get('/Admin/Clinic/Vaccine_subtact', 'ClinicController@Vaccine_subtact')->name('Admin.Clinic.Vaccine_subtact');
Route::post('/Admin/Clinic/Clinic_store', 'ClinicController@Clinic_store')->name('Admin.Clinic.Clinic_store');
Route::get('/Admin/Clinic/treatment', 'ClinicController@treatment')->name('Admin.Clinic.treatment');
Route::get('/Admin/Clinic/{id}/Clinic_view', 'ClinicController@Clinic_view')->name('Admin.Clinic.Clinic_view');
Route::get('/Admin/Clinic/{id}/destory', 'ClinicController@destory')->name('Admin.Clinic.destory');
Route::get('/Admin/Clinic/{id}/Clinic_edit', 'ClinicController@Clinic_edit')->name('Admin.Clinic.Clinic_edit');
Route::patch('/Admin/Clinic/{id}/Clinic_update', 'ClinicController@Clinic_update')->name('Admin.Clinic.Clinic_update');
Route::get('/Admin/Clinic/Clinic_list', 'ClinicController@Clinic_list')->name('Admin.Clinic.Clinic_list');
Route::post('/Admin/Clinic/search', 'ClinicController@search')->name('Admin.Clinic.search');
//clinic expenditure
Route::get('/Admin/Clinic/expenditure', 'ClinicController@expenditure')->name('Admin.Clinic.expenditure');
Route::get('/Admin/Clinic/Monthly', 'ClinicController@Monthly')->name('Admin.Clinic.Monthly');
Route::get('/Admin/Clinic/{id}/Monthly_edit', 'ClinicController@Monthly_edit')->name('Admin.Expense.Clinic');
Route::patch('/Admin/Clinic/{id}/Monthly_update', 'ClinicController@Monthly_update')->name('Admin.Clinic.Monthly_update');
Route::post('/Admin/Clinic/clinic_monthly_expense', 'ClinicController@clinic_monthly_expense')->name('Admin.Clinic.clinic_monthly_expense');
Route::post('/Admin/Clinic/expenditure_store', 'ClinicController@expenditure_store')->name('Admin.Clinic.expenditure_store');
//vaccine start from here
Route::get('/Admin/Clinic/Clinic_supplier', 'ClinicController@Clinic_supplier')->name('Admin.Clinic.Clinic_supplier');
Route::post('/Admin/Clinic/Clinic_supplier_store', 'ClinicController@Clinic_supplier_store')->name('Admin.Clinic.Clinic_supplier_store');
Route::get('/Admin/Clinic/Clinic_add_vaccine', 'ClinicController@Clinic_add_vaccine')->name('Admin.Clinic.Clinic_add_vaccine');
Route::post('/Admin/Clinic/Clinic_add_vaccine_store', 'ClinicController@Clinic_add_vaccine_store')->name('Admin.Clinic.Clinic_add_vaccine_store');
Route::get('/Admin/Clinic/Clinic_list_vaccine', 'ClinicController@Clinic_list_vaccine')->name('Admin.Clinic.Clinic_list_vaccine');
Route::get('/Admin/Clinic/newsupply', 'ClinicController@newsupply')->name('Admin.Clinic.newsupply');
Route::get('/Admin/Clinic/{id}/Clinic_edit_vaccine', 'ClinicController@Clinic_edit_vaccine')->name('Admin.Clinic.Clinic_edit_vaccine');
Route::patch('/Admin/Clinic/{id}/Clinic_update_vaccine', 'ClinicController@Clinic_update_vaccine')->name('Admin.Clinic.Clinic_update_vaccine');
Route::get('/Admin/Clinic/Clinic_sale', 'ClinicController@Clinic_sale')->name('Admin.Clinic.Clinic_sale');
Route::post('/Admin/Clinic/Clinic_cart', 'ClinicController@Clinic_cart')->name('Admin.Clinic.Clinic_cart');
Route::get('/Admin/Clinic/{id}/Clinic_destory', 'ClinicController@Clinic_destory')->name('Admin.Clinic.Clinic_destory');
Route::post('/Admin/Clinic/{id}/Clinic_cart_update', 'ClinicController@Clinic_cart_update')->name('Admin.Clinic.Clinic_cart_update');
Route::post('/Admin/Clinic/Clinic_inventory', 'ClinicController@Clinic_inventory')->name('Admin.Clinic.Clinic_inventory');
Route::get('/Admin/Clinic/cart_pending', 'ClinicController@cart_pending')->name('Admin.Clinic.cart_pending');
Route::get('/Admin/Clinic/cart_history', 'ClinicController@cart_history')->name('Admin.Clinic.cart_history');
Route::get('/Admin/Clinic/vaccin_sale', 'ClinicController@vaccin_sale')->name('Admin.Clinic.vaccin_sale');
Route::get('/Admin/Clinic/{id}/Clinic_inventory_invoice', 'ClinicController@Clinic_inventory_invoice')->name('Admin.Clinic.Clinic_inventory_invoice');
Route::get('/Admin/Clinic/{id}/destory_pending', 'ClinicController@destory_pending')->name('Admin.Clinic.destory_pending');
Route::get('/Admin/Clinic/{id}/vaccin_discount', 'ClinicController@vaccin_discount')->name('Admin.Clinic.vaccin_discount');
Route::get('/Admin/Clinic/{id}/order_status', 'ClinicController@order_status')->name('Admin.Clinic.order_status');
Route::patch('/Admin/Clinic/{id}/vaccine_update', 'ClinicController@vaccine_update')->name('Admin.Clinic.vaccine_update');
Route::get('/Admin/Clinic/{id}/vaccine_print', 'ClinicController@vaccine_print')->name('Admin.Clinic.vaccine_print');
Route::get('/Admin/Clinic/{id}/order_cash', 'ClinicController@order_cash')->name('Admin.Clinic.order_cash');
Route::get('/Admin/Clinic/{id}/order_pos', 'ClinicController@order_pos')->name('Admin.Clinic.order_pos');
Route::get('/Admin/Clinic/{id}/order_transfer', 'ClinicController@order_transfer')->name('Admin.Clinic.order_transfer');
Route::get('/Admin/Clinic/{id}/cash_pos', 'ClinicController@cash_pos')->name('Admin.Clinic.cash_pos');
Route::get('/Admin/Clinic/{id}/cash_transfer', 'ClinicController@cash_transfer')->name('Admin.Clinic.cash_transfer');
Route::get('/Admin/Clinic/{id}/vaccin_edit', 'ClinicController@vaccin_edit')->name('Admin.Clinic.vaccin_edit');
Route::patch('/Admin/Clinic/{id}/vaccin_update2', 'ClinicController@vaccin_update2')->name('Admin.Clinic.vaccin_update2');

//brand start from here ....................
Route::get('/Admin/Clinic/brand', 'ClinicController@brand')->name('Admin.Clinic.brand');
Route::post('/Admin/Clinic/brand_store', 'ClinicController@brand_store')->name('Admin.Clinic.brand_store');
Route::delete('/Admin/Clinic/{id}/brand_destory', 'ClinicController@brand_destory')->name('Admin.Clinic.brand_destory');


//attendance start from here...................
Route::get('/Admin/attendance/attendance', 'AttendanceController@attendance')->name('Admin.attendance.attendance');
Route::post('/Admin/attendance/attendance_store', 'AttendanceController@attendance_store')->name('Admin.attendance.attendance_store');
Route::get('/Admin/attendance/attendance_list', 'AttendanceController@attendance_list')->name('Admin.Attendance.attendance_list');


///Employee start from here............
Route::get('/Admin/Employee/Employee', 'EmployeeController@Employee')->name('Admin.Employee.Employee');
Route::get('/Admin/Employee/Employee_list', 'EmployeeController@Employee_list')->name('Admin.Employee.Employee_list');
Route::get('/Admin/Employee/{id}/Employee_view', 'EmployeeController@Employee_view')->name('Admin.Employee.Employee_view');
Route::get('/Admin/Employee/{id}/Employee_edit', 'EmployeeController@Employee_edit')->name('Admin.Employee.Employee_edit');
Route::patch('/Admin/Employee/{id}/Employee_update', 'EmployeeController@Employee_update')->name('Admin.Employee.Employee_update');
Route::post('/Admin/Employee/Employee_store', 'EmployeeController@Employee_store')->name('Admin.Employee.Employee_store');
Route::get('/Admin/Employee/barcode', 'EmployeeController@barcode')->name('Admin.Employee.barcode');
Route::get('/Admin/Employee/leave', 'EmployeeController@leave')->name('Admin.Employee.leave');
Route::post('/Admin/Employee/leave_store', 'EmployeeController@leave_store')->name('Admin.Employee.leave_store');
Route::get('/Admin/Employee/leave_list', 'EmployeeController@leave_list')->name('Admin.Employee.leave_list');
Route::get('/Admin/Employee/{id}/leave_update', 'EmployeeController@leave_update')->name('Admin.Employee.leave_update');
Route::get('/Admin/Employee/{id}/leave_decline', 'EmployeeController@leave_decline')->name('Admin.Employee.leave_decline');
Route::get('/Admin/Employee/salary_add', 'EmployeeController@salary_add')->name('Admin.Employee.salary_add');
Route::get('/Admin/Employee/salary_details', 'EmployeeController@salary_details')->name('Admin.Employee.salary_details');
Route::post('/Admin/Employee/salary_store', 'EmployeeController@salary_store')->name('Admin.Employee.salary_store');
Route::get('/Admin/Employee/{id}/leave_edit', 'EmployeeController@leave_edit')->name('Admin.Employee.leave_edit');

// treatment start from here
Route::post('/Admin/Treatment/treatment_store', 'TreatmentController@treatment_store')->name('Admin.Treatment.treatment_store');
Route::get('/Admin/Treatment/treatment_list', 'TreatmentController@treatment_list')->name('Admin.Treatment.treatment_list');
Route::get('/Admin/Treatment/{id}/Treatment_view', 'TreatmentController@Treatment_view')->name('Admin.Treatment.Treatment_view');
Route::get('/Admin/Treatment/{id}/Treatment_edit', 'TreatmentController@Treatment_edit')->name('Admin.Treatment.Treatment_edit');
Route::patch('/Admin/Treatment/{id}/Treatment_update', 'TreatmentController@Treatment_update')->name('Admin.Treatment.Treatment_update');
//case note start from here
Route::get('/Admin/Casenote/Casenote', 'CasenoteController@Casenote')->name('Admin.Casenote.Casenote');
Route::post('/Admin/Casenote/Casenote_store', 'CasenoteController@Casenote_store')->name('Admin.Casenote.Casenote_store');
Route::get('/Admin/Casenote/Casenote_list', 'CasenoteController@Casenote_list')->name('Admin.Casenote.Casenote_list');
Route::get('/Admin/Casenote/{id}/Casenote_view', 'CasenoteController@Casenote_view')->name('Admin.Casenote.Casenote_view');
Route::get('/Admin/Casenote/{id}/Casenote_edit', 'CasenoteController@Casenote_edit')->name('Admin.Casenote.Casenote_edit');
Route::patch('/Admin/Casenote/{id}/Casenote_update', 'CasenoteController@Casenote_update')->name('Admin.Casenote.Casenote_update');
Route::delete('/Admin/Casenote/{id}/Casenote_destory', 'CasenoteController@Casenote_destory')->name('Admin.Casenote.Casenote_destory');

//make payment start from here
Route::get('/Admin/Payment/Payment', 'PaymentController@Payment')->name('Admin.Payment.Payment');
Route::get('/Admin/Payment/bank_deposit', 'PaymentController@bank_deposit')->name('Admin.Payment.bank_deposit');
Route::post('/Admin/Payment/bank_deposit_search', 'PaymentController@bank_deposit_search')->name('Admin.Payment.bank_deposit_search');
Route::post('/Admin/Payment/Payment_store', 'PaymentController@Payment_store')->name('Admin.Payment.Payment_store');
Route::get('/Admin/Payment/Payment_list', 'PaymentController@Payment_list')->name('Admin.Payment.Payment_list');
Route::get('/Admin/Payment/{id}/Payment_edit', 'PaymentController@Payment_edit')->name('Admin.Payment.Payment_edit');
Route::post('/Admin/Payment/{id}/Payment_update', 'PaymentController@Payment_update')->name('Admin.Payment.Payment_update');
Route::get('/Admin/Payment/Payment_admin_outstanding', 'PaymentController@Payment_admin_outstanding')->name('Admin.Payment.Payment_admin_outstanding');
Route::get('/Admin/Payment/{id}/Payment_list_edit', 'PaymentController@Payment_list_edit')->name('Admin.Payment.Payment_list_edit');
Route::patch('/Admin/Payment/{id}/Payment_list_update', 'PaymentController@Payment_list_update')->name('Admin.Payment.Payment_list_update');

Route::get('/Admin/Payment/fullpayments', 'PaymentController@fullpayment')->name('Admin.Payment.fullpayments');
Route::get('/Admin/Payment/{id}/fullpayment', 'PaymentController@fullpayment_view')->name('Admin.Payment.fullpayment_view');
Route::get('/Admin/Payment/outstandingpayment', 'PaymentController@outstandingpayment')->name('Admin.Payment.outstandingpayment');
Route::get('/Admin/Payment/paynent_pending', 'PaymentController@paynent_pending')->name('Admin.Payment.paynent_pending');
Route::get('/Admin/Payment/{id}/payment_invoice', 'PaymentController@payment_invoice')->name('Admin.Payment.payment_invoice');
Route::get('/Admin/Payment/{id}/payment_invoice_delete', 'PaymentController@payment_invoice_delete')->name('Admin.Payment.payment_invoice_delete');
Route::get('/Admin/Payment/{id}/order_status', 'PaymentController@order_status')->name('Admin.Payment.order_status');
Route::patch('/Admin/Payment/{id}/order_update', 'PaymentController@order_update')->name('Admin.Payment.order_update');
Route::get('/Admin/Payment/{id}/print_invoice', 'PaymentController@print_invoice')->name('Admin.Payment.print_invoice');
//special vaccine start from here
Route::get('/Admin/Payment/oustanding', 'PaymentController@oustanding')->name('Admin.Payment.oustanding');
Route::get('/Admin/Payment/vaccineoustanding', 'PaymentController@vaccineoustanding')->name('Admin.Payment.vaccineoustanding');
Route::get('/Admin/Payment/{id}/oustanding_edit', 'PaymentController@oustanding_edit')->name('Admin.Payment.oustanding_edit');
Route::patch('/Admin/Payment/{id}/oustanding_update', 'PaymentController@oustanding_update')->name('Admin.Payment.oustanding_update');
Route::patch('/Admin/Payment/{id}/oustanding_update', 'PaymentController@oustanding_update')->name('Admin.Payment.oustanding_update');
Route::patch('/Admin/Payment/{id}/oustanding_update', 'PaymentController@oustanding_update')->name('Admin.Payment.oustanding_update');
Route::get('/Admin/Payment/{id}/order_cash', 'PaymentController@order_cash')->name('Admin.Payment.order_cash');
Route::get('/Admin/Payment/{id}/order_pos', 'PaymentController@order_pos')->name('Admin.Payment.order_pos');
Route::get('/Admin/Payment/{id}/order_transfer', 'PaymentController@order_transfer')->name('Admin.Payment.order_transfer');
Route::get('/Admin/Payment/{id}/cash_pos', 'PaymentController@cash_pos')->name('Admin.Payment.cash_pos');
Route::get('/Admin/Payment/{id}/cash_transfer', 'PaymentController@cash_transfer')->name('Admin.Payment.cash_transfer');
Route::get('/Admin/Payment/full_doctor_list', 'PaymentController@full_doctor_list')->name('Admin.Payment.full_doctor_list');
//Report start from here
Route::get('/Admin/Payment/due_payment', 'PaymentController@due_payment')->name('Admin.Payment.due_payment');
Route::post('/Admin/Payment/search', 'PaymentController@search')->name('Admin.Payment.search');
Route::get('/Admin/Payment/Account_pos', 'PaymentController@Account_pos')->name('Admin.Payment.Account_pos');
Route::get('/Admin/Payment/Account_transfer', 'PaymentController@Account_transfer')->name('Admin.Payment.Account_transfer');
Route::get('/Admin/Payment/Account_cash', 'PaymentController@Account_cash')->name('Admin.Payment.Account_cash');
Route::get('/Admin/Payment/vaccine_report', 'PaymentController@vaccine_report')->name('Admin.Payment.vaccine_report');
Route::get('/Admin/Payment/vaccine_outstanding_report', 'PaymentController@vaccine_outstanding_report')->name('Admin.Payment.vaccine_outstanding_report');
Route::get('/Admin/Payment/cash_report', 'PaymentController@cash_report')->name('Admin.Payment.cash_report');
Route::post('/Admin/Payment/cash_report_store', 'PaymentController@cash_report_store')->name('Admin.Payment.cash_report_store');

//Customer start from here
Route::get('/Admin/Customer/add_customer', 'CustomerController@add_customer')->name('Admin.Customer.add_customer');
Route::get('/Admin/Customer/add_customer_list', 'CustomerController@add_customer_list')->name('Admin.Customer.add_customer_list');
Route::get('/Admin/Customer/{id}/add_customer_edit', 'CustomerController@add_customer_edit')->name('Admin.Customer.add_customer_edit');
Route::post('/Admin/Customer/add_customer_store', 'CustomerController@add_customer_store')->name('Admin.Customer.add_customer_store');
Route::patch('/Admin/Customer/{id}/add_customer_update', 'CustomerController@add_customer_update')->name('Admin.Customer.add_customer_update');
Route::get('/Admin/Customer/{id}/add_customer_destory', 'CustomerController@add_customer_destory')->name('Admin.Customer.add_customer_destory');


//pos outstanding work start here
Route::get('/Admin/Pos/Pos', 'PosController@Pos')->name('Admin.Pos.Pos');
Route::post('/Admin/Pos/Pos_store', 'PosController@Pos_store')->name('Admin.Pos.Pos_store');
Route::post('/Admin/Pos/directPayment', 'PosController@directPayment')->name('Admin.Pos.directPayment');
Route::patch('/Admin/Pos/{id}/Pos_update', 'PosController@Pos_update')->name('Admin.Pos.Pos_update');
Route::get('/Admin/Pos/{id}/Pos_invoice', 'PosController@Pos_invoice')->name('Admin.Pos.Pos_invoice');
Route::get('/Admin/Pos/{id}/Pos_invoice_view', 'PosController@Pos_invoice_view')->name('Admin.Pos.Pos_invoice_view');
Route::get('/Admin/Pos/{id}/Pos_invoice_discount', 'PosController@Pos_invoice_discount')->name('Admin.Pos.Pos_invoice_discount');
Route::get('/Admin/Pos/{id}/print_invoice', 'PosController@print_invoice')->name('Admin.Pos.print_invoice');
Route::get('/Admin/Pos/Pos_view', 'PosController@Pos_view')->name('Admin.Pos.Pos_view');
Route::get('/Admin/Pos/Pos_pending', 'PosController@Pos_pending')->name('Admin.Pos.Pos_pending');
Route::delete('/Admin/Pos/{id}/Pos_pending_delete', 'PosController@Pos_pending_delete')->name('Admin.Pos.Pos_pending_delete');
Route::get('/Admin/Pos/{id}/order_status', 'PosController@order_status')->name('Admin.Pos.order_status');
Route::get('/Admin/Pos/{id}/order_cash', 'PosController@order_cash')->name('Admin.Pos.order_cash');
Route::get('/Admin/Pos/{id}/order_pos', 'PosController@order_pos')->name('Admin.Pos.order_pos');
Route::get('/Admin/Pos/{id}/order_transfer', 'PosController@order_transfer')->name('Admin.Pos.order_transfer');
Route::get('/Admin/Pos/{id}/cash_pos', 'PosController@cash_pos')->name('Admin.Pos.cash_pos');
Route::get('/Admin/Pos/{id}/cash_transfer', 'PosController@cash_transfer')->name('Admin.Pos.cash_transfer');
Route::get('/Admin/Pos/daily_sales_report', 'PosController@daily_sales_report')->name('Admin.Pos.daily_sales_report');
Route::get('/Admin/Pos/{id}/daily_sales_view', 'PosController@daily_sales_view')->name('Admin.Pos.daily_sales_view');
Route::get('/Admin/Pos/due', 'PosController@due')->name('Admin.Pos.due');
Route::get('/Admin/Pos/{id}/due_edit', 'PosController@due_edit')->name('Admin.Pos.due_edit');
Route::patch('/Admin/Pos/{id}/due_update', 'PosController@due_update')->name('Admin.Pos.due_update');
Route::get('/Admin/Pos/store_full_payment', 'PosController@store_full_payment')->name('Admin.Pos.store_full_payment');
Route::get('/Admin/Pos/store_due', 'PosController@store_due')->name('Admin.Pos.store_due');
Route::get('/Admin/Pos/store_transfer', 'PosController@store_transfer')->name('Admin.Pos.store_transfer');
Route::get('/Admin/Pos/store_pos', 'PosController@store_pos')->name('Admin.Pos.store_pos');
Route::get('/Admin/Pos/store_cash', 'PosController@store_cash')->name('Admin.Pos.store_cash');
Route::get('/Admin/Pos/transfer_cash', 'PosController@transfer_cash')->name('Admin.Pos.transfer_cash');
Route::get('/Admin/Pos/pos_cash', 'PosController@pos_cash')->name('Admin.Pos.pos_cash');
Route::get('/Admin/Pos/sales_history', 'PosController@sales_history')->name('Admin.Pos.sales_history');
Route::get('/Admin/Pos/today_items', 'PosController@today_items')->name('Admin.Pos.today_items');
Route::get('/Admin/Pos/today_items_cashier', 'PosController@today_items_cashier')->name('Admin.Pos.today_items_cashier');
Route::patch('/Admin/Pos/{id}/daily_sales_update', 'PosController@daily_sales_update')->name('Admin.Pos.daily_sales_update');
Route::get('/Admin/Pos/{id}/daily_sales_edit', 'PosController@daily_sales_edit')->name('Admin.Pos.daily_sales_edit');
Route::get('/Admin/Pos/balance', 'PosController@balance')->name('Admin.Pos.balance');
Route::get('/Admin/Pos/direct_print', 'PosController@direct_print')->name('Admin.Pos.direct_print');

//search start from here

Route::post('/Admin/Pos/search', 'PosController@search')->name('Admin.search.search');
Route::post('/Admin/Pos/today_search', 'PosController@today')->name('Admin.Pos.today_search');
Route::post('/Admin/Pos/payment_search', 'PosController@payment_search')->name('Admin.Pos.payment_search');
Route::post('/Admin/Pos/search_dubts', 'PosController@search_dubts')->name('Admin.Pos.search_dubts');
Route::post('/Admin/Pos/search_payment', 'PosController@search_payment')->name('Admin.Pos.search_payment');
Route::post('/Admin/Pos/newproduct_supply', 'PosController@newproduct_supply')->name('Admin.Pos.newproduct_supply');
Route::post('/Admin/Pos/cashbackseach', 'PosController@cashbackseach')->name('Admin.Pos.cashbackseach');
Route::post('/Admin/Pos/storekseach', 'PosController@storekseach')->name('Admin.Pos.storekseach');
//cart controller start from here
Route::post('/Admin/Cart/add_cart', 'CartController@add_cart')->name('Admin.Cart.add_cart');
Route::post('/Admin/Cart/get_cart', 'CartController@get_cart')->name('Admin.Cart.get_cart');
Route::post('/Admin/Cart/barcode_scanner', 'CartController@barcode_scanner')->name('Admin.Cart.barcode_scanner');
Route::get('/Admin/Cart/fetch_cart', 'CartController@fetch_cart')->name('Admin.Cart.fetch_cart');

Route::patch('/Admin/Cart/{id}/update_cart', 'CartController@update_cart')->name('Admin.Cart.update_cart');
Route::patch('/Admin/Cart/update_cart_all', 'CartController@update_cart_all')->name('Admin.Cart.update_cart_all');
Route::get('/Admin/Cart/{id}/destory_cart', 'CartController@destory_cart')->name('Admin.Cart.destory_cart');
Route::get('/Admin/Payment/doctor_report', 'PaymentController@doctor_report')->name('Admin.Payment.doctor_report');
Route::get('/Admin/Payment/{id}', 'PaymentController@doctor')->name('Admin.Payment.doctor');

//syn pending
Route::get('/Admin/syn/syn', 'Syn_flatController@syn')->name('Admin.syn.syn');



Route::get('/Admin/syn/syn_receiver', 'Syn_flatController@syn_receiver')->name('Admin.syn.syn_receiver');
// Route::post('/Admin/syn/syn_receiver', 'Syn_flatController@syn_receiver')->name('Admin.syn.syn_receiver');

// permssion and role
Route::get('/Admin/User/role', 'RoleController@role')->name('Admin.User.role');
Route::post('/Admin/User/role_store', 'RoleController@role_store')->name('Admin.User.role_store');
Route::get('/Admin/User/{id}/role_edit', 'UserController@role_edit')->name('Admin.User.role_edit');
Route::patch('/Admin/User/{id}/role_update', 'UserController@role_update')->name('Admin.User.role_update');

Route::get('/Admin/User/register', 'UserController@register')->name('Admin.User.register');
Route::post('/Admin/User/register_store', 'UserController@register_store')->name('Admin.User.register_store');

Route::post('/Admin/User/bank_store', 'UserController@bank_store')->name('Admin.User.bank_store');
Route::get('/Admin/User/{id}/delete', 'UserController@delete')->name('Admin.User.delete');

Route::get('/Admin/User/{id}/register_edit', 'UserController@register_edit')->name('Admin.User.register_edit');
Route::patch('/Admin/User/{id}/register_update', 'UserController@register_update')->name('Admin.User.register_update');
// user stat from here
Route::get('/Admin/User/add_user', 'UserController@add_user')->name('Admin.User.add_user');
Route::get('/Admin/User/{id}/profile', 'UserController@profile')->name('Admin.User.profile');
Route::get('/Admin/User/user/user_list', 'UserController@user_list')->name('Admin.User.user_list');

Route::patch('/Admin/{user}/attach', 'UserController@attach')->name('admin.role.attach');

Route::patch('/Admin/{user}/detach', 'UserController@detach')->name('admin.role.detach');
Route::get('/Admin/User/add_user', 'UserController@add_user')->name('Admin.User.add_user');
Route::delete('/Admin/User/{id}/destory', 'UserController@destory')->name('Admin.User.destory');
//addmission start from here
Route::get('/Admin/admission/admission', 'AdmissionController@admission')->name('Admin.admission.admission');
Route::post('/Admin/admission/admission_store', 'AdmissionController@admission_store')->name('Admin.admission.admission_store');
Route::patch('/Admin/admission/{id}/admission_update', 'AdmissionController@admission_update')->name('Admin.admission.admission_update');
Route::patch('/Admin/admission/{id}/admission_payment', 'AdmissionController@admission_payment')->name('Admin.admission.admission_payment');
Route::get('/Admin/admission/{id}/admission_payment_edit', 'AdmissionController@admission_payment_edit')->name('Admin.admission.admission_payment_edit');

//store transfer
Route::get('/Admin/Store/store', 'StoreController@store')->name('Admin.Store.store');
Route::post('/Admin/Store/store_cart', 'StoreController@store_cart')->name('Admin.Store.store_cart');
Route::patch('/Admin/Store/{id}/store_cart_update', 'StoreController@store_cart_update')->name('Admin.Store.store_cart_update');
Route::get('/Admin/Store/{id}/destory', 'StoreController@destory')->name('Admin.Store.destory');
Route::post('/Admin/Store/store_order', 'StoreController@store_order')->name('Admin.Store.store_order');
Route::patch('/Admin/Store/update_cart_all', 'StoreController@update_cart_all')->name('Admin.Store.update_cart_all');


Route::get('/Admin/Store/store_view', 'StoreController@store_view')->name('Admin.Store.store_view');
Route::get('/Admin/Store/Retail', 'StoreController@Retail')->name('Admin.Store.Retail');
Route::get('/Admin/Store/clinicuse', 'StoreController@clinicuse')->name('Admin.Store.clinicuse');





Route::get('/Admin/Store/vaccine_due', 'StoreController@vaccine_due')->name('Admin.Store.vaccine_due');
Route::get('/Admin/Store/vaccine_balance', 'StoreController@vaccine_balance')->name('Admin.Store.vaccine_balance');
Route::post('/Admin/Store/vaccine_search', 'StoreController@vaccine_search')->name('Admin.Store.vaccine_search');

Route::get('/Admin/Store/service_due', 'StoreController@service_due')->name('Admin.Store.service_due');
Route::get('/Admin/Store/service_balance', 'StoreController@service_balance')->name('Admin.Store.service_balance');
Route::post('/Admin/Store/service_search', 'StoreController@service_search')->name('Admin.Store.service_search');




Route::get('/Admin/Store/store_move', 'StoreController@store_move')->name('Admin.Store.store_move');
Route::get('/Admin/Store/store_damage', 'StoreController@store_damage')->name('Admin.Store.store_damage');
Route::get('/Admin/Store/{id}/store_items', 'StoreController@store_items')->name('Admin.Store.store_items');
// Damage
Route::patch('/Admin/Store/{id}/store_damage_update', 'StoreController@store_damage_update')->name('Admin.Store.store_damage_update');
Route::patch('/Admin/Store/{id}/store_head_update', 'StoreController@store_head_update')->name('Admin.Store.store_head_update');

Route::patch('/Admin/Store/{id}/clinic_use', 'StoreController@clinic_use')->name('Admin.Store.clinic_use');

Route::patch('/Admin/Store/{id}/Retails', 'StoreController@Retails')->name('Admin.Store.Retails');



//add services
Route::get('/Admin/Store/service', 'StoreController@service')->name('Admin.Store.service');

// Pending
Route::get('/Admin/Store/store_view_details', 'StoreController@store_view_details')->name('Admin.Store.store_view_details');
Route::post('/Admin/Store/service_store', 'StoreController@service_store')->name('Admin.Store.service_store');
Route::get('/Admin/Store/service/{id}', 'StoreController@des')->name('Admin.Store.destory2');

Route::post('/Admin/Store/service_item_store', 'StoreController@service_item_store')->name('Admin.Store.service_item_store');


Route::post('/Admin/Store/item_store', 'StoreController@item_store')->name('Admin.Store.item_store');
Route::post('/Admin/Store/item', 'StoreController@item')->name('Admin.Store.item');
Route::post('/Admin/Store/service_item', 'StoreController@service_item')->name('Admin.Store.service_item');
Route::get('/Admin/Store/{id}/service_item_destory', 'StoreController@service_item_destory')->name('Admin.Store.service_item_destory');
Route::Patch('/Admin/Store/{id}/service_item_update', 'StoreController@service_item_update')->name('Admin.Store.service_item_update');
Route::Patch('/Admin/Store/{id}/service_item_update2', 'StoreController@service_item_update2')->name('Admin.Store.service_item_update2');

Route::get('/Admin/Store/{id}/fatchonlineGood', 'StoreController@fatchonlineGood')->name('Admin.Store.fatchonlineGood');
});




