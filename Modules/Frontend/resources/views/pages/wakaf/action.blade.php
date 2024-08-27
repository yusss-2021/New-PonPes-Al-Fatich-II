@extends('frontend::layouts.master', ['title' => 'Wakaf Sekarang'])
@section('content')
    <div class="container-fluid py-5">
        <div id="wizard">
            <h3>Langkah Pertama </h3>
            <section>
                <h5 class="bd-wizard-step-title">Langkah Pertama</h5>
                <h2 class="section-heading">Masukan Detail Informasi Anda!! </h2>
                <div class="form-group mb-3 default-form-name">
                    <label for="nama_depan" class="sr-only">Nama Depan</label>
                    <input type="text" name="nama_depan" id="nama_depan" class="form-control" placeholder="Nama Depan">
                </div>
                <div class="form-group mb-3 default-form-name">
                    <label for="nama_belakang" class="sr-only">Nama Belakang</label>
                    <input type="text" name="nama_belakang" id="nama_belakang" class="form-control"
                        placeholder="Nama Belakang">
                </div>
                <div class="form-group mb-3">
                    <label for="phoneNumber" class="sr-only">No Telephone</label>
                    <input type="tel" name="nomor_telephone" id="phoneNumber" class="form-control"
                        placeholder="Nomor Telepon / WA">
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="sr-only">Alamat Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Alamat Email">
                </div>
                <div class="form-group mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="show-hamba-allah">
                        <label class="form-check-label" for="show-hamba-allah">Tampilkan Sebagai Hamba Allah</label>
                    </div>
                </div>
                <small class="text-danger text-wrap">*Data anda hanya digunakan untuk mengirim sertifikat penghargaan, tidak
                    akan
                    diarsipkan ke dalam sistem kami!!</small>
            </section>
            <h3>Langkah Kedua</h3>
            <section>
                <h5 class="bd-wizard-step-title">Langkah Kedua</h5>
                <h2 class="section-heading">Masukan Nominal Wakaf</h2>
                <div class="card card-body mb-3" style="max-width: 550px;">
                    <input type="hidden" name="nominal" id="nominal">
                    <div class="input-nominal-container">
                        <button class="btn-decreas" type="button" id="btn-decreas"><i class="fas fa-minus"></i></button>
                        <span class="field-nominal" id="render-nominal"></span>
                        <button class="btn-increas" type="button" id="btn-increas"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card card-body" style="max-width: 550px;">
                    <div class="row justify-content-center">
                        <div class="col-md-6 list-nominal-body" onclick="cangeNominal(100000)">
                            <h3>Rp. 100.000</h3>
                        </div>
                        <div class="col-md-6 list-nominal-body" onclick="cangeNominal(200000)">
                            <h3>Rp. 200.000</h3>
                        </div>
                        <div class="col-md-6 list-nominal-body" onclick="cangeNominal(300000)">
                            <h3>Rp. 300.000</h3>
                        </div>
                        <div class="col-md-6 list-nominal-body" onclick="cangeNominal(400000)">
                            <h3>Rp. 400.000</h3>
                        </div>
                        <div class="col-md-6 list-nominal-body" onclick="cangeNominal(500000)">
                            <h3>Rp. 500.000</h3>
                        </div>
                        <div class="col-md-6 list-nominal-body" onclick="cangeNominal(600000)">
                            <h3>Rp. 600.000</h3>
                        </div>
                    </div>
                    <div class="form-group mb-3 mt-3">
                        <input type="number" name="custom-nominal" id="custom-nominal"
                            placeholder="Atau Masukan Nominal Anda, Minimum Rp. 100.000,00" min="100000"
                            class="form-control">
                        <small id="error-message" class="text-danger" style="display: none;">Nominal harus minimal Rp.
                            100,000,00</small>
                    </div>
                </div>
            </section>
            <h3>Pilih Metode Pembayaran</h3>
            <section>
                <h5 class="bd-wizard-step-title">Pilih Metode Pembayaran</h5>
                <h2 class="section-heading mb-5">Silahkan Pilih Metode Pembayaran </h2>
                <div id="embed-payment-container" class="w-100"></div>
            </section>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .input-nominal-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .input-nominal-container .btn-increas {
            max-width: max-content;
            height: max-content;
            padding: 0.5rem;
            border: none;
            outline: transparent;
            background-color: var(--bs-primary);
            color: var(--bs-white);
            border-radius: 5px;
        }

        .input-nominal-container .btn-decreas {
            max-width: max-content;
            height: max-content;
            padding: 0.5rem;
            border: none;
            outline: transparent;
            background-color: var(--bs-primary);
            color: var(--bs-white);
            border-radius: 5px;
        }

        .input-nominal-container .field-nominal {
            width: 100%;
            padding: 0.3rem;
            border: none;
            outline: transparent;
            background-color: var(--bs-light);
            color: var(--bs-primary);
            border-radius: 5px;
            font-size: 1.8rem;
            text-align: center;
        }

        .input-nominal-container .field-nominal:hover::-webkit-inner-spin-button {
            display: none;
            -webkit-appearance: none;
        }

        .input-nominal-container .field-nominal:active::-webkit-inner-spin-button {
            display: none;
        }

        .input-nominal-container .field-nominal:focus::-webkit-inner-spin-button {
            display: none;
        }

        .list-nominal-body {
            background-color: var(--bs-light);
            padding: 0.3rem;
            border-radius: 5px;
            width: 100%;
            text-align: center;
            color: var(--bs-dark);
            margin: 0.5rem 0.5rem 0.5rem 0.5rem;
        }

        .list-nominal-body:hover h3 {
            color: var(--bs-white);
        }

        .list-nominal-body:hover {
            background-color: var(--bs-primary);
            cursor: pointer;
        }

        #custom-nominal::-webkit-inner-spin-button {
            display: none;
        }
    </style>
