<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Eat & Drink - Événement</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <header class="bg-gradient-to-r from-green-400 to-blue-400 py-16 text-center text-white">
        <h1 class="text-5xl font-bold tracking-wide">Eat & Drink</h1>
        <p class="mt-4 text-lg">Le Salon des Saveurs et de l'Innovation Culinaire</p>
    </header>

    <section class="relative">
        <div class="relative bg-cover bg-center h-[450px]" style="background-image: url('https://images.unsplash.com/photo-1555992336-03a23c4a7bdf?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80')">
            <div class="absolute inset-0 bg-green-500/50"></div>
            <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center px-4">
                <h2 class="text-4xl md:text-5xl font-semibold">Bienvenue à Eat & Drink 2025</h2>
                <p class="mt-4 max-w-xl text-lg">Le rendez-vous incontournable des artisans, restaurateurs, producteurs et amateurs de bonne cuisine.</p>
                <div class="mt-8 flex flex-col md:flex-row gap-4">
                    <a href="{{ route('login') }}" class="bg-white text-green-500 font-semibold px-6 py-3 rounded-full shadow hover:bg-green-500 hover:text-white transition">Se connecter</a>
                    <a href="{{ route('register') }}" class="bg-white text-green-500 font-semibold px-6 py-3 rounded-full shadow hover:bg-green-500 hover:text-white transition">Créer un compte</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 max-w-5xl mx-auto px-6">
        <h3 class="text-3xl font-bold text-green-500 mb-4 text-center">À propos de l'événement</h3>
        <p class="text-center text-lg text-gray-600 leading-relaxed">
            Eat & Drink est une célébration de la gastronomie, de la créativité culinaire et de l'innovation. Explorez les stands, assistez à des démonstrations de chefs renommés, découvrez des produits exclusifs et participez à des conférences inspirantes sur l'avenir de l'alimentation.
        </p>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <h3 class="text-3xl font-bold text-green-500 mb-4 text-center">Nos Objectifs</h3>
            <p class="text-center text-lg text-gray-600 leading-relaxed">
                Favoriser les rencontres professionnelles, promouvoir les talents émergents et offrir au public une expérience immersive autour du goût, des saveurs et des innovations du secteur alimentaire.
            </p>
        </div>
    </section>

    <section class="py-16 max-w-5xl mx-auto px-6">
        <h3 class="text-3xl font-bold text-green-500 mb-4 text-center">Pourquoi participer ?</h3>
        <p class="text-center text-lg text-gray-600 leading-relaxed">
            Pour élargir votre réseau, découvrir de nouvelles tendances, échanger avec des experts du secteur et vivre une expérience riche en découvertes sensorielles.
        </p>
    </section>

    <footer class="bg-green-500 text-white py-6 text-center text-sm">
        &copy; 2025 Eat & Drink. Tous droits réservés.
    </footer>
</body>
</html>