<?php

return [

    /**
     * The cms settings that are available in the CMS.
     * - This is used to create the main settings in the AppSettingSeeder
     */

    'settings' => [
        [
            'key' => 'show_header',
            'status' => 'active',
            'en' => [
                'label' => 'Show Header',
                'value' => true,
            ],
            'ar' => [
                'label' => 'إظهار الهيدر',
                'value' => true,
            ],
        ],
        [
            'key' => 'show_footer',
            'status' => 'active',
            'en' => [
                'label' => 'Show Footer',
                'value' => true,
            ],
            'ar' => [
                'label' => 'إظهار الفوتر',
                'value' => true,
            ],
        ],
        [
            'key' => 'logo',
            'status' => 'disabled',
            'en' => [
                'label' => 'Logo',
                'value' => 'path/to/logo.png',
            ],
            'ar' => [
                'label' => 'الشعار',
                'value' => 'path/to/logo.png',
            ],
        ],
        [
            'key' => 'logo_text',
            'status' => 'active',
            'en' => [
                'label' => 'Logo Text',
                'value' => 'CMS',
            ],
            'ar' => [
                'label' => 'الشعار النصي',
                'value' => 'CMS',
            ],
        ],
        [
            'key' => 'contact_email',
            'status' => 'active',
            'en' => [
                'label' => 'Contact Email',
                'value' => 'contact@project.test',
            ],
            'ar' => [
                'label' => 'البريد الإلكتروني للتواصل',
                'value' => 'contact@project.test',
            ],
        ],
        [
            'key' => 'contact_text',
            'status' => 'active',
            'en' => [
                'label' => 'Contact Text',
                'value' => 'Contact us for more information.',
            ],
            'ar' => [
                'label' => 'نص صفحة اتصل بنا',
                'value' => 'للمزيد من المعلومات اتصل بنا.',
            ],
        ],
        [
            'key' => 'meta_title',
            'status' => 'active',
            'en' => [
                'label' => 'App Title',
                'value' => 'CMS',
            ],
            'ar' => [
                'label' => 'App Title',
                'value' => 'CMS',
            ],
        ],
        [
            'key' => 'meta_description',
            'status' => 'active',
            'en' => [
                'label' => 'App Description',
                'value' => 'Description Value',
            ],
            'ar' => [
                'label' => 'App Description',
                'value' => 'Description Value',
            ],
        ],
        [
            'key' => 'meta_og_title',
            'status' => 'active',
            'en' => [
                'label' => 'Meta Og Title',
                'value' => 'Value',
            ],
            'ar' => [
                'label' => 'Meta Og Title',
                'value' => 'Value',
            ],
        ],
        [
            'key' => 'meta_og_description',
            'status' => 'active',
            'en' => [
                'label' => 'Meta Og Description',
                'value' => 'Value',
            ],
            'ar' => [
                'label' => 'Meta Og Description',
                'value' => 'Value',
            ],
        ],
        [
            'key' => 'meta_og_image',
            'status' => 'active',
            'en' => [
                'label' => 'Meta Og Image',
                'value' => 'Value',
            ],
            'ar' => [
                'label' => 'Meta Og Image',
                'value' => 'Value',
            ],
        ],
    ],

    /**
     * The cms pages that are available in the CMS.
     * - This is used to show the select options in the Filamnent Dashboard in the NavigationResource.
     */

    'pages' => [
        [
            'key' => 'contact-us',
            'status' => 'active',
            'en' => [
                'label' => 'Contact Us',
            ],
            'ar' => [
                'label' => 'أتصل بنا',
            ],
        ],
        [
            'key' => 'blog',
            'status' => 'active',
            'en' => [
                'label' => 'Blog',
            ],
            'ar' => [
                'label' => 'المدونة',
            ],
        ],
        [
            'key' => 'products',
            'status' => 'active',
            'en' => [
                'label' => 'Products',
            ],
            'ar' => [
                'label' => 'المنتجات',
            ],
        ],
    ],

];
