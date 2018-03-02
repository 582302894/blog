<?php

namespace lib\app\test;
use lib\obj\cache;
use lib\obj\log;
use think\Db;

class test {
    public function find() {
        $find = server('find');
        $files = $find->getFiles();
        // return view();
    }

    public function test() {
        $user = Db::table('user')->where(['con_id' => 1])->find();
        show($user['username']);
        // show($user);
        die;
        // log::error('nameasdlasjdlasd');
        try {
            // cinss();
        } catch (\Exception $e) {
            log::exception($e);
        }
        die;
        Cache::get('name');
    }

    public function tag() {
        $dbCoinfig = [
            'hostname' => '127.0.0.1',
            'database' => 'test',
            'username' => 'root',
            'password' => 'root',
        ];
        \lib\obj\Db::run($dbCoinfig);

        return view('');
    }
}