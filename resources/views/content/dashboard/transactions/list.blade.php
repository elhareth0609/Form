@extends('layouts.app')

@section('title', __('Transactions'))

@section('content')

<h1 class="h3 mb-4 text-gray-800" dir="{{ app()->getLocale() == "ar" ? "rtl" : "" }}">{{ __('Transactions') }}</h1>

<div class="card p-2" dir="{{ app()->getLocale() == "ar" ? "rtl" : "" }}">
    <div class="container-fluid mt-5">
        <div class="row {{ app()->getLocale() == "ar" ? "me-1" : "ms-1" }} mb-2">
            <input type="text" class="form-control my-w-fit-content m-1" id="dataTables_my_filter" placeholder="{{ __('Search ...') }}" name="search">

            <select class="form-select my-w-fit-content m-1" id="selectType" name="type">
                <option value="">{{ __('All') }}</option>
                <option value="active">{{ __('Active') }}</option>
                <option value="inactive">{{ __('In Active') }}</option>
            </select>

            <select class="form-select my-w-fit-content m-1" id="dataTables_my_length" name="length">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>

            <button class="btn btn-icon btn-outline-primary m-1" id="" data-bs-toggle="modal" data-bs-target="#createtransactionModal"><span class="mdi mdi-plus-outline"></span></button>

            <div class="dropdown my-w-fit-content px-0">
                <button class="btn btn-icon btn-outline-primary m-1" type="button" data-bs-toggle="dropdown">
                    <span class="mdi mdi-filter-outline"></span>
                </button>
                <ul class="dropdown-menu p-1 {{ app()->getLocale() == "ar" ? "text-end dropdown-menu-end" : "dropdown-menu-start" }}" aria-labelledby="dropdownMenuButton1" id="columns_filter_dropdown">
                </ul>
            </div>
        </div>
        <div class="table-responsive rounded-3 border mb-3">
            <table id="table" class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th><input class="form-check-input" type="checkbox" id="check-all"></th>
                        <th>{{__("Id")}}</th>
                        <th>{{__("Name")}}</th>
                        <th>{{ __('Amount') }}</th>
                        {{-- <th>{{ __('Status') }}</th> --}}
                        <th>{{ __('Created At') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="row align-items-baseline justify-content-end">
            <div class="my-w-fit-content" id="dataTables_my_info"></div>
            <nav class="my-w-fit-content" aria-label="Table navigation"><ul class="pagination" id="dataTables_my_paginate"></ul></nav>
        </div>
    </div>
</div>

<!-- Create transaction Modal -->
<div class="modal fade" id="createtransactionModal" tabindex="-1" aria-labelledby="createtransactionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="createtransactionForm" action="{{route('transaction.create')}}" method="POST" enctype="multipart/form-data">
            <div class="modal-content" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="createtransactionLabel">{{ __('Create transaction') }}</h5>
                    <button type="button" class="btn btn-light btn-close {{ app()->isLocale('ar') ? 'ms-0 me-auto' : '' }}" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="id" name="id" required>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="user_id" class="form-label">{{ __('User') }}</label>
                        <div class="custom-select-container">
                            <select class="form-select custom-select" id="user_id" name="user_id" data-v="required" required>
                                <option value="">{{ __('Select User') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="{{ __('Amount') }}" data-v="required" required>
                        <label for="amount" class="form-label">{{ __('Amount') }}</label>
                    </div>
                    {{-- <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <select class="form-select" id="status" name="status" data-v="required" required>
                            <option value="active">{{ __('Active') }}</option>
                            <option value="inactive">{{ __('Inactive') }}</option>
                        </select>
                        <label for="status" class="form-label">{{ __('Status') }}</label>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit transaction Modal -->
<div class="modal fade" id="edittransactionModal" tabindex="-1" aria-labelledby="edittransactionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="edittransactionForm" method="POST">
            <div class="modal-content" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="edittransactionLabel">{{ __('Edit transaction') }}</h5>
                    <button type="button" class="btn btn-light btn-close {{ app()->isLocale('ar') ? 'ms-0 me-auto' : '' }}" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id" name="id" required>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="edit_user_id" class="form-label">{{ __('User') }}</label>
                        <div class="custom-select-container">
                            <select class="form-select custom-select" id="edit_user_id" name="user_id" data-v="required" required>
                                <option value="">{{ __('Select User') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <input type="number" class="form-control" id="edit_amount" name="amount" placeholder="{{ __('Amount') }}" data-v="required" required>
                        <label for="edit_amount" class="form-label">{{ __('Amount') }}</label>
                    </div>
                    {{-- <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <select class="form-select" id="edit_status" name="status" data-v="required" required>
                            <option value="active">{{ __('Active') }}</option>
                            <option value="inactive">{{ __('Inactive') }}</option>
                        </select>
                        <label for="edit_status" class="form-label">{{ __('Status') }}</label>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var table;
    // Start of checkboxes
    var selectedIds = [];
    var ids = [];
    let isCheckAllTrigger = false;
    // End of checkboxes

    function editTransaction(id) {
        $('#loading').show();

        $.ajax({
            url: '/transaction/' + id,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                console.log(response);
                let transaction = response.data; // Use `response` instead of `data`
                console.log(transaction.id);
                $('#edit_id').val(transaction.id);
                $('#edit_user_id').val(transaction.user_id).trigger('change');
                $('#edit_amount').val(transaction.amount);
                // $('#edit_status').val(transaction.status).trigger('change');

                $('#loading').hide();
                $('#edittransactionModal').modal('show');
            },
            error: function(xhr, textStatus, errorThrown) {
                const response = JSON.parse(xhr.responseText);
                $('#loading').hide();
                Swal.fire({
                    icon: response.icon,
                    title: response.state,
                    text: response.message,
                    confirmButtonText: __("Ok",lang)
                });
            }
        });

    }

    function deleteTransaction(id) {
        confirmDelete({
            id: id,
            url: '/transaction',
            table: table
        });
    }

    // function restoreTransaction(id) {
    //     confirmRestore({
    //         id: id,
    //         url: '/transaction',
    //         table: table
    //     });
    // }

    function showContextMenu(id, x, y) {

        var contextMenu = $('<ul class="context-menu" dir="{{ app()->isLocale("ar") ? "rtl" : "" }}"></ul>')
            .append('<li><a onclick="edittransaction(' + id + ')"><i class="tf-icons mdi mdi-pencil-outline {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Edit") }}</a></li>')
            .append('<li class="px-0 pe-none"><div class="divider border-top my-0"></div></li>')
            .append('<li><a onclick="deletetransaction(' + id + ')"><i class="tf-icons mdi mdi-trash-can-outline {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Delete") }}</a></li>');


        contextMenu.css({
            top: y,
            left: x
        });


        $('body').append(contextMenu);

        $(document).on('click', function() {
            $('.context-menu').remove();
        });
    }


    $(document).ready(function() {
        table = $('#table').DataTable({
            pageLength: 100,
            language: {
                "emptyTable": "<div id='no-data-animation' style='width: 100%; height: 200px;'></div>",
                "zeroRecords": "<div id='no-data-animation' style='width: 100%; height: 200px;'></div>"
            },
            ajax: {
                url: "{{ route('transactions') }}",
                data: function(d) {
                    d.type = $('#selectType').val();
                },
                // Start of checkboxes
                dataSrc: function(response) {
                    ids = (response.ids || []).map(id => parseInt(id, 10)); // Ensure all IDs are integers
                    selectedIds = [];
                    return response.data;
                }
            // End of checkboxes
            },
            columns: [
                // Start of checkboxes
                {
                    data: 'id',
                    name: '#',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        return '<input type="checkbox" class="form-check-input rounded-2 check-item" value="' + data + '">';
                    }
                },
                // End  of checkboxes
                {data: 'id', name: '{{__("Id")}}'},
                {data: 'user_id', name: '{{__("Name")}}'},
                {data: 'amount', name: '{{__("Amount")}}'},
                // {data: 'status', name: '{{__("Status")}}'},
                {data: 'created_at', name: '{{__("Created At")}}'},
                {data: 'actions', name: '{{__("Actions")}}', orderable: false, searchable: false}
            ],
            order: [[4, 'desc']],   // if not admin

            rowCallback: function(row, data) {
                $(row).attr('id', 'transaction_' + data.id);

                $(row).on('contextmenu', function(e) {
                    e.preventDefault();
                    showContextMenu(data.id, e.pageX, e.pageY);
                });

                // Start of checkboxes
                var $checkbox = $(row).find('.check-item');
                var transactionId = parseInt($checkbox.val());

                if (selectedIds.includes(transactionId)) {
                    $checkbox.prop('checked', true);
                } else {
                    $checkbox.prop('checked', false);
                }
                // End of checkboxes

            },
            drawCallback: function() {
                // Start of checkboxes
                $('#check-all').off('click').on('click', function() { // Unbind previous event and bind a new one
                    $('.check-item').prop('checked', this.checked);
                    var totalCheckboxes = ids.length;
                    var checkedCheckboxes = selectedIds.length;

                    if (checkedCheckboxes === 0 || checkedCheckboxes < totalCheckboxes) { // if new all checked or some checked
                        selectedIds = [];
                        selectedIds = ids.slice();
                    } else {
                        selectedIds = [];
                    }
                });

                $('.check-item').on('change', function() {
                    var itemId = parseInt($(this).val());

                    if (this.checked) { // if new checked add to selected
                        selectedIds.push(itemId);
                    } else { // if remove checked remove from selected
                        selectedIds = selectedIds.filter(id => id !== itemId);
                    }

                    var totalCheckboxes = ids.length;
                    var checkedCheckboxes = selectedIds.length;
                    if (checkedCheckboxes === totalCheckboxes) { // all checkboxes checked
                        $('#check-all').prop('checked', true).prop('indeterminate', false);
                        selectedIds = ids.slice();
                    } else if (checkedCheckboxes > 0) { // not all checkboxes are checked
                        $('#check-all').prop('checked', false).prop('indeterminate', true);
                    } else {  // all checkboxes are not checked
                        $('#check-all').prop('checked', false).prop('indeterminate', false);
                        selectedIds = [];
                    }
                });
                // End of checkboxes
            }

        });

        // Initialize Components
        initLengthChange(table);
        initSearchFilter(table);
        initTypeChange(table);
        initTrashButton(table);
        // initPagination(table);
        initColumnVisibilityToggle(table);

        // Table draw event for sorting icons and pagination updates
        table.on('draw', function () {
            handlePagination(table);
            updateSortingIcons(table);
            updateInfoText(table);
        });

        $('#createtransactionForm').submit(function(event) {
            event.preventDefault();
            $('#createtransactionModal').modal('hide');

            if (!$(this).valid()) {
                $('#createtransactionModal').modal('show');
                return;
            }

            $('#loading').show();

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    $('#loading').hide();
                    Swal.fire({
                        icon: response.icon,
                        title: response.state,
                        text: response.message,
                        confirmButtonText: __("Ok",lang)
                    });
                    $('#createtransactionForm')[0].reset();
                    $('#createtransactionForm .form-control').removeClass('valid');
                    $('#createtransactionForm .form-select').removeClass('valid');
                    table.ajax.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    $('#loading').hide();
                    const response = JSON.parse(xhr.responseText);
                    Swal.fire({
                        icon: response.icon,
                        title: response.state,
                        text: response.message,
                        confirmButtonText: __("Ok",lang)
                    });
                }
            });
        });

        $('#edittransactionForm').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();
            var id = $('#edit_id').val();
            console.log(id);

            $.ajax({
                url: "{{ route('transaction.update', ':id') }}".replace(':id', id),
                type: $(this).attr('method'),
                data: formData,
                dataType: 'json',
                success: function(response) {
                Swal.fire({
                    icon: response.icon,
                    title: response.state,
                    text: response.message,
                    confirmButtonText: __("Ok",lang)
                });
                table.ajax.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                const response = JSON.parse(xhr.responseText);
                Swal.fire({
                    icon: response.icon,
                    title: response.state,
                    text: response.message,
                    confirmButtonText: __("Ok",lang)
                });
                }
            });
        });

        new SearchableSelect({
            selectId: 'user_id',
            url: '/user/all',
            method: 'GET',
            csrfToken: document.querySelector('meta[name="csrf-token"]').content
        });

        new SearchableSelect({
            selectId: 'edit_user_id',
            url: '/user/all',
            method: 'GET',
            csrfToken: document.querySelector('meta[name="csrf-token"]').content
        });

        // Set the selected user after fetching the transaction details
        // function setUserSelection(userId) {
        //     $('#edit_user_id').val(userId).trigger('change');
        // }

        // function editTransaction(id) {
        //     $('#loading').show();

        //     $.ajax({
        //         url: '/transaction/' + id,
        //         type: 'GET',
        //         headers: {
        //             'X-CSRF-TOKEN': csrfToken
        //         },
        //         success: function(response) {
        //             let transaction = response.data;
        //             $('#edit_id').val(transaction.id);
        //             $('#edit_amount').val(transaction.amount);
        //             setUserSelection(transaction.user_id);

        //             $('#loading').hide();
        //             $('#edittransactionModal').modal('show');
        //         },
        //         error: function(xhr) {
        //             const response = JSON.parse(xhr.responseText);
        //             $('#loading').hide();
        //             Swal.fire({
        //                 icon: response.icon,
        //                 title: response.state,
        //                 text: response.message,
        //                 confirmButtonText: __("Ok", lang)
        //             });
        //         }
        //     });
        // }

    });

</script>

@endsection
