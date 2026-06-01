<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Your Cart</h1>

        @if(empty($cart))
            <p class="text-gray-500">Your cart is empty. <a href="{{ route('products.index') }}" class="text-[#541A1A] hover:underline font-medium">Shop now</a></p>
        @else
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="text-left p-3">Product</th>
                        <th class="p-3">Qty</th>
                        <th class="p-3">Price</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cart as $id => $item)
                    <tr class="border-b">
                        <td class="p-3">{{ $item['name'] }}</td>
                        <td class="p-3 text-center">
                            <form method="POST" action="{{ route('cart.update', $id) }}" class="inline">
                                @csrf @method('PUT')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                    onchange="this.form.submit()"
                                    class="w-16 border rounded text-center">
                            </form>
                        </td>
                        <td class="p-3 text-center">RM{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        <td class="p-3 text-center">
                            <form method="POST" action="{{ route('cart.remove', $id) }}">
                                @csrf @method('DELETE')
                                <button class="text-red-500 hover:underline">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-4 text-right">
                <p class="text-xl font-bold">Total: RM{{ number_format($total, 2) }}</p>
                <form method="POST" action="{{ route('cart.order') }}" class="mt-3">
                    @csrf
                    <button class="bg-[#541A1A] text-white px-8 py-3 rounded-lg hover:bg-[#3a1212] transition-colors duration-150">
                        Place Order
                    </button>
                </form>
            </div>
        @endif
    </div>
</x-app-layout>