@extends('layout.master')

@section('title', 'Homepage')

@section('content')
    <h1>List Category</h1>

    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{route('category.create')}}">Add Category</a>
            @isset($categories)
                <form action="{{route('category-search')}}" style="float: right">
                    @csrf
                    <input class="form-control d-inline" name="search" style="width:60%" id="search" type="text" placeholder="Search" aria-label="Search Category">
                    <button type="submit" class="btn btn-primary d-inline">Search</button>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Publish</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->is_publish == 1 ? 'Publish' : 'Non-Publish'}}</td>
                                <td> 
                                    <a href="{{route('category.edit', $category->id)}}" class="btn btn-primary d-inline">Edit</a>
                                    <a href="{{route('category.show', $category->id)}}" class="btn btn-secondary d-inline">Show</a>
                                    <form action="{{route('category.destroy', $category->id)}}" class="d-inline" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger d-inline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$categories->links()}}
            @endisset
        </div>
    </div>
@endsection