<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <title>Todo List</title>
</head>

<body>
    @include('add_modal')

    <div class="container">

        <div class="row">

            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <h1 class="my-4"> To-Do List</h1>
                <div style="display:flex;justify-content:end">
                    <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addmodal">Add</a>
                </div>
                <div class="table-data">

                    <table class="table my-3">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Is Active</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="todo_body">
                            @foreach ($todo as $key => $todos)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $todos->title }}</td>

                                    <td>

                                        @if ($todos->is_active)
                                            <span class="badge text-bg-success">Active</span>
                                        @else
                                            <span class="badge text-bg-danger">InActive</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="#" class="btn btn-warning upate_modal_form"
                                            data-bs-toggle="modal" data-bs-target="#updatemodal"
                                            data-id="{{ $todos->id }}">

                                            Edit
                                        </a>


                                        <a href="#" class="btn btn-danger delete_modal"
                                            data-id="{{ $todos->id }}">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                </div>

                </table>
                <div class=" d-fex gap-1" id="pagination_container">
                    @for ($page=1;$page<=$total_page;$page++)
                <a href="" class="btn btn-sm btn-secondary pagination_item " data-page="{{ $page-1 }}">{{ $page }}</a>
                @endfor
            </div>
         
            </div>
        </div>
    </div>
    @include('update_modal')
    @include('ajax')
    {!! Toastr::message() !!}

</body>

</html>
