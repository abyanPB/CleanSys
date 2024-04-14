{{-- Laravel Pusher with Jquery --}}
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@if (Auth::user()->level == 'spv')
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var pusher = new Pusher('756eb93483e90f6aa3f5', {
        cluster: 'ap1'
        });
        var channel = pusher.subscribe('popup-notifications');
        channel.bind('laporan-grooming-notifications', function(data) {
            toastr.info('Cleaner dengan nama ' + JSON.stringify(data.name) + ', Baru saja memasukan Laporan Grooming, Silahkan Periksa Laporan Tersebut', {timeOut: 4000});
            // Refresh halaman setelah 1 detik
            setTimeout(function() {
                location.reload();
            }, 5000);
        });
    </script>
@elseif (Auth::user()->level == 'cleaner')
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var pusher = new Pusher('756eb93483e90f6aa3f5', {
        cluster: 'ap1'
        });
        var channel = pusher.subscribe('popup-notifications');
        channel.bind('laporan-grooming-notifications', function(data) {
            toastr.info('Supervisor dengan nama ' + JSON.stringify(data.name) + ', Baru saja memberikan tanggapan pada Laporan Grooming, Silahkan periksa tanggapan Tersebut', {timeOut: 4000});
            // Refresh halaman setelah 1 detik
            setTimeout(function() {
                location.reload();
            }, 5000);
        });
    </script>
@endif
{{-- End Laravel Pusher with Jquery --}}
