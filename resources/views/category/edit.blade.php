@extends('layout.master')

@section('title', 'Edit Category')

@section('content')
    <h1>Edit Category</h1>

    <div class="card">
        <div class="container">
            <form action="{{route('category.update', $category->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label"><strong>Name</strong></label>
                    <input name="name" type="text" id="name" class="form-control" value="{{ old('name', $category->name)  }}" placeholder="Name Category">
                    @if($errors->has('name'))
                        <div style="color: red">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="publish" class="form-label"><strong>Publish</strong></label>
                    <select id="publish"  name="publish" class="form-select">
                        <option value="1" {{ old('publish') === 1 ? 'selected' : '' }}>Publish</option>
                        <option value="0" {{ old('publish') === 0 ? 'selected' : '' }}>Non-Publish</option>
                    </select>
                    @if($errors->has('publish'))
                        <div style="color: red">{{ $errors->first('publish') }}</div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
@endsection