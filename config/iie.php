<?php

return [
    'name' => 'International Institute of Excellence',
    'short_name' => 'IIE',
    'logo' => env('IIE_LOGO', 'assets/images/logo.png'),
    'tagline' => 'L\'excellence en formation professionnelle',
    'admin_email' => env('IIE_ADMIN_EMAIL', env('IIE_EMAIL', 'info@iie-edu.com')),
    'phone' => env('IIE_PHONE', '+225 07 88 08 68 88'),
    'whatsapp' => env('IIE_WHATSAPP', '+2250788086888'),
    'email' => env('IIE_EMAIL', 'info@iie-edu.com'),
    'address' => env('IIE_ADDRESS', '3e niveau Immeuble en face restaurant la shish Riviera, Rond point ADO'),
    'google_maps_embed' => env('IIE_GOOGLE_MAPS', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.252!2d-3.978!3d5.365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zUsKwMjEnNTQuMCJOIDPCsDU4JzQwLjgiVw!5e0!3m2!1sfr!2sci!4v1'),
    'social' => [
        'facebook' => env('IIE_FACEBOOK', '#'),
        'twitter' => env('IIE_TWITTER', '#'),
        'linkedin' => env('IIE_LINKEDIN', '#'),
        'instagram' => env('IIE_INSTAGRAM', '#'),
        'youtube' => env('IIE_YOUTUBE', '#'),
    ],
    'api_token' => env('IIE_API_TOKEN'),
];
