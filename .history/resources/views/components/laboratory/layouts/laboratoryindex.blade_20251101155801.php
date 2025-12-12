<div class="card shadow-sm">
    <div class="card-header text-white theme_bg_color">
        <div class="d-flex flex-row bd-highlight">
            <div class="flex-grow-1 bd-highlight mt-1"><span class="h5">{{ $title }}</span></div>
            <div class="bd-highlight">
                {{ $action }}
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tableid" class="table table-striped table-hover w-100 text-center">
                <thead class="text-white theme_bg_color">
                    <tr>
                        {{ $tableheader }}
                    </tr>
                </thead>
                <tbody>
                    {{ $tablebody }}
                </tbody>
            </table>
        </div>
    </div>
</div>