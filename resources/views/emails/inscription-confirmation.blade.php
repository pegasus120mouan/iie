<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .header { background: #0A2342; color: #fff; padding: 20px; text-align: center; }
        .header h1 { color: #D4AF37; margin: 0; }
        .content { padding: 30px; }
        .info-box { background: #F8F9FA; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .footer { background: #0A2342; color: #999; padding: 15px; text-align: center; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset(config('iie.logo')) }}" alt="IIE" style="height: 48px; width: auto;">
    </div>
    <div class="content">
        <h2>Confirmation d'inscription</h2>
        <p>Bonjour <strong>{{ $inscription->prenoms }} {{ $inscription->nom }}</strong>,</p>
        <p>Nous avons bien reçu votre demande d'inscription. Voici les détails de votre dossier :</p>
        <div class="info-box">
            <p><strong>N° de dossier :</strong> {{ $inscription->numero_dossier }}</p>
            <p><strong>Formation :</strong> {{ $inscription->formation->name }}</p>
            <p><strong>Email :</strong> {{ $inscription->email }}</p>
            <p><strong>Statut :</strong> En attente de validation</p>
        </div>
        <p>Notre équipe examinera votre dossier et vous contactera sous 48 heures.</p>
        <p>Cordialement,<br>L'équipe IIE</p>
    </div>
    <div class="footer">&copy; {{ date('Y') }} International Institute of Excellence</div>
</body>
</html>
