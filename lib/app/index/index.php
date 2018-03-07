<?php
namespace lib\app\index;

class index {

    public function index() {
    }

    public function test() {
        return 'test';
    }

    public function output() {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="test.csv"');
        header('Cache-Control: max-age=0');
        $fp = fopen('php://output', 'w');
        $str = "xxxxxxxxxxxxxxxxxxxxxxxxxxx";
        for ($i = 0; $i < 1000000; $i++) {
            fputcsv($fp, array($str, $str, $str, $str, $str, $str));
        }
        fclose($fp);
    }
}