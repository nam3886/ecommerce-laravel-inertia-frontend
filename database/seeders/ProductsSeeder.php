<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = __DIR__ . '/json/';
        $products = json_decode(file_get_contents($path . 'products.json'), true);
        $images = json_decode(file_get_contents($path . 'images.json'), true);

        // sort products and images by product_id
        usort($products, fn ($a, $b) => $a['id'] <=> $b['id']);
        usort($images, fn ($a, $b) => $a['product_id'] <=> $b['product_id']);

        foreach ($products as $key => $product) {
            $dt = Carbon::now();
            $newProduct = new Product();
            $price = ceil(rand(500000, 999999) / 1E3) * 1E3;
            $quantity = rand(30, 50);
            $weight = rand(300, 600);
            $discount = rand(10, 15);
            $start = now();
            $end = $dt->addDays(rand(1, 30));
            $isMultipleVariant = rand(0, 1);
            $hasMaterial = rand(0, 1);
            $lastImage = collect($product['seo_image']['link'])->last();
            $description = '<div class="wc-tab-inner"> <div class="">   <div data-elementor-type="product-post" data-elementor-id="90831" class="elementor elementor-90831" data-elementor-settings="[]"> <div class="elementor-inner"> <div class="elementor-section-wrap"> <section class="wd-negative-gap elementor-section elementor-top-section elementor-element elementor-element-ae4b4df elementor-section-boxed elementor-section-height-default elementor-section-height-default wd-section-disabled" data-id="ae4b4df" data-element_type="section"> <div class="elementor-container elementor-column-gap-default"> <div class="elementor-row"> <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-09c6ee8" data-id="09c6ee8" data-element_type="column"> <div class="elementor-column-wrap elementor-element-populated"> <div class="elementor-widget-wrap"> <div class="elementor-element elementor-element-862a644 color-scheme-inherit text-left elementor-widget elementor-widget-text-editor" data-id="862a644" data-element_type="widget" data-widget_type="text-editor.default"> <div class="elementor-widget-container"> <div class="elementor-text-editor elementor-clearfix"><p>Fullbox ' . $product['name'] . ' CDG c??? cao, th???p 2 m??u ??en, tr???ng. Ph?? h???p: nam n???, ??i h???c, ??i l??m, ho???t ?????ng th??? thao. Size: 36-44. Ch???t li???u: Canvas. Giao h??ng to??n qu???c. B???o h??nh 3 th??ng. ?????i tr??? d??? d??ng. Streetwear, tr??? trung n??ng ?????ng.</p></div> </div> </div> <div class="elementor-element elementor-element-c10484c color-scheme-inherit text-left elementor-widget elementor-widget-text-editor" data-id="c10484c" data-element_type="widget" data-widget_type="text-editor.default"> <div class="elementor-widget-container"> <div class="elementor-text-editor elementor-clearfix"><p>COMME des GAR??ONS v?? ' . $product['name'] . ' th???t s??? ???? mang ?????n m???t l??n gi?? m???i cho nh???ng ai y??u th??ch s??? gi???n ????n nh??ng v???n th??? hi???n ???????c phong c??ch ri??ng v?? s??? s??ng t???o trong ????.</p><p>????i gi??y CDG Play x ' . $product['name'] . ' ???????c ra m???t l???n ?????u v??o n??m 2013. S??? k???t h???p n??y kh??ng ch??? mang ?????n m???t h??nh ???nh m???i m??? cho ' . $product['name'] . ' c??ng nh?? CDG Play m?? c??n t???o ???????c d???u ???n kh?? r?? n??t trong l??ng nh???ng ai ??am m?? sneakers.</p><p>????n gi???n m?? hi???u qu???, n???m b???t ???????c t??m l?? n??y c???a gi???i ??am m?? th???i trang v?? sneakers to??n th??? gi???i, COMME des GAR??ONS Play v?? ' . $product['name'] . ' th???t s??? ???? mang ?????n m???t l??n gi?? m???i cho nh???ng ai y??u th??ch s??? gi???n ????n nh??ng v???n th??? hi???n ???????c phong c??ch ri??ng v?? s??? s??ng t???o trong ????.</p><p>D??? d??ng k???t h???p v???i c??c lo???i trang ph???c v?? phong c??ch kh??c nhau, CDG Play X ' . $product['name'] . ' th???t s??? r???t ????ng ????? ch??ng ta s??? h???u v?? l??m m???i h??nh ???nh thay v?? nh???ng m???u ' . $product['name'] . ' th??ng th?????ng ????ng kh??ng n??o?</p></div> </div> </div> </div> </div> </div> </div> </div> </section> <section class="wd-negative-gap elementor-section elementor-top-section elementor-element elementor-element-9026a73 elementor-section-boxed elementor-section-height-default elementor-section-height-default wd-section-disabled" data-id="9026a73" data-element_type="section"> <div class="elementor-container elementor-column-gap-default"> <div class="elementor-row"> <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-17d4c3b" data-id="17d4c3b" data-element_type="column"> <div class="elementor-column-wrap elementor-element-populated"> <div class="elementor-widget-wrap"> <div class="elementor-element elementor-element-71b4c9d elementor-widget elementor-widget-image" data-id="71b4c9d" data-element_type="widget" data-widget_type="image.default"> <div class="elementor-widget-container"> <div class="elementor-image"> <div class="placeholder-image loading"><img class="lazyload" data-sizes="auto" data-srcset="' . $lastImage . '"data-src="' . $lastImage . '" /></div> </div> </div> </div> </div> </div> </div> </div></div> </section> </div> </div> </div> </div> </div> ';

            $newProduct->fill([
                'brand_id'          =>  $product['brand_id'],
                'shop_id'           =>  $product['brand_id'] != 1 ? 1 : 2,
                'slug'              =>  create_slug($product['name']),
                'sku'               =>  get_uniqid_code(),
                'name'              =>  $product['name'],
                'sub_description'   =>  substr($product['content'], 0, 100),
                'description'       =>  $description,
                'price'             =>  $price,
                'quantity'          =>  $quantity,
                'flag'              =>  $product['flag'],
                'updated_by'        =>  1,
                'weight'            =>  $weight,
                'is_featured'       =>  rand(0, 1),
            ])->save();

            $newProduct->sku = strtoupper(substr($newProduct->name, 0, 3) . $newProduct->id . 'nul' . get_uniqid_code() . '/VN');
            $newProduct->save();

            // seo
            $newProduct->seo()->create([
                'seo_image'         =>  [
                    'name' => Str::slug($product['name']) . '.webp',
                    'url' => collect($product['seo_image']['link'])->last(),
                    'path' => collect($product['seo_image']['path'])->last(),
                    'size' => 4240,
                    'ext' => 'webp',
                    'type' => 'image/webp',
                    'accepted' => "image/webp",
                    "dimensions" => [
                        "width" => intval(collect($product['seo_image']['path'])->keys()->last()),
                        "height" => intval(collect($product['seo_image']['path'])->keys()->last())
                    ]
                ],
                'seo_title'         =>  $product['seo_title'],
                'seo_description'   =>  $product['seo_description'],
                'seo_keyword'       =>  $product['seo_keyword'],
            ]);

            // gallery
            $newProduct->gallery()->create([
                'avatar'        =>  [
                    'name' => Str::slug($product['name']) . '.webp',
                    'url' => collect($images[$key]['avatar']['link'])->last(),
                    'path' => collect($images[$key]['avatar']['path'])->last(),
                    'size' => 4240,
                    'ext' => 'webp',
                    'type' => 'image/webp',
                    'accepted' => "image/webp",
                    "dimensions" => [
                        "width" => intval(collect($images[$key]['avatar']['path'])->keys()->last()),
                        "height" => intval(collect($images[$key]['avatar']['path'])->keys()->last())
                    ]
                ],

                'images'        =>  collect($images[$key]['images'])
                    ->map(function ($image) use ($product) {
                        return [
                            'name' => Str::slug($product['name']) . '.webp',
                            'url' => collect($image['link'])->last(),
                            'path' => collect($image['path'])->last(),
                            'size' => 4240,
                            'ext' => 'webp',
                            'type' => 'image/webp',
                            'accepted' => "image/webp",
                            "dimensions" => [
                                "width" => intval(collect($image['path'])->keys()->last()),
                                "height" => intval(collect($image['path'])->keys()->last())
                            ]
                        ];
                    }),
            ]);

            // categories
            $newProduct->categories()->attach([1, rand(2, 3)]);

            // tags
            $newProduct->tags()->attach([1, rand(2, 3)]);

            // discount
            if ($newProduct->flag !== 'hot') {
                $newProduct->discount()->create([
                    'price' => $discount,
                    'start' => $start,
                    'end'   => $end,
                ]);
            }

            // variants
            if (!$isMultipleVariant) continue;

            $sizes = AttributeValue::whereIn('id', range(1, 8))->inRandomOrder()->take(3)->get();
            $colors = AttributeValue::whereIn('id', range(15, 21))->inRandomOrder()->take(3)->get();
            $materials = AttributeValue::whereIn('id', range(22, 24))->inRandomOrder()->take(2)->get();

            $variants = $this->permutation($hasMaterial ? [$sizes, $colors, $materials] : [$sizes, $colors]);

            foreach ($variants as $var) {
                $var = collect($var);
                $isEmpty = rand(0, 1);
                $combination = $var->pluck('code')->sort();
                $combination = strtoupper($newProduct->id . $combination->join('') . ':' . $var->count());
                $productSku = strtoupper(substr($newProduct->name, 0, 3) . $newProduct->id . $combination . '/VN');
                $name = $var->map(fn ($item) => $item->attribute->name . ':' . $item->name)->join('-');

                $variant = $newProduct->variants()->create([
                    'name' => $name,
                    'sku' => $productSku,
                    'combination' => $combination,
                    'price' => $isEmpty ? null : $price + rand(2, 5) * 5000,
                    'quantity' => $isEmpty ? 0 : $quantity - rand(10, 20),
                    'weight' => $isEmpty ? null : $weight,
                    'updated_by' => 1
                ]);

                $variant->attributeValues()->sync($var->pluck('id'));

                if ($newProduct->flag !== 'hot') {
                    $variant->discount()->create([
                        'price' => $discount,
                        'start' => $start,
                        'end'   => $end,
                    ]);
                }
            }

            $newProduct->price = $newProduct->variants()->max('price');
            $newProduct->weight = $newProduct->variants()->max('weight');
            $newProduct->quantity = $newProduct->variants()->sum('quantity');
            $newProduct->save();
        }
    }


    public function permutation($list, $n = 0, &$result = [], $current = [])
    {
        if ($n === count($list)) {
            $result[] = $current;
        } else {
            foreach ($list[$n] as $item) {
                $this->permutation($list, $n + 1, $result, [...$current, $item]);
            }
        }

        return $result;
    }
}
