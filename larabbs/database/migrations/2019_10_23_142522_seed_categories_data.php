<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //初始化数据
        $categories = [
            [
                'name'       => '分享',
                'description'=> '分享创造，分享发现',
            ],
            [
                'name'       => '教程',
                'description'=> '开发技巧、推荐扩展包等',
            ],
            [
                'name'       => '问答',
                'description'=> '请保持文明 和谐 诚信 友善',
            ],
            [
                'name'       => '公告',
                'description'=> '站点公告',
            ],
        ];

        DB::table('categories')->insert($categories);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //回滚操作
        DB::table('categories')->truncate();
    }
}
