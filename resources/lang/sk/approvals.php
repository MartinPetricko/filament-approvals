<?php

// translations for MartinPetricko/FilamentApprovals
return [
    'pages' => [
        'approvals' => [
            'breadcrumb' => 'Schválenia',

            'view' => [
                'revisions_list' => 'Zoznam revízií',
                'revision_by' => 'Revízia od :name',
                'anonymous_user' => 'Anonymný používateľ',
                'message' => 'Správa',
            ],

            'actions' => [
                'approve' => [
                    'label' => 'Potvrdiť',
                ],
                'reject' => [
                    'label' => 'Zamietnuť',

                    'form' => [
                        'fields' => [
                            'message' => 'Správa',
                        ],
                    ],
                ],
            ],
        ],
    ],

    'actions' => [
        'approvals' => [
            'label' => 'Schválenia',
        ],
    ],

    'enums' => [
        'draft_status' => [
            'label' => [
                'pending' => 'Čakajúce',
                'approved' => 'Schválené',
                'rejected' => 'Zamietnuté',
            ],
        ],
        'draft_type' => [
            'label' => [
                'create' => 'Vytvoriť',
                'update' => 'Upraviť',
                'delete' => 'Odstrániť',
            ],
        ],
    ],
];
