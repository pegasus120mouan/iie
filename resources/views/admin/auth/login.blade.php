<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - IIE</title>
    @include('partials.favicon')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css'])
</head>
<body class="font-sans login-wrapper">
    <div class="w-full max-w-md mx-4 relative z-10">
        <div class="text-center mb-8">
            <x-logo variant="admin" class="mx-auto logo-admin--login" />
            <p class="text-slate mt-4 font-medium">Espace d'administration</p>
        </div>

        <form action="{{ route('admin.login.post') }}" method="POST" class="login-card">
            @csrf
            @if($errors->any())
                <div class="alert-error mb-6">{{ $errors->first() }}</div>
            @endif
            <div class="mb-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-input" required autofocus>
            </div>
            <div class="mb-6">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-input" required>
            </div>
            <label class="flex items-center gap-2 text-slate text-sm mb-6">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-navy"> Se souvenir de moi
            </label>
            <button type="submit" class="btn-navy w-full"><i class="fas fa-sign-in-alt mr-2"></i>Connexion</button>
        </form>
    </div>
</body>
</html>
