<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use App\Tag;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TagsController extends Controller
{

    use Helpers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tags = \App\Tag::all();

      return $tags->toArray();;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $tag = new Tag;
      $tag->name = $request->get('name');

      if($tag->save())
          return $this->response->created();
      else
          return $this->response->error('could_not_create_tag', 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = \App\Tag::find($id);
        if(!$tag)
            throw new NotFoundHttpException;

        return $tag;
    }
}
