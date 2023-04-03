<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace Database\Seeders;

use App\Models\ChatgptQuestion;
use Dcat\Admin\Models\Administrator;
use Dcat\Admin\Models\Menu;
use Dcat\Admin\Models\Permission;
use Dcat\Admin\Models\Role;
use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $createdAt = date('Y-m-d H:i:s');

        // create a user.
        Administrator::truncate();
        Administrator::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'name' => 'Administrator',
            'created_at' => $createdAt,
        ]);

        // create a role.
        Role::truncate();
        Role::create([
            'name' => 'Administrator',
            'slug' => Role::ADMINISTRATOR,
            'created_at' => $createdAt,
        ]);

        // add role to user.
        Administrator::first()->roles()->save(Role::first());

        // create a permission
        Permission::truncate();
        Permission::insert([
            [
                'id' => 1,
                'name' => '权限管理',
                'slug' => '权限管理',
                'http_method' => '',
                'http_path' => '',
                'parent_id' => 0,
                'order' => 1,
                'created_at' => $createdAt,
            ],
            [
                'id' => 2,
                'name' => '用户管理',
                'slug' => '用户管理',
                'http_method' => '',
                'http_path' => '/auth/users*',
                'parent_id' => 1,
                'order' => 2,
                'created_at' => $createdAt,
            ],
            [
                'id' => 3,
                'name' => '角色管理',
                'slug' => '角色管理',
                'http_method' => '',
                'http_path' => '/auth/roles*',
                'parent_id' => 1,
                'order' => 3,
                'created_at' => $createdAt,
            ],
            [
                'id' => 4,
                'name' => '权限设置',
                'slug' => '权限设置',
                'http_method' => '',
                'http_path' => '/auth/permissions*',
                'parent_id' => 1,
                'order' => 4,
                'created_at' => $createdAt,
            ],
            [
                'id' => 5,
                'name' => '菜单',
                'slug' => '菜单',
                'http_method' => '',
                'http_path' => '/auth/menu*',
                'parent_id' => 1,
                'order' => 5,
                'created_at' => $createdAt,
            ],
            [
                'id' => 6,
                'name' => '扩展管理',
                'slug' => '扩展管理',
                'http_method' => '',
                'http_path' => '/auth/extensions*',
                'parent_id' => 1,
                'order' => 6,
                'created_at' => $createdAt,
            ],
            [
                'id' => 7,
                'name' => 'ChatGPT管理',
                'slug' => 'ChatGPT管理',
                'http_method' => '',
                'http_path' => '',
                'parent_id' => 0,
                'order' => 7,
                'created_at' => $createdAt,
            ],
            //            [
            //                'id' => 8,
            //                'name' => 'Api管理',
            //                'slug' => 'Api管理',
            //                'http_method' => '',
            //                'http_path' => '/chatgpt/apis*',
            //                'parent_id' => 7,
            //                'order' => 8,
            //                'created_at' => $createdAt,
            //            ],
            //            [
            //                'id' => 9,
            //                'name' => '模型管理',
            //                'slug' => '模型管理',
            //                'http_method' => '',
            //                'http_path' => '/chatgpt/modes*',
            //                'parent_id' => 7,
            //                'order' => 9,
            //                'created_at' => $createdAt,
            //            ],
            //            [
            //                'id' => 10,
            //                'name' => '问答库',
            //                'slug' => '问答库',
            //                'http_method' => '',
            //                'http_path' => '/chatgpt/ask-libs*',
            //                'parent_id' => 7,
            //                'order' => 10,
            //                'created_at' => $createdAt,
            //            ],
            [
                'id' => 11,
                'name' => '请求日志',
                'slug' => '请求日志',
                'http_method' => '',
                'http_path' => '/chatgpt/request-logs*',
                'parent_id' => 7,
                'order' => 11,
                'created_at' => $createdAt,
            ],
            [
                'id' => 12,
                'name' => '聊天机器人',
                'slug' => '聊天机器人',
                'http_method' => '',
                'http_path' => '/chatgpt/chat*',
                'parent_id' => 7,
                'order' => 12,
                'created_at' => $createdAt,
            ],
            [
                'id' => 13,
                'name' => '创建图片',
                'slug' => '创建图片',
                'http_method' => '',
                'http_path' => '/chatgpt/image-create*',
                'parent_id' => 7,
                'order' => 13,
                'created_at' => $createdAt,
            ],
            [
                'id' => 14,
                'name' => '编辑图片',
                'slug' => '编辑图片',
                'http_method' => '',
                'http_path' => '/chatgpt/image-edit*',
                'parent_id' => 7,
                'order' => 13,
                'created_at' => $createdAt,
            ],
            [
                'id' => 15,
                'name' => '图片变体',
                'slug' => '图片变体',
                'http_method' => '',
                'http_path' => '/chatgpt/image-variation*',
                'parent_id' => 7,
                'order' => 14,
                'created_at' => $createdAt,
            ],
            [
                'id' => 16,
                'name' => '问题汇总',
                'slug' => '问题汇总',
                'http_method' => '',
                'http_path' => '/chatgpt/image-questions*',
                'parent_id' => 7,
                'order' => 15,
                'created_at' => $createdAt,
            ],
            [
                'id' => 17,
                'name' => '',
                'slug' => '扩展市场',
                'http_method' => '',
                'http_path' => '/dcat-extension-client*',
                'parent_id' => 0,
                'order' => 16,
                'created_at' => $createdAt,
            ],
        ]);

