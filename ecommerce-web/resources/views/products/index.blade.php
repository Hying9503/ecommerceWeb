<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Products</h1>

        <script>
            // Pass necessary data and Laravel environment variables to Vue
            window.initialProducts = @json($products);
            window.csrfToken = "{{ csrf_token() }}";
            window.isAuthenticated = @json(auth()->check());
            window.loginRoute = "{{ route('login') }}";
            
            // Pass a template route using a dummy ID (999999) so Vue can replace it with the real ID
            window.cartAddRouteTemplate = "{{ route('cart.add', 999999) }}";
        </script>
        <div id="vue-app"></div>

        <div id="blade-product-grid" style="display:grid; grid-template-columns: repeat(3, 1fr); gap:24px; margin-top:24px;">
            @foreach($products as $product)
            <div id="product-{{ $product->id }}" style="background:white; border:1px solid #e5e7eb; border-radius:12px; overflow:hidden; display:flex; flex-direction:column; min-width:0;">
                @if($product->image)
                    <img src="{{ asset($product->image) }}" 
                         alt="{{ $product->name }}"
                         style="width:100%; height:200px; object-fit:contain; object-position:center; display:block; flex-shrink:0; min-height:200px; max-height:200px; padding:16px; box-sizing:border-box;">
                @else
                    <div style="width:100%; height:200px; background:#f3f4f6; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <span style="color:#9ca3af;">No image</span>
                    </div>
                @endif
                <div style="padding:16px; display:flex; flex-direction:column; flex:1;">
                    <h3 style="font-weight:600; font-size:18px; margin-bottom:8px;">{{ $product->name }}</h3>
                    <p style="color:#6b7280; font-size:14px; margin-bottom:8px;">{{ $product->description }}</p>
                    <p style="font-size:20px; font-weight:700; margin-bottom:4px;">RM{{ number_format($product->price, 2) }}</p>
                    <p style="color:#9ca3af; font-size:14px; margin-bottom:16px;">Stock: {{ $product->stock }}</p>
                    <div style="margin-top:auto;">
                        @auth
                        <form method="POST" action="{{ route('cart.add', $product->id) }}">
                            @csrf
                            <button type="submit" style="width:100%; background:#541A1A; color:white; border:none; border-radius:8px; padding:10px; font-size:15px; cursor:pointer;">
                                Add to Cart
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" style="display:block; text-align:center; background:#e5e7eb; border-radius:8px; padding:10px; text-decoration:none; color:#374151;">
                            Login to buy
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>