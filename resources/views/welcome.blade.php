@extends('layouts.home')

@section('title',' - Inicio')

@push('css')

@endpush

@section('content')

<header class="antialiased">
    <!--nav class="bg-white border-b-2 border-gray-400 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center">
            <img src="{{asset('img/fisme.svg')}}" class="mx-auto h-14" alt="Fisme Logo" />
        </div>
        <button>Hola</button>
    </nav---->


    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{asset('img/fisme.svg')}}" class="mx-auto h-14" alt="Fisme Logo" />
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <a href="{{route('login')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Iniciar sesión</a>
                <button data-collapse-toggle="navbar-cta" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-cta" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Sistema de control de la Fisme</span>
            </div>
        </div>
    </nav>

</header>

<section class="bg-blue-400">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">

        <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">

            <!-- Proyectos de tesis-->
            <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                <h3 class="mb-4 text-2xl font-semibold">Gestión de proyectos de tesis</h3>
                <p class="font-light text-gray-700 sm:text-lg dark:text-gray-400">Eres egresado y buscar tramitar tu proyecto de tesis.</p>

                <a href="{{route('login')}}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center my-4">Ingresa aquí</a>
            </div>

            <!-- Trámite documentario -->
            <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                <h3 class="mb-4 text-2xl font-semibold">Trámite documentario externo</h3>
                <p class="font-light text-gray-700 sm:text-lg dark:text-gray-400">Quieres enviar un documento a la mesa de partes de la facultad.</p>

                <a href="{{route('login.tramite')}}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center my-4">Ingresa aquí</a>
            </div>

            <!-- Prácticas -->
            <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                <h3 class="mb-4 text-2xl font-semibold">Gestion de Prácticas preprofesionales</h3>
                <p class="font-light text-gray-700 sm:text-lg dark:text-gray-400">Quieres hacer tus prácticas y buscar tramitarlo.</p>

                <a href="{{route('practicante.auth.showLogin')}}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center my-4">Ingresa aquí</a>
            </div>

        </div>
    </div>
</section>


@endsection

@push('js')

@endpush