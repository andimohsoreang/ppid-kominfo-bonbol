<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Not Found - PPID Bone Bolango</title>
        <link rel="stylesheet" href="{{ asset('be/assets/css/bootstrap.css') }}">
        
        <link rel="shortcut icon" href="{{ asset('be/assets/images/ppidbonebol.png') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('be/assets/css/app.css') }}">
    </head>
    <body>
        <div id="error">
            <div class="container text-center pt-32">
                <h1 class='error-title'>404</h1>
                <p>Kami tidak dapat menemukan halaman yang anda cari.</p>
                <a href="{{ url()->previous() }}" class='btn btn-primary'>Kembali</a>
            </div>
    
            <div class="footer pt-32">
                <p class="text-center">Copyright &copy; PPID Bone Bolango {{ \Carbon\Carbon::now()->isoFormat('Y') }}</p>
            </div>
        </div>
    </body>
</html>