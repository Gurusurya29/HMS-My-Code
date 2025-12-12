<div class="table-responsive mt-3 rounded ">
    <table class="table table-striped table-hover shadow">
        <thead class="theme_bg_color text-white">
            <tr>
                <th>Room Type</th>
                <th>Total Numbers</th>
                <th>Occupied</th>
                <th>House Keeping</th>
                <th>Available</th>
                <th>Blocked</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wardtype as $type)
                <tr>
                    <td>{{ $type->name }}</td>
                    <td>{{ $bedorroom->where('wardtype_id', $type->id)->count() }}</td>
                    <td>{{ $bedorroom->where('wardtype_id', $type->id)->where('is_available', 1)->count() }}
                    </td>
                    <td>{{ $bedorroom->where('wardtype_id', $type->id)->where('is_available', 2)->count() }}
                    </td>
                    <td>{{ $bedorroom->where('wardtype_id', $type->id)->where('is_available', 0)->count() }}
                    </td>
                    <td>{{ $bedorroom->where('wardtype_id', $type->id)->where('is_available', 3)->count() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <thead>
            <tr>
                <th>Total Counts</th>
                <th>{{ $bedorroom->count() }}</th>
                <th>{{ $bedorroom->where('is_available', 1)->count() }}</th>
                <th>{{ $bedorroom->where('is_available', 2)->count() }}</th>
                <th>{{ $bedorroom->where('is_available', 0)->count() }}</th>
                <th>{{ $bedorroom->where('is_available', 3)->count() }}</th>
            </tr>
        </thead>
    </table>
</div>
