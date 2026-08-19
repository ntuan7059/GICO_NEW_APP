<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductInquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = ProductInquiry::with(['product.translation'])->withCount('messages')->latest('last_message_at')->paginate(30);
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show(ProductInquiry $inquiry)
    {
        $inquiry->load(['messages', 'product.translation']);
        $inquiry->messages()->where('sender', 'customer')->whereNull('read_at')->update(['read_at' => now()]);
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function reply(Request $request, ProductInquiry $inquiry)
    {
        $data = $request->validate(['message' => ['required', 'string', 'max:3000']]);
        $inquiry->messages()->create(['sender' => 'admin', 'message' => $data['message']]);
        $inquiry->update(['status' => 'waiting_customer', 'last_message_at' => now()]);
        return back()->with('success', 'Đã gửi phản hồi cho khách hàng.');
    }

    public function status(Request $request, ProductInquiry $inquiry)
    {
        $data = $request->validate(['status' => ['required', 'in:open,waiting_customer,closed']]);
        $inquiry->update($data);
        return back()->with('success', 'Đã cập nhật trạng thái.');
    }
}
