


<div class="col-lg-12 col-md-12 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
    <div class="service-item row d-flex gap-1">

        <div class="col-lg-4 col-md-4 justify-content-center align-items-center d-flex">
            <h3>{{ $cartItem->product->name }}</h3>
        </div>

        <div class="col-lg-1 col-md-1 justify-content-center align-items-center d-flex">
            <h4>$</h4>
            <h4>{{ $cartItem->product->price }}</h4>
        </div>

        <div class="col-lg-4 col-md-4 justify-content-center align-items-center d-flex gap-5">

            <form id="decrease-{{ $cartItem->id }}" action="{{ route('cart.decrease', $cartItem->id) }}" method="POST">
                @csrf
                <a href="#"
                    onclick="event.preventDefault(); document.getElementById('decrease-{{ $cartItem->id }}').submit();">
                    <i class="bi bi-dash text-dark fs-1"></i>
                </a>
            </form>

            <h4>{{ $cartItem->quantity }}</h4>

            <form id="increase-{{ $cartItem->id }}" action="{{ route('cart.increase', $cartItem->id) }}" method="POST">
                @csrf
                <a href="#"
                    onclick="event.preventDefault(); document.getElementById('increase-{{ $cartItem->id }}').submit();">
                    <i class="bi bi-plus text-dark fs-1"></i>
                </a>
            </form>

        </div>

        <div class="col-lg-1 col-md-1 justify-content-center align-items-center d-flex">
            <h4>$</h4>
            <h4>{{ $cartItem->product->price * $cartItem->quantity }}</h4>
        </div>
        <div class="col-lg-1 col-md-1 justify-content-center align-items-center d-flex">
            <form id="remove-{{ $cartItem->id }}" action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="#"
                    onclick="event.preventDefault(); document.getElementById('remove-{{ $cartItem->id }}').submit();">
                    <i class="bi bi-trash fs-1 text-danger"></i>
                </a>
            </form>
        </div>



    </div>
</div>
