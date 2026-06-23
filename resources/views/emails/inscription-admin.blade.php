<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family: Arial, sans-serif;">
    <h2>Nouvelle inscription reçue</h2>
    <p><strong>N° dossier :</strong> {{ $inscription->numero_dossier }}</p>
    <p><strong>Nom :</strong> {{ $inscription->full_name }}</p>
    <p><strong>Email :</strong> {{ $inscription->email }}</p>
    <p><strong>Téléphone :</strong> {{ $inscription->telephone }}</p>
    <p><strong>Formation :</strong> {{ $inscription->formation->name }}</p>
    <p><a href="{{ url('/admin/inscriptions/'.$inscription->id) }}">Voir le dossier dans l'admin</a></p>
</body>
</html>
