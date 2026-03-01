<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SyA Group · Sangüesa y Asociados</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Topographic radial pattern */
        .topo-pattern {
            background-image:
                repeating-radial-gradient(ellipse at 65% 50%, transparent 0, transparent 52px, rgba(255,255,255,0.03) 52px, rgba(255,255,255,0.03) 53px),
                repeating-radial-gradient(ellipse at 65% 50%, transparent 0, transparent 90px, rgba(255,255,255,0.02) 90px, rgba(255,255,255,0.02) 91px);
        }

        /* Diagonal clip */
        .clip-hero { clip-path: polygon(0 0, 100% 0, 100% 92%, 0 100%); }
        .clip-inv  { clip-path: polygon(0 4%, 100% 0, 100% 100%, 0 100%); }

        /* Animations */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes floatY {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-10px); }
        }

        .anim-1 { animation: fadeUp .7s .00s cubic-bezier(.22,1,.36,1) both; }
        .anim-2 { animation: fadeUp .7s .12s cubic-bezier(.22,1,.36,1) both; }
        .anim-3 { animation: fadeUp .7s .24s cubic-bezier(.22,1,.36,1) both; }
        .anim-4 { animation: fadeUp .7s .36s cubic-bezier(.22,1,.36,1) both; }
        .float  { animation: floatY 5s ease-in-out infinite; }

        /* Navbar scroll */
        .nav-solid {
            background: rgba(2, 82, 131, 0.97) !important;
            backdrop-filter: blur(12px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.2);
        }

        /* Card hover */
        .service-card {
            transition: transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s ease;
        }
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(3,103,166,0.10);
        }

        /* Underline grow on hover */
        .underline-grow::after {
            content: '';
            display: block;
            height: 2px;
            width: 0;
            background: #ff8c42;
            border-radius: 99px;
            transition: width .4s ease;
            margin-top: 10px;
        }
        .service-card:hover .underline-grow::after { width: 100%; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800 overflow-x-hidden">

{{-- ════════════════════════════
     NAVBAR
════════════════════════════ --}}
<nav id="navbar" class="fixed top-0 inset-x-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="flex justify-between items-center py-4">

            <a href="#" class="flex items-center gap-2.5 group">
                <div class="w-9 h-9 rounded-xl bg-orange flex items-center justify-center shadow-md transition-transform group-hover:scale-105">
                    <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17 8C8 10 5.9 16.17 3.82 21.34L5.71 22l1-2.3A4.49 4.49 0 008 20C19 20 22 3 22 3c-1 2-8 5-8 5H14C8 8 6 12.5 6 12.5A5.5 5.5 0 0117 8z"/>
                    </svg>
                </div>
                <span class="text-white font-semibold text-lg tracking-wide">SyA <span class="font-light opacity-70">Group</span></span>
            </a>

            <div class="hidden md:flex items-center gap-8">
                <a href="#servicios" class="text-white/75 hover:text-white text-sm font-medium transition-colors">Servicios</a>
                <a href="#nosotros"  class="text-white/75 hover:text-white text-sm font-medium transition-colors">Nosotros</a>
                <a href="#impacto"   class="text-white/75 hover:text-white text-sm font-medium transition-colors">Impacto</a>
                <a href="#contacto"  class="text-white/75 hover:text-white text-sm font-medium transition-colors">Contacto</a>
            </div>

            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="text-sm font-semibold px-4 py-2 rounded-xl bg-orange hover:bg-orange-dark text-white shadow-md transition-all hover:shadow-lg">
                            Dashboard
                        </a>
                    @else
                        @if (Route::has('login'))
                        <a href="{{ route('login') }}"
                           class="text-sm font-semibold px-4 py-2 rounded-xl bg-orange hover:bg-orange-dark text-white shadow-md transition-all hover:shadow-lg">
                            Iniciar Sesión
                        </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>

{{-- ════════════════════════════
     HERO
════════════════════════════ --}}
<section class="relative bg-blue-dark topo-pattern clip-hero overflow-hidden" style="min-height: 100vh; padding-top: 5rem;">

    {{-- Glows decorativos --}}
    <div class="absolute top-1/3 right-0 w-[600px] h-[600px] rounded-full opacity-10 pointer-events-none"
         style="background: radial-gradient(circle, #0480cc 0%, transparent 65%);"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 rounded-full opacity-10 pointer-events-none"
         style="background: radial-gradient(circle, #ff8c42 0%, transparent 70%);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-5 lg:px-8 flex flex-col lg:flex-row items-center gap-14 py-28 md:py-36">

        {{-- Copy principal --}}
        <div class="flex-1">
            <div class="anim-1 inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-medium tracking-widest uppercase mb-6
                        border border-white/15 text-white/65"
                 style="background: rgba(255,255,255,0.08);">
                <span class="w-1.5 h-1.5 rounded-full bg-green animate-pulse"></span>
                Fundada en 2003 · México
            </div>

            <h1 class="anim-2 text-5xl md:text-6xl font-bold text-white leading-tight mb-6">
                Asesoría ambiental<br>
                <span class="text-orange font-light italic">con propósito.</span>
            </h1>

            <p class="anim-3 text-lg font-light leading-relaxed text-white/60 max-w-[520px] mb-10">
                Más de 20 años acompañando a empresas e instituciones en el cumplimiento normativo, gestión ambiental y desarrollo sostenible en México y Latinoamérica.
            </p>

            <div class="anim-4 flex flex-wrap gap-4">
                <a href="#servicios"
                   class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl font-semibold text-sm text-white bg-orange hover:bg-orange-dark shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                    Nuestros servicios
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="#nosotros"
                   class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl font-semibold text-sm text-white transition-all hover:scale-105"
                   style="background: rgba(255,255,255,0.10); border: 1px solid rgba(255,255,255,0.20);">
                    Conoce SyA Group
                </a>
            </div>
        </div>

        {{-- Visual flotante --}}
        <div class="hidden lg:flex flex-col gap-4 flex-shrink-0 float">
            <div class="w-72 rounded-2xl p-6 shadow-2xl"
                 style="background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12);">
                <div class="w-11 h-11 rounded-xl bg-blue flex items-center justify-center mb-4 shadow-md">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="font-semibold text-white text-base mb-1">Gestión Ambiental</p>
                <p class="text-sm font-light text-white/50">MIA · Auditorías · Licenciamiento</p>
                <div class="mt-5 flex gap-1.5">
                    <div class="h-1.5 flex-1 rounded-full bg-green"></div>
                    <div class="h-1.5 w-10 rounded-full" style="background: rgba(255,255,255,0.2);"></div>
                    <div class="h-1.5 w-5 rounded-full"  style="background: rgba(255,255,255,0.1);"></div>
                </div>
            </div>

            <div class="self-end w-52 rounded-xl p-4 shadow-xl"
                 style="background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12);">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-orange flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white text-xs font-semibold">+20 años</p>
                        <p class="text-white/50 text-xs">de experiencia</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats bar --}}
    <div class="relative z-10 max-w-7xl mx-auto px-5 lg:px-8 pb-32">
        <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-white/10 rounded-2xl overflow-hidden shadow-2xl"
             style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.10);">
            @foreach([
                ['México', 'Sede principal'],
                ['+200',   'Proyectos entregados'],
                ['2003',   'Año de fundación'],
            ] as $stat)
            <div class="px-6 py-5">
                <p class="text-2xl md:text-3xl font-bold text-white">{{ $stat[0] }}</p>
                <p class="text-xs font-light mt-1 text-white/45">{{ $stat[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ════════════════════════════
     SERVICIOS
════════════════════════════ --}}
<section id="servicios" class="py-24 md:py-32 bg-gray-50">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="mb-14">
            <span class="inline-flex items-center gap-1.5 text-xs font-semibold tracking-widest uppercase text-blue mb-3">
                <span class="w-5 h-px bg-blue inline-block"></span>
                ¿Qué hacemos?
            </span>
            <h2 class="text-4xl md:text-5xl font-bold text-blue-dark leading-tight">
                Soluciones ambientales<br>
                <span class="text-orange font-light italic">integrales.</span>
            </h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
            @php
            $servicios = [
                ['MIA', 'Manifestaciones de Impacto Ambiental',    'Elaboración y tramitación ante la SEMARNAT para proyectos de infraestructura, industria y desarrollo.',                                'text-blue-dark', 'bg-blue-dark/10', 'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7'],
                ['ADA', 'Auditorías y Diagnósticos Ambientales',    'Evaluación del desempeño ambiental de instalaciones, identificando riesgos, pasivos y oportunidades de mejora.',                   'text-green',     'bg-green/10',     'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                ['TLA', 'Trámites de Licenciamiento Ambiental',     'Gestión integral ante autoridades federales, estatales y municipales para permisos y autorizaciones ambientales.',                   'text-blue',      'bg-blue/10',      'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ['GRP', 'Gestión de Residuos Peligrosos',           'Planes de manejo y manifiestos conforme a las NOM vigentes para el correcto tratamiento de residuos peligrosos.',                    'text-red',       'bg-red/10',       'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16'],
                ['MMA', 'Monitoreo y Muestreo Ambiental',           'Campañas de monitoreo de calidad del agua, suelo y aire con laboratorio acreditado para reportes ante autoridades.',                 'text-blue-light','bg-blue-light/10','M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
                ['CCE', 'Capacitación y Consultoría Estratégica',   'Programas de capacitación en legislación ambiental, sustentabilidad y gestión de riesgos para equipos operativos y directivos.',   'text-orange',    'bg-orange/10',    'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
            ];
            @endphp

            @foreach($servicios as [$abbr, $title, $desc, $ic, $ibg, $path])
            <div class="service-card bg-white rounded-2xl p-7 shadow-sm border border-gray-100 group cursor-default">
                <div class="flex items-start justify-between mb-5">
                    <div class="w-11 h-11 rounded-xl {{ $ibg }} flex items-center justify-center transition-transform group-hover:scale-110">
                        <svg class="w-5 h-5 {{ $ic }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $path }}"/>
                        </svg>
                    </div>
                    <span class="text-xs font-bold tracking-widest px-2 py-1 rounded-lg {{ $ic }} {{ $ibg }}">{{ $abbr }}</span>
                </div>
                <h3 class="font-semibold text-blue-dark text-base mb-2.5 underline-grow">{{ $title }}</h3>
                <p class="text-sm font-light leading-relaxed text-gray-500">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ════════════════════════════
     NOSOTROS
════════════════════════════ --}}
<section id="nosotros" class="py-24 md:py-32 clip-inv bg-blue-dark relative overflow-hidden">
    <div class="absolute inset-0 topo-pattern pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 rounded-full opacity-10 pointer-events-none"
         style="background: radial-gradient(circle, #ff8c42 0%, transparent 70%);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-5 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <div>
                <span class="inline-flex items-center gap-1.5 text-xs font-semibold tracking-widest uppercase text-orange mb-4">
                    <span class="w-5 h-px bg-orange inline-block"></span>
                    Quiénes somos
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-8">
                    Sangüesa y<br>
                    <span class="text-blue-light font-light italic">Asociados Limitada.</span>
                </h2>
                <div class="space-y-4 text-base font-light leading-relaxed text-white/60">
                    <p>Somos una empresa mexicana fundada en 2003, especializada en asesorías y servicios ambientales técnicos para los sectores industrial, energético, agropecuario y de infraestructura.</p>
                    <p>A lo largo de más de dos décadas, hemos desarrollado proyectos en todo el territorio nacional, conciliando el desarrollo económico con el cuidado del entorno natural.</p>
                    <p>Nuestro equipo multidisciplinario de biólogos, ingenieros ambientales y especialistas jurídicos garantiza una asesoría integral con rigor técnico-legal.</p>
                </div>
                <div class="mt-8 flex flex-wrap gap-2.5">
                    @foreach(['NOM Compliance','SEMARNAT','ISO 14001','LGEEPA','Sustentabilidad'] as $tag)
                    <span class="text-xs font-medium px-3 py-1.5 rounded-full text-white/65 border border-white/15"
                          style="background: rgba(255,255,255,0.07);">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                @foreach([
                    ['Rigor técnico',     'Metodologías validadas y profesionales certificados en cada proyecto.',        'bg-blue',       '🔬'],
                    ['Cumplimiento legal','Conocimiento profundo de la legislación ambiental mexicana vigente.',          'bg-orange',     '⚖️'],
                    ['Sostenibilidad',    'Soluciones que equilibran el desarrollo económico y la conservación natural.',  'bg-green',      '🌿'],
                    ['Confianza',         '+20 años siendo aliados estratégicos de nuestros clientes en México.',         'bg-blue-light', '🤝'],
                ] as [$titulo, $texto, $accent, $icon])
                <div class="rounded-2xl p-5 border border-white/10" style="background: rgba(255,255,255,0.06);">
                    <div class="text-2xl mb-3">{{ $icon }}</div>
                    <p class="font-semibold text-white text-sm mb-1.5">{{ $titulo }}</p>
                    <p class="text-xs font-light leading-relaxed text-white/45">{{ $texto }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════
     IMPACTO
════════════════════════════ --}}
<section id="impacto" class="py-24 md:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="text-center mb-14">
            <span class="inline-flex items-center gap-1.5 text-xs font-semibold tracking-widest uppercase text-blue mb-3">
                <span class="w-5 h-px bg-blue inline-block"></span>
                Nuestro alcance
                <span class="w-5 h-px bg-blue inline-block"></span>
            </span>
            <h2 class="text-4xl md:text-5xl font-bold text-blue-dark">Impacto que se mide.</h2>
        </div>

        <div class="grid md:grid-cols-4 gap-5 mb-20">
            @foreach([
                ['+200', 'Proyectos ambientales completados en todo México',   'border-blue-dark', 'text-blue-dark'],
                ['+80',  'Clientes activos en sectores industriales y públicos','border-orange',    'text-orange'],
                ['22',   'Años de trayectoria ininterrumpida en el sector',     'border-green',     'text-green'],
                ['100%', 'Comprometidos con el cumplimiento normativo',         'border-blue',      'text-blue'],
            ] as [$num, $desc, $border, $color])
            <div class="text-center p-8 rounded-2xl bg-gray-50 border border-gray-100 shadow-sm border-t-4 {{ $border }}">
                <p class="text-5xl font-bold mb-3 {{ $color }}">{{ $num }}</p>
                <p class="text-sm font-light text-gray-500 leading-snug">{{ $desc }}</p>
            </div>
            @endforeach
        </div>

        {{-- CTA --}}
        <div id="contacto" class="relative overflow-hidden rounded-3xl p-10 md:p-16 text-center bg-blue-dark shadow-2xl">
            <div class="absolute inset-0 topo-pattern pointer-events-none"></div>
            <div class="absolute top-0 right-0 w-64 h-64 rounded-full opacity-15 pointer-events-none"
                 style="background: radial-gradient(circle, #ff8c42 0%, transparent 70%); transform: translate(30%,-30%);"></div>

            <div class="relative z-10">
                <h3 class="text-3xl md:text-4xl font-bold text-white mb-4">¿Tienes un proyecto ambiental?</h3>
                <p class="text-lg font-light text-white/60 mb-10 max-w-lg mx-auto">
                    Cuéntanos tu caso. Un especialista te contactará sin costo ni compromiso.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="mailto:contacto@syagroup.com.mx"
                       class="inline-flex items-center justify-center gap-2 px-7 py-4 rounded-xl font-semibold text-sm text-white bg-orange hover:bg-orange-dark shadow-lg transition-all hover:scale-105">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Enviar consulta
                    </a>
                    <a href="https://wa.me/521XXXXXXXXXX"
                       class="inline-flex items-center justify-center gap-2 px-7 py-4 rounded-xl font-semibold text-sm text-white transition-all hover:scale-105"
                       style="background: rgba(255,255,255,0.10); border: 1px solid rgba(255,255,255,0.20);">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════
     FOOTER
════════════════════════════ --}}
<footer class="bg-gray-900 text-gray-400">
    <div class="max-w-7xl mx-auto px-5 lg:px-8 py-12">
        <div class="grid md:grid-cols-4 gap-10 pb-10 border-b border-gray-800">

            <div class="md:col-span-2">
                <div class="flex items-center gap-2.5 mb-4">
                    <div class="w-9 h-9 rounded-xl bg-orange flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17 8C8 10 5.9 16.17 3.82 21.34L5.71 22l1-2.3A4.49 4.49 0 008 20C19 20 22 3 22 3c-1 2-8 5-8 5H14C8 8 6 12.5 6 12.5A5.5 5.5 0 0117 8z"/>
                        </svg>
                    </div>
                    <span class="text-white font-semibold text-lg">SyA <span class="font-light opacity-60">Group</span></span>
                </div>
                <p class="text-sm font-light leading-relaxed max-w-xs">
                    Sangüesa y Asociados Limitada. Asesoría ambiental técnica y legal desde 2003.
                </p>
            </div>

            <div>
                <h5 class="text-white text-sm font-semibold mb-4">Servicios</h5>
                <ul class="space-y-2.5 text-sm font-light">
                    @foreach(['Impacto Ambiental (MIA)','Auditorías Ambientales','Licenciamiento','Residuos Peligrosos','Monitoreo Ambiental'] as $s)
                    <li><a href="#" class="hover:text-orange transition-colors">{{ $s }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h5 class="text-white text-sm font-semibold mb-4">Empresa</h5>
                <ul class="space-y-2.5 text-sm font-light">
                    <li><a href="#nosotros" class="hover:text-orange transition-colors">Sobre nosotros</a></li>
                    <li><a href="#contacto" class="hover:text-orange transition-colors">Contacto</a></li>
                    <li><a href="#"         class="hover:text-orange transition-colors">Aviso de privacidad</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-orange transition-colors">Acceso al sistema</a></li>
                </ul>
            </div>
        </div>

        <div class="pt-6 flex flex-col md:flex-row justify-between items-center gap-3 text-xs">
            <p>&copy; {{ date('Y') }} SyA Group · Sangüesa y Asociados Limitada. Todos los derechos reservados.</p>
            <p>Hecho con cuidado en México 🇲🇽</p>
        </div>
    </div>
</footer>

<script>
    const navbar = document.getElementById('navbar');
    navbar.style.background = 'linear-gradient(to bottom, rgba(2,82,131,0.6) 0%, transparent 100%)';

    window.addEventListener('scroll', () => {
        if (window.scrollY > 60) {
            navbar.classList.add('nav-solid');
            navbar.style.background = '';
        } else {
            navbar.classList.remove('nav-solid');
            navbar.style.background = 'linear-gradient(to bottom, rgba(2,82,131,0.6) 0%, transparent 100%)';
        }
    });
</script>

</body>
</html>