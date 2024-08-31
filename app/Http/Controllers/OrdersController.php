<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\DataTables;

class OrdersController extends Controller
{
    public function index()
    {
        return Inertia::render('Orders');
    }

    public function list(Request $request){
        $orders = Order::with(['customer', 'orderStatus'])
            ->select([
                'orders.*',
            ]);
        return DataTables::of($orders)
            ->filter(function ($query) use($request){
                if ($request->has('search')){
                    $query->where('reference', 'LIKE', '%'.$request->search['value'].'%');
                }
                #add search functionality on relations customer.full_name and orderStatus.name
                $query->orWhereHas('customer', function ($query) use ($request){
                    $query->where('first_name', 'LIKE', '%'.$request->search['value'].'%')
                        ->orWhere('last_name', 'LIKE', '%'.$request->search['value'].'%');
                });
                $query->orWhereHas('orderStatus', function ($query) use ($request){
                    $query->where('name', 'LIKE', '%'.$request->search['value'].'%');
                });
                $query->orWhere(DB::raw('DATE_FORMAT(created_at, \'%M/%d/%Y H%:%i %A\')'), 'LIKE', '%'.$request->search['value'].'%');
                $query->orWhere('updated_at', 'LIKE', '%'.$request->search['value'].'%');

            })
            ->editColumn('created_at', function ($order) {
                return $order->created_at->format('M/d/Y H:i A');
            })
            ->editColumn('updated_at', function ($order) {
                return $order->created_at->format('M/d/Y H:i A');
            })
            ->addColumn('customer', function ($order) {
                return $order->customer->first_name . ' ' . $order->customer->last_name;
            })
            ->addColumn('total', function ($order) {
                return Number::format($order->total_price, 2);
            })
            ->addColumn('status', function ($order) {
                return $order->orderStatus->name;
            })
            ->make(true);
    }
}
