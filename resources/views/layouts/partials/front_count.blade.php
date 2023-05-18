<section id="counts" class="counts">
    <div class="container">
        <div class="row" data-aos="fade-up">
            <div class="col-12 col-md-12 text-center">
                <div style="display:inline;width:100px;height:90px;">
                    <div class="knob-container">
                        <input class="knob" data-min="0" data-max="100" data-width="200" data-height="200" readonly
                            data-displayInput="true" data-displayPrevious="true">
                        <div class="knob-description">Keterangan</div>
                    </div>
                </div>
            </div>

        </div>
</section>

@push('scripts_vendor')
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.knob').knob({
                'width': 200,
                'height': 200,
                'min': 0,
                'max': 100,
                'readOnly': true,
                'displayInput': true,
                'displayPrevious': true,
            });

            setInterval(() => {
                getDataSensor();
            }, 1000);
        });


        function getDataSensor() {
            $.ajax({
                type: "GET",
                url: "{{ route('sensor.data_single') }}",
                dataType: "JSON",
                success: function(response) {
                    $('.knob')
                        .val(response.data.sensor)
                        .trigger('change');

                    $('.knob-description').text('Status : ' + response.data.status);
                },
                errors: function(errors) {
                    console.log(errors)
                }
            });
        }
    </script>
@endpush
