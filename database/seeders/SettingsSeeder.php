<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    protected $settings = [
        [
            'key' => 'site_name',
            'value' => 'Skinest E-Commerce',
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
            'value' => 'VND',
        ],
        [
            'key' => 'currency_symbol',
            'value' => '₫',
        ],
        [
            'key' => 'site_logo',
            'value' => '',
        ],
        [
            'key' => 'site_favicon',
            'value' => '',
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
            'key' => 'google_drive_refresh_token',
            'value' => ''
        ],
        [
            'key' => 'get_featured_products',
            'value' => 5
        ],
        [
            'key' => 'get_best_sell_products',
            'value' => 4
        ],
        [
            'key' => 'get_related_products',
            'value' => 4
        ],
        [
            'key' => 'get_own_products',
            'value' => 6
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