//        Role::first()->permissions()->save(Permission::first());

        // add default menus.
        Menu::truncate();
        Menu::insert([
            [
                'parent_id' => 0,
                'order' => 1,
                'title' => '主页',
                'icon' => 'feather icon-bar-chart-2',
                'uri' => '/',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 2,
                'title' => '后台管理',
                'icon' => 'feather icon-settings',
                'uri' => '',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 2,
                'order' => 3,
                'title' => '用户管理',
                'icon' => '',
                'uri' => 'auth/users',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 2,
                'order' => 4,
                'title' => '角色管理',
                'icon' => '',
                'uri' => 'auth/roles',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 2,
                'order' => 5,
                'title' => '权限设置',
                'icon' => '',
                'uri' => 'auth/permissions',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 2,
                'order' => 6,
                'title' => '菜单管理',
                'icon' => '',
                'uri' => 'auth/menu',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 2,
                'order' => 7,
                'title' => '扩展管理',
                'icon' => '',
                'uri' => 'auth/extensions',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 8,
                'title' => 'ChatGPT管理',
                'icon' => 'fa-wechat',
                'uri' => '',
                'created_at' => $createdAt,
            ],
            //            [
            //                'parent_id' => 8,
            //                'order' => 9,
            //                'title' => 'Api管理',
            //                'icon' => '',
            //                'uri' => '/chatgpt/apis',
            //                'created_at' => $createdAt,
            //            ],
            //            [
            //                'parent_id' => 8,
            //                'order' => 10,
            //                'title' => '模型管理',
            //                'icon' => '',
            //                'uri' => '/chatgpt/modes',
            //                'created_at' => $createdAt,
            //            ],
            //            [
            //                'parent_id' => 8,
            //                'order' => 11,
            //                'title' => '问答库',
            //                'icon' => '',
            //                'uri' => '/chatgpt/ask-libs',
            //                'created_at' => $createdAt,
            //            ],
            [
                'parent_id' => 8,
                'order' => 12,
                'title' => '请求日志',
                'icon' => '',
                'uri' => '/chatgpt/request-logs',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 8,
                'order' => 13,
                'title' => '聊天机器人',
                'icon' => '',
                'uri' => '/chatgpt/chat',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 8,
                'order' => 14,
                'title' => '创建图片',
                'icon' => '',
                'uri' => '/chatgpt/image-create',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 8,
                'order' => 15,
                'title' => '编辑图片',
                'icon' => '',
                'uri' => '/chatgpt/image-edit',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 8,
                'order' => 16,
                'title' => '图片变体',
                'icon' => '',
                'uri' => '/chatgpt/image-variation',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 8,
                'order' => 17,
                'title' => '问题汇总',
                'icon' => '',
                'uri' => '/chatgpt/questions',
                'created_at' => $createdAt,
            ],
            [
                'parent_id' => 0,
                'order' => 18,
                'title' => '扩展市场',
                'icon' => 'icon-download',
                'uri' => '/dcat-extension-client',
                'created_at' => $createdAt,
            ],
        ]);

        (new Menu())->flushCache();

        ChatgptQuestion::truncate();
        ChatgptQuestion::insert([
            [
                'question' => "Invalid input image - format must be in ['RGBA'], got RGB.",
                'ask' => '图片色彩不正确，或者您这张图片需要一个透明的蒙层，请用Photoshop或其他软件编辑一下',
                'created_at' => $createdAt,
            ],
            [
                'question' => 'Invalid input image - expected an image with equal width and height, got ***x*** instead.',
                'ask' => '图片必须是一个宽高相等的png图片，并且小于4MB',
                'created_at' => $createdAt,
            ],
            [
                'question' => 'You exceeded your current quota, please check your plan and billing details.',
                'ask' => '您超出了当前的配额，请检查您的计划和账单细节。',
                'created_at' => $createdAt,
            ],
        ]);
    }
}
