<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = trim((string) $request->get('keyword'));

        $customers = User::when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.customers.index', compact('customers', 'keyword'));
    }

    public function show(User $customer): View
    {
        $orders = method_exists($customer, 'orders')
            ? $customer->orders()->latest('id')->take(10)->get()
            : collect();

        return view('admin.customers.show', compact('customer', 'orders'));
    }

    public function destroy(User $customer): RedirectResponse
    {
        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', 'Xóa khách hàng thành công.');
    }
}