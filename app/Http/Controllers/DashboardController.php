<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with counts for products, orders, companies, and users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve counts for each entity
        $productsCount = Product::count();
        $ordersCount = Order::count();
        $companiesCount = Company::count();
        $usersCount = User::count();

        // Pass the counts to the view
        return view('dashboard', compact('productsCount', 'ordersCount', 'companiesCount', 'usersCount'));
    }
}
