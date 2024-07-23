<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use NumberFormatter;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $amount = Sale::sum('price_paid_in_cents') / 100;
        $numberofSales = Sale::count();

        $formatter = new NumberFormatter('en_CA', NumberFormatter::CURRENCY);
        $amount = $formatter->formatCurrency($amount, 'CAD');

        $numberOfUsers = User::count();
        $avarageValuePerUser = ($numberOfUsers == 0)  ? 0 : ((Sale::sum('price_paid_in_cents') / $numberOfUsers) / 100);
        $avarageValuePerUser = $formatter->formatCurrency($avarageValuePerUser, 'CAD');

        $activeProducts = Product::where('is_available_for_purchase', true)->count();
        $inactiveProducts = Product::where('is_available_for_purchase', false)->count();

        if ($request->hasHeader('x-refresh')) {
            return view('components.admin-dashboard-data', [
                'amount' => $amount,
                'numberofSales' => $numberofSales,
                'avarageValuePerUser' => $avarageValuePerUser,
                'numberOfUsers' => $numberOfUsers,
                'activeProducts' => $activeProducts,
                'inactiveProducts' => $inactiveProducts
            ]);
        }

        return view('admin.dashboard');
    }
}