@endpush
@push('js')
    <script type="text/javascript" src="{{ env('MIDTRANS_LIB_URL') }}" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>
    <script src="{{ asset('modules/frontend/js/jquery.steps.min.js') }}"></script>
    <script type="text/javascript">
        $('#mnWakaf').addClass('active');
        $("#wizard").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "none",
            stepsOrientation: "vertical",
            titleTemplate: '<span class="number">#index#</span>',
            onFinishing: function() {
                alert('Sedang Proses...');
            },
            onStepChanging: function(event, currentIndex, newIndex) {

                if ($('#show-hamba-allah').is(':checked')) {
                    $('#nama_depan').val('hamba_allah');
                    $('#nama_belakang').val('hamba_allah');

                    if (currentIndex == 1) {
                        $.ajax({
                            url: '{{ route('frontend.wakaf.payment', ':id') }}'.replace(':id',
                                '{{ $wakaf->id }}'),
                            method: 'post',
                            data: {
                                _token: '{{ csrf_token() }}',
                                nominal: $('#nominal').val(),
                                nama_depan: $('#nama_depan').val(),
                                nama_belakang: $('#nama_belakang').val(),
                                phoneNumber: $('#phoneNumber').val(),
                                email: $('#email').val(),
                                is_hamba: $('#show-hamba-allah').val()
                            },
                            success: function(response) {
                                if (response.status == 200) {

                                    window.snap.embed(response.data, {
                                        embedId: 'embed-payment-container',
                                        onSuccess: function(result) {
                                            window.location.replace(
                                                `{{ route('payment.handle') }}/?order_id=${result.order_id}&transaction_status=${result.transaction_status}&wakaf_id={{ $wakaf->id }}`
                                            );
                                        },
                                        onPending: function(result) {
                                            let mess =
                                                `Menunggu pembayaran pada transaksi ${result.order_id} anda`;
                                            Toast(mess, 'warning');
                                            window.location.replace(
                                                `{{ route('payment.handle') }}/?order_id=${result.order_id}&transaction_status=${result.transaction_status}&wakaf_id={{ $wakaf->id }}`
                                            );

                                        },
                                        onError: function(result) {
                                            /* You may add your own implementation here */
                                            window.location.replace(
                                                `{{ route('payment.handle') }}/?order_id=${result.order_id}&transaction_status=${result.transaction_status}&wakaf_id={{ $wakaf->id }}`
                                            );
                                        },
                                        onClose: function() {
                                            /* You may add your own implementation here */
                                            if (confirm(
                                                    'Apakah anda yakin ingin membatalkan transaksi ini ?'
                                                )) {
                                                Toast('Transaksi dibatalkan', 'danger');
                                            }
                                        }
                                    });
                                }
                            },
                            error: function(err) {
                                console.log(err);

                            }
                        })
                    }
                    return true;
                } else {
                    if ($('#nama_depan').val() == '' || $('#nama_belakang').val() == '' || $('#phoneNumber')
                        .val() == '' || $('#email').val() == '') {
                        alert('Tolong isi semua kolom');
                        return false;
                    }
                    if (currentIndex == 1) {
                        console.log('Fetch Data');

                        $.ajax({
                            url: '{{ route('frontend.wakaf.payment', ':id') }}'.replace(':id',
                                '{{ $wakaf->id }}'),
                            method: 'post',
                            data: {
                                _token: '{{ csrf_token() }}',
                                nominal: $('#nominal').val(),
                                nama_depan: $('#nama_depan').val(),
                                nama_belakang: $('#nama_belakang').val(),
                                phoneNumber: $('#phoneNumber').val(),
                                email: $('#email').val(),
                                is_hamba: $('#show-hamba-allah').val()
                            },
                            success: function(response) {
                                if (response.status == 200) {
                                    console.log(response.data);

                                    window.snap.embed(response.data, {
                                        embedId: 'embed-payment-container',
                                        onSuccess: function(result) {
                                            window.location.replace(
                                                `{{ route('payment.handle') }}/?order_id=${result.order_id}&transaction_status=${result.transaction_status}&wakaf_id={{ $wakaf->id }}`
                                            );
                                        },
                                        onPending: function(result) {
                                            let mess =
                                                `Menunggu pembayaran pada transaksi ${result.order_id} anda`;
                                            Toast(mess, 'warning');

                                        },
                                        onError: function(result) {
                                            /* You may add your own implementation here */
                                            window.location.replace(
                                                `{{ route('payment.handle') }}/?order_id=${result.order_id}&transaction_status=${result.transaction_status}&wakaf_id={{ $wakaf->id }}`
                                            );
                                        },
                                        onClose: function() {
                                            /* You may add your own implementation here */
                                            if (confirm(
                                                    'Apakah anda yakin ingin membatalkan transaksi ini ?'
                                                )) {
                                                Toast('Transaksi dibatalkan', 'danger');
                                            }
                                        }
                                    });
                                }
                            },
                            error: function(err) {
                                console.log(err);

                            }
                        })
                    }
                    return true;
                }

            }
        });
        $('#render-nominal').text('Rp. 100.000,00');
        $('#nominal').val(100000);

        function cangeNominal(nominal) {
            $('#nominal').val(nominal);
            const noms = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            })
            $('#render-nominal').text(noms.format(nominal));
        }

        $('#btn-increas').click(function() {
            const nominal = $('#nominal').val();
            cangeNominal(parseInt(nominal) + 50000);
        });

        $('#btn-decreas').click(function() {
            const nominal = $('#nominal').val();
            if (nominal <= 100000) {
                $('#nominal').val(100000);
                $('#render-nominal').text('Rp. 100.000,00');
            } else {
                cangeNominal(parseInt(nominal) - 50000);
            }
        });

        $('#custom-nominal').on('input', function() {
            let nominal = parseInt($(this).val());

            if (nominal < 100000) {
                $('#error-message').show();
                cangeNominal(100000);
            } else {
                $('#error-message').hide();
                cangeNominal(nominal);
            }
        });

        $('#show-hamba-allah').change(function() {
            if ($(this).is(':checked')) {
                $('.default-form-name').hide();
            } else {
                $('.default-form-name').show();
            }
        })
    </script>
@endpush
