<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $data['TotalOrder'] = OrderModel::getTotalOrder();
        $data['TodayTotalOrder'] = OrderModel::getTodayTotalOrder();
        $data['TotalAmount'] = OrderModel::getTotalAmount();
        $data['TotalTodayAmount'] = OrderModel::getTotalTodayAmount();
        $data['TotalCustomer'] = User::getTotalCustomer();
        $data['TotalTodayCustomer'] = User::getTotalTodayCustomer();
        $data['getLatestOrders'] = OrderModel::getLatestOrders();

        if (!empty($request->year)) {
            $year = $request->year;
        } else {
            $year = date('Y');
        }



        $getTotalCustomerMounth = '';
        $getTotalOrderMounth = '';
        $getTotalOrderAmountMounth = '';
        $totalAmount = 0;
        for ($mounth = 1; $mounth <= 12; $mounth++) {
            $startDate = new \DateTime("$year-$mounth-01");
            $endDate = new \DateTime("$year-$mounth-01");
            $endDate->modify("last day of this month");

            $start_date = $startDate->format('Y-m-d');
            $end_date = $endDate->format('Y-m-d');

            $customer = User::getTotalCustomerMonth($start_date, $end_date);
            $getTotalCustomerMounth .= $customer . ',';
            $order = OrderModel::getTotalOrderMounth($start_date, $end_date);
            $getTotalOrderMounth .= $order . ',';
            $orderpayment = OrderModel::getTotalOrderAmountMounth($start_date, $end_date);
            $getTotalOrderAmountMounth .= $orderpayment . ',';

            $totalAmount = $totalAmount + $orderpayment;

        }

        $data['getTotalCustomerMounth'] = rtrim($getTotalCustomerMounth, ",");
        $data['getTotalOrderMounth'] = rtrim($getTotalOrderMounth, ",");
        $data['getTotalOrderAmountMounth'] = rtrim($getTotalOrderAmountMounth, ",");
        $data['totalAmount'] = $totalAmount;
        $data['year'] = $year;


        $data['header_title'] = 'Dashboard';
        return view('admin.dashboard', $data);
    }
}
