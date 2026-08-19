<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageTranslation;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'about',
                'title' => 'About Us',
                'content' => '<p>About Us content will be added here. Please edit this page in the admin panel to add your content from the old_about.html file.</p>',
            ],
            [
                'slug' => 'contact',
                'title' => 'Contact Us',
                'content' => '<p>Contact Us content will be added here. Please edit this page in the admin panel to add your content from the old_contact.html file.</p>',
            ],
            [
                'slug' => 'document',
                'title' => 'Document',
                'content' => '<p>Document content will be added here. Please edit this page in the admin panel to add your content from the old_document.html file.</p>',
            ],
            [
                'slug' => 'home',
                'title' => 'Home',
                'content' => '<p>Home page content will be added here. Please edit this page in the admin panel to add your content from the old_home.html file.</p>',
            ],
        ];

        foreach ($pages as $pageData) {
            $page = Page::firstOrCreate(
                ['slug' => $pageData['slug']],
                ['status' => true]
            );

            PageTranslation::updateOrCreate(
                [
                    'page_id' => $page->id,
                    'language_code' => 'en',
                ],
                [
                    'title' => $pageData['title'],
                    'content' => $pageData['content'],
                ]
            );
        }

        $this->command->info('Pages seeded successfully.');
    }
}
