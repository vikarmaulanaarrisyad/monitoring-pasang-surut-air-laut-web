@push('scripts')
    <script>
        var table;
        table = $('.table-sensor').DataTable({
            processing: true,
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route('sensor.data') }}',
                data: function(d) {
                    d.datefilter = $('input[name="datefilter"]').val();
                    d.status = $('[name=status2]').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    sortable: false,
                    searchable: false
                },
                {
                    data: 'tanggal'
                },
                {
                    data: 'waktu',
                    sortable: false,
                    searchable: false
                },
                {
                    data: 'sensor'
                },
                {
                    data: 'weend_speed'
                },
                {
                    data: 'status',
                    sortable: false,
                    searchable: false
                },
            ],
        });

        $('.datepicker').on('change.datetimepicker', function() {
            table.ajax.reload();
        });

        $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
            table.ajax.reload();
        });

        $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            table.ajax.reload();
        });

        $('[name=status2]').on('change', function() {
            table.ajax.reload();
            $('input[name="datefilter"]').val('');
        });
    </script>
@endpush
