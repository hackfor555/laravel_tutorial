<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Validator;

global $head, $style, $body, $end;
$head = '<html><head>';
$style = <<<EOF
<style>
body  { font-size:16pt; color:#999; }
h1 { font-size:100pt; text-align:right; color:#eee;
    margin:-40px 0px -50px 0px; }
</style>
EOF;
$body = '</head><body>';
$end = '</body></html>';


function tag($tag, $txt) {
    return "<{$tag}>" . $txt . "</{$tag}>";
}
 
class HelloController extends Controller
{
       public function post(Request $request)
       {
           $rules = [
               'name' => 'required',
               'mail' => 'email',
               'age' => 'numeric|between:0,150',
           ];

           $messages = [
               'name.required' => '名前は必ず入力して下さい。',
               'mail.email' => 'メールアドレスが必要です。',
               'age.numeric' => '年齢を整数で記入下さい。',
               'age.between' => '年齢は0~150の間で入力下さい。',
           ];

           $validator = Validator::make($request->all(), $rules, 
           $messages);

           $validator->sometimes('age', 'min:0', function($input){
               return !is_int($input->age);
           });

           $validator->sometimes('age', 'max:200', function($input){
               return !is_int($input->age);
           });

           if ($validator->fails()) {
               return redirect('/hello')
                                ->withErrors($validator)
                                ->withInput();
           }

           return view('hello.index', ['msg'=>'正しく入力されました！']);
       } 

       public function index(Request $request)
       {
           $validator = Validator::make($request->query(), [
               'id' => 'required',
               'pass' => 'required',
           ]);
           if ($validator->fails()) {
                $msg = 'クエリーに問題があります。';
           } else {
                $msg = 'ID/PASSを受け付けしました。フォームを入力してください。';
           }
           return view('hello.index', ['msg'=>$msg, ]);
       }

}
 ?>