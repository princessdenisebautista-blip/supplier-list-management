<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Auth System</title>

 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    

    <!-- success toast -->
    @if(session('success'))
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <div class="toast bg-success text-white border-0 shadow" role="alert">
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif

    <!-- error toast -->
    @if(session('error'))
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <div class="toast bg-danger text-white border-0 shadow" role="alert">
            <div class="toast-body">
                {{ session('error') }}
            </div>
        </div>
    </div>
    @endif

    <!-- vallidation errors -->
    @if ($errors->any())
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        @foreach ($errors->all() as $error)
            <div class="toast bg-danger text-white border-0 shadow mb-2" role="alert">
                <div class="toast-body">
                    {{ $error }}
                </div>
            </div>
        @endforeach
    </div>
    @endif

   <div style="margin:0;padding:0;">
    @yield('content')
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toastElList = document.querySelectorAll('.toast');

            toastElList.forEach(function(toastEl){
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 4000
                });
                toast.show();
            });
        });
    </script>

</body>
</html>