@extends('layouts.app')

@section('title', __('Records'))

@section('content')

<h1 class="h3 mb-4 text-gray-800" dir="{{ app()->getLocale() == "ar" ? "rtl" : "" }}">{{ __('Records') }}</h1>

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

            <button class="btn btn-icon btn-outline-primary m-1" id="" data-bs-toggle="modal" data-bs-target="#createRecordModal"><span class="mdi mdi-plus-outline"></span></button>

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
                        <th>{{__("User")}}</th>
                        <th>{{__("Full Name")}}</th>
                        <th>{{__("Birth Date")}}</th>
                        <th>{{__("Birth Place")}}</th>
                        <th>{{__("Employment Year")}}</th>
                        <th>{{__("Employment Rank")}}</th>
                        <th>{{ __('Status') }}</th>
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

<!-- Create Record Modal -->
<div class="modal fade" id="createRecordModal" tabindex="-1" aria-labelledby="createRecordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="createRecordForm" action="{{route('record.create')}}" method="POST">
            <div class="modal-content" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRecordLabel">{{ __('Create Record') }}</h5>
                    <button type="button" class="btn btn-light btn-close {{ app()->isLocale('ar') ? 'ms-0 me-auto' : '' }}" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    {{-- <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="user_id" class="form-label">{{ __('User') }}</label>
                        <div class="custom-select-container">
                            <select class="form-select custom-select" id="user_id" name="user_id" data-v="required" required>
                                <option value="">{{ __('Select User') }}</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="first_name" class="form-label">{{ __('First Name') }}</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="{{ __('First Name') }}" data-v="required" required>
                    </div>

                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="{{ __('Last Name') }}" data-v="required" required>
                    </div>

                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="birth_date" class="form-label">{{ __('Birth Date') }}</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" data-v="required" required>
                    </div>

                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="birth_place" class="form-label">{{ __('Birth Place') }}</label>
                        <input type="text" class="form-control" id="birth_place" name="birth_place" placeholder="{{ __('Birth Place') }}" data-v="required" required>
                    </div>

                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="employment_year" class="form-label">{{ __('Employment Year') }}</label>
                        <input type="number" class="form-control" id="employment_year" name="employment_year" placeholder="{{ __('Employment Year') }}" min="1900" max="2099" data-v="required" required>
                    </div>

                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="employment_rank" class="form-label">{{ __('Employment Rank') }}</label>
                        <input type="text" class="form-control" id="employment_rank" name="employment_rank" placeholder="{{ __('Employment Rank') }}" data-v="required" required>
                    </div>

                    {{-- <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <select class="form-select" id="status" name="status" data-v="required" required>
                            <option value="accepted">{{ __('Accepted') }}</option>
                            <option value="in progress">{{ __('In Progress') }}</option>
                            <option value="rejected">{{ __('Rejected') }}</option>
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

<!-- Edit Record Modal -->
<div class="modal fade" id="editRecordModal" tabindex="-1" aria-labelledby="editRecordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editRecordForm" method="POST">
            <div class="modal-content" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRecordLabel">{{ __('Edit Record') }}</h5>
                    <button type="button" class="btn btn-light btn-close {{ app()->isLocale('ar') ? 'ms-0 me-auto' : '' }}" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id" name="id" required>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="edit_user_id" class="form-label">{{ __('Client') }}</label>
                        <div class="custom-select-container">
                            <select class="form-select custom-select" id="edit_user_id" name="edit_user_id" data-v="required" required>
                                <option value="">{{ __('Select Client') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="edit_first_name" class="form-label">{{ __('First Name') }}</label>
                        <input type="text" class="form-control" id="edit_first_name" name="first_name" placeholder="{{ __('First Name') }}" data-v="required" required>
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="edit_last_name" class="form-label">{{ __('Last Name') }}</label>
                        <input type="text" class="form-control" id="edit_last_name" name="last_name" placeholder="{{ __('Last Name') }}" data-v="required" required>
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="edit_birth_date" class="form-label">{{ __('Birth Date') }}</label>
                        <input type="date" class="form-control" id="edit_birth_date" name="birth_date" data-v="required" required>
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="edit_birth_place" class="form-label">{{ __('Birth Place') }}</label>
                        <input type="text" class="form-control" id="edit_birth_place" name="birth_place" placeholder="{{ __('Birth Place') }}" data-v="required" required>
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="edit_employment_year" class="form-label">{{ __('Employment Year') }}</label>
                        <input type="number" class="form-control" id="edit_employment_year" name="employment_year" placeholder="{{ __('Employment Year') }}" min="1900" max="2099" data-v="required" required>
                    </div>
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <label for="edit_employment_rank" class="form-label">{{ __('Employment Rank') }}</label>
                        <input type="text" class="form-control" id="edit_employment_rank" name="employment_rank" placeholder="{{ __('Employment Rank') }}" data-v="required" required>
                    </div>
                    {{-- <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }} mb-3">
                        <select class="form-select" id="edit_status" name="status" data-v="required" required>
                            <option value="accepted">{{ __('Accepted') }}</option>
                            <option value="in progress">{{ __('In Progress') }}</option>
                            <option value="rejected">{{ __('Rejected') }}</option>
                        </select>
                        <label for="status" class="form-label">{{ __('Status') }}</label>
                    </div> --}}
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

        function editRecord(id) {
            $('#loading').show();

            $.ajax({
                url: '/record/' + id,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(data) {
                record = data.data;
                console.log(record);
                $('#edit_id').val(record.id);
                $('#edit_user_id').val(record.user_id);
                $('#edit_name').val(record.first_name + ' ' + record.last_name);
                $('#edit_code').val(record.code);
                $('#edit_birth_date').val(record.birth_date);
                $('#edit_birth_place').val(record.birth_place);
                $('#edit_employment_year').val(record.employment_year);
                $('#edit_employment_rank').val(record.employment_rank);
                $('#edit_status').val(record.status).trigger('change');

                $('#loading').hide();
                $('#editRecordModal').modal('show');
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

        function deleteRecord(id) {
            confirmDelete({
                id: id,
                url: '/record',
                table: table
            });
        }

        function restoreRecord(id) {
            confirmRestore({
                id: id,
                url: '/record',
                table: table
            });
        }

        function showContextMenu(id, x, y) {

            var contextMenu = $('<ul class="context-menu" dir="{{ app()->isLocale("ar") ? "rtl" : "" }}"></ul>')
                .append('<li><a onclick="editRecord(' + id + ')"><i class="tf-icons mdi mdi-pencil-outline {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Edit") }}</a></li>')
                .append('<li class="px-0 pe-none"><div class="divider border-top my-0"></div></li>')
                .append('<li><a onclick="deleteRecord(' + id + ')"><i class="tf-icons mdi mdi-trash-can-outline {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Delete") }}</a></li>');


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
                    url: "{{ route('records') }}",
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
                    {data: 'id', name: '{{__("Id")}}',},
                    {data: 'user_id', name: '{{__("User")}}'},
                    {data: 'full_name', name: '{{__("Full Name")}}'},
                    {data: 'birth_date', name: '{{__("Birth Date")}}'},
                    {data: 'birth_place', name: '{{__("Birth Place")}}'},
                    {data: 'employment_year', name: '{{__("Employment Year")}}'},
                    {data: 'employment_rank', name: '{{__("Employment Rank")}}'},
                    {data: 'status', name: '{{__("Status")}}'},
                    {data: 'created_at', name: '{{__("Created At")}}'},
                    {data: 'actions', name: '{{__("Actions")}}', orderable: false, searchable: false}
                ],
                order: [[9, 'desc']], // Default order by created_at column

                rowCallback: function(row, data) {
                    $(row).attr('id', 'record_' + data.id);

                    // $(row).on('dblclick', function() {
                    //     window.location.href = "{{ url('record') }}/" + data.id;
                    // });

                    $(row).on('contextmenu', function(e) {
                        e.preventDefault();
                        showContextMenu(data.id, e.pageX, e.pageY);
                    });

                    // Start of checkboxes
                    var $checkbox = $(row).find('.check-item');
                    var recordId = parseInt($checkbox.val());

                    if (selectedIds.includes(recordId)) {
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

            $('#createRecordForm').submit(function(event) {
                event.preventDefault();
                $('#createRecordModal').modal('hide');

                if (!$(this).valid()) {
                    $('#createRecordModal').modal('show');
                    return;
                }

                $('#loading').show();

                var formData = $(this).serialize();


                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        $('#loading').hide();
                        Swal.fire({
                            icon: response.icon,
                            title: response.state,
                            text: response.message,
                            confirmButtonText: __("Ok",lang)
                        });
                        $('#createRecordForm')[0].reset();
                        $('#createRecordForm .form-control').removeClass('valid');
                        $('#createRecordForm .form-select').removeClass('valid');
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

            $('#editRecordForm').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();
                var id = $('#edit_id').val();
                console.log(id);

                $.ajax({
                    url: "{{ route('record.update', ':id') }}".replace(':id', id),
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

    });


    new SearchableSelect({
        selectId: 'user_id',
        url: '/clients/all',
        method: 'GET',
        csrfToken: document.querySelector('meta[name="csrf-token"]').content,
        renderOption: (option) => `
            <div class="d-flex align-items-center">
                <img src="${option.photo}" class="me-2" width="20" height="20">
                <span>${option.full_name}</span>
            </div>
        `
    });

    new SearchableSelect({
        selectId: 'edit_user_id',
        url: '/clients/all',
        method: 'GET',
        csrfToken: document.querySelector('meta[name="csrf-token"]').content,
        renderOption: (option) => `
            <div class="d-flex align-items-center">
                <img src="${option.photo}" class="me-2" width="20" height="20">
                <span>${option.full_name}</span>
            </div>
        `
    });



</script>

@endsection
