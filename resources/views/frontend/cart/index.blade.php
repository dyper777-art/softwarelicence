@extends('frontend.layout.master')

@section('content')
    <x-top-padding></x-top-padding>

    <!-- Team Section -->
    <section id="services" class="services section hero">

        <div class="container-xxl bg-light my-6 py-6 pb-0">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s"
                    style="max-width: 500px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                    <h1 class="display-6 mb-4">YOUR CART</h1>
                </div>
                <div class="bg-primary text-light rounded-top p-5 my-6 mb-0 wow fadeInUp" data-wow-delay="0.1s"
                    style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                    <div class="row align-items-center">
                        @foreach ($cartItems as $cartItem)
                            <div class="col-md-12">
                                <x-cart :cartItem="$cartItem"></x-cart>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if ($cartItems->isEmpty())
            <div class="container">

                <div class="row gy-4 mt-5 mb-5">

                    <div class="col-lg-12 col-md-12 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item row d-flex gap-1">

                            <div class="col-lg-4 col-md-4 justify-content-center align-items-center d-flex">
                                <h3>YOUR CART ARE EMPTY</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @else
            <div class="container">

                <div class="row gy-4 mt-4">


                    <div class="col-lg-12 col-md-12 aos-init aos-animate d-flex justify-content-end" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="service-item row d-flex gap-1">


                            <div class="col-lg-12 col-md-12 justify-content-center align-items-center d-flex">
                                <a href="#" onclick="showBakongQR()" class="btn btn-primary rounded-pill p-3"
                                    data-bs-toggle="modal" data-bs-target="#bakongModal">
                                    Check Out
                                </a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        @endif

    </section>

    <div class="modal fade" id="bakongModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Bakong Payment QR</h5>
                </div>

                <div class="modal-body text-center">
                    <img id="qrImage" alt="Bakong QR Code" style="width:250px; height:250px;">
                    <p class="mt-3" id="paymentAmount">Total Amount: $0</p>
                    <p class="mt-3">Scan with Bakong App to Pay</p>
                    <button class="btn btn-success" id="pay-manually-btn">Pay Manually</button>
                </div>

            </div>
        </div>
    </div>


    <script>
        let pollingInterval;

        function showBakongQR() {


            fetch('{{ route('checkout.generateQR') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    document.getElementById('qrImage').src = data.qrUrl;
                    document.getElementById('paymentAmount').innerText = 'Total Amount: $ ' + data.amount;

                    const modalEl = document.getElementById('bakongModal');
                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();

                    // Start polling
                    if (pollingInterval) clearInterval(pollingInterval);
                    pollingInterval = setInterval(async () => {
                        try {
                            const resp = await fetch('{{ route('checkout.checkPayment') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    md5: data.md5 // or pass from generateQR response
                                })
                            });

                            const result = await resp.json();

                            if (result.paid) {
                                clearInterval(pollingInterval);
                                modal.hide();
                                window.location.href = "{{ route('home') }}?payment=success";
                            }
                        } catch (err) {
                            console.error('Polling error:', err);
                        }
                    }, 4000);

                })
                .catch(err => {
                    console.error(err);
                    alert('Failed to generate QR code: ' + err.message);
                });
        }

        // Cancel polling
        document.getElementById('cancelPaymentBtn')?.addEventListener('click', () => {
            clearInterval(pollingInterval);
        });
    </script>

    <script>
        document.getElementById('pay-manually-btn').addEventListener('click', async function() {
            if (!confirm("Are you sure you want to mark this order as paid manually?")) return;

            const modalEl = document.getElementById('bakongModal');
            const modal = new bootstrap.Modal(modalEl);

            try {
                const resp = await fetch('{{ route('checkout.manualPayment') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const result = await resp.json();

                if (result.paid) { // match your controller JSON key
                    clearInterval(pollingInterval); // if using polling
                    modal.hide();
                    window.location.href = "{{ route('home') }}?payment=success";
                } else {
                    alert('Error: ' + (result.error || 'Something went wrong'));
                }
            } catch (err) {
                console.error(err);
                alert('Network or server error');
            }
        });
    </script>
@endsection
