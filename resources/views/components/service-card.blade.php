<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s"
    style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
    <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
        <div class="text-center p-4">
            <div class="d-inline-block border border-primary rounded-pill px-3 mb-3">${{ $product->price }}
            </div>
            <h3 class="mb-3">{{ $product->name }}</h3>
            <span>{{ $product->description }}</span>
        </div>
        <div class="position-relative mt-auto">
            <img class="img-fluid" src="{{ asset($product->image) }}" alt="">
            <div class="product-overlay d-flex gap-5">
                <a class="btn btn-lg-square btn-outline-light rounded-circle"
                    href="{{ route('product.show', $product->id) }}"><i class="fa fa-eye text-primary"></i></a>
                <form method="POST" action="{{ route('cart.add', $product->id) }}"
                    id="add-to-cart-{{ $product->id }}">
                    @csrf
                    <a href="#" class="btn btn-lg-square btn-outline-light rounded-circle"
                        onclick="event.preventDefault(); document.getElementById('add-to-cart-{{ $product->id }}').submit();">
                        <i class="bi bi-cart"></i>
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
