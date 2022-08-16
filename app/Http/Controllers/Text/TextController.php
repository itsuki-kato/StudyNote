<?php

namespace App\Http\Controllers\Text;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Text;
use App\Models\Category;

class TextController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * ホーム画面を表示する
     */
    public function index(Request $request)
    {
        // 検索フォームから送信されたキーワードを取得する
        $keyword = $request->input('keyword');

        $category_id = $request->category_id;

        // 閲覧用のカテゴリ名を取得する。
        $Categories = Category::all();

        // キーワードがあれば検索条件に合った一覧を表示する
        if ($keyword) {
            $user_id = $request->user()->id;
            $query = Text::query();
            $query
                ->where('title', 'LIKE', "%{$keyword}%");
            $Texts = $query->orderBy('sort_no', 'ASC')->paginate(8);
        } else {
            // それ以外だったら全件取得する(sort_noの昇順で表示する)
            $Texts = Text::orderBy('sort_no', 'ASC')->paginate(8);
        }

        return view('home', compact('Texts', 'Categories', 'keyword'));
    }

    /**
     * 新規作成画面を表示する
     */
    public function create()
    {
        $Categories = Category::all();

        return view('create', compact('Categories'));
    }

    /**
     * 新規作成
     */
    public function createText(Request $request)
    {
        $request->validate([
            'text' => 'required'
        ]);
        $Text = new Text;
        $Text->user_id = $request->user()->id;
        $Text->category_id = $request->category;
        $Text->text = $request->text;
        $Text->title = $request->title;
        $Text->save();

        return redirect('/home');
    }

    /**
     * 編集画面を表示する
     */
    public function edit($id)
    {
        $Text = Text::find($id);
        // 閲覧用のカテゴリ名を取得する。
        $Categories = Category::all();
        // $Textのcategory_idを取得して、Categoriesテーブルから該当のカテゴリ名を取得する。
        $category_id = $Text->category_id;
        $targetCategory = Category::find($category_id);
        $targetCategoryName = $targetCategory->name;

        return view('edit', compact('Text', 'Categories', 'targetCategoryName'));
    }

    // TODO:editとマージする。
    /**
     * 編集内容を保存する
     */
    public function edit_save(Request $request, $id)
    {
        $Text = Text::find($id);
        $Text->user_id = $request->user()->id;
        $Text->category_id = $request->category;
        $Text->title = $request->title;
        $Text->text = $request->text;
        $Text->save();

        return redirect('/home');
    }

    /**
     * 削除する。
     */
    public function delete($id)
    {
        $Text = Text::find($id);
        $Text->delete();

        return redirect('/home');
    }

    /**
     * sort_noを更新する。
     */
    public function sortText(Request $request)
    {
        // Requestオブジェクトのajax()を使用するとboolで返してくれる。
        $is_ajax = $request->ajax();
        if($is_ajax) {
            // この書き方でも取得できる。
            // $sortNos = $request->sortNos;
            $result = $request->all();
            // 新しいsortNos(入れ替えた後のidの配列)
            $sortNos = $result['sortNos'];
            $i = 1;
            foreach ($sortNos as $sortNo) {
                $TargetText = Text::find($sortNo);
                $TargetText->sort_no = $i;
                $TargetText->save();
                $i++;
            }
        }
    }
}
