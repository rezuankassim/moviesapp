<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript" defer>
    $(() => {
        $('.navbar-mobile-toggle').on('click', () => {
            if ($('.navbar-mobile').is(':hidden')) {
                $('.navbar-mobile').show()
            } else {
                $('.navbar-mobile').hide()
            }
        })
    })
</script>