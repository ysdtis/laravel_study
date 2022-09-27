<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreMember;
use App\Http\Requests\UpdateMember;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //memberテーブルからname,telephone,emailを$membersに格納
        $members = DB::table('members')
            ->select('id', 'name', 'telephone', 'email')
            ->paginate(20);

        //viewを返す(compactでviewに$membersを渡す)
        return view('member/index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMember $request)
    {
        $member=new Member;

        $member->name=$request->input('name');
        $member->telephone=$request->input('telephone');
        $member->email=$request->input('email');

        $member->save();

        //一覧表示画面にリダイレクト
        return redirect('member/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member=Member::find($id);

        return view('member/show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member=Member::find($id);

        return view('member/edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMember $request, $id)
    {
        $member=Member::find($id);

        $member->name=$request->input('name');
        $member->telephone=$request->input('telephone');
        $member->email=$request->input('email');

        //DBに保存
        $member->save();

        //処理が終わったらmember/indexにリダイレクト
        return redirect('member/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member=Member::find($id);

        $member->delete();

        return redirect('member/index');
    }

    public function search(Request $request)
    {
        $serach=$request->input('q');

        $query=DB::table('members');

        //検索ワードの全角スペースを半角スペースに変換
        $serach_spaceharf=mb_convert_kana($serach, 's');


        //検索ワードを半角スペースで区切る
        $keyword_array=preg_split('/[\s]+/', $serach_spaceharf, -1, PREG_SPLIT_NO_EMPTY);

        //検索ワードをループで回してマッチするレコードを探す
        foreach ($keyword_array as $keyword) {
            $query->where('name', 'like', '%'.$keyword.'%');
        }

        $query->select('id', 'name', 'telephone', 'email');
        $members=$query->paginate(20);

        return view('member/index', compact('members'));
    }
}
