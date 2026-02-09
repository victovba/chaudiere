<?php
return [
  'site_name' => 'Chauffage-Vosges',
  'domain' => 'chauffage-vosges.fr',
  'brand' => 'Chauffage-Vosges',

  // Contact
  'lead_to_email' => 'contact@chauffage-vosges.fr',
  'phone' => '03 29 XX XX XX',
  
  // Adresse générique
  'address' => [
    'street' => 'Zone d\'activité',
    'city' => 'Épinal',
    'postal_code' => '88000',
    'region' => 'Grand Est',
    'country' => 'FR',
  ],

  // Services chauffage détaillés
  'heating_services' => [
    [
      'slug' => 'chaudiere-gaz',
      'title' => 'Chaudière Gaz',
      'icon' => '🔥',
      'color' => '#e63946',
      'description' => 'Chaudière gaz naturel ou propane - Installation, entretien et réparation dans les Vosges',
      'meta_title' => 'Chaudière Gaz Vosges (88) | Installation & Dépannage | Devis Gratuit',
      'meta_desc' => 'Installation et réparation chaudière gaz dans les Vosges. Condensation, basse température, murale ou sol. Devis gratuit. Intervention rapide Épinal et alentours.',
      'keywords' => ['chaudière gaz', 'installation chaudière gaz', 'réparation chaudière gaz', 'chauffage gaz', 'condensation gaz'],
      'features' => [
        'Installation chaudière gaz neuve',
        'Remplacement ancienne chaudière',
        'Entretien annuel obligatoire',
        'Dépannage urgent 24/7',
        'Chaudière condensation haut rendement',
        'Chaudière basse température'
      ],
      'benefits' => [
        'Économies jusqu\'à 30% sur facture',
        'Subventions MaPrimeRénov',
        'Installation en 1 journée',
        'Garantie décennale',
        'Toutes marques installées'
      ]
    ],
    [
      'slug' => 'chaudiere-electrique',
      'title' => 'Chaudière Électrique',
      'icon' => '⚡',
      'color' => '#f4a261',
      'description' => 'Chaudière électrique - Solution écologique et facile à installer',
      'meta_title' => 'Chaudière Électrique Vosges | Installation & Réparation | Devis',
      'meta_desc' => 'Installation chaudière électrique dans les Vosges. Solution écologique, facile à installer, sans émission. Devis gratuit. Intervention Épinal, Saint-Dié, Rambervillers.',
      'keywords' => ['chaudière électrique', 'chauffage électrique', 'installation chaudière électrique', 'chaudière sans gaz'],
      'features' => [
        'Installation rapide sans conduit',
        'Réparation toutes pannes',
        'Mise aux normes électriques',
        'Entretien annuel conseillé',
        'Changement modèle ancien',
        'Conseil optimisation énergie'
      ],
      'benefits' => [
        'Installation sans travaux lourds',
        'Pas de conduit de cheminée',
        'Écologique zéro émission',
        'Sûr et silencieux',
        'Tarif Heures Creuses optimisé'
      ]
    ],
    [
      'slug' => 'chaudiere-condensation',
      'title' => 'Chaudière à Condensation',
      'icon' => '💧',
      'color' => '#2a9d8f',
      'description' => 'Chaudière à condensation haute performance - Jusqu\'à 30% d\'économies',
      'meta_title' => 'Chaudière Condensation Vosges | Installation RGE | MaPrimeRénov',
      'meta_desc' => 'Installation chaudière à condensation dans les Vosges. Rendement 109%, économies 30%. Aides MaPrimeRénov. Installateur RGE Épinal, Saint-Dié-des-Vosges. Devis gratuit.',
      'keywords' => ['chaudière condensation', 'installation condensation', 'chaudière haute performance', 'MaPrimeRénov', 'aide état chaudière'],
      'features' => [
        'Installation certifiée RGE',
        'Aide MaPrimeRénov',
        'Rendement exceptionnel 109%',
        'Économies 25-30% garanties',
        'Écologique réduction CO2',
        'Subventions calculées'
      ],
      'benefits' => [
        'Rendement maximal',
        'Éligible aides 2024',
        'Amortissement 5 ans',
        'Fiabilité 15+ ans',
        'Réduction facture énergétique'
      ]
    ],
    [
      'slug' => 'chaudiere-fioul',
      'title' => 'Chaudière Fioul',
      'icon' => '🛢️',
      'color' => '#6b705c',
      'description' => 'Entretien et remplacement chaudière fioul - Conversion gaz disponible',
      'meta_title' => 'Chaudière Fioul Vosges | Entretien & Conversion Gaz | Devis',
      'meta_desc' => 'Entretien et remplacement chaudière fioul dans les Vosges. Conversion gaz naturel. Faites des économies ! Intervention rapide. Devis gratuit Épinal, Rambervillers.',
      'keywords' => ['chaudière fioul', 'entretien chaudière fioul', 'conversion fioul gaz', 'remplacement fioul'],
      'features' => [
        'Entretien annuel obligatoire',
        'Ramonage conduit',
        'Conversion fioul vers gaz',
        'Réparation panne fioul',
        'Remplacement complet',
        'Dépannage urgent fioul'
      ],
      'benefits' => [
        'Conversion économique',
        'Fin contrat fioul',
        'Modernisation installation',
        'Gain confort important',
        'Économies substantielles'
      ]
    ],
    [
      'slug' => 'pompe-a-chaleur',
      'title' => 'Pompe à Chaleur',
      'icon' => '🌱',
      'color' => '#52b788',
      'description' => 'PAC air/eau et air/air - Installation et maintenance toutes marques',
      'meta_title' => 'Pompe à Chaleur Vosges (88) | Installation PAC | Aides État',
      'meta_desc' => 'Installation pompe à chaleur air/eau et air/air dans les Vosges. Installateur RGE. Aides MaPrimeRénov et CEE. Devis gratuit. Épinal, Saint-Dié, Rambervillers.',
      'keywords' => ['pompe à chaleur', 'PAC air eau', 'installation PAC', 'aide pompe chaleur', 'PAC Vosges'],
      'features' => [
        'Installation RGE qualifiée',
        'Aides MaPrimeRénov + CEE',
        'PAC Air/Eau haute température',
        'PAC Air/Air multi-split',
        'Entretien annuel PAC',
        'Dépannage toutes marques'
      ],
      'benefits' => [
        'Économies 70% chauffage',
        'Climatisation l\'été',
        'Écologique 100%',
        'Aides jusqu\'à 5000€',
        'Amortissement 7 ans'
      ]
    ],
    [
      'slug' => 'poele-granules',
      'title' => 'Poêle à Granulés',
      'icon' => '🌿',
      'color' => '#8b5e34',
      'description' => 'Poêle et chaudière à granulés de bois - Chauffage écologique',
      'meta_title' => 'Poêle Granulés Vosges | Installation & Entretien | Devis Gratuit',
      'meta_desc' => 'Installation poêle à granulés et chaudière bois dans les Vosges. Chauffage renouvelable, économique. Aides disponibles. Devis gratuit Épinal et alentours.',
      'keywords' => ['poêle granulés', 'chaudière granulés', 'installation poêle bois', 'chauffage bois', 'granulés Vosges'],
      'features' => [
        'Installation poêle granulés',
        'Chaudière à granulés',
        'Ramonage annuel',
        'Entretien complet',
        'Remplacement ancien poêle',
        'Marques Premium (MCZ, Palazzetti)'
      ],
      'benefits' => [
        'Énergie 100% renouvelable',
        'Coût combustible stable',
        'Ambiance chaleureuse',
        'Indépendance énergétique',
        'Aides installation'
      ]
    ],
    [
      'slug' => 'radiateur-electrique',
      'title' => 'Radiateur Électrique',
      'icon' => '🔌',
      'color' => '#e9c46a',
      'description' => 'Radiateurs électriques modernes - Inertie et connecté',
      'meta_title' => 'Radiateur Électrique Vosges | Installation & Remplacement | Devis',
      'meta_desc' => 'Installation radiateurs électriques dans les Vosges. Inertie sèche, fluide, connecté. Optimisez votre chauffage électrique. Devis gratuit Épinal, Saint-Dié.',
      'keywords' => ['radiateur électrique', 'radiateur inertie', 'remplacement radiateur', 'radiateur connecté', 'chauffage électrique'],
      'features' => [
        'Radiateur inertie sèche',
        'Radiateur inertie fluide',
        'Radiateur connecté WiFi',
        'Programmable intelligent',
        'Installation murale',
        'Conseil optimisation'
      ],
      'benefits' => [
        'Économies 30% Heures Creuses',
        'Confort thermique optimal',
        'Installation rapide',
        'Design moderne',
        'Pilotable à distance'
      ]
    ],
    [
      'slug' => 'plancher-chauffant',
      'title' => 'Plancher Chauffant',
      'icon' => '🏠',
      'color' => '#457b9d',
      'description' => 'Plancher chauffant hydraulique ou électrique - Confort optimal',
      'meta_title' => 'Plancher Chauffant Vosges | Installation & Rénovation | Devis',
      'meta_desc' => 'Installation plancher chauffant dans les Vosges. Hydraulique ou électrique, neuf ou rénovation. Confort optimal. Devis gratuit Épinal, Rambervillers, Saint-Dié.',
      'keywords' => ['plancher chauffant', 'chauffage sol', 'installation plancher', 'plancher hydraulique', 'plancher électrique'],
      'features' => [
        'Plancher chauffant hydraulique',
        'Plancher chauffant électrique',
        'Plancher rafraîchissant',
        'Rénovation plancher existant',
        'Construction neuve',
        'Couplage PAC idéal'
      ],
      'benefits' => [
        'Confort thermique maximum',
        'Chaleur homogène',
        'Invisible dans la maison',
        'Compatible PAC',
        'Économies énergie'
      ]
    ]
  ],

  // Villes avec contenu unique
  'main_cities' => [
    'epinal' => [
      'name' => 'Épinal',
      'cp' => '88000',
      'population' => 32105,
      'slug' => 'epinal',
      'caracteristics' => 'Préfecture des Vosges, climat semi-continental avec hivers froids',
      'specific_needs' => 'Rénovation énergétique des maisons anciennes du centre-ville',
      'top_services' => ['chaudière condensation', 'pompe à chaleur', 'rénovation complète'],
      'nearby' => ['Golbey', 'Jeuxey', 'Chantraine'],
      'content_focus' => 'Rénovation énergétique, aides MaPrimeRénov, maisons anciennes',
      'climate' => 'Hivers froids -5°C, besoin chauffage performant'
    ],
    'saint-die-des-vosges' => [
      'name' => 'Saint-Dié-des-Vosges',
      'cp' => '88100', 
      'population' => 19638,
      'slug' => 'saint-die-des-vosges',
      'caracteristics' => 'Capitale géographique, altitude 360m, vallée encaissée',
      'specific_needs' => 'Résistance au froid intense, chauffage haute performance',
      'top_services' => ['pompe à chaleur air/eau', 'chaudière gaz haute puissance'],
      'nearby' => ['Saint-Michel-sur-Meurthe', 'Nompatelize'],
      'content_focus' => 'Hivers rigoureux, altitude, solutions très haute performance',
      'climate' => 'Hivers très froids -10°C, nécessité puissance élevée'
    ],
    'rambervillers' => [
      'name' => 'Rambervillers',
      'cp' => '88700',
      'population' => 4965,
      'slug' => 'rambervillers',
      'caracteristics' => 'Zone rurale vosgienne, maisons individuelles isolées',
      'specific_needs' => 'Conversion fioul vers solutions modernes',
      'top_services' => ['conversion fioul gaz', 'poêle à granulés', 'pompe à chaleur'],
      'nearby' => ['Padoux', 'Saint-Genest', 'Domptail-sur-Madon'],
      'content_focus' => 'Ruralité, conversion énergétique, fioul à remplacer',
      'climate' => 'Zone rurale froide, maisons mal isolées'
    ],
    'thaon-les-vosges' => [
      'name' => 'Thaon-les-Vosges',
      'cp' => '88150',
      'population' => 4271,
      'slug' => 'thaon-les-vosges',
      'caracteristics' => 'Zone industrielle et résidentielle mixte',
      'specific_needs' => 'Solutions économiques pour budgets maîtrisés',
      'top_services' => ['radiateur électrique', 'chaudière économique', 'chaudière électrique'],
      'nearby' => ['Chavelot', 'Dombasle-sur-Madon'],
      'content_focus' => 'Budgets maîtrisés, solutions abordables, logements sociaux',
      'climate' => 'Standard, besoins économies maximales'
    ],
    'bruyeres' => [
      'name' => 'Bruyères',
      'cp' => '88600',
      'population' => 3063,
      'slug' => 'bruyeres',
      'caracteristics' => 'Village de montagne vosgienne, altitude 500m',
      'specific_needs' => 'Chauffage robuste pour froid montagnard',
      'top_services' => ['poêle à granulés', 'chaudière bois', 'PAC haute température'],
      'nearby' => ['Aumontzey', 'Fays', 'Biffontaine'],
      'content_focus' => 'Montagne, altitude, bois énergie, résistance froid',
      'climate' => 'Montagne -15°C possible, besoin puissance + isolation'
    ],
    'golbey' => [
      'name' => 'Golbey',
      'cp' => '88190',
      'population' => 8982,
      'slug' => 'golbey',
      'caracteristics' => 'Banlieue pavillonnaire d\'Épinal, constructions récentes',
      'specific_needs' => 'Domotique et confort thermique moderne',
      'top_services' => ['chaudière condensation', 'plancher chauffant', 'domotique'],
      'nearby' => ['Épinal', 'Chavelot'],
      'content_focus' => 'Pavillons modernes, domotique, confort premium',
      'climate' => 'Standard, maisons bien isolées récentes'
    ]
  ],

  // Horaires
  'opening_hours' => [
    'monday' => ['07:30', '19:00'],
    'tuesday' => ['07:30', '19:00'],
    'wednesday' => ['07:30', '19:00'],
    'thursday' => ['07:30', '19:00'],
    'friday' => ['07:30', '19:00'],
    'saturday' => ['08:00', '17:00'],
    'sunday' => null,
  ],

  // Tech
  'timezone' => 'Europe/Paris',
  'cache_ttl_seconds' => 3600,
  'base_url' => 'https://chauffage-vosges.fr',
];
