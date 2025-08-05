<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #f8f9fa; padding: 20px; text-align: center; }
        .content { padding: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Procès-verbal de réception de travaux</h2>
        </div>
        
        <div class="content">
            <p>Bonjour,</p>
            
            <p>Veuillez trouver en pièce jointe le procès-verbal de réception de travaux validé pour :</p>
            
            <ul>
                <li><strong>Client :</strong> {{ $workReception->client_name }}</li>
                <li><strong>Société :</strong> {{ $workReception->company_name }}</li>
                <li><strong>Date de validation :</strong> {{ $workReception->validated_at?->format('d/m/Y à H:i') }}</li>
                <li><strong>Lieu :</strong> {{ $workReception->electronic_location }}</li>
            </ul>
            
            <p>Ce document officialise la réception des travaux réalisés.</p>
            
            <p>Cordialement,<br>
            L'équipe Hr Telecoms</p>
        </div>
    </div>
</body>
</html>