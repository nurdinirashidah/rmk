@extends('layout')

@section('content')
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">{{$article->title}}</h1>

        <!-- Author -->
        <p class="lead">
          Author: <a href="/author/{{$article->author_id}}">{{$article->author->name}} ({{$article->author->articles->count()}})</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Date: {{$article->date}}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{$article->image}}" alt="">

        <hr>

        <!-- Post Content -->
        {!!$article->content!!}

        <hr>

        Tags:

        <ul>
          @foreach($article->tags as $tag)
          <li><a href="/tag/{{$tag->id}}">{{$tag->name}}</a></li>
          @endforeach
        </ul>

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <form action="/search" method="get">
              <input type="text" class="form-control" name="text" placeholder="Search for...">
                
              <span class="input-group-append">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
              </form>
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