<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Todo;

// use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function index()
    {
        // Todo(クラス)モデルをインスタンス化
        // $todo = new Todo();
        // Todoオブジェクト(モデルオブジェクト)のall()を実行、返り値はcollectionクラス
        // DB::enableQueryLog();
        // $todos = $todo->all();
        // dd(DB::getQueryLog());
        // dd($todos);：collectionクラスのitemプロパティにarray(配列)でTodoインスタンスが格納されている

        $todos = $this->todo->all();

        // 連想配列として$todosを渡している
        // 第二引数の連想配列は、[blade内での変数名 => 代入したい値]
        return view('todo.index', ['todos' => $todos]);
    }

    public function create()
    {
        return view('todo.create');
    }

    // 引数：Requestクラスで受け取ったデータをインスタンス化して$requestに格納
    public function store(TodoRequest $request)
    {
        /*
        requestクラスのall()メソッドを使用してリクエストを配列で受け取る
        今回は配列で'_token'と'content'の値を受け取っている
        */
        $inputs = $request->all();

        // Todoインスタンスのfill()を実行、引数に用意された配列の値をモデルのプロパティに代入
        // $todo->fill($inputs);
        // Todoインスタンスの`->save()`を実行してオブジェクトの状態をDBに保存するINSERT文を実行
        // DB::enableQueryLog();
        // $todo->save();
        // dd(DB::getQueryLog());

        $this->todo->fill($inputs);
        $this->todo->save();

        // redirect()関数に定義されているroute()関数を使用している、引数：名前定義したルート
        return redirect()->route('todo.index');
    }

    public function show($id)
    {
        // $model = new Todo();
        // $todo = $model->find($id);

        $todo = $this->todo->find($id);

        return view('todo.show', ['todo' => $todo]);
    }

    public function edit($id)
    {
        $todo = $this->todo->find($id);

        return view('todo.edit', ['todo' => $todo]);
    }

    public function update(TodoRequest $request, $id)
    {
        $inputs = $request->all();
        $todo = $this->todo->find($id);
        $todo->fill($inputs)->save();

        return redirect()->route('todo.show', $todo->id);
    }

    public function delete($id)
    {
        $todo = $this->todo->find($id);
        $todo->delete();

        return redirect()->route('todo.index');
    }
}