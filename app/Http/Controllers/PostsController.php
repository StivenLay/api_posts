<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\PostsRequest;
use App\Posts;
use Illuminate\Support\Facades\Validator;
class PostsController extends Controller
{
    public function index($limit, $offset)
    {
        $data = Posts::offset($offset)->limit($limit)->get();
        return response()->json([
            'data' => $data
        ]);
    }
    public function show($id)
    {
        $posts = Posts::find($id);
        if (!$posts) {
            return response()->json([
                'message' => 'Sorry, Posts with id ' . $id . ' Not Found'
            ], 400);
        } else {
            return response()->json($posts, 200);
        }
    }
    public function store(PostsRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'Title' => ['required', 'min:20'],
            'Content' => ['required', 'min:200'],
            'Category' => ['required', 'min:3'],
            'Status' => ['required', 'in:publish,draft,thrash']
        ]);
         if ($validator->fails()) {
            return response()
                ->json([
                    'error' => true,
                    'validations' => $validator->errors()
                ], 422);
        }
        $posts = new Posts();
        $posts->Title = $request->Title;
        $posts->Content = $request->Content;
        $posts->Category = $request->Category;
        $posts->Status = $request->Status;
        $posts->save();
 
        return response()
            ->json([
                'success' => true,
                'data' => $posts
            ], 200);

    }
    public function update(PostsRequest $request, $id)
    {
        $posts = Posts::where('id', $id)->first();
        $validator = Validator::make($request->all(), [
            'Title' => ['required', 'min:20'],
            'Content' => ['required', 'min:200'],
            'Category' => ['required', 'min:3'],
            'Status' => ['required', 'in:publish,draft,thrash']
        ]);
        if ($validator->fails()) {
            return response()
                ->json([
                    'error' => true,
                    'validations' => $validator->errors()
                ], 422);
        }
        if ($posts) {
            $posts->Title = $request->Title ? $request->Title : $posts->Title;
            $posts->Content = $request->Content ? $request->Content : $posts->Content;
            $posts->Category = $request->Category ? $request->Category : $posts->Category;
            $posts->Status = $request->Status ? $request->Status : $posts->Status;
            $posts->save();
            return response()->json();
        } else {
            return response()->json([
                'message' => "failed update " . $id
            ], 400);
        }
    }
    public function destroy($id)
    {
        Posts::destroy($id);
        return response()->json();
    }
}
