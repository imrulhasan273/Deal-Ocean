<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ReviewController extends Controller
{
    public function ajaxRating(Request $request)
    {
        $ProdRating = $request->id;
        $res = explode(' ', $ProdRating);
        $prod_id = $res[0];
        $UserRating = $res[1];

        $reviews = DB::table('reviews')->where([
            ['product_id', '=', $prod_id],
            ['user_id', '=', auth()->id()],
        ])->get();

        if (empty($reviews->toarray())) {
            $count = 1;
            # Insert new record
            $insertReview = Review::create([
                'user_id' => auth()->id(),
                'product_id' => $prod_id,
                'rating' => $UserRating,
                'comment' => ''
            ]);
        } else {
            $count = 0;
            # Update existing record
            $update_review = DB::table('reviews')
                ->where([
                    ['product_id', '=', $prod_id],
                    ['user_id', '=', auth()->id()],
                ])
                ->update(['rating' => $UserRating]);
        }

        $reviews = Review::where('product_id', $prod_id)->get();


        # Start Avg Rating
        $avg_rating = 0;
        $c = 0;
        foreach ($reviews as $review) {
            $c++;
            $avg_rating = ($avg_rating + $review->rating) / $c;
        }
        # End Avg Rating

        $data = [$UserRating, $count, $avg_rating];
        return response()->json($data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        // dd($review);
        $deleteReview = DB::table('reviews')->where('id', $review->id)->delete();
        return Redirect::route('dashboard.reviews');
    }
}
