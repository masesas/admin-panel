@extends('backend.layouts.app')

@section('title')
    Withdraws
@endsection

@section('title_main')
    Withdraws
@endsection

@section('breadcrumb_item')
    <li class="breadcrumb-item active">Withdraws</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Withdraws
                    </div>
                    <div class="divider mb-3"></div>
                    @if ($userSession->tipe_user === 'user')
                        <div class="row">
                            <span class="text-primary">Balance</span>
                            <div class="col">
                                <h4 class="">{{ $balance }}</h4>
                            </div>
                            <span class="text-danger mt-3 f-15">Minimal Withdraws Rp. 30.000</h4>
                        </div>
                        <div class="divider mb-3"></div>
                    @endif
                    <div class="row my-5">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="float-start">
                                @if ($userSession->tipe_user === 'user')
                                    <button type="button" class="btn-act btn-act-primary btn-act-md">
                                        <i class="bi bi-newspaper"></i> Withdraws
                                    </button>
                                    <button type="button" class="btn-act btn-act-primary btn-act-md" data-bs-toggle="modal"
                                        data-bs-target="#m_bank_account">
                                        <i class="bi bi-newspaper"></i> Bank Account
                                    </button>
                                    @include('backend.includes.modal_bank_account')
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Amount</th>
                                        <th>Request Date</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody class="text-center">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script type="text/javascript" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript">
        let table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: true,
            responsive: true,
            "searching": false,
            responsive: true,
            "autoWidth": false,
            'language': {
                "loadingRecords": "&nbsp;",
                "processing": "Loading Data ..."
            },
            ajax: {
                url: '{{ route('backend.withdraws_list') }}',
                data: function(d) {

                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'request_date',
                    name: 'request_date',
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                }
            ],
            ordering: false,
            lengthChange: false,
            // oLanguage: {
            //     "sSearch": "Cari Nama Alumni"
            // }
        });

        $('#platform').change(function() {
            table.draw();
        });

        $('#accounting-period').change(function() {
            table.draw();
        });

        $("#btn-refresh").click(() => {
            table.draw();
        });
    </script>
@endpush
