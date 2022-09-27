<h1>編集</h1>

<form method="POST" action="{{route('member.update',['id' =>$member->id])}}">
    @csrf

    <div>
        名前
        <input type="text" name=name value="{{$member->name}}">
        @error('name')
        {{$message}}
        @enderror
    </div>

    <div>
        電話番号
        <input type="text" name=telephone value="{{$member->telephone}}">
        @error('telephone')
        {{$message}}
        @enderror
    </div>

    <div>
        メールアドレス
        <input type="text" name=email value="{{$member->email}}">
        @error('email')
        {{$message}}
        @enderror
    </div>


    <input type="submit" value="更新する">

</form>

<a href="{{ route('member.show',['id'=>$member->id]) }}">{{ __('詳細に戻る') }}</a>
