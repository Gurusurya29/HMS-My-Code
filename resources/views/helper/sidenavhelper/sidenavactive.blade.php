@if ($type == 1)
    <script>
        $("{{ $nameone }}").css({
            "background-color": "{{ App::make('themesetting') ? App::make('themesetting')->collapse_active_color : '#05257e' }}",
        });
    </script>
@else
    <script>
        $("{{ $collapsename }}").addClass('show');
        $("{{ $nameone }}").css({
            "background-color": "{{ App::make('themesetting') ? App::make('themesetting')->collapse_active_color : '#05257e' }}",
            "margin-top": "2px"
        });
        $("{{ $nametwo }}").css({
            "background-color": "{{ App::make('themesetting') ? App::make('themesetting')->collapse_activesub_color : '#05257e' }}",
        });
    </script>
@endif
