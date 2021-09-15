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
           $validate_rule = [
               'msg' => 'required',
           ];
           $this->validate($request, $validate_rule);
           $msg = $request->msg;
           $response = response()->view('hello.index',
           ['msg'=>'「' . $msg .
           '」をクッキーに保存しました。']);
           $response->cookie('msg', $msg, 100);
           return $response;
       } 

       public function index(Request $request)
       {
           if ($request->hasCookie('msg'))
           {
               $msg = 'Cookie: ' . $request->cookie('msg');
           } else {
               $msg = '※クッキーはありません。';
           }
          return view('hello.index', ['msg'=> $msg]);
       }

}
 ?>