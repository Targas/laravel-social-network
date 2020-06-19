<?php
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function getDashboard()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('dashboard', ['posts' => $posts]);
    }

    public function postCreatePost(request $request)
    {
        $this->validate($request, [
            'post_content' => 'required|max:1000'
        ]);

        $post = new Post();
        $post->post_content = $request['post_content'];
        $message = 'There was an error';

        if($request->user()->posts()->save($post)) {
            $message = 'Posted!';
        }

        return redirect()->route('dashboard')->with(['message' => $message]);
    }

    public function getDeletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();

        if (Auth::user() != $post->user) {
            return redirect()->back();
        };

        $post->delete();
        return redirect()->route('dashboard')->with(['message' => 'Deletado']);
    }

    public function postEditPost(Request $request)
    {
        $this->validate($request, [
            'modalPostContent' => 'required'
        ]);

        $post = Post::find($request['postId']);

        if (Auth::user() != $post->user) {
            return redirect()->back();
        };

        $post->post_content = $request['modalPostContent'];
        $post->update();

        return response()->json(['newPost' => $post->post_content], 200);
    }

    public function getAccount()
    {
        return view('account', [ 'user' => Auth::user() ]);
    }
}
