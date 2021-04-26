<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function create()
    {
        return view('post');
    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->theme = $request->thema;
        $post->content = $request->content;
        $post->save();
        return redirect()->back()->with('successRegister', '投稿が完了しました！');;
    }

    public function show_all()
    {
        $posts = Post::all();
        $like_model = new Like();
        return view('show_all', compact('posts', 'like_model'));
    }

    public function show_search(Request $request)
    {
        $query = DB::table('posts');
        $search = $request->input('keyword');
        $search_split = mb_convert_kana($search, 's');
        $search_split2 = preg_split('/[\s]+/', $search_split, -1, PREG_SPLIT_NO_EMPTY);
        foreach($search_split2 as $value) {
            $query->where('theme', 'like', '%'.$value.'%');
        }     
        $query->orderBy('created_at', 'asc');
        $contacts = $query->paginate(20);
        $like_model = new Like();
        return view('show_search', compact('contacts','like_model'));
    }

    public function show_likes()
    {
        $user = User::find(Auth::id());;
        $likes = $user->like->sortByDesc('created_at');
        return view('show_likes',compact('likes'));
    }

    public function ajaxlike(Request $request)
    {
        $id = Auth::user()->id;
        $post_id = $request->post_id;
        $like = new Like;
        $post = Post::findOrFail($post_id);
        if ($like->like_exist($id, $post_id)) {
            $like = Like::where('post_id', $post_id)->where('user_id', $id)->delete();
        } 
        else {
            $like = new Like;
            $like->post_id = $request->post_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }

        return response()->json();
    }
}
