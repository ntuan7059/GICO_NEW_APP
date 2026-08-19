<?php

namespace Tests\Feature;

use App\Models\ProductInquiry;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class InquiryTest extends TestCase
{
    use DatabaseTransactions;

    public function test_guest_can_start_and_continue_an_inquiry(): void
    {
        $response = $this->postJson(route('inquiries.store'), [
            'name' => 'Khách kiểm thử',
            'phone' => '0901234567',
            'message' => 'Tôi cần báo giá dây đồng CV 1x16 mm².',
        ]);

        $response->assertCreated();
        $inquiry = ProductInquiry::where('phone', '0901234567')->firstOrFail();
        $this->assertCount(1, $inquiry->messages);

        $this->postJson(route('inquiries.reply'), ['message' => 'Số lượng dự kiến 2.000 m.'])
            ->assertOk();

        $this->getJson(route('inquiries.messages'))
            ->assertOk()
            ->assertJsonCount(2, 'messages');
    }
}
