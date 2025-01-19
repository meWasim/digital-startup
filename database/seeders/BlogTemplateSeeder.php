<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     */

    public function run(): void
    {
        $user_id =1;
    $template_id =1;

        $blogPosts = [
            [
                'user_id' => $user_id,
                'template_id' =>$template_id,
                'title' => 'First Blog Post',
                'content' => 'This is the first blog post. Learn how to create dynamic blog content with Laravel seeder.',
                'image_url' => 'https://www.techgeartalk.com/wp-content/uploads/2016/12/properly-exposed-photograph.jpg',
            ],
            [
                'user_id' => $user_id,
                'template_id' =>$template_id,
                'title' => 'Second Blog Post',
                'content' => 'This is the second blog post. This one talks about how to manage your blog efficiently using Laravel.',
                'image_url' => 'https://www.techgeartalk.com/wp-content/uploads/2016/12/properly-exposed-photograph.jpg',
            ],
            [
                'user_id' => $user_id,
                'template_id' =>$template_id,
                'title' => 'Third Blog Post',
                'content' => 'The third blog post explains how to integrate a blog with a dynamic template system in Laravel.',
                'image_url' => 'https://www.techgeartalk.com/wp-content/uploads/2016/12/properly-exposed-photograph.jpg',

            ],
        ];

        // Insert blog posts into the database
        DB::table('blog_posts')->insert($blogPosts);
    }
}
