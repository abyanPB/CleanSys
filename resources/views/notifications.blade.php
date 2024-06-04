{{-- Laravel Pusher with Jquery --}}
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@if (Auth::check())

@php
    $userId = Auth::id();
    $userLevel = Auth::user()->level;
@endphp

    {{-- Start Grooming Reports --}}
        <script>
            Pusher.logToConsole = true;

            var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
                encrypted: true
            });

            var channel = pusher.subscribe('popup-notifications-grooming');
            channel.bind('reports-grooming', function(data) {
                var userLevel = '{{ $userLevel }}';
                var userId = '{{ $userId }}';

                if (userLevel === 'spv' && data.userId == userId) {
                    toastr.info('Cleaner dengan nama ' + data.name + ', baru saja memasukkan Laporan Grooming, silahkan periksa laporan tersebut.', { timeOut: 4000 });
                    // Refresh halaman setelah 1 detik
                    setTimeout(function() {
                            location.reload();
                        }, 5000);
                } else if (userLevel === 'cleaner' && data.userId == userId) {
                    toastr.info('Supervisor dengan nama ' + data.name + ', baru saja memberikan tanggapan pada Laporan Grooming, silahkan periksa tanggapan tersebut.', { timeOut: 4000 });
                    // Refresh halaman setelah 1 detik
                    setTimeout(function() {
                            location.reload();
                        }, 5000);
                }
            });
        </script>
    {{-- End Grooming Reports --}}

    {{-- Start PJKP Reports --}}
        <script>
            Pusher.logToConsole = true;

            var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
                encrypted: true
            });

            var channel = pusher.subscribe('popup-notifications-pjkp');
            channel.bind('reports-pjkp', function(data) {
                var userLevel = '{{ $userLevel }}';
                var userId = '{{ $userId }}';

                if (userLevel === 'spv' && data.userId == userId) {
                    toastr.info('Cleaner dengan nama ' + data.name + ', baru saja memasukkan Laporan PJKP, silahkan periksa laporan tersebut.', { timeOut: 4000 });
                    // Refresh halaman setelah 1 detik
                    setTimeout(function() {
                            location.reload();
                        }, 5000);
                } else if (userLevel === 'cleaner' && data.userId == userId) {
                    toastr.info('Supervisor dengan nama ' + data.name + ', baru saja memberikan tanggapan pada Laporan PJKP, silahkan periksa tanggapan tersebut.', { timeOut: 4000 });
                    // Refresh halaman setelah 1 detik
                    setTimeout(function() {
                            location.reload();
                        }, 5000);
                }
            });
        </script>
    {{-- End PJKP Reports --}}

    {{-- Start Guest Reports --}}
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true
        });

        var channel = pusher.subscribe('popup-notifications-guest');
        channel.bind('reports-guest', function(data) {
            var userLevel = '{{ $userLevel }}';
            var userId = '{{ $userId }}';

            if (userLevel === 'spv' && data.userId == userId) {
                toastr.info('Visitor dengan nama ' + data.name + ', baru saja memasukkan Laporan Pelayanan, silahkan periksa pengaduan tersebut.', { timeOut: 4000 });
                // Refresh halaman setelah 1 detik
                setTimeout(function() {
                        location.reload();
                    }, 5000);
            } else if (userLevel === 'cleaner' && data.userId == userId) {
                toastr.info('Visitor dengan nama ' + data.name + ', baru saja memberikan tanggapan pada Laporan Pelayanan, silahkan periksa pengaduan tersebut.', { timeOut: 4000 });
                // Refresh halaman setelah 1 detik
                setTimeout(function() {
                        location.reload();
                    }, 5000);
            }
        });
    </script>
    {{-- End Guest Reports --}}
@endif
{{-- End Laravel Pusher with Jquery --}}
