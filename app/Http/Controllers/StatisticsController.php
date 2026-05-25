<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\User;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function index()
    {
        // Supplier stats
        $totalSuppliers = Supplier::count();

        $activeSuppliers = Supplier::where(
            'status',
            'active'
        )->count();

        $inactiveSuppliers = Supplier::where(
            'status',
            'inactive'
        )->count();

        $averageRating = round(
            Supplier::avg('rating'),
            1
        );

        // Count users only
        $totalUsers = User::where(
            'role',
            'user'
        )->count();

        // Contract expiration tracker
        $expiringContracts = Supplier::where(
            'contract_end',
            '<=',
            Carbon::now()->addDays(30)
        )
        ->where(
            'contract_end',
            '>=',
            Carbon::now()
        )
        ->get();

      return view(
    'admin.statistical-dashboard',
            compact(
                'totalSuppliers',
                'activeSuppliers',
                'inactiveSuppliers',
                'averageRating',
                'totalUsers',
                'expiringContracts'
            )
        );
    }
}