@extends('layout.master')

@section('title', 'Detail Category')

@section('content')
    <h1>Detail Category</h1>

    <div class="card">
        <div class="container">
            <div class="mb-3">
                <label for="name" class="form-label"><strong>Name</strong></label>
                <input disabled name="name" type="text" id="name" class="form-control" value="{{ old('name', $category->name)  }}" placeholder="Name Category">
            </div>
            <div class="mb-3">
                <label for="publish" class="form-label"><strong>Publish</strong></label>
                <select disabled id="publish"  name="publish" class="form-select">
                    <option value="1" {{ old('publish') === 1 ? 'selected' : '' }}>Publish</option>
                    <option value="0" {{ old('publish') === 0 ? 'selected' : '' }}>Non-Publish</option>
                </select>
            </div>
        </div>
    </div>
@endsection