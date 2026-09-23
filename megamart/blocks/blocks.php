<?php 
	return [
        'blocks' => [
         'divider_megamart' => [
           'name' => 'MegaMart',
           'type' => 'divider'
         ],

         'mm_hero' => [
              'name' => 'Hero Slider',
              'type' => 'normal',
              'icon' => 'Ecom Icon Grid 3.png',
              'banner' => 'bannerimg.png',
              'subtitle' => 'Dark rounded banner slider with up to 3 slides',
              'inputs' => [
                'slide1_overline' => ['type' => 'text', 'name' => 'Slide 1: Small heading'],
                'slide1_title' => ['type' => 'text', 'name' => 'Slide 1: Big title (leave empty to hide slide)'],
                'slide1_subtitle' => ['type' => 'text', 'name' => 'Slide 1: Offer text'],
                'slide1_link' => ['type' => 'text', 'name' => 'Slide 1: Link (optional)'],
                'slide1_image' => ['type' => 'image', 'name' => 'Slide 1: Image'],
                'slide2_overline' => ['type' => 'text', 'name' => 'Slide 2: Small heading'],
                'slide2_title' => ['type' => 'text', 'name' => 'Slide 2: Big title (leave empty to hide slide)'],
                'slide2_subtitle' => ['type' => 'text', 'name' => 'Slide 2: Offer text'],
                'slide2_link' => ['type' => 'text', 'name' => 'Slide 2: Link (optional)'],
                'slide2_image' => ['type' => 'image', 'name' => 'Slide 2: Image'],
                'slide3_overline' => ['type' => 'text', 'name' => 'Slide 3: Small heading'],
                'slide3_title' => ['type' => 'text', 'name' => 'Slide 3: Big title (leave empty to hide slide)'],
                'slide3_subtitle' => ['type' => 'text', 'name' => 'Slide 3: Offer text'],
                'slide3_link' => ['type' => 'text', 'name' => 'Slide 3: Link (optional)'],
                'slide3_image' => ['type' => 'image', 'name' => 'Slide 3: Image'],
              ],
              'include' => 'megamart.hero',
          ],

         'mm_deals' => [
              'name' => 'Deal Products',
              'type' => 'normal',
              'icon' => 'Ecom Icon Grid 6.png',
              'banner' => 'bannerimg.png',
              'subtitle' => 'Product cards with discount badge and savings',
              'inputs' => [
                'title_prefix' => ['type' => 'text', 'name' => 'Title (grey part)'],
                'title_highlight' => ['type' => 'text', 'name' => 'Title (blue part)'],
                'category' => ['type' => 'text', 'name' => 'Category slug (optional, empty = all products)'],
                'number_of_products' => ['type' => 'select', 'name' => 'Number Of Products', 'options' => ['5' => '5', '10' => '10', '15' => '15', '20' => '20']],
              ],
              'include' => 'megamart.deals',
          ],

         'mm_top_categories' => [
              'name' => 'Top Categories',
              'type' => 'normal',
              'icon' => 'Ecom Icon Grid 7.png',
              'banner' => 'bannerimg.png',
              'subtitle' => 'Round category icons',
              'inputs' => [
                'title_prefix' => ['type' => 'text', 'name' => 'Title (grey part)'],
                'title_highlight' => ['type' => 'text', 'name' => 'Title (blue part)'],
                'number_of_categories' => ['type' => 'select', 'name' => 'Number Of Categories', 'options' => ['7' => '7', '14' => '14', '21' => '21']],
              ],
              'include' => 'megamart.top_categories',
          ],

         'mm_brands' => [
              'name' => 'Brand Promo Cards',
              'type' => 'normal',
              'icon' => 'Ecom Icon Grid 5.png',
              'banner' => 'bannerimg.png',
              'subtitle' => 'Three coloured brand offer cards',
              'inputs' => [
                'title_prefix' => ['type' => 'text', 'name' => 'Title (grey part)'],
                'title_highlight' => ['type' => 'text', 'name' => 'Title (blue part)'],
                'brand1_tag' => ['type' => 'text', 'name' => 'Card 1: Tag'],
                'brand1_offer' => ['type' => 'text', 'name' => 'Card 1: Offer text'],
                'brand1_link' => ['type' => 'text', 'name' => 'Card 1: Link (optional)'],
                'brand1_logo' => ['type' => 'image', 'name' => 'Card 1: Logo'],
                'brand1_image' => ['type' => 'image', 'name' => 'Card 1: Product image'],
                'brand2_tag' => ['type' => 'text', 'name' => 'Card 2: Tag'],
                'brand2_offer' => ['type' => 'text', 'name' => 'Card 2: Offer text'],
                'brand2_link' => ['type' => 'text', 'name' => 'Card 2: Link (optional)'],
                'brand2_logo' => ['type' => 'image', 'name' => 'Card 2: Logo'],
                'brand2_image' => ['type' => 'image', 'name' => 'Card 2: Product image'],
                'brand3_tag' => ['type' => 'text', 'name' => 'Card 3: Tag'],
                'brand3_offer' => ['type' => 'text', 'name' => 'Card 3: Offer text'],
                'brand3_link' => ['type' => 'text', 'name' => 'Card 3: Link (optional)'],
                'brand3_logo' => ['type' => 'image', 'name' => 'Card 3: Logo'],
                'brand3_image' => ['type' => 'image', 'name' => 'Card 3: Product image'],
              ],
              'include' => 'megamart.brands',
          ],

         'mm_essentials' => [
              'name' => 'Daily Essentials',
              'type' => 'normal',
              'icon' => 'Ecom Icon Grid 8.png',
              'banner' => 'bannerimg.png',
              'subtitle' => 'Category tiles with an offer line',
              'inputs' => [
                'title_prefix' => ['type' => 'text', 'name' => 'Title (grey part)'],
                'title_highlight' => ['type' => 'text', 'name' => 'Title (blue part)'],
                'offer_text' => ['type' => 'text', 'name' => 'Offer text under each tile'],
                'number_of_categories' => ['type' => 'select', 'name' => 'Number Of Categories', 'options' => ['6' => '6', '12' => '12', '18' => '18']],
              ],
              'include' => 'megamart.essentials',
          ],


         'divider_basic' => [
           'name' => 'Basic',
           'type' => 'divider'
         ],

          'page_title' => [
            'name' => 'Page Title',
            'type' => 'normal',
            'icon' => 'Ecom Icon Grid 1.png',
            'banner' => 'bannerimg.png',
            'subtitle' => 'Add Heading Tag',
            'inputs' => [
              'title' => ['type' => 'text', 'name' => 'Title'],
            ],
            'include' => 'pageTitle',
          ],

          'textarea' => [
            'name' => 'Text Area',
            'type' => 'normal',
            'icon' => 'Ecom Icon Grid 2.png',
            'banner' => 'bannerimg.png',
            'subtitle' => 'Add Simple Text',
            'inputs' => [
              'textarea' => ['type' => 'textarea', 'name' => 'Textarea'],
            ],
            'include' => 'textarea',
          ],

          'divider_b' => [
            'name' => 'Banners',
            'type' => 'divider'
          ],

          'products_banner_1' => [
            'name' => 'Products Banner 1',
            'type' => 'normal',
            'icon' => 'Ecom Icon Grid 3.png',
            'banner' => 'bannerimg.png',
            'subtitle' => 'Products banner slider',
            'inputs' => [
              'number_of_products' => ['type' => 'select', 'name' => 'Number Of Products', 'options' => ['1' => '1', '2' => '2', '3' => '3']],
            ],
            'include' => 'banner',
          ],

          'personal_banner' => [
            'name' => 'Personal Banner 1',
            'type' => 'normal',
            'icon' => 'Ecom Icon Grid 5.png',
            'banner' => 'bannerimg.png',
            'subtitle' => 'Personal banner',
            'inputs' => [
              'tagline' => ['type' => 'text', 'name' => 'Tagline'],
              'short_about' => ['type' => 'textarea', 'name' => 'A little description / About'],
              'banner' => ['type' => 'image', 'name' => 'Background image'],
            ],
            'include' => 'banner_2',
          ],



          'divider_1' => [
            'name' => 'About',
            'type' => 'divider'
          ],

          'left_banner_about' => [
            'name' => 'About section',
            'type' => 'normal',
            'icon' => 'Ecom Icon Grid 4.png',
            'banner' => 'bannerimg.png',
            'subtitle' => 'Short about',
            'inputs' => [
              'title' => ['type' => 'text', 'name' => 'Title'],
              'description' => ['type' => 'textarea', 'name' => 'Description'],
            ],
            'include' => 'about_left_banner',
          ],

          'divider_2' => [
            'name' => 'Products',
            'type' => 'divider'
          ],

        'products' => [
            'name' => 'Products',
            'type' => 'normal',
            'icon' => 'Ecom Icon Grid 13.png',
            'subtitle' => 'Products grid',
            'products' => ['limit' => 2],
            'banner' => 'bannerimg.png',
            'inputs' => [
              'number_of_products' => ['type' => 'select', 'name' => 'Number Of Products', 'options' => ['1' => '1', '5' => '5', '999' => 'All']],
              'show_search' => ['type' => 'select', 'name' => 'Show search form', 'options' => [0 => 'No', 1 => 'Yes']],
            ],
            'include' => 'product',
        ],

        'product_categories_1' => [
            'name' => 'Products Categories',
            'type' => 'normal',
            'icon' => 'Ecom Icon Grid 13.png',
            'subtitle' => 'Big Products Categories',
            'banner' => 'bannerimg.png',
            'inputs' => [
              'number_of_products' => ['type' => 'select', 'name' => 'Number Of Products', 'options' => ['3' => '3', '6' => '6', '999' => 'All']],
            ],
            'include' => 'product_categories_1',
        ],

       'product_categories_2' => [
            'name' => 'Products Categories 2',
            'type' => 'normal',
            'icon' => 'Ecom Icon Grid 13.png',
            'banner' => 'bannerimg.png',
            'subtitle' => 'Small Products Categories',
            'inputs' => [
              'number_of_products' => ['type' => 'select', 'name' => 'Number Of Products', 'options' => ['4' => '4', '8' => '8', '999' => 'All']],
            ],
            'include' => 'product_categories_2',
       ],
       'divider_blog' => [
         'name' => 'Blog',
         'type' => 'divider'
       ],
       'blogs_list' => [
            'name' => 'Blog list',
            'type' => 'normal',
            'icon' => 'Ecom Icon Grid 12.png',
            'banner' => 'bannerimg.png',
            'subtitle' => 'List blog posts',
            'inputs' => [
              'number_of_blogs' => ['type' => 'select', 'name' => 'Number Of Blog', 'options' => ['3' => '3', '6' => '6', '999' => 'All']],
            ],
            'include' => 'blogs.blog_list',
       ],
       'blogs_grid' => [
            'name' => 'Blog Grid',
            'type' => 'normal',
            'icon' => 'Ecom Icon Grid 13.png',
            'banner' => 'bannerimg.png',
            'subtitle' => 'Grid of blog posts',
            'inputs' => [
              'number_of_blogs' => ['type' => 'select', 'name' => 'Number Of Blog', 'options' => ['3' => '3', '6' => '6', '999' => 'All']],
            ],
            'include' => 'blogs.blog_grid',
       ],
    ],


    'pages' => [

      'home' => [
        'name' => 'Home',
        'active' => 1,
        'slug' => 'home',
        'blocks' => [
          'mm_hero' => [
            'slide1_overline' => ['type' => 'text', 'value' => 'Best Deal Online on smart watches'],
            'slide1_title' => ['type' => 'text', 'value' => 'SMART WEARABLE.'],
            'slide1_subtitle' => ['type' => 'text', 'value' => 'UP to 80% OFF'],
            'slide2_overline' => ['type' => 'text', 'value' => 'New arrivals every week'],
            'slide2_title' => ['type' => 'text', 'value' => 'SHOP THE LATEST.'],
            'slide2_subtitle' => ['type' => 'text', 'value' => 'Free delivery on first order'],
          ],
          'mm_deals' => [
            'title_prefix' => ['type' => 'text', 'value' => 'Grab the best deal on'],
            'title_highlight' => ['type' => 'text', 'value' => 'Smartphones'],
            'number_of_products' => ['type' => 'select', 'value' => '5'],
          ],
          'mm_top_categories' => [
            'title_prefix' => ['type' => 'text', 'value' => 'Shop From'],
            'title_highlight' => ['type' => 'text', 'value' => 'Top Categories'],
            'number_of_categories' => ['type' => 'select', 'value' => '7'],
          ],
          'mm_brands' => [
            'title_prefix' => ['type' => 'text', 'value' => 'Top'],
            'title_highlight' => ['type' => 'text', 'value' => 'Electronics Brands'],
            'brand1_tag' => ['type' => 'text', 'value' => 'IPHONE'],
            'brand1_offer' => ['type' => 'text', 'value' => 'UP to 80% OFF'],
            'brand2_tag' => ['type' => 'text', 'value' => 'REALME'],
            'brand2_offer' => ['type' => 'text', 'value' => 'UP to 80% OFF'],
            'brand3_tag' => ['type' => 'text', 'value' => 'XIAOMI'],
            'brand3_offer' => ['type' => 'text', 'value' => 'UP to 80% OFF'],
          ],
          'mm_essentials' => [
            'title_prefix' => ['type' => 'text', 'value' => 'Daily'],
            'title_highlight' => ['type' => 'text', 'value' => 'Essentials'],
            'offer_text' => ['type' => 'text', 'value' => 'UP to 50% OFF'],
            'number_of_categories' => ['type' => 'select', 'value' => '6'],
          ],
        ],
      ],
      'products' => [
        'name' => 'Products',
        'active' => 0,
        'slug' => 'products',
        'blocks' => [
          'products' => [
            'number_of_products' => ['type' => 'select', 'value' => 999],
            'show_search' => ['type' => 'select', 'value' => 1],
          ],
        ],
      ],
    ],
	];
?>