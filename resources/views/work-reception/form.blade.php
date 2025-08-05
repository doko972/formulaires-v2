@extends('layouts.form-layout')

@section('title', 'Formulaire de réception de travaux')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h1 class="text-2xl font-bold mb-6">
            {{ isset($workReception) ? 'Modifier le formulaire' : 'Nouveau formulaire de réception de travaux' }}
        </h1>

        <form method="POST" action="{{ route('work-reception.store') }}" class="space-y-8">
            @csrf
            
            <!-- ID du formulaire pour les modifications -->
            @if(isset($workReception))
                <input type="hidden" name="work_reception_id" value="{{ $workReception->id }}">
            @endif

            <!-- Section 1: Informations générales -->
            <div class="bg-blue-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold mb-4 text-blue-800">Section 1: Informations générales</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom de la société -->
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nom de la société
                        </label>
                        <input 
                            type="text" 
                            name="company_name" 
                            id="company_name"
                            value="{{ old('company_name', $workReception->company_name ?? '') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Ex: SARL Exemple"
                        >
                        @error('company_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nom du client -->
                    <div>
                        <label for="client_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nom du client
                        </label>
                        <input 
                            type="text" 
                            name="client_name" 
                            id="client_name"
                            value="{{ old('client_name', $workReception->client_name ?? '') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Ex: Martin Dupont"
                        >
                        @error('client_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Agissant en qualité de -->
                    <div class="md:col-span-2">
                        <label for="acting_as" class="block text-sm font-medium text-gray-700 mb-2">
                            Agissant en qualité de
                        </label>
                        <input 
                            type="text" 
                            name="acting_as" 
                            id="acting_as"
                            value="{{ old('acting_as', $workReception->acting_as ?? '') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Ex: Gérant, Représentant légal..."
                        >
                        @error('acting_as')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section 2: Coordonnées -->
            <div class="bg-green-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold mb-4 text-green-800">Section 2: Coordonnées</h2>
                
                <div class="space-y-6">
                    <!-- Adresse d'installation -->
                    <div>
                        <label for="installation_address" class="block text-sm font-medium text-gray-700 mb-2">
                            Adresse d'installation
                        </label>
                        <textarea 
                            name="installation_address" 
                            id="installation_address"
                            rows="3"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500"
                            placeholder="Ex: 123 Rue de la République&#10;Bâtiment A, 2ème étage"
                        >{{ old('installation_address', $workReception->installation_address ?? '') }}</textarea>
                        @error('installation_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Code postal -->
                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-2">
                                Code postal
                            </label>
                            <input 
                                type="text" 
                                name="postal_code" 
                                id="postal_code"
                                value="{{ old('postal_code', $workReception->postal_code ?? '') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500"
                                placeholder="Ex: 75001"
                                maxlength="5"
                            >
                            @error('postal_code')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ville -->
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                                Ville
                            </label>
                            <select 
                                name="city" 
                                id="city"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500"
                            >
                                <option value="">Sélectionnez une ville</option>
                                @if(old('city', $workReception->city ?? ''))
                                    <option value="{{ old('city', $workReception->city ?? '') }}" selected>
                                        {{ old('city', $workReception->city ?? '') }}
                                    </option>
                                @endif
                            </select>
                            @error('city')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="help-text mt-1 text-sm text-gray-500">
                                La liste des villes se remplira automatiquement après avoir saisi le code postal.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 3: Description des travaux -->
            <div class="bg-orange-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold mb-4 text-orange-800">Section 3: Description des travaux</h2>
                
                <div class="space-y-6">
                    <!-- Nature des travaux -->
                    <div>
                        <label for="work_description" class="block text-sm font-medium text-gray-700 mb-2">
                            Nature des travaux
                        </label>
                        <textarea 
                            name="work_description" 
                            id="work_description"
                            rows="4"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                            placeholder="Décrivez les travaux effectués..."
                        >{{ old('work_description', $workReception->work_description ?? '') }}</textarea>
                        @error('work_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cartes SIM - Section répétable -->
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Cartes SIM</h3>
                            <button 
                                type="button" 
                                id="add-sim-card" 
                                class="bg-orange-600 hover:bg-orange-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out"
                            >
                                + Ajouter Carte Sim
                            </button>
                        </div>

                        <div id="sim-cards-container" class="space-y-4">
                            @if(isset($workReception) && $workReception->simCards->count() > 0)
                                @foreach($workReception->simCards as $index => $simCard)
                                    <div class="sim-card-row bg-white p-4 border border-gray-200 rounded-lg">
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Option</label>
                                                <select name="sim_cards[{{ $index }}][option]" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
                                                    <option value="">Sélectionner</option>
                                                    <option value="Backup" {{ $simCard->option === 'Backup' ? 'selected' : '' }}>Backup</option>
                                                    <option value="Routeur 4G" {{ $simCard->option === 'Routeur 4G' ? 'selected' : '' }}>Routeur 4G</option>
                                                    <option value="Téléphonie" {{ $simCard->option === 'Téléphonie' ? 'selected' : '' }}>Téléphonie</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Opérateur</label>
                                                <select name="sim_cards[{{ $index }}][operator]" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
                                                    <option value="">Sélectionner</option>
                                                    <option value="Free" {{ $simCard->operator === 'Free' ? 'selected' : '' }}>Free</option>
                                                    <option value="Orange" {{ $simCard->operator === 'Orange' ? 'selected' : '' }}>Orange</option>
                                                    <option value="Bouygues" {{ $simCard->operator === 'Bouygues' ? 'selected' : '' }}>Bouygues</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">N° de Carte Sim</label>
                                                <input 
                                                    type="text" 
                                                    name="sim_cards[{{ $index }}][sim_number]" 
                                                    value="{{ $simCard->sim_number }}"
                                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                                    placeholder="Ex: 0123456789"
                                                >
                                            </div>
                                            <div class="flex items-end">
                                                <button 
                                                    type="button" 
                                                    class="remove-sim-card bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-3 rounded-md transition duration-150 ease-in-out"
                                                >
                                                    Supprimer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Une carte SIM par défaut -->
                                <div class="sim-card-row bg-white p-4 border border-gray-200 rounded-lg">
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Option</label>
                                            <select name="sim_cards[0][option]" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
                                                <option value="">Sélectionner</option>
                                                <option value="Backup">Backup</option>
                                                <option value="Routeur 4G">Routeur 4G</option>
                                                <option value="Téléphonie">Téléphonie</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Opérateur</label>
                                            <select name="sim_cards[0][operator]" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
                                                <option value="">Sélectionner</option>
                                                <option value="Free">Free</option>
                                                <option value="Orange">Orange</option>
                                                <option value="Bouygues">Bouygues</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">N° de Carte Sim</label>
                                            <input 
                                                type="text" 
                                                name="sim_cards[0][sim_number]" 
                                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                                placeholder="Ex: 0123456789"
                                            >
                                        </div>
                                        <div class="flex items-end">
                                            <button 
                                                type="button" 
                                                class="remove-sim-card bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-3 rounded-md transition duration-150 ease-in-out"
                                            >
                                                Supprimer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Matériels - Section répétable -->
                    <div class="mt-8">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-4">
                            <h3 class="text-lg font-medium text-gray-900">Matériels installés</h3>
                            <button 
                                type="button" 
                                id="add-material" 
                                class="inline-flex items-center justify-center bg-orange-600 hover:bg-orange-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out"
                                style="display: inline-flex !important; background-color: #ea580c !important; color: white !important; padding: 8px 16px !important; border-radius: 6px !important;"
                            >
                                ➕ Ajouter un matériel
                            </button>
                        </div>

                        <div id="materials-container" class="space-y-4">
                            @if(isset($workReception) && $workReception->materials->count() > 0)
                                @foreach($workReception->materials as $index => $material)
                                    <div class="material-row bg-white p-4 border border-gray-200 rounded-lg">
                                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                                                <select name="materials[{{ $index }}][type]" class="material-type w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
                                                    <option value="">Sélectionner</option>
                                                    @foreach(\App\Models\Material::getTypes() as $type)
                                                        <option value="{{ $type }}" {{ $material->type === $type ? 'selected' : '' }}>{{ $type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Modèle/Nom</label>
                                                <input 
                                                    type="text" 
                                                    name="materials[{{ $index }}][name]" 
                                                    value="{{ $material->name }}"
                                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                                    placeholder="Nom du matériel"
                                                >
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Quantité</label>
                                                <input 
                                                    type="number" 
                                                    name="materials[{{ $index }}][quantity]" 
                                                    value="{{ $material->quantity }}"
                                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                                    placeholder="1"
                                                    min="1"
                                                >
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                                <input 
                                                    type="text" 
                                                    name="materials[{{ $index }}][description]" 
                                                    value="{{ $material->description }}"
                                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                                    placeholder="Optionnel"
                                                >
                                            </div>
                                            <div class="flex items-end">
                                                <button 
                                                    type="button" 
                                                    class="remove-material bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-3 rounded-md transition duration-150 ease-in-out"
                                                >
                                                    Supprimer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Un matériel par défaut -->
                                <div class="material-row bg-white p-4 border border-gray-200 rounded-lg">
                                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                                            <select name="materials[0][type]" class="material-type w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
                                                <option value="">Sélectionner</option>
                                                @foreach(\App\Models\Material::getTypes() as $type)
                                                    <option value="{{ $type }}">{{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Modèle/Nom</label>
                                            <input 
                                                type="text" 
                                                name="materials[0][name]" 
                                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                                placeholder="Nom du matériel"
                                            >
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Quantité</label>
                                            <input 
                                                type="number" 
                                                name="materials[0][quantity]" 
                                                value="1"
                                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                                placeholder="1"
                                                min="1"
                                            >
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                            <input 
                                                type="text" 
                                                name="materials[0][description]" 
                                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                                placeholder="Optionnel"
                                            >
                                        </div>
                                        <div class="flex items-end">
                                            <button 
                                                type="button" 
                                                class="remove-material bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-3 rounded-md transition duration-150 ease-in-out"
                                            >
                                                Supprimer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 4: Juridique -->
            <div class="bg-purple-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold mb-4 text-purple-800">Section 4: Juridique</h2>
                
                <div class="space-y-6">
                    <!-- Checkbox 1: Réception des travaux -->
                    <div class="bg-white p-4 rounded-lg border border-purple-200">
                        <div class="flex items-start space-x-3">
                            <input 
                                type="checkbox" 
                                name="contract_reception_checked" 
                                id="contract_reception_checked"
                                value="1"
                                {{ old('contract_reception_checked', $workReception->contract_reception_checked ?? false) ? 'checked' : '' }}
                                class="mt-1 h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded"
                            >
                            <div class="flex-1">
                                <label for="contract_reception_checked" class="text-sm font-medium text-gray-900">
                                    Par la présente, il est procédé à la réception des travaux réalisés en exécution du contrat du :
                                </label>
                                <div class="mt-2">
                                    <input 
                                        type="date" 
                                        name="contract_date" 
                                        id="contract_date"
                                        value="{{ old('contract_date', $workReception->contract_date ?? '') }}"
                                        class="border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500"
                                    >
                                </div>
                            </div>
                        </div>
                        @error('contract_reception_checked')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('contract_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Checkbox 2: Conformité des travaux -->
                    <div class="bg-white p-4 rounded-lg border border-purple-200">
                        <div class="flex items-start space-x-3">
                            <input 
                                type="checkbox" 
                                name="work_compliance_checked" 
                                id="work_compliance_checked"
                                value="1"
                                {{ old('work_compliance_checked', $workReception->work_compliance_checked ?? false) ? 'checked' : '' }}
                                class="mt-1 h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded"
                            >
                            <label for="work_compliance_checked" class="text-sm font-medium text-gray-900">
                                Il est constaté que les travaux de construction ont été exécutés conformément au contrat. Aucune réserve n'est émise.
                            </label>
                        </div>
                        @error('work_compliance_checked')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lieu électronique -->
                    <div>
                        <label for="electronic_location" class="block text-sm font-medium text-gray-700 mb-2">
                            Fait électroniquement à
                        </label>
                        <input 
                            type="text" 
                            name="electronic_location" 
                            id="electronic_location"
                            value="{{ old('electronic_location', $workReception->electronic_location ?? '') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500"
                            placeholder="Ex: Paris, Lyon, Marseille..."
                        >
                        @error('electronic_location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Signature du client -->
                        <div class="bg-white p-4 rounded-lg border border-gray-200">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Signature du client</h4>
                            
                            <div class="mb-4">
                                <label for="signatory_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nom du signataire
                                </label>
                                <input 
                                    type="text" 
                                    name="signatory_name" 
                                    id="signatory_name"
                                    value="{{ old('signatory_name', $workReception->signatory_name ?? '') }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500"
                                    placeholder="Nom et prénom"
                                >
                                @error('signatory_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="signature-container">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Signature</label>
                                <canvas 
                                    id="client-signature-pad" 
                                    class="border border-gray-300 rounded-md bg-white"
                                    width="280" 
                                    height="150"
                                    style="touch-action: none;"
                                ></canvas>
                                <input type="hidden" name="client_signature" id="client-signature-data" value="{{ old('client_signature', $workReception->client_signature ?? '') }}">
                                <div class="mt-2 space-x-2">
                                    <button type="button" id="clear-client-signature" class="text-sm text-red-600 hover:text-red-800">Effacer</button>
                                </div>
                            </div>
                        </div>

                        <!-- Signature du technicien -->
                        <div class="bg-white p-4 rounded-lg border border-gray-200">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Signature du technicien</h4>
                            
                            <div class="mb-4">
                                <label for="technician_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nom du technicien
                                </label>
                                <input 
                                    type="text" 
                                    name="technician_name" 
                                    id="technician_name"
                                    value="{{ old('technician_name', $workReception->technician_name ?? '') }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500"
                                    placeholder="Nom et prénom du technicien"
                                >
                                @error('technician_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="signature-container">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Signature</label>
                                <canvas 
                                    id="technician-signature-pad" 
                                    class="border border-gray-300 rounded-md bg-white"
                                    width="280" 
                                    height="150"
                                    style="touch-action: none;"
                                ></canvas>
                                <input type="hidden" name="technician_signature" id="technician-signature-data" value="{{ old('technician_signature', $workReception->technician_signature ?? '') }}">
                                <div class="mt-2 space-x-2">
                                    <button type="button" id="clear-technician-signature" class="text-sm text-red-600 hover:text-red-800">Effacer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action finaux -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t">
                <button 
                    type="submit" 
                    name="save_draft" 
                    class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-6 rounded-md transition duration-150 ease-in-out"
                >
                    📄 Enregistrer comme brouillon
                </button>

                <button 
                    type="submit" 
                    id="validate-form"
                    class="bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-md transition duration-150 ease-in-out"
                >
                    ✅ Valider et générer le PDF
                </button>

                <!-- Bouton de debug temporaire -->
                <button 
                    type="button" 
                    onclick="debugSignatures()" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out text-sm"
                >
                    🔍 Debug signatures
                </button>

                <a 
                    href="{{ route('work-reception.index') }}" 
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-3 px-6 rounded-md text-center transition duration-150 ease-in-out"
                >
                    ❌ Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<style>
/* Styles pour les zones de signature */
.signature-container canvas {
    border: 2px dashed #d1d5db;
    border-radius: 8px;
    transition: border-color 0.2s ease-in-out;
    cursor: crosshair;
}

.signature-container canvas:hover {
    border-color: #9ca3af;
}

.signature-container canvas:focus {
    outline: none;
    border-color: #8b5cf6;
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
}

/* Responsive pour les zones de signature */
@media (max-width: 768px) {
    .signature-container canvas {
        width: 100% !important;
        max-width: 100%;
        height: 120px;
    }
}

/* Style pour les checkboxes juridiques */
.bg-purple-50 input[type="checkbox"]:checked {
    background-color: #8b5cf6;
    border-color: #8b5cf6;
}

/* Animation pour les boutons finaux */
.bg-green-600:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.4);
}

.bg-gray-600:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(75, 85, 99, 0.4);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let simCardIndex = {{ isset($workReception) && $workReception->simCards ? $workReception->simCards->count() : 1 }};
    let materialIndex = {{ isset($workReception) && $workReception->materials ? $workReception->materials->count() : 1 }};
    
    // === GESTION DES CARTES SIM ===
    
    // Fonction pour ajouter une nouvelle carte SIM
    document.getElementById('add-sim-card').addEventListener('click', function() {
        const container = document.getElementById('sim-cards-container');
        const newSimCard = document.createElement('div');
        newSimCard.className = 'sim-card-row bg-white p-4 border border-gray-200 rounded-lg';
        
        newSimCard.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Option</label>
                    <select name="sim_cards[${simCardIndex}][option]" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        <option value="">Sélectionner</option>
                        <option value="Backup">Backup</option>
                        <option value="Routeur 4G">Routeur 4G</option>
                        <option value="Téléphonie">Téléphonie</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Opérateur</label>
                    <select name="sim_cards[${simCardIndex}][operator]" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        <option value="">Sélectionner</option>
                        <option value="Free">Free</option>
                        <option value="Orange">Orange</option>
                        <option value="Bouygues">Bouygues</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">N° de Carte Sim</label>
                    <input 
                        type="text" 
                        name="sim_cards[${simCardIndex}][sim_number]" 
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                        placeholder="Ex: 0123456789"
                    >
                </div>
                <div class="flex items-end">
                    <button 
                        type="button" 
                        class="remove-sim-card bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-3 rounded-md transition duration-150 ease-in-out"
                    >
                        Supprimer
                    </button>
                </div>
            </div>
        `;
        
        container.appendChild(newSimCard);
        simCardIndex++;
        
        // Ajouter l'événement de suppression au nouveau bouton
        newSimCard.querySelector('.remove-sim-card').addEventListener('click', function() {
            newSimCard.remove();
        });
    });
    
    // Fonction pour supprimer une carte SIM
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-sim-card')) {
            const container = document.getElementById('sim-cards-container');
            // Empêcher la suppression s'il n'y a qu'une seule carte
            if (container.children.length > 1) {
                e.target.closest('.sim-card-row').remove();
            } else {
                alert('Vous devez garder au moins une carte SIM.');
            }
        }
    });

    // === GESTION DES MATÉRIELS ===
    
    // Vérifier que le bouton existe
    const addMaterialButton = document.getElementById('add-material');
    if (!addMaterialButton) {
        console.error('Bouton add-material non trouvé !');
        return;
    }
    
    // Fonction pour ajouter un nouveau matériel
    addMaterialButton.addEventListener('click', function() {
        console.log('Ajout d\'un nouveau matériel - Index:', materialIndex);
        
        const container = document.getElementById('materials-container');
        if (!container) {
            console.error('Container materials-container non trouvé !');
            return;
        }
        
        const newMaterial = document.createElement('div');
        newMaterial.className = 'material-row bg-white p-4 border border-gray-200 rounded-lg';
        
        newMaterial.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                    <select name="materials[${materialIndex}][type]" class="material-type w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        <option value="">Sélectionner</option>
                        <option value="Routeur">Routeur</option>
                        <option value="Antenne">Antenne</option>
                        <option value="Téléphonie">Téléphonie</option>
                        <option value="Accessoire">Accessoire</option>
                        <option value="Câblage">Câblage</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Modèle/Nom</label>
                    <input 
                        type="text" 
                        name="materials[${materialIndex}][name]" 
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                        placeholder="Nom du matériel"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Quantité</label>
                    <input 
                        type="number" 
                        name="materials[${materialIndex}][quantity]" 
                        value="1"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                        placeholder="1"
                        min="1"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <input 
                        type="text" 
                        name="materials[${materialIndex}][description]" 
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                        placeholder="Optionnel"
                    >
                </div>
                <div class="flex items-end">
                    <button 
                        type="button" 
                        class="remove-material bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-3 rounded-md transition duration-150 ease-in-out"
                    >
                        Supprimer
                    </button>
                </div>
            </div>
        `;
        
        container.appendChild(newMaterial);
        materialIndex++;
        
        // Ajouter l'événement de suppression au nouveau bouton
        newMaterial.querySelector('.remove-material').addEventListener('click', function() {
            newMaterial.remove();
        });
    });
    
    // Fonction pour supprimer un matériel
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-material')) {
            const container = document.getElementById('materials-container');
            // Empêcher la suppression s'il n'y a qu'un seul matériel
            if (container.children.length > 1) {
                e.target.closest('.material-row').remove();
            } else {
                alert('Vous devez garder au moins un matériel.');
            }
        }
    });

    // === AUTOCOMPLÉTION DES VILLES ===
    
    const postalCodeInput = document.getElementById('postal_code');
    const citySelect = document.getElementById('city');
    let searchTimeout;

    // Fonction pour mettre à jour les villes
    function updateCities(postalCode) {
        // Réinitialiser la liste des villes
        citySelect.innerHTML = '<option value="">Chargement...</option>';
        citySelect.disabled = true;

        // Appel AJAX à notre API
        fetch(`/api/cities/${postalCode}`)
            .then(response => response.json())
            .then(data => {
                citySelect.innerHTML = '<option value="">Sélectionnez une ville</option>';
                citySelect.disabled = false;

                if (data.success && data.cities.length > 0) {
                    // Ajouter chaque ville trouvée
                    data.cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.name;
                        option.textContent = city.name;
                        citySelect.appendChild(option);
                    });

                    // Message informatif
                    const helpText = citySelect.parentElement.querySelector('.help-text');
                    if (helpText) {
                        helpText.textContent = `${data.cities.length} ville(s) trouvée(s) pour le code postal ${postalCode}.`;
                        helpText.className = 'help-text mt-1 text-sm text-green-600';
                    }
                } else {
                    // Aucune ville trouvée
                    const option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'Aucune ville trouvée';
                    option.disabled = true;
                    citySelect.appendChild(option);

                    const helpText = citySelect.parentElement.querySelector('.help-text');
                    if (helpText) {
                        helpText.textContent = data.message || 'Aucune ville trouvée pour ce code postal.';
                        helpText.className = 'help-text mt-1 text-sm text-red-600';
                    }
                }
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des villes:', error);
                citySelect.innerHTML = '<option value="">Erreur de chargement</option>';
                citySelect.disabled = false;

                const helpText = citySelect.parentElement.querySelector('.help-text');
                if (helpText) {
                    helpText.textContent = 'Erreur lors du chargement des villes. Veuillez réessayer.';
                    helpText.className = 'help-text mt-1 text-sm text-red-600';
                }
            });
    }

    // Événement sur la saisie du code postal
    postalCodeInput.addEventListener('input', function() {
        const postalCode = this.value.trim();

        // Annuler la recherche précédente
        clearTimeout(searchTimeout);

        // Réinitialiser si le code postal est vide ou trop court
        if (postalCode.length < 5) {
            citySelect.innerHTML = '<option value="">Sélectionnez une ville</option>';
            citySelect.disabled = false;
            const helpText = citySelect.parentElement.querySelector('.help-text');
            if (helpText) {
                helpText.textContent = 'La liste des villes se remplira automatiquement après avoir saisi le code postal.';
                helpText.className = 'help-text mt-1 text-sm text-gray-500';
            }
            return;
        }

        // Vérifier que c'est bien 5 chiffres
        if (!/^\d{5}$/.test(postalCode)) {
            citySelect.innerHTML = '<option value="">Code postal invalide</option>';
            const helpText = citySelect.parentElement.querySelector('.help-text');
            if (helpText) {
                helpText.textContent = 'Le code postal doit contenir exactement 5 chiffres.';
                helpText.className = 'help-text mt-1 text-sm text-red-600';
            }
            return;
        }

        // Recherche avec délai pour éviter trop d'appels API
        searchTimeout = setTimeout(() => {
            updateCities(postalCode);
        }, 500);
    });

    // === GESTION DES SIGNATURES ===
    
    // Initialisation des 2 zones de signature
    const clientCanvas = document.getElementById('client-signature-pad');
    const technicianCanvas = document.getElementById('technician-signature-pad');

    const clientSignaturePad = new SignaturePad(clientCanvas, {
        backgroundColor: 'rgb(255, 255, 255)',
        penColor: 'rgb(0, 0, 0)',
        minWidth: 0.5,
        maxWidth: 2.5,
    });

    const technicianSignaturePad = new SignaturePad(technicianCanvas, {
        backgroundColor: 'rgb(255, 255, 255)',
        penColor: 'rgb(0, 0, 0)',
        minWidth: 0.5,
        maxWidth: 2.5,
    });

    // Exposer les SignaturePad globalement pour le debug
    window.clientSignaturePad = clientSignaturePad;
    window.technicianSignaturePad = technicianSignaturePad;

    // Restaurer les signatures existantes si présentes
    const existingClientSignature = document.getElementById('client-signature-data').value;
    const existingTechnicianSignature = document.getElementById('technician-signature-data').value;

    if (existingClientSignature) {
        clientSignaturePad.fromDataURL(existingClientSignature);
    }
    if (existingTechnicianSignature) {
        technicianSignaturePad.fromDataURL(existingTechnicianSignature);
    }

    // Boutons pour effacer les signatures
    document.getElementById('clear-client-signature').addEventListener('click', function() {
        clientSignaturePad.clear();
        document.getElementById('client-signature-data').value = '';
    });

    document.getElementById('clear-technician-signature').addEventListener('click', function() {
        technicianSignaturePad.clear();
        document.getElementById('technician-signature-data').value = '';
    });

    // Sauvegarder les signatures lors de la soumission du formulaire
    document.querySelector('form').addEventListener('submit', function(e) {
        console.log('Soumission du formulaire...');
        
        // Sauvegarder les signatures en base64 dans les champs cachés
        if (!clientSignaturePad.isEmpty()) {
            const clientSignatureData = clientSignaturePad.toDataURL();
            document.getElementById('client-signature-data').value = clientSignatureData;
            console.log('Signature client sauvegardée:', clientSignatureData.substring(0, 50) + '...');
        } else {
            console.log('Signature client vide');
        }
        
        if (!technicianSignaturePad.isEmpty()) {
            const technicianSignatureData = technicianSignaturePad.toDataURL();
            document.getElementById('technician-signature-data').value = technicianSignatureData;
            console.log('Signature technicien sauvegardée:', technicianSignatureData.substring(0, 50) + '...');
        }

        // Validation avant soumission pour le bouton "Valider"
        if (e.submitter && e.submitter.id === 'validate-form') {
            const contractChecked = document.getElementById('contract_reception_checked').checked;
            const complianceChecked = document.getElementById('work_compliance_checked').checked;
            const contractDate = document.getElementById('contract_date').value;
            const location = document.getElementById('electronic_location').value.trim();
            const signatoryName = document.getElementById('signatory_name').value.trim();

            let errors = [];

            if (!contractChecked) {
                errors.push('- Vous devez cocher la case de réception des travaux');
            }
            if (!complianceChecked) {
                errors.push('- Vous devez cocher la case de conformité des travaux');
            }
            if (!contractDate) {
                errors.push('- Vous devez saisir la date du contrat');
            }
            if (!location) {
                errors.push('- Vous devez indiquer le lieu électronique');
            }
            if (!signatoryName) {
                errors.push('- Vous devez saisir le nom du signataire');
            }
            
            // Vérification de la signature côté client
            const clientSignatureValue = document.getElementById('client-signature-data').value;
            console.log('Valeur signature client:', clientSignatureValue ? 'Présente (' + clientSignatureValue.length + ' caractères)' : 'Absente');
            
            if (clientSignaturePad.isEmpty() || !clientSignatureValue) {
                errors.push('- La signature du client est obligatoire');
            }

            if (errors.length > 0) {
                e.preventDefault();
                alert('Validation impossible. Éléments obligatoires manquants :\n\n' + errors.join('\n'));
                return false;
            }

            // Confirmation avant validation finale
            if (!confirm('Êtes-vous sûr de vouloir valider ce formulaire ?\n\nUne fois validé, un PDF sera généré et envoyé par email.')) {
                e.preventDefault();
                return false;
            }
        }
    });

    // Ajuster la taille des canvas en fonction de la fenêtre
    function resizeSignaturePads() {
        const canvases = [clientCanvas, technicianCanvas];
        const signaturePads = [clientSignaturePad, technicianSignaturePad];

        canvases.forEach((canvas, index) => {
            const container = canvas.parentElement;
            const containerWidth = container.offsetWidth - 20; // padding
            
            if (containerWidth < 280) {
                canvas.width = containerWidth;
                signaturePads[index].clear(); // Clear when resizing
            }
        });
    }

    // Redimensionner au chargement et lors du redimensionnement de la fenêtre
    window.addEventListener('resize', resizeSignaturePads);
    resizeSignaturePads();
});

// Fonction de debug pour les signatures
function debugSignatures() {
    console.log('=== DEBUG SIGNATURES ===');
    
    const clientEmpty = window.clientSignaturePad ? window.clientSignaturePad.isEmpty() : 'SignaturePad non trouvé';
    const technicianEmpty = window.technicianSignaturePad ? window.technicianSignaturePad.isEmpty() : 'SignaturePad non trouvé';
    
    const clientData = document.getElementById('client-signature-data').value;
    const technicianData = document.getElementById('technician-signature-data').value;
    
    console.log('Client isEmpty:', clientEmpty);
    console.log('Technician isEmpty:', technicianEmpty);
    console.log('Client data length:', clientData ? clientData.length : 0);
    console.log('Technician data length:', technicianData ? technicianData.length : 0);
    
    if (clientData) {
        console.log('Client data preview:', clientData.substring(0, 100) + '...');
    }
    
    alert(`Debug Signatures:
Client vide: ${clientEmpty}
Technicien vide: ${technicianEmpty}
Data client: ${clientData ? clientData.length + ' caractères' : 'Aucune'}
Data technicien: ${technicianData ? technicianData.length + ' caractères' : 'Aucune'}

Vérifiez la console pour plus de détails.`);
}
</script>
@endsection