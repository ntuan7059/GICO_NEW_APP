<?php

namespace Tests\Feature;

use App\Models\Banner;
use App\Models\Document;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ContentManagementTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_can_upload_publish_and_delete_a_document(): void
    {
        Storage::fake('local');
        $admin = User::factory()->create();

        $this->actingAs($admin)->post(route('admin.documents.store'), [
            'title' => 'Catalogue dây đồng 2026',
            'description' => 'Thông số kỹ thuật mới nhất.',
            'file' => UploadedFile::fake()->create('catalogue.pdf', 128, 'application/pdf'),
            'published_at' => now()->format('Y-m-d'),
            'sort_order' => 1,
            'status' => 1,
        ])->assertRedirect(route('admin.documents.index'));

        $document = Document::where('title', 'Catalogue dây đồng 2026')->firstOrFail();
        Storage::disk('local')->assertExists($document->file_path);

        $this->get(route('document.index'))->assertOk()->assertSee('Catalogue dây đồng 2026');
        $this->get(route('document.download', $document))->assertOk()->assertDownload('catalogue.pdf');

        $this->actingAs($admin)->delete(route('admin.documents.destroy', $document))
            ->assertRedirect(route('admin.documents.index'));
        Storage::disk('local')->assertMissing($document->file_path);
        $this->assertDatabaseMissing('documents', ['id' => $document->id]);
    }

    public function test_homepage_uses_active_admin_banner_content(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('banner_images/managed.jpg', 'image');

        $banner = Banner::create([
            'type' => 'featured',
            'status' => 1,
            'sort_order' => 1,
            'link_url' => '/product',
        ]);
        $banner->translations()->create([
            'language_code' => 'vi',
            'title' => 'Banner quản trị linh hoạt',
            'description' => 'Nội dung được cập nhật từ trang quản trị.',
            'image_url' => 'banner_images/managed.jpg',
        ]);

        $this->get(route('xylo.home'))
            ->assertOk()
            ->assertSee('Banner quản trị linh hoạt')
            ->assertSee('/storage/banner_images/managed.jpg');
    }
}
