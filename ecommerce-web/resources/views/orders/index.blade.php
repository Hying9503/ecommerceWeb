<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">My Orders</h1>

        @foreach($orders as $order)
        <div class="border rounded-xl p-4 mb-4 shadow-sm">
            <div class="flex justify-between items-center">
                <div>
                    <p class="font-semibold">Order #{{ $order->id }}</p>
                    <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="font-bold">RM{{ number_format($order->total, 2) }}</p>
                    <form method="POST" action="{{ route('orders.updateStatus', $order->id) }}">
                        @csrf @method('PUT')
                        <select name="status" onchange="this.form.submit()"
                                class="border rounded pl-2 pr-8 py-1 text-sm mt-1 cursor-pointer">
                            @foreach(['pending','processing','completed','cancelled'] as $status)
                                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            <ul class="mt-3 text-sm text-gray-600">
                @foreach($order->items as $item)
                    <li>{{ $item->product->name }} × {{ $item->quantity }} — RM{{ number_format($item->price * $item->quantity, 2) }}</li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
</x-app-layout>