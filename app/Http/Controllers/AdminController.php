<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Helper untuk memastikan user adalah admin.
     */
    protected function checkAdmin()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk Administrator.');
        }
    }

    /**
     * Tampilkan Dashboard Admin.
     */
    public function index()
    {
        $this->checkAdmin();

        $products = Product::orderBy('created_at', 'desc')->get();

        // Ambil daftar file gambar yang telah diunggah di public/uploads/
        $images = [];
        $uploadsPath = public_path('uploads');
        if (is_dir($uploadsPath)) {
            $files = scandir($uploadsPath);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])) {
                        $images[] = [
                            'name' => $file,
                            'url' => url('uploads/' . $file),
                            'size' => round(filesize($uploadsPath . '/' . $file) / 1024, 2) . ' KB',
                        ];
                    }
                }
            }
        }

        // Urutkan gambar berdasarkan waktu modifikasi terbaru
        usort($images, function($a, $b) use ($uploadsPath) {
            return filemtime($uploadsPath . '/' . $b['name']) - filemtime($uploadsPath . '/' . $a['name']);
        });

        return view('admin.dashboard', compact('products', 'images'));
    }

    /**
     * Simpan produk baru beserta upload gambar produk.
     */
    public function storeProduct(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        try {
            $imageUrl = '';
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $uploadsPath = public_path('uploads');
                
                // Pastikan folder uploads sudah ada
                if (!is_dir($uploadsPath)) {
                    mkdir($uploadsPath, 0755, true);
                }

                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->move($uploadsPath, $filename);
                $imageUrl = url('uploads/' . $filename);
            }

            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'image' => $imageUrl,
            ]);

            return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan produk: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Unggah gambar umum / aset toko.
     */
    public function uploadImage(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
        ]);

        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $uploadsPath = public_path('uploads');
                
                // Pastikan folder uploads sudah ada
                if (!is_dir($uploadsPath)) {
                    mkdir($uploadsPath, 0755, true);
                }

                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->move($uploadsPath, $filename);
                
                return redirect()->back()->with('success', 'Gambar berhasil diunggah!');
            }
            
            return redirect()->back()->with('error', 'Pilih file gambar terlebih dahulu.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengunggah gambar: ' . $e->getMessage());
        }
    }

    /**
     * Hapus produk lokal.
     */
    public function deleteProduct($id)
    {
        $this->checkAdmin();

        try {
            $product = Product::findOrFail($id);
            
            // Hapus file gambar jika ada di uploads lokal
            if ($product->image) {
                $filename = basename($product->image);
                $filePath = public_path('uploads/' . $filename);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            $product->delete();
            return redirect()->back()->with('success', 'Produk berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }

    /**
     * Hapus gambar aset dari disk.
     */
    public function deleteImage(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'name' => 'required|string',
        ]);

        try {
            $filename = $request->input('name');
            $filePath = public_path('uploads/' . $filename);
            
            if (file_exists($filePath)) {
                unlink($filePath);
                return redirect()->back()->with('success', 'Gambar berhasil dihapus dari server!');
            }

            return redirect()->back()->with('error', 'File tidak ditemukan di server.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus gambar: ' . $e->getMessage());
        }
    }
}
