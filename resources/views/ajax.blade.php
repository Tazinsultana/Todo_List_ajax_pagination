<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.add_lst', function(e) {

            e.preventDefault();
            // For Creating....
            let title = $('#title').val();
            let is_active = $('#is_active').is(":checked");
            // console.log(title, is_active);

            $.ajax({

                url: "{{ route('add.list') }}",
                method: 'POST',
                data: {
                    title,
                    is_active
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('#addmodal').modal('hide');
                        $('#add')[0].reset();
                        Paginate();
                        // $('.table').load(location.href + ' .table');
                        Command: toastr["success"](
                            "List Added Succecfully",
                            "Success")

                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                    // $('#todo_modal').modal('hide')
                    // $('#title').val('')
                    // getData();
                },
                error: function(err) {

                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' +
                            value + '</span>');


                    });
                }
            })

        })


        // show update form

        $(document).on('click', '.upate_modal_form', function() {
            let id = $(this).data('id');
            console.log(id);

            $.ajax({

                url: "{{ route('edit.list') }}",
                method: "GeT",
                data: {
                    id
                },
                success: function(res) {

                    $('#up_id').val(res.data.id);
                    $('#up_title').val(res.data.title);

                    if (res.data.is_active) {
                        $('#up_is_active').prop('checked', true);

                    } else {
                        $('#up_is_active').prop('checked', false);
                    }

                    // console.log(res);
                }

            })

        });

        // update list

        $(document).on('click', '.up_lst', function(e) {

            e.preventDefault();

            let up_id = $('#up_id').val();
            let up_title = $('#up_title').val();
            let up_is_active = $('#up_is_active').is(":checked");
            // console.log(title, is_active);

            $.ajax({

                url: "{{ route('update.list') }}",
                method: 'PUT',
                data: {
                    id: up_id,
                    title: up_title,
                    is_active: up_is_active
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('#updatemodal').modal('hide');
                        $('#update')[0].reset();
                        // $('.table').load(location.href + ' .table');
                        Paginate();
                        Command: toastr["success"](
                            "List Updated Succecfully",
                            "Success")

                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }

                },
                error: function(err) {

                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' +
                            value + '</span>');


                    });
                }
            })

        })

        // delete list

        $(document).on('click', '.delete_modal', function(e) {

            e.preventDefault();

            let del_id = $(this).data('id');
            // alert(del_id);
            if (confirm('Are you sure to delte list??')) {

                $.ajax({

                    //    url: '/delete/'+id,

                    url: "{{ route('delete.list') }}",
                    method: 'DELETE',
                    data: {
                        del_id
                    },


                    success: function(res) {
                        if (res.status == 'success') {

                            // $('.table').load(location.href + ' .table');
                            Paginate();
                            Command: toastr["success"](
                                "List Deleted Succecfully",
                                "Success")

                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                        }

                    }

                })

            }

            // console.log(title, is_active)


        })

        function Paginate(page = 0) {


            $.ajax({
                url: "{{ route('pagination.list') }}",


                method: "GET",
                data: {
                    page
                },
                success: function(res) {
                    console.log(res);
                    const result = res.data;
                    // console.log(result);
                    let r_res = '';
                    $.each(result, function(key, item) {
                        r_res += `
                                 <tr>
                                    <th scope="row">${key+1}</th>
                                    <td>${item.title}</td>
                                    <td> <span class="badge ${item.is_active ? 'text-bg-success' : 'text-bg-danger'}"> ${item.is_active ? 'Active' : 'InActive'}</span> </td>




                                    <td>
                                        <a href="#" class="btn btn-warning upate_modal_form"
                                            data-bs-toggle="modal" data-bs-target="#updatemodal"
                                            data-id="${item.id}">Edit

                                        </a>


                                        <a href="#" class="btn btn-danger delete_modal"
                                            data-id="${item.id}">
                                            Delete
                                        </a>
                                    </td>
                                </tr>

                        `
                    })

                    $('#todo_body').html(r_res);
                    let pagination = '';
                    for (let page = 1; page <= res.total_page; page++) {
                        pagination +=
                            `<a href="" class="btn btn-sm btn-secondary pagination_item " data-page="${page-1}"> ${page} </a>`;
                    }
                    $('#pagination_container').html(pagination);


                }
            })

        }


        $(document).on('click', '.pagination_item', function(e) {
            e.preventDefault();
            const page = $(this).data('page');
            Paginate(page);



        })
    });
</script>
