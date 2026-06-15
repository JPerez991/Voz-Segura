<!DOCTYPE html>
<html lang="es" data-theme="cupcake">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Voz Segura — Tu Espacio Seguro</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Delius&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])

    <style>
        body { font-family: 'Delius', cursive; }
        html { scroll-behavior: smooth; }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.4; }
            50% { transform: translateY(-30px) rotate(10deg); opacity: 0.8; }
        }
        @keyframes float-delayed {
            0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.3; }
            50% { transform: translateY(-20px) rotate(-8deg); opacity: 0.7; }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(124,58,237,0.3); }
            50% { box-shadow: 0 0 40px rgba(236,72,153,0.5); }
        }
        .heart-1 { animation: float 6s ease-in-out infinite; }
        .heart-2 { animation: float-delayed 8s ease-in-out infinite 1s; }
        .heart-3 { animation: float 7s ease-in-out infinite 2s; }
        .heart-4 { animation: float-delayed 9s ease-in-out infinite 0.5s; }
        .fade-in-up { animation: fadeInUp 0.8s ease-out both; }
        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.6s; }
        .pulse-glow { animation: pulse-glow 3s ease-in-out infinite; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(124,58,237,0.15); }
        .card-hover { transition: all 0.3s ease; }
        .gradient-text {
            background: linear-gradient(135deg, #7c3aed, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-base-100">

    <!-- Navbar -->
    <div class="navbar fixed top-0 left-0 w-full z-50 bg-base-100/60 backdrop-blur-lg border-b border-base-200/50">
        <div class="navbar-start">
            <a href="#page-top" class="btn btn-ghost text-2xl font-bold tracking-tight">
                <span class="gradient-text">Voz Segura</span>
            </a>
        </div>
        <div class="navbar-end gap-2">
            <a href="{{ route('register') }}" class="btn btn-ghost text-base-content/70 hover:text-primary">Registrar</a>
            <a href="{{ route('login') }}" class="btn btn-primary btn-sm md:btn-md shadow-md">Entrar</a>
        </div>
    </div>

    <!-- Hero -->
    <section id="page-top" class="hero min-h-screen bg-gradient-to-br from-primary via-secondary to-accent overflow-hidden relative">
        <!-- Floating hearts -->
        <svg class="heart-1 absolute top-[15%] left-[10%] w-8 h-8 text-white/30" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        <svg class="heart-2 absolute top-[25%] right-[15%] w-6 h-6 text-white/30" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        <svg class="heart-3 absolute bottom-[20%] left-[20%] w-5 h-5 text-white/30" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        <svg class="heart-4 absolute bottom-[30%] right-[10%] w-7 h-7 text-white/30" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>

        <div class="hero-content text-center text-neutral-content z-10">
            <div class="max-w-2xl space-y-6">
                <div class="fade-in-up">
                    <h1 class="text-5xl md:text-7xl font-bold drop-shadow-lg">Bienvenidos</h1>
                </div>
                <div class="fade-in-up delay-1">
                    <p class="text-xl md:text-3xl font-light drop-shadow-md">A tu Espacio Seguro</p>
                </div>
                <div class="fade-in-up delay-2 pt-4">
                    <a href="#scroll" class="btn bg-white/20 hover:bg-white/30 text-white border-2 border-white/40 hover:border-white/60 btn-lg rounded-full px-10 pulse-glow shadow-2xl backdrop-blur-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                        Conoce más
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Wave divider -->
    <div class="relative -mt-1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" class="w-full h-auto fill-base-100">
            <path d="M0,32L48,42.7C96,53,192,75,288,80C384,85,480,75,576,69.3C672,64,768,64,864,69.3C960,75,1056,85,1152,80C1248,75,1344,53,1392,42.7L1440,32V120H0Z"/>
        </svg>
    </div>

    <!-- Values cards -->
    <section class="py-16 bg-base-100">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">
                <span class="gradient-text">¿Por qué Voz Segura?</span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="card bg-base-100 shadow-lg hover:shadow-2xl card-hover rounded-3xl border border-base-200/60">
                    <div class="card-body items-center text-center p-8">
                        <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        </div>
                        <h3 class="card-title text-xl text-primary">Confianza</h3>
                        <p class="text-base-content/70">Un espacio donde puedes ser tú misma, sin miedo al juicio.</p>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-lg hover:shadow-2xl card-hover rounded-3xl border border-base-200/60">
                    <div class="card-body items-center text-center p-8">
                        <div class="w-16 h-16 rounded-full bg-secondary/10 flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                        </div>
                        <h3 class="card-title text-xl text-secondary">Apoyo</h3>
                        <p class="text-base-content/70">Una comunidad de mujeres que te respaldan y acompañan.</p>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-lg hover:shadow-2xl card-hover rounded-3xl border border-base-200/60">
                    <div class="card-body items-center text-center p-8">
                        <div class="w-16 h-16 rounded-full bg-accent/10 flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.589-1.202L18.75 4.971zm-13.5 0L2.66 15.696c-.122.499.106 1.028.589 1.202a5.989 5.989 0 002.031.352 5.989 5.989 0 002.031-.352c.483-.174.711-.703.589-1.202L5.25 4.971z"/></svg>
                        </div>
                        <h3 class="card-title text-xl text-accent">Empoderamiento</h3>
                        <p class="text-base-content/70">Juntas descubrimos nuestra fuerza y alcanzamos nuestras metas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 1: Eres fuerte -->
    <section id="scroll" class="py-20 bg-base-200">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-12 max-w-6xl mx-auto">
                <div class="md:w-1/2">
                    <div class="mockup-browser bg-base-300 shadow-2xl rounded-3xl overflow-hidden">
                        <div class="mockup-browser-toolbar">
                            <div class="input">vozsegura.app</div>
                        </div>
                        <picture>
                            <source srcset="assets/img/01.webp" type="image/webp">
                            <img class="w-full h-80 md:h-96 object-cover" src="assets/img/01.jpg" alt="Mujer sonriente" />
                        </picture>
                    </div>
                </div>
                <div class="md:w-1/2 space-y-5">
                    <div class="badge badge-primary badge-outline px-4 py-3 text-sm">Empoderamiento</div>
                    <h2 class="text-4xl md:text-5xl font-bold">
                        <span class="gradient-text">Eres fuerte</span>
                    </h2>
                    <p class="text-lg text-base-content/70 leading-relaxed">
                        Recuerda, eres más fuerte de lo que crees. No estás sola en esta lucha; a tu lado hay una comunidad dispuesta a apoyarte en cada paso del camino. Aunque enfrentemos desafíos, nuestra resiliencia y valentía son más poderosas que cualquier obstáculo. Juntas, somos invencibles, capaces de transformar el dolor en fuerza y la desesperanza en esperanza.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Nunca te rindas -->
    <section class="py-20 bg-base-100">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row-reverse items-center gap-12 max-w-6xl mx-auto">
                <div class="md:w-1/2">
                    <div class="mockup-browser bg-base-300 shadow-2xl rounded-3xl overflow-hidden">
                        <div class="mockup-browser-toolbar">
                            <div class="input">vozsegura.app</div>
                        </div>
                        <picture>
                            <source srcset="assets/img/06.webp" type="image/webp">
                            <img class="w-full h-80 md:h-96 object-cover" src="assets/img/06.jpg" alt="Mujer pensativa" />
                        </picture>
                    </div>
                </div>
                <div class="md:w-1/2 space-y-5">
                    <div class="badge badge-secondary badge-outline px-4 py-3 text-sm">Motivación</div>
                    <h2 class="text-4xl md:text-5xl font-bold">
                        <span class="gradient-text">Nunca te rindas</span>
                    </h2>
                    <p class="text-lg text-base-content/70 leading-relaxed">
                        No importa cuán difíciles sean los días, cada paso hacia adelante es una victoria en sí misma. La fortaleza se encuentra en la perseverancia, en la capacidad de levantarse una y otra vez, sin importar cuántas veces caigamos. A través de cada desafío, ganamos sabiduría, fuerza y una comprensión más profunda de nuestra propia capacidad para superar adversidades.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Juntas somos más fuertes -->
    <section class="py-20 bg-base-200">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-12 max-w-6xl mx-auto">
                <div class="md:w-1/2">
                    <div class="mockup-browser bg-base-300 shadow-2xl rounded-3xl overflow-hidden">
                        <div class="mockup-browser-toolbar">
                            <div class="input">vozsegura.app</div>
                        </div>
                        <picture>
                            <source srcset="assets/img/09.webp" type="image/webp">
                            <img class="w-full h-80 md:h-96 object-cover" src="assets/img/09.png" alt="Grupo de mujeres" />
                        </picture>
                    </div>
                </div>
                <div class="md:w-1/2 space-y-5">
                    <div class="badge badge-accent badge-outline px-4 py-3 text-sm">Comunidad</div>
                    <h2 class="text-4xl md:text-5xl font-bold">
                        <span class="gradient-text">Juntas somos más fuertes</span>
                    </h2>
                    <p class="text-lg text-base-content/70 leading-relaxed">
                        En este espacio, encontrarás apoyo y comprensión en cada momento. Aquí, cada voz es importante y cada historia tiene el poder de inspirar y transformar. Al compartir nuestras experiencias, creamos un lazo de empatía y solidaridad que nos fortalece a todas. Conectemos, compartamos y crezcamos juntas, sabiendo que en la unión encontramos la fortaleza para enfrentar cualquier desafío.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer footer-center bg-neutral text-neutral-content p-10">
        <svg class="w-8 h-8 text-secondary mb-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        <p class="text-sm text-neutral-content/60">&copy; Voz Segura 2024. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
