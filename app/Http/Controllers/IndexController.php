<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category, Article, Author};

class IndexController extends Controller
{
    public function home()
    {
    	$categories = Category::all();

    	$articles = Article::inRandomOrder()->limit(3)->get();

    	return view('home', compact('categories', 'articles'));
    }

	public function category($category_id)
    {

    	$categories = Category::withCount('articles')->get();

    	$articles = Article::where('category_id', $category_id)->paginate(3);

    	return view('category', compact('articles', 'categories'));
    }

    public function author($author_id)
    {
    	$author = Author::withCount('articles')->find($author_id);

    	$categories = Category::withCount('articles')->get();
    	
    	if($author)
    	{
	    	$articles = Article::where('author_id', $author_id)->paginate(3);
    	}

    	// dd($author);

    	return view('category', compact('articles', 'categories'));
    }

    public function article($slug)
    {
    	$article = Article::where('slug', $slug)->first();

    	$categories = Category::withCount('articles')->get();

    	return view('single', compact('article', 'categories'));
    }

    public function tag($tag_id)
    {

    	$categories = Category::withCount('articles')->get();

    	$articles = Article::whereHas('tags', function($q) use ($tag_id){
    		$q->where('tag_id', $tag_id);
    	})->paginate(3);

    	return view('category', compact('articles', 'categories'));
    }

    public function search(Request $r)
    {
    	$categories = Category::withCount('articles')->get();

    	$text = $r->input(['text']);

    	$query = mb_strtolower($text, 'UTF-8');
        $arr = explode(" ", $query);

        $query = [];
        foreach ($arr as $word)
        {
            $len = mb_strlen($word, 'UTF-8');
            switch (true)
            {
                case ($len <= 3):
                {
                    $query[] = $word . "*";
                    break;
                }
                case ($len > 3 && $len <= 6):
                {
                    $query[] = mb_substr($word, 0, -1, 'UTF-8') . "*";
                    break;
                }
                case ($len > 6 && $len <= 9):
                {
                    $query[] = mb_substr($word, 0, -2, 'UTF-8') . "*";
                    break;
                }
                case ($len > 9):
                {
                    $query[] = mb_substr($word, 0, -3, 'UTF-8') . "*";
                    break;
                }
                default:
                {
                    break;
                }
            }
        }
        $query = array_unique($query, SORT_STRING);
        $qQeury = implode(" ", $query);

    	$articles = Article::whereRaw(
            "MATCH(title, description, content) AGAINST(? IN BOOLEAN MODE)",
            $qQeury)->get();

    	// dd($results);
    	return view('search', compact('articles', 'categories'));
    }
}
