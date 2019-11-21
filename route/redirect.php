<?php
return [
    'blog/:id' => 'redirect/blog/location',
    'blog/category/blog/:sign' => 'redirect/category/location',
    'blog/tag/:sign' => 'redirect/tag/location'
];