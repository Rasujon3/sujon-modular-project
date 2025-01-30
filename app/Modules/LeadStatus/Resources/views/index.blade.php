@extends('layouts.app')
@section('title')
    Lead Status
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/nano.min.css') }}">
@endsection
@section('content')
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Lead Status</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('lead.status.create') }}" class="btn btn-primary form-btn float-right-mobile">Add</a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('LeadStatus::table')
                </div>
            </div>
        </div>
    </section>

    @include('LeadStatus::templates.templates')
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsrender/1.0.12/jsrender.min.js"></script>
    <script src="{{ asset('assets/js/pickr.min.js') }}"></script>
    <script>
        console.log('lead status');
        let tableName = '#leadStatusTbl';
        $(tableName).DataTable({
            oLanguage: {
                'sEmptyTable': 'No Data Available In Table',
                'sInfo': 'Data Base Entries',
                sLengthMenu: 'MenuEntry',
                sInfoEmpty: 'No Entry',
                sInfoFiltered: 'Filter By',
                sZeroRecords: 'No Matching',
            },
            processing: true,
            serverSide: true,
            'order': [[2, 'asc']],
            ajax: {
                url: "{{ route('lead.status.index') }}",
            },
            columnDefs: [
                {
                    'targets': [1],
                    'width': '8%',
                    'orderable': false,
                },
                {
                    'targets': [2],
                    'className': 'text-right',
                    'width': '8%',
                },
                {
                    'targets': [3],
                    'className': 'text-center',
                    'width': '8%',
                    'searchable': false,
                },
                {
                    'targets': [4],
                    'orderable': false,
                    'className': 'text-center',
                    'width': '7%',
                },
                {
                    targets: '_all',
                    defaultContent: 'N/A',
                },
            ],
            columns: [
                {
                    data: function (row) {
                        let element = document.createElement('textarea');
                        element.innerHTML = row.name;
                        return element.value;
                    },
                    name: 'name',
                },
                {
                    data: function (row) {
                        // console.log('row', row.color);
                        // let data = [{ 'color': row.color, 'colorStyle': 'style' }];
                        let data = [{ 'color': row.color }];
                        // console.log(prepareTemplateRender('#leadStatusColorBox', data))
                        let renderedHtml = prepareTemplateRender('#leadStatusColorBox', data);
                        // console.log('renderedHtml', renderedHtml);
                        if (row.color == null)
                            return 'N/A';
                        else
                            return prepareTemplateRender('#leadStatusColorBox', data);
                            // return 'N/A';
                    },
                    name: 'color',
                },
                {
                    data: 'order',
                    name: 'order',
                },
                {
                    data: 'leads_count',
                    name: 'leads_count',
                },
                {
                    data: function (row) {
                        let data = [{ 'id': row.id }];
                        // return prepareTemplateRender('#leadStatusActionTemplate', data);
                        // return 'N/A2';
                        return renderActionButtons(row.id)
                    }, name: 'id',
                },
            ],
        });

        function renderActionButtons(id) {
            let buttons = '';

            let editUrl = `{{ route('lead.status.edit', ':id') }}`;
            editUrl = editUrl.replace(':id', id);
            buttons += `
                           <a title="Edit" href="${editUrl}" class="btn btn-warning action-btn has-icon edit-btn" style="float:right;margin:2px;padding: 5px;">
                               <i class="fa fa-edit"></i>
                           </a>
                        `;


            {{--let viewUrl = `{{ route('lead.status.edit', ':id') }}`;--}}
            {{--viewUrl = viewUrl.replace(':id', id);--}}
            {{--buttons += `--}}
            {{--               <a title="View" href="${viewUrl}" class="btn btn-info action-btn has-icon view-btn" style="float:right;margin:2px;padding: 5px;">--}}
            {{--                   <i class="fa fa-eye"></i>--}}
            {{--               </a>--}}
            {{--           `;--}}




            buttons += `
                           <a title="Delete" href="#" class="btn btn-danger action-btn has-icon delete-btn" data-id="${id}" style="float:right;margin:2px;padding: 5px;">
                               <i class="fa fa-trash"></i>
                           </a>
                       `;

            return buttons;
        }


        const pickr = Pickr.create({
            el: '.color-wrapper',
            theme: 'nano', // or 'monolith', or 'nano'
            closeWithKey: 'Enter',
            autoReposition: true,
            defaultRepresentation: 'HEX',
            position: 'bottom-end',
            swatches: [
                'rgba(244, 67, 54, 1)',
                'rgba(233, 30, 99, 1)',
                'rgba(156, 39, 176, 1)',
                'rgba(103, 58, 183, 1)',
                'rgba(63, 81, 181, 1)',
                'rgba(33, 150, 243, 1)',
                'rgba(3, 169, 244, 1)',
                'rgba(0, 188, 212, 1)',
                'rgba(0, 150, 136, 1)',
                'rgba(76, 175, 80, 1)',
                'rgba(139, 195, 74, 1)',
                'rgba(205, 220, 57, 1)',
                'rgba(255, 235, 59, 1)',
                'rgba(255, 193, 7, 1)',
            ],

            components: {
                // Main components
                preview: true,
                hue: true,

                // Input / output Options
                interaction: {
                    input: true,
                    clear: false,
                    save: false,
                },
            },
        });

        const editPickr = Pickr.create({
            el: '.color-wrapper',
            theme: 'nano', // or 'monolith', or 'nano'
            closeWithKey: 'Enter',
            autoReposition: true,
            defaultRepresentation: 'HEX',
            position: 'bottom-end',
            swatches: [
                'rgba(244, 67, 54, 1)',
                'rgba(233, 30, 99, 1)',
                'rgba(156, 39, 176, 1)',
                'rgba(103, 58, 183, 1)',
                'rgba(63, 81, 181, 1)',
                'rgba(33, 150, 243, 1)',
                'rgba(3, 169, 244, 1)',
                'rgba(0, 188, 212, 1)',
                'rgba(0, 150, 136, 1)',
                'rgba(76, 175, 80, 1)',
                'rgba(139, 195, 74, 1)',
                'rgba(205, 220, 57, 1)',
                'rgba(255, 235, 59, 1)',
                'rgba(255, 193, 7, 1)',
            ],

            components: {
                // Main components
                preview: true,
                hue: true,

                // Input / output Options
                interaction: {
                    input: true,
                    clear: false,
                    save: false,
                },
            },
        });

        pickr.on('change', function () {
            const color = pickr.getColor().toHEXA().toString();
            if (wc_hex_is_light(color)) {
                $('#validationErrorsForColor').
                addClass('d-block').
                text('Pick a different color');
                $(':input[id="btnSave"]').prop('disabled', true);
                return;
            }
            $('#validationErrorsForColor').removeClass('d-block');
            $(':input[id="btnSave"]').prop('disabled', false);
            pickr.setColor(color);
            $('#color').val(color);
        });

        editPickr.on('change', function () {
            const editColor = editPickr.getColor().toHEXA().toString();
            if (wc_hex_is_light(editColor)) {
                $('#editValidationErrorsForColor').
                addClass('d-block').
                text('Pick a different color');
                $(':input[id="btnEditSave"]').prop('disabled', true);
                return;
            }
            $('#editValidationErrorsForColor').removeClass('d-block');
            $(':input[id="btnEditSave"]').prop('disabled', false);
            editPickr.setColor(editColor);
            $('#edit_color').val(editColor);
        });

        function wc_hex_is_light (color) {
            const hex = color.replace('#', '');
            const c_r = parseInt(hex.substr(0, 2), 16);
            const c_g = parseInt(hex.substr(2, 2), 16);
            const c_b = parseInt(hex.substr(4, 2), 16);
            const brightness = ((c_r * 299) + (c_g * 587) + (c_b * 114)) / 1000;
            return brightness > 240;
        }

        let picked = false;

        $(document).on('click', '#color', function () {
            picked = true;
        });

        $(document).on('click', '.addLeadStatusModal', function () {
            $('#addModal').appendTo('body').modal('show');
        });

        $(document).on('submit', '#addNewForm', function (e) {

            if ($('#color').val() == '') {
                displayErrorMessage('Please select your color.');
                return false;
            }

            e.preventDefault();
            processingBtn('#addNewForm', '#btnSave', 'loading');
            $.ajax({
                url: route('lead.status.store'),
                type: 'POST',
                data: $(this).serialize(),
                success: function (result) {
                    if (result.success) {
                        displaySuccessMessage(result.message);
                        $('#addModal').modal('hide');
                        $('#leadStatusTbl').DataTable().ajax.reload(null, false);
                    }
                },
                error: function (result) {
                    displayErrorMessage(result.responseJSON.message);
                },
                complete: function () {
                    processingBtn('#addNewForm', '#btnSave');
                },
            });
        });

        $(document).on('click', '.edit-btn', function (event) {
            let leadStatusId = $(event.currentTarget).data('id');
            renderData(leadStatusId);
        });

        window.renderData = function (id) {
            $.ajax({
                url: route('lead.status.edit', id),
                type: 'GET',
                success: function (result) {
                    if (result.success) {
                        $('#leadStatusId').val(result.data.id);
                        let element = document.createElement('textarea');
                        element.innerHTML = result.data.name;
                        $('#editName').val(element.value);
                        editPickr.setColor(result.data.color);
                        $('#editOrder').val(result.data.order);
                        $('#editModal').appendTo('body').modal('show');
                    }
                },
                error: function (result) {
                    displayErrorMessage(result.responseJSON.message);
                },
            });
        };

        $(document).on('submit', '#editForm', function (event) {
            event.preventDefault();
            processingBtn('#editForm', '#btnEditSave', 'loading');
            let id = $('#leadStatusId').val();
            $.ajax({
                url: route('lead.status.update', id),
                type: 'put',
                data: $(this).serialize(),
                success: function (result) {
                    if (result.success) {
                        displaySuccessMessage(result.message);
                        $('#editModal').modal('hide');
                        $('#leadStatusTbl').DataTable().ajax.reload(null, false);
                    }
                },
                error: function (result) {
                    displayErrorMessage(result.responseJSON.message);
                },
                complete: function () {
                    processingBtn('#editForm', '#btnEditSave');
                },
            });
        });

        $(document).on('click', '.delete-btn', function (event) {
            let leadStatusId = $(event.currentTarget).data('id');
            deleteItem(route('lead.status.destroy', leadStatusId), '#leadStatusTbl',
                Lang.get('messages.lead_status.lead_status'));
        });

        $('#addModal').on('show.bs.modal', function () {
            pickr.setColor('#3F51B5');
        });

        $('#addModal').on('hidden.bs.modal', function () {
            pickr.setColor('#000');
            resetModalForm('#addNewForm', '#validationErrorsBox');
            pickr.hide();
        });

        $('#editModal').on('hidden.bs.modal', function () {
            resetModalForm('#editForm', '#editValidationErrorsBox');
            editPickr.hide();
        });
    </script>

    <script>
        window.prepareTemplateRender = function (templateSelector, data) {
            // console.log('templateSelector', templateSelector);
            // console.log('data', data);
            // console.log('data[0]', data[0]);
            // console.log('data[0]', data[0].color);
            let template = $.templates(templateSelector);
            // console.log('template', template);
            // console.log('template.render(data)', template.render(data[0].color));
            // console.log('template.render(data)', template.render(data[0]));
            // return template.render(data);
            return template.render(data[0]);
        };
    </script>
@endpush
