@extends('layouts.master')

@section('content')

  <h2 data="header-admin">Admin dashboard</h2>

  <div class="loader"></div>

  <script>
    const getUrl = "{{ route('admin.dashboard') }}";
    function loadData() {
        $.ajax({
            headers: {
                'x-refresh': true
            },
            url: getUrl,
            method: 'GET',
        }).done(function(response) {
            // console.log('response: ', response);
            $("[data=header-admin]").after(response);
        }).fail(function(error) {
            alert(error);
        });
    }

    setTimeout(() => {
        $(".loader").remove();
        loadData();
    }, 2000);
</script>

@endsection