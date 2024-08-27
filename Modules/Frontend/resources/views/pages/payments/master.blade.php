@extends('frontend::layouts.master', ['title' => 'Pembayaran Pending'])
@section('content')
    <div class="container-fluid py-5">
        <div class="d-flex justify-content-center">
            <div class="skeleton" id="loading">
                <div class="skeleton title"></div>
                <div class="skeleton text"></div>
                <div class="skeleton text"></div>
                <div class="skeleton text"></div>
                <div class="skeleton avatar"></div>
            </div>
            <div id="pending" class="d-none">
                <div class="card card-body" style="max-width: 550px;">
                    <div style="background-image: url('{{ asset('modules/frontend/img/icons/payment-warning.png') }}')"
                        class="img-payment"></div>
                    <h2 class="text-center mb-2" id="title"></h2>
                    <span class="order-id text-muted">{{ $order_id }}</span>
                    <p class="text-center mb-0">No. VA</p>
                    <div class="no-va">
                        <span id="no-va"></span>
                    </div>
                    <p class="text-center mb-0 mt-3">Total</p>
                    <div class="total-nominal" id="total-nominal"></div>
                    <span class="expired_time text-center text-danger mt-2" id="expired_time"></span>
                    <div class="py-3">
                        <p class="text-center">Silahkan lakukan pembayaran dengan Nomor Virtual Akun diatas</p>
                        <p class="text-center">Menunggu pembayaran pada transaksi <strong>{{ $order_id }}</strong> untuk
                            <strong class="text-primary">{{ ucfirst($wakaf->title) }}</strong> {{ config('app.name') }}.
                        </p>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="{{ route('frontend.index') }}" class="btn btn-warning text-white btn-block">Kembali ke
                            Beranda</a>
                    </div>
                </div>
            </div>
            <div id="settlement" class="d-none">
                <div class="card card-body" style="max-width: 550px;">
                    <div style="background-image: url('{{ asset('modules/frontend/img/icons/payment-success.png') }}')"
                        class="img-payment"></div>
                    <h2 class="text-center mb-2">Berhasil</h2>
                    <span class="text-muted text-center ">Total Transaki </span>
                    <span class="order-id text-muted">{{ $order_id }}</span>
                    <h2 class="text-center">{{ $payment->getAmountRupiah() }}</h2>
                    <div class="py-3">
                        <p class="text-center">Terima kasih telah melakukan transaksi untuk
                            <strong class="text-primary">{{ ucfirst($wakaf->title) }}</strong> {{ config('app.name') }}.
                            Semoga kebaikan anda dibalas oleh Allah SWT.
                        </p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('frontend.index') }}" class="btn btn-warning text-white btn-block">Kembali ke
                            Beranda</a>
                        <span>Atau</span>
                        <button type="button" class="btn btn-primary btn-block">Cetak Sertifikat</button>
                    </div>
                </div>
            </div>
            <div id="error" class="d-none">
                <div class="card card-body" style="max-width: 550px;">
                    <div style="background-image: url('{{ asset('modules/frontend/img/icons/payment-error.png') }}')"
                        class="img-payment"></div>
                    <h2 class="text-center mb-2">Gagal</h2>
                    <span class="order-id text-muted">{{ $order_id }}</span>
                    <div class="py-3">
                        <p class="text-center">Maaf ada kesalahan pada transaksi <strong>{{ $order_id }}</strong> untuk
                            <strong class="text-primary">{{ ucfirst($wakaf->title) }}</strong> {{ config('app.name') }}.
                        </p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('frontend.index') }}" class="btn btn-warning text-white btn-block">Kembali ke
                            Beranda</a>
                        <span>Atau</span>
                        @if (isset($_GET['wakaf_id']))
                            <a href="{{ route('frontend.wakaf.donate', $wakaf->id) }}"
                                class="btn btn-primary btn-block">Ulangi
                                Transaksi</a>
                        @else
                            <a href="{{ route('frontend.donasi.action', $wakaf->id) }}"
                                class="btn btn-primary btn-block">Ulangi
                                Transaksi</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .img-payment {
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            height: 100px;
            margin-bottom: 1.2rem;
            margin-top: 1.2rem;
        }

        .order-id {
            position: absolute;
            top: 0;
            right: 3px;
            padding: 0.2rem;
            text-decoration: underline;
        }

        .no-va {
            font-size: 1.8rem;
            text-align: center;
            background-color: var(--bs-light);
            padding: 0.4rem;
            font-weight: bold;
            color: var(--bs-primary);
        }

        .total-nominal {
            font-size: 1.8rem;
            text-align: center;
            background-color: var(--bs-light);
            padding: 0.4rem;
            font-weight: bold;
            color: var(--bs-primary);
        }

        .skeleton {
            background-color: #e0e0e0;
            background-image: linear-gradient(90deg, #e0e0e0, #f5f5f5, #e0e0e0);
            background-size: 200% 100%;
            background-position: -150% 0;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            width: 660px;
        }

        .skeleton.text {
            height: 20px;
            margin-bottom: 10px;
        }

        .skeleton.title {
            height: 30px;
            width: 60%;
            margin-bottom: 15px;
        }

        .skeleton.avatar {
            height: 50px;
            width: 50px;
            border-radius: 50%;
        }

        @keyframes loading {
            0% {
                background-position: -150% 0;
            }

            50% {
                background-position: 150% 0;
            }

            100% {
                background-position: -150% 0;
            }
        }
    </style>
@endpush
@push('js')
    <script type="text/javascript">
        $.ajax({
            url: '{{ route('payment.status', ':id') }}'.replace(':id', '{{ $order_id }}'),
            method: 'GET',
            beforeSend: function() {
                $('#loading').removeClass('d-none');
            },
            success: function(data) {
                if (data.transaction_status == 'settlement') {
                    $('#pending').html('');
                    $('#error').html('');
                    $('#settlement').removeClass('d-none');
                    window.onload = function() {
                        if (sessionStorage.getItem('refreshed') === 'true') {
                            Toast('Halaman ini hanya bisa diakses sekali', 'warning');
                            // window.location.href = "{{ route('frontend.index') }}";
                        } else {
                            sessionStorage.setItem('refreshed', 'true');
                        }
                        updateStatus(data.order_id, data.transaction_status, '{{ $wakaf->id }}',
                            data
                            .gross_amount);
                    };

                } else if (data.transaction_status == 'pending') {
                    $('#settlement').html('');
                    $('#error').html('');
                    $('#pending').removeClass('d-none');
                    $('#no-va').text(data.va_numbers[0].va_number);
                    const totalNominal = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                    })
                    $('#total-nominal').text(totalNominal.format(data.gross_amount));
                    $('#expired_time').text("Lakukan pembayaran sebelum " + data.expiry_time);
                    updateStatus(data.order_id, data.transaction_status, '{{ $wakaf->id }}', 0);
                } else {
                    $('#pending').html('');
                    $('#settlement').html('');
                    $('#error').removeClass('d-none');
                    updateStatus(data.order_id, data.transaction_status, '{{ $wakaf->id }}', 0);
                }


            },
            complete: function() {
                $('#loading').addClass('d-none');
            },
            error: function(err) {
                console.log(err);

            }
        });

        function updateStatus(id, status, id_campaign, nom) {
            $.ajax({
                url: '{{ route('payment.update', ':id') }}'.replace(':id', id),
                method: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status,
                    campaign_id: id_campaign,
                    nominal: nom
                },
                success: function(res) {
                    if (res.status == 200) {

                    }
                },
                error: function(err) {
                    console.log(err);
                }
            })
        }
    </script>
@endpush
