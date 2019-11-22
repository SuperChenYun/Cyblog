<?php

return [
    // 后台部分
    'layout$'   =>  ['dashboard/index/layout', []],
    'welcome$'   =>  ['dashboard/index/welcome', []],
    'base/theme' =>  ['dashboard/base/theme', []],
    'base/about' =>  ['dashboard/base/about', []],
    '[dashboard]' => [

        'auth/login_post' => ['dashboard/auth/loginPost'],
        'article/art_add' => ['dashboard/article/artAdd'],
        'article/art_edit' => ['dashboard/article/artEdit'],
        'article/art_del' => ['dashboard/article/artDel'],
        'article/art_enable_or_disable' => ['dashboard/article/artEnableOrDisable'],

        'category/cat_del' => ['dashboard/category/catDel'],
        'category/cat_add' => ['dashboard/category/catAdd'],
        'category/cat_edit' => ['dashboard/category/catEdit'],

        'manage/auth_list' => ['dashboard/manage/authList'],
        'manage/group_list' => ['dashboard/manage/groupList'],
        'manage/manage_list' => ['dashboard/manage/manageList'],

        'manage/auth_add' => ['dashboard/manage/authAdd'],
        'manage/group_add' => ['dashboard/manage/groupAdd'],
        'manage/manage_add' => ['dashboard/manage/manageAdd'],

        'manage/auth_edit' => ['dashboard/manage/authEdit'],
        'manage/group_edit' => ['dashboard/manage/groupEdit'],
        'manage/manage_edit' => ['dashboard/manage/manageEdit'],

        'manage/manage_enable_or_disable' => ['dashboard/manage/manageEnableOrDisable'],
        'manage/manage_repass' => ['dashboard/manage/manageRepass'],
        'manage/manage_del' => ['dashboard/manage/manageDel'],
        'manage/group_enable_or_disable' => ['dashboard/manage/groupEnableOrDisable'],
        'manage/auth_del' => ['dashboard/manage/authDel'],
        'manage/group_del' => ['dashboard/manage/groupDel'],

    ],
];
