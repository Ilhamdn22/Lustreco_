<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - Lustreco</title>
    <!-- CDN Tailwind CSS untuk Tampilan Rapi -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800 border-b-2 border-gray-300 pb-2">
            Katalog Produk Lustreco
        </h1>

        @if($products->isEmpty())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded shadow-sm">
                <p class="font-bold">Data Produk Masih Kosong</p>
                <p>Silakan isi data produk ke database terlebih dahulu.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col justify-between p-4">
                        <div>
                            <img src="{{ $product->image ?? 'https://via.placeholder.com/300' }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md mb-4">
                            <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $product->name }}</h2>
                            <p class="text-gray-600 text-sm mb-4">{{ $product->description }}</p>
                        </div>
                        <div>
                            <div class="flex justify-between items-center my-2">
                                <span class="text-lg font-bold text-emerald-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="text-sm text-gray-500 bg-gray-200 px-2 py-1 rounded">Stok: {{ $product->stock }}</span>
                            </div>
                            <button class="w-full mt-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded transition duration-200">
                                Beli Sekarang
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>