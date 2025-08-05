<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Procès-verbal de réception de travaux</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; line-height: 1.4; }
        .header { text-align: center; margin-bottom: 30px; }
        .section { margin-bottom: 20px; }
        .section h3 { background: #f5f5f5; padding: 8px; margin: 0 0 15px 0; }
        .field { margin-bottom: 8px; }
        .field strong { display: inline-block; width: 150px; }
        .signatures { display: flex; justify-content: space-between; margin-top: 30px; }
        .signature-box { text-align: center; border: 1px solid #ccc; width: 45%; padding: 10px; }
        .signature-img { max-width: 200px; max-height: 80px; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background: #f5f5f5; }
    </style>
</head>
<body>
    <div class="header">
        <h1>PROCÈS-VERBAL DE RÉCEPTION DE TRAVAUX</h1>
        <p>Généré le {{ now()->format('d/m/Y à H:i') }}</p>
    </div>

    <div class="section">
        <h3>Informations générales</h3>
        <div class="field"><strong>Société :</strong> {{ $workReception->company_name ?: 'Non renseigné' }}</div>
        <div class="field"><strong>Client :</strong> {{ $workReception->client_name ?: 'Non renseigné' }}</div>
        <div class="field"><strong>Agissant en qualité de :</strong> {{ $workReception->acting_as ?: 'Non renseigné' }}</div>
    </div>

    <div class="section">
        <h3>Coordonnées</h3>
        <div class="field"><strong>Adresse d'installation :</strong><br>{{ $workReception->installation_address ?: 'Non renseigné' }}</div>
        <div class="field"><strong>Code postal :</strong> {{ $workReception->postal_code ?: 'Non renseigné' }}</div>
        <div class="field"><strong>Ville :</strong> {{ $workReception->city ?: 'Non renseigné' }}</div>
    </div>

    <div class="section">
        <h3>Description des travaux</h3>
        <div class="field"><strong>Nature des travaux :</strong><br>{{ $workReception->work_description ?: 'Non renseigné' }}</div>
        
        @if($workReception->materials->count() > 0)
            <h4>Matériels installés</h4>
            <table>
                <thead>
                    <tr><th>Type</th><th>Nom/Modèle</th><th>Quantité</th><th>Description</th></tr>
                </thead>
                <tbody>
                    @foreach($workReception->materials as $material)
                        <tr>
                            <td>{{ $material->type ?: '-' }}</td>
                            <td>{{ $material->name ?: '-' }}</td>
                            <td>{{ $material->quantity ?: '-' }}</td>
                            <td>{{ $material->description ?: '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if($workReception->simCards->count() > 0)
            <h4>Cartes SIM</h4>
            <table>
                <thead>
                    <tr><th>Option</th><th>Opérateur</th><th>N° de carte</th></tr>
                </thead>
                <tbody>
                    @foreach($workReception->simCards as $simCard)
                        <tr>
                            <td>{{ $simCard->option ?: '-' }}</td>
                            <td>{{ $simCard->operator ?: '-' }}</td>
                            <td>{{ $simCard->sim_number ?: '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="section">
        <h3>Juridique</h3>
        @if($workReception->contract_reception_checked)
            <div class="field">☑️ Par la présente, il est procédé à la réception des travaux réalisés en exécution du contrat du : {{ $workReception->contract_date ? $workReception->contract_date->format('d/m/Y') : 'Non renseigné' }}</div>
        @endif
        @if($workReception->work_compliance_checked)
            <div class="field">☑️ Il est constaté que les travaux de construction ont été exécutés conformément au contrat. Aucune réserve n'est émise.</div>
        @endif
        <div class="field"><strong>Fait électroniquement à :</strong> {{ $workReception->electronic_location ?: 'Non renseigné' }}</div>
    </div>

    <div class="signatures">
        <div class="signature-box">
            <h4>Signature du client</h4>
            <p><strong>{{ $workReception->signatory_name ?: 'Nom non renseigné' }}</strong></p>
            @if($workReception->client_signature)
                <img src="{{ $workReception->client_signature }}" class="signature-img" alt="Signature client">
            @else
                <div style="height: 80px; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center;">
                    Signature non fournie
                </div>
            @endif
        </div>

        <div class="signature-box">
            <h4>Signature du technicien</h4>
            <p><strong>{{ $workReception->technician_name ?: 'Nom non renseigné' }}</strong></p>
            @if($workReception->technician_signature)
                <img src="{{ $workReception->technician_signature }}" class="signature-img" alt="Signature technicien">
            @else
                <div style="height: 80px; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center;">
                    Signature non fournie
                </div>
            @endif
        </div>
    </div>

    <div style="margin-top: 30px; text-align: center; font-size: 10px; color: #666;">
        Document généré automatiquement le {{ now()->format('d/m/Y à H:i:s') }} - ID Formulaire: {{ $workReception->id }}
    </div>
</body>
</html>