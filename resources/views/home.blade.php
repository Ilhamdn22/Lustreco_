@extends('layouts.store')

@section('title', 'lustreco® | Official Store')

@section('content')

    <!-- Hero Image Banner -->
    <div class="w-full h-screen relative overflow-hidden bg-gray-100">
        <img
            src="https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=1600&auto=format&fit=crop"
            alt="Lustreco Hero Banner"
            class="w-full h-full object-cover object-center object-[50%_30%]"
        >
    </div>

    <!-- Section Informasi Payment & Shipment -->
    <section class="py-12 bg-white border-t border-gray-100">
        <div class="max-w-5xl mx-auto px-4 text-center">

            <!-- Payment Method -->
            <div class="mb-10">
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-6">
                    Payment Method
                </h3>
                <div class="flex flex-wrap items-center justify-center gap-6 md:gap-8 opacity-80 hover:opacity-100 transition-opacity">
                    <img src="https://tse1.mm.bing.net/th/id/OIP.SJk3_1NbGUAvZ-bJslHM4wHaC0?r=0&pid=Api&P=0&h=180" alt="QRIS" class="h-6 object-contain">
                    <img src="https://tse1.mm.bing.net/th/id/OIP.BgWRZO7z2VuHDvJVh4q-0gHaCT?r=0&pid=Api&P=0&h=180" alt="OVO" class="h-5 object-contain">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg" alt="Mandiri" class="h-5 object-contain">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/68/BANK_BRI_logo.svg" alt="BRI" class="h-5 object-contain">
                    <img src="https://tse1.mm.bing.net/th/id/OIP.7ac-BBuYSK0mgmanTkM5hwHaCJ?r=0&pid=Api&P=0&h=180" alt="BNI" class="h-4 object-contain">
                    <img src="https://tse2.mm.bing.net/th/id/OIP.nisHwf4UfdBIJWh6EcVA6gHaB2?r=0&pid=Api&P=0&h=180" alt="Permata Bank" class="h-5 object-contain">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a0/Bank_Syariah_Indonesia.svg" alt="BSI" class="h-5 object-contain">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/CIMB_Niaga_logo.svg" alt="CIMB Niaga" class="h-5 object-contain">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" class="h-6 object-contain">
                </div>
            </div>

            <!-- Shipment Method -->
            <div>
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">
                    Shipment Method
                </h3>
                <div class="flex justify-center items-center opacity-80">
                    <img src="https://tse4.mm.bing.net/th/id/OIP.2j4gL2L4bv2w5hByr8syMgHaC-?r=0&pid=Api&P=0&h=180" alt="JNE Express" class="h-7 object-contain">
                </div>
            </div>

        </div>
    </section>

@endsection