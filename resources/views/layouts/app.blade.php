<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mailchimpie</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.bootcss.com/toastr.js/latest/css/toastr.min.css"> 
    </head>
    <body class="antialiased">
        
        <div class="overflow-x-auto">
            <div class="min-w-screen bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
                <div class="w-full lg:w-5/6 mt-6">
                    @yield('content')
                </div>
            </div>
        </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    (function() {
        const deleteButtons = document.querySelectorAll('a.delete');
        for(let i = 0; i < deleteButtons.length; i++) {
            deleteButtons[i].addEventListener('click', function(e) {
                e.preventDefault();
                let link = deleteButtons[i].getAttribute('href');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: '#e24d42',
                    cancelButtonColor: '#1bae50',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                    }
                    })
            })
        }
        

    })();

    </script>
    <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    </body>
</html>