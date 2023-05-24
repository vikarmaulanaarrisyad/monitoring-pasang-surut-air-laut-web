<div class="table-responsive">
    <table {{ $attributes->merge(['class' => 'table table-striped']) }} style="width:100%;">
        @isset($thead)
            <thead>
                {{ $thead }}
            </thead>
        @endisset

        <tbody>
            {{ $slot }}
        </tbody>

        @isset($tfoot)
            <tfoot>
                {{ $tfoot }}
            </tfoot>
        @endisset
    </table>
</div>
