<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
// use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function index()
    {
        // Todo(クラス)モデルをインスタンス化
        $todo = new Todo();
        // Todoオブジェクト(モデルオブジェクト)のall()を実行、返り値はcollectionクラス
        // DB::enableQueryLog();
        $todos = $todo->all();
        // dd(DB::getQueryLog());
        // dd($todos);：collectionクラスのitemプロパティにarray(配列)でTodoインスタンスが格納されている

        // 連想配列として$todosを渡している
        // 第二引数の連想配列は、[blade内での変数名 => 代入したい値]
        return view('todo.index', ['todos' => $todos]);
    }

    public function create()
    {
        return view('todo.create');
    }

    // 引数：Requestクラスで受け取ったデータをインスタンス化して$requestに格納
    public function store(Request $request)
    {
        /*
        requestクラスのall()メソッドを使用してリクエストを配列で受け取る
        今回は配列で'_token'と'content'の値を受け取っている
        */
        $inputs = $request->all();
        // dd($inputs);

        // 1. todosテーブルの1レコードを表すTodoクラスをインスタンス化
        $todo = new Todo();
        // 2. Todoインスタンスのカラム名のプロパティに保存したい値を代入
        // $todo->content = $inputs['content'];
        // 2. Todoインスタンスのfill()を実行、引数に用意された配列の値をモデルのプロパティに代入
        $todo->fill($inputs);
        // 3. Todoインスタンスの`->save()`を実行してオブジェクトの状態をDBに保存するINSERT文を実行
        // DB::enableQueryLog();
        $todo->save();
        // dd(DB::getQueryLog());

        // redirect()関数に定義されているroute()関数を使用している、引数：名前定義したルート
        return redirect()->route('todo.index');
    }
}
