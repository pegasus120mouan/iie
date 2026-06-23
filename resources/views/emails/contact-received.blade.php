<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family: Arial, sans-serif;">
    <h2>Nouveau message de contact</h2>
    <p><strong>De :</strong> {{ $contact->name }} ({{ $contact->email }})</p>
    <p><strong>Sujet :</strong> {{ $contact->subject }}</p>
    <p><strong>Message :</strong></p>
    <p>{{ $contact->message }}</p>
</body>
</html>
