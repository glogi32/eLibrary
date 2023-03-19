@extends('layouts.template')

@section('pageTitle')
    Books
@endsection

@section('content')
    <!-- Section-->
    <section class="py-5">
        
        <div class="container px-4 px-lg-5 mt-5">
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addBookModal">
                Add new book
            </button>
            <table id="booksTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Book number</th>
                        <th>Author</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                  
                </tbody>
                <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Book number</th>
                        <th>Author</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        @if (session()->has("user"))
            <input type="hidden" name="roleId" id="roleId" value="{{session("user")->role->id}}">
        @endif
    </section>

    <!-- Modal -->
    <div class="modal fade" id="addBookModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add new book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{route("addBook")}}" >
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" >
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea  class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Author</label>
                        <select class="form-select" aria-label="Default select example" name="author" id="author">
                            <option selected></option>
                            @foreach ($authors as $author)
                                <option value="{{$author->id}}">{{$author->name}} {{$author->surname}}</option>
                            @endforeach
                        </select>
                    </div>
                    

                    @if(session()->has("success"))
                        <div class="alert alert-success" role="alert">
                            {{session("success")["message"]}}
                        </div>
                    @endif
                    @if(session()->has("error"))
                        <div class="alert alert-danger" role="alert">
                            {{session("error")["message"]}}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteBook" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to delete selected book?
                </div>
                <div class="modal-footer">
                    @csrf
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="deleteBookButton" data-id="0" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    @if(!$errors->isEmpty() || session()->has("error") || session()->has("success"))
        <script>
            $(document).ready(function() {
                $("#addBookModal").modal("show");
            })
        </script>
    @endif
@endsection