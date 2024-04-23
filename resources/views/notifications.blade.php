{{-- Laravel Pusher with Jquery --}}
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- Start Grooming Reports --}}
        @if (Auth::user()->level == 'spv')
            <script>
                // Enable pusher logging - don't include this in production
                Pusher.logToConsole = true;
                var pusher = new Pusher('756eb93483e90f6aa3f5', {
                cluster: 'ap1'
                });
                var channel = pusher.subscribe('popup-notifications-grooming');
                channel.bind('reports-grooming-cleaner-to-spv', function(data) {
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
                var channel = pusher.subscribe('popup-notifications-grooming');
                channel.bind('reports-grooming-spv-to-cleaner', function(data) {
                    toastr.info('Supervisor dengan nama ' + JSON.stringify(data.name) + ', Baru saja memberikan tanggapan pada Laporan Grooming, Silahkan periksa tanggapan Tersebut', {timeOut: 4000});
                    // Refresh halaman setelah 1 detik
                    setTimeout(function() {
                        location.reload();
                    }, 5000);
                });
            </script>
        @endif
    {{-- End Grooming Reports --}}

    {{-- Start PJKP Reports --}}
        @if (Auth::user()->level == 'spv')
            <script>
                // Enable pusher logging - don't include this in production
                Pusher.logToConsole = true;
                var pusher = new Pusher('756eb93483e90f6aa3f5', {
                cluster: 'ap1'
                });
                var channel = pusher.subscribe('popup-notifications-pjkp');
                channel.bind('reports-pjkp-cleaner-to-spv', function(data) {
                    toastr.info('Cleaner dengan nama ' + JSON.stringify(data.name) + ', Baru saja memasukan Laporan PJKP, Silahkan Periksa Laporan Tersebut', {timeOut: 4000});
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
                var channel = pusher.subscribe('popup-notifications-pjkp');
                channel.bind('reports-pjkp-spv-to-cleaner', function(data) {
                    toastr.info('Supervisor dengan nama ' + JSON.stringify(data.name) + ', Baru saja memberikan tanggapan pada Laporan PJKP, Silahkan periksa tanggapan Tersebut', {timeOut: 4000});
                    // Refresh halaman setelah 1 detik
                    setTimeout(function() {
                        location.reload();
                    }, 5000);
                });
            </script>
        @endif
    {{-- End PJKP Reports --}}
{{-- End Laravel Pusher with Jquery --}}
