<?php

return [

    'filters' => [

        'archived' => [

            'label' => 'Enregistrement archivés',

            'only_archived' => 'Seulement Enregistrement archivés',

            'with_archived' => 'Avec Enregistrement archivés',

            'without_archived' => 'Sans Enregistrement archivés',

        ],
    ],

    'actions' => [

        'archive' => [

            'single' => [

                'label' => 'Archive',

                'modal' => [

                    'heading' => 'Archive :label',

                    'actions' => [

                        'archive' => [

                            'label' => 'Archive',
                        ],

                    ],

                ],

                'notifications' => [

                    'archived' => [

                        'title' => 'Enregistrement archivé',
                    ],
                ],
            ],
        ],

        'unarchive' => [

            'single' => [

                'label' => 'Publié',

                'modal' => [

                    'heading' => 'Publié :label',

                    'actions' => [

                        'unarchive' => [

                            'label' => 'Publié',
                        ],

                    ],
                ],

                'notifications' => [

                    'unarchived' => [

                        'title' => 'Enregistrement publié',
                    ],
                ],
            ],
        ],
    ],
];
