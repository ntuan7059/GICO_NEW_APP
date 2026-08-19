<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\ProductInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:160', 'required_without:phone'],
            'phone' => ['nullable', 'string', 'max:30', 'required_without:email'],
            'company' => ['nullable', 'string', 'max:160'],
            'product_id' => ['nullable', 'exists:products,id'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        $inquiry = DB::transaction(function () use ($data) {
            $inquiry = ProductInquiry::create([
                'public_token' => (string) Str::uuid(),
                'product_id' => $data['product_id'] ?? null,
                'name' => $data['name'],
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null,
                'company' => $data['company'] ?? null,
                'status' => 'open',
                'last_message_at' => now(),
            ]);
            $inquiry->messages()->create(['sender' => 'customer', 'message' => $data['message']]);
            return $inquiry;
        });

        $request->session()->put('inquiry_token', $inquiry->public_token);
        return response()->json(['message' => 'Yêu cầu đã được gửi. Gia Hưng sẽ phản hồi ngay tại cửa sổ này.'], 201);
    }

    public function messages(Request $request)
    {
        $inquiry = $this->currentInquiry($request);
        if (!$inquiry) return response()->json(['messages' => []]);

        $inquiry->messages()->where('sender', 'admin')->whereNull('read_at')->update(['read_at' => now()]);
        return response()->json([
            'inquiry' => ['id' => $inquiry->id, 'name' => $inquiry->name, 'status' => $inquiry->status],
            'messages' => $inquiry->messages()->get()->map(fn ($message) => [
                'id' => $message->id,
                'sender' => $message->sender,
                'message' => $message->message,
                'time' => $message->created_at->format('H:i d/m/Y'),
            ]),
        ]);
    }

    public function reply(Request $request)
    {
        $data = $request->validate(['message' => ['required', 'string', 'max:3000']]);
        $inquiry = $this->currentInquiry($request);
        abort_unless($inquiry, 404);
        $inquiry->messages()->create(['sender' => 'customer', 'message' => $data['message']]);
        $inquiry->update(['status' => 'open', 'last_message_at' => now()]);
        return response()->json(['message' => 'Đã gửi tin nhắn.']);
    }

    private function currentInquiry(Request $request): ?ProductInquiry
    {
        $token = $request->session()->get('inquiry_token');
        return $token ? ProductInquiry::where('public_token', $token)->first() : null;
    }
}
