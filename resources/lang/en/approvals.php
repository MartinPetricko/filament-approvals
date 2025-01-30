<?php

// translations for MartinPetricko/FilamentApprovals
return [
    'pages' => [
        'approvals' => [
            'breadcrumb' => 'Approvals',

            'view' => [
                'revisions_list' => 'Revisions list',
                'revision_by' => 'Revision by :name',
                'anonymous_user' => 'Anonymous User',
                'message' => 'Message',
            ],

            'actions' => [
                'approve' => [
                    'label' => 'Approve',
                ],
                'reject' => [
                    'label' => 'Reject',

                    'form' => [
                        'fields' => [
                            'message' => 'Message',
                        ],
                    ],
                ],
            ],
        ],
    ],

    'actions' => [
        'approvals' => [
            'label' => 'Approvals',
        ],
    ],

    'enums' => [
        'draft_status' => [
            'label' => [
                'pending' => 'Pending',
                'approved' => 'Approved',
                'rejected' => 'Rejected',
            ],
        ],
        'draft_type' => [
            'label' => [
                'create' => 'Create',
                'update' => 'Update',
                'delete' => 'Delete',
            ],
        ],
    ],
];
