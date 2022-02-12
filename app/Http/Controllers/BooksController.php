<?php

namespace App\Http\Controllers;

use App\Models\books;
use App\Http\Requests\StorebooksRequest;
use App\Http\Requests\UpdatebooksRequest;
use App\Http\Resources\BooksResource;
use Validator;



class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
        $books = Books::all();
        return BooksResource::collection($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorebooksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorebooksRequest $request)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required' | 'string',
        'title' => 'required' | 'string',
        'year' => 'required'
      ]);

      if($validator->fails()){
        return response()->json($validator->errors());
      }

      $books = Books::create([
        'name' => $request->name,
        'title' => $request->title,
        'year' => $request->year

      ]);

      return response()->json(['Book created Successfully', new BooksResource($books) ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\books  $books
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Books::find($id);
        if (is_null($book)) {
          return response()->json('Data not found', 404);
        }
        return response()->json([new BooksResource($book)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\books  $books
     * @return \Illuminate\Http\Response
     */
    public function edit(books $books)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebooksRequest  $request
     * @param  \App\Models\books  $books
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatebooksRequest $request, books $books)
    {

      $validate = Validator::validate($request->all(),[
        'name' => 'required'|'string',
        'title' => 'required'|'string',
        'year' => 'required'|'numeric'

      ]);

        if($validate->fails()) {
          return response()->json($validator->errors());
        }

        $books->name = $request->name;
        $books->title = $request->title;
        $books->year = $request->year;

        return response()->json(['Book updated !', new BookResource($book)]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\books  $books
     * @return \Illuminate\Http\Response
     */
    public function destroy(books $books)
    {
        $books->delete();

        return response()->json('Book Deleted Successfully');
    }
}
