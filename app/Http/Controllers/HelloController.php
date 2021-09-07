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
           $validator = Validator::make($request->all(), [
               'name' => 'required',
               'mail' => 'email',
               'age' => 'numeric|between:0,150',
           ]);
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