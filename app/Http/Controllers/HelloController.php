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
       public function post(HelloRequest $request)
       {
          return view('hello.index', ['msg'=>'正しく入力されました！']);
       } 

       public function index(Request $request)
       {
          return view('hello.index', ['msg'=>'フォームを入力下さい。' ]);
       }

}
 ?>