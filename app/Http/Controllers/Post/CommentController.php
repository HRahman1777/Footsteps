<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addComment(Request $request, $pid)
    {
        $request->validate([
            'comment' => 'required',
        ]);
        $comment = Comment::create([
            'comment' => $request->input('comment'),
            'post_id' => $pid,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/explore/' . $pid);
    }

    public function edit(Request $request, $pid, $cid)
    {
        $comment = Comment::where('id', $cid)->first();
        if ($comment && ($comment->user->username == Auth::user()->username)) {
            if ($comment) {
                $comment->update([
                    'comment' => $request->input('comment')
                ]);
                $jervis = [
                    'status' => 'success',
                    'message' => 'Comment Updated Successfully!'
                ];
                return redirect('/explore/' . $pid)->with('jervis', $jervis);
            }
        }
        $jervis = [
            'status' => 'error',
            'message' => 'Could not Updated!'
        ];
        return redirect('/explore/' . $pid)->with('jervis', $jervis);
    }

    public function deleteComment($pid, $cid)
    {
        $comment = Comment::where('id', $cid)->first();
        if ($comment && ($comment->user->username == Auth::user()->username)) {
            $isDelete = $comment->delete();
            if ($isDelete) {
                $jervis = [
                    'status' => 'success',
                    'message' => 'Comment Deleted Successfully!'
                ];
                return redirect('/explore/' . $pid)->with('jervis', $jervis);
            }
        }
        $jervis = [
            'status' => 'error',
            'message' => 'Could not delete!'
        ];
        return redirect('/explore/' . $pid)->with('jervis', $jervis);
    }
}
