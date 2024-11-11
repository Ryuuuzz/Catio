@extends('layouts.app')

@section('content')
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <style>
            .slide-in {
                opacity: 0;
                transform: translateY(20px);
                transition: opacity 0.5s ease, transform 0.5s ease;
            }
            .slide-in-active {
                opacity: 1;
                transform: translateY(0);
            }
        </style>
    </head>

    <body class="bg-gray-50 min-h-screen">

        <div class="h-[100vh] flex flex-col justify-center items-center space-y-20 px-6">
            <h1 class="text-gray-800 text-6xl md:text-7xl mt-32 font-extrabold text-center leading-tight">
                Selamat datang di Catio 
            </h1>

            <p class="text-gray-600 text-xl md:text-2xl text-center">
                Informasi tentang jenis-jenis kucing.
            </p>

            <a href="{{ route('login') }}" 
            @guest
                onclick="alert('Tolong buat akun / login terlebih dahulu');"
            @endguest
            class="px-3 py-3 bg-blue-600 text-white rounded-xl shadow-lg hover:bg-blue-700 transition text-lg">
            Beranda
        </a>


        </div>

        <hr class="border-t-4 border-gray-300 my-12 mx-16 md:mx-32">

        <!-- Tentang kami -->
        <div id="about" class="py-11 px-8 md:px-24 lg:px-40 bg-white shadow-md slide-in">
            <h2 class="text-4xl font-bold text-gray-800 text-center mb-10">
                Tentang kami
            </h2>
            <p class="text-gray-700 text-lg md:text-xl leading-relaxed text-center">
                Bingung mau kucing apa buat di adopsi, ayo liat-liat di website kami siapa tau ada yang cocok
            </p>
        </div>


        <!-- kontak -->
        <div class="flex flex-col items-center mt-5">
            <h1 class="text-sm mb-3">
                Contacts:
            </h1>
            <ul class="grid grid-cols-3 gap-5">
                <li class="flex flex-col items-center">
                    <a href="https://wa.me/YOUR_PHONE_NUMBER" target="_blank" class="flex flex-col items-center">
                        <i class="fa-duotone fab fa-whatsapp text-xl" style="color: #0ca678;"></i>
                    </a>
                </li>
                <li class="flex flex-col items-center">
                    <a href="https://www.instagram.com/professional.breather/" target="_blank" class="flex flex-col items-center">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                </li>
                <li class="flex flex-col items-center">
                    <a href="#" class="flex flex-col items-center">
                        <i class="fab fa-tiktok text-xl"></i>
                    </a>
                </li>
            </ul>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const aboutSection = document.getElementById('about');
                const observer = new IntersectionObserver(entries => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            aboutSection.classList.add('slide-in-active');
                        } else {
                            aboutSection.classList.remove('slide-in-active');
                        }
                    });
                });

                observer.observe(aboutSection);
            });
        </script>
    </body>
@endsection
