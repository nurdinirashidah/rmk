@extends('layout')

@section('content')
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <h1 class="my-4">Page Heading
          <small>Secondary Text</small>
        </h1>

        <!-- Blog Post -->
        @foreach($articles as $article)
        <div class="card mb-4">
          <img class="card-img-top" src="{{$article->image}}" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title">{{$article->title}}</h2>
            <p class="card-text">{{$article->description}}</p>
            <a href="/article/{{$article->slug}}" class="btn btn-primary">Read More &rarr;</a>
          </div>
          <div class="card-footer text-muted">
            {{$article->date}} -- <a href="/author/{{$article->author_id}}">{{$article->author->name}}  ({{$article->author->articles->count()}})</a>
          </div>
        </div>
        @endforeach

        <!-- Pagination -->
        {{ $articles->links() }}

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-append">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <ul class="list-unstyled mb-0">
                  @foreach($categories as $category)
                  <li>
                    <a href="/category/{{$category->id}}">{{$category->name}} (_{{$category->articles_count}}_)</a>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->

  </div>
@endsection