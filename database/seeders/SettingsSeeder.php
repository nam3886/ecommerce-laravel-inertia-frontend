<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    protected $settings = [
        [
            'key' => 'site_name',
            'value' => 'TrueMark E-Commerce',
        ],
        [
            'key' => 'site_title',
            'value' => 'E-Commerce',
        ],
        [
            'key' => 'default_email_address',
            'value' => 'truemarkaplication@gmail.com',
        ],
        [
            'key' => 'default_address',
            'value' => '4710-4890 Breckinridge St, Fayettevill',
        ],
        [
            'key' => 'default_phone',
            'value' => '(+800) 345 678, (+800) 123 456',
        ],
        [
            'key' => 'currency_code',
            'value' => 'USD',
        ],
        [
            'key' => 'currency_symbol',
            'value' => '₫',
        ],
        [
            'key' => 'site_logo',
            'value' => '{"link":{"204w":"https:\/\/drive.google.com\/uc?id=1Fg7M-NzZ-LyERACybfJ8ASKEv5d7Nbhk&export=media"},"path":{"204w":"1hfIZRrjkaRLP_tzGqV8tBIWiUTqcwR0f\/1Fg7M-NzZ-LyERACybfJ8ASKEv5d7Nbhk"}}',
        ],
        [
            'key' => 'site_favicon',
            'value' => '{"link":{"204w":"https:\/\/drive.google.com\/uc?id=183aMFZl3FRVcdeHNA57R7RM16FYFogHF&export=media"},"path":{"204w":"1hfIZRrjkaRLP_tzGqV8tBIWiUTqcwR0f\/183aMFZl3FRVcdeHNA57R7RM16FYFogHF"}}',
        ],
        [
            'key' => 'footer_copyright_text',
            'value' => '<p> COPYRIGHT &copy; <a href="https://hasthemes.com/" target="_blank">HasThemes</a>. ALL
            RIGHTS RESERVED.</p>',
        ],
        [
            'key' => 'seo_meta_title',
            'value' => null,
        ],
        [
            'key' => 'seo_meta_description',
            'value' => null,
        ],
        [
            'key' => 'social_facebook',
            'value' => null,
        ],
        [
            'key' => 'social_twitter',
            'value' => null,
        ],
        [
            'key' => 'social_instagram',
            'value' => null,
        ],
        [
            'key' => 'social_linkedin',
            'value' => null,
        ],
        [
            'key' => 'google_analytics',
            'value' => null,
        ],
        [
            'key' => 'facebook_pixels',
            'value' => null,
        ],
        [
            'key' => 'get_new_products',
            'value' => 10
        ],
        [
            'key' => 'get_best_products',
            'value' => 6
        ],
        [
            'key' => 'get_related_products',
            'value' => 5
        ],
        [
            'key' => 'get_image_slides',
            'value' => 3
        ],
        [
            'key' => 'get_banner_brands',
            'value' => 4
        ],
        [
            'key' => 'get_categories',
            'value' => 4
        ],
        [
            'key' => 'pagination',
            'value' => 9
        ],
        [
            'key' => 'get_search_result',
            'value' => 5
        ],
        [
            'key' => 'facebook_page_id',
            'value' => '106661111629251'
        ],
        [
            'key' => 'facebook_app_id',
            'value' => '2986319748312354'
        ],
        [
            'key' => 'google_drive_refresh_token',
            'value' => ''
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $index => $setting) {
            $setting['updated_by'] = 1;
            $result = Setting::create($setting);
            // if (!$result) {
            //     $this->command->info("Insert failed at record $index.");
            //     return;
            // }
        }
        // $this->command->info('Inserted ' . count($this->settings) . ' records');
    }
}
