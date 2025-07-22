<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    /**
     * Hello Worldメッセージを表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // データベースからメッセージを取得
            $message = Message::first();
            
            if ($message) {
                $displayMessage = $message->content;
            } else {
                $displayMessage = 'Error';
            }
        } catch (\Exception $e) {
            // データベース接続エラーやその他のエラーの場合
            $displayMessage = 'Error';
        }

        return view('hello', ['message' => $displayMessage]);
    }
}