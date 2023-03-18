@extends('layouts.template')

@section('pageTitle')
    Authors
@endsection

@section('content')
    <!-- Section-->
    <section class="py-5">
        
        <div class="container px-4 px-lg-5 mt-5">
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addAuthorModal">
                Add new author
            </button>
            <table id="authorsTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Surname</th>
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
                        <th>Image</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </section>
      
    <!-- Modal -->
    <div class="modal fade" id="addAuthorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Add new author</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{route("addAuthor")}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
                    {{-- <div id="nameHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label">Surname</label>
                    <input type="text" class="form-control" id="surname" name="surname">
                </div>
                <div class="mb-3 ">
                    <label for="image" class="form-label">Add Image</label>
                    <input class="form-control" type="file" name="image" id="image">
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

    <div class="modal fade" id="deleteAuthor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete author</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Do you want to delete selected author?
            </div>
            <div class="modal-footer">
                {{-- <form action="{{route("deleteAuthor")}}" method="POST"> --}}
                    @csrf
                    @method("DELETE")
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="deleteAuthorButton" data-id="0" class="btn btn-primary">Delete</button>
                {{-- </form> --}}
            </div>
            </div>
        </div>
    </div>
    
@endsection

@section("scripts")
    @if(!$errors->isEmpty() || session()->has("error") || session()->has("success"))
        <script>
            $(document).ready(function() {
                $("#addAuthorModal").modal("show");
            })
        </script>
    @endif
@endsection