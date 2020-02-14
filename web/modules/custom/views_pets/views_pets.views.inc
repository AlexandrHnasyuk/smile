<?php

/**
 * Implements hook_views_data_alter().
 */
function views_pets_views_data_alter() {
  $data = [];
  $data['pets_owners_storage'] = [];
  $data['pets_owners_storage']['table'] = [];
  $data['pets_owners_storage']['table']['group'] = t('Pets owners');
  $data['pets_owners_storage']['table']['provider'] = 'pets_owners_storage';
  $data['pets_owners_storage']['table']['base'] = [
    'field' => 'id',
    'title' => t('Pets owners'),
    'help' => t('Pets owners table filter.'),
  ];

  $data['pets_owners_storage']['id'] = [
    'title' => t('id'),
    'help' => t('ID'),
    'field' => [
      'id' => 'standard',
    ],
  ];
  $data['pets_owners_storage']['name'] = [
    'title' => t('name'),
    'help' => t('User name'),
    'field' => [
      'id' => 'standard',
    ],
    'sort' => [
      'id' => 'standard',
    ],
    'filter' => [
      'id' => 'string',
    ],
  ];
  $data['pets_owners_storage']['gender'] = [
    'title' => t('gender'),
    'help' => t('User gender'),
    'field' => [
      'id' => 'standard',
    ],
    'sort' => [
      'id' => 'standard',
    ],
    'filter' => [
      'id' => 'string',
    ],
  ];
  $data['pets_owners_storage']['prefix'] = [
    'title' => t('prefix'),
    'help' => t('Prefix'),
    'field' => [
      'id' => 'standard',
    ],
    'sort' => [
      'id' => 'standard',
    ],
    'filter' => [
      'title' => t('User gender'),
      'help' => t('Filter gender'),
      'field' => 'prefix',
      'id' => 'views_pets',
    ],
  ];
  $data['pets_owners_storage']['age'] = [
    'title' => t('age'),
    'help' => t('User age'),
    'field' => [
      'id' => 'numeric',
    ],
    'sort' => [
      'id' => 'standard',
    ],
  ];
  $data['pets_owners_storage']['father_name'] = [
    'title' => t('father name'),
    'help' => t('Father`s name'),
    'field' => [
      'id' => 'standard',
    ],
    'sort' => [
      'id' => 'standard',
    ],
    'filter' => [
      'id' => 'string',
    ],
  ];
  $data['pets_owners_storage']['mother_name'] = [
    'title' => t('mother name'),
    'help' => t('Mother`s name'),
    'field' => [
      'id' => 'standard',
    ],
    'sort' => [
      'id' => 'standard',
    ],
    'filter' => [
      'id' => 'string',
    ],
  ];
  $data['pets_owners_storage']['pets_name'] = [
    'title' => t('pets name'),
    'help' => t('Pet`s name'),
    'field' => [
      'id' => 'standard',
    ],
    'sort' => [
      'id' => 'standard',
    ],
    'filter' => [
      'id' => 'string',
    ],
  ];
  $data['pets_owners_storage']['email'] = [
    'title' => t('email'),
    'help' => t('User email'),
    'field' => [
      'id' => 'standard',
    ],
    'sort' => [
      'id' => 'standard',
    ],
    'filter' => [
      'id' => 'string',
    ],
  ];

  return $data;
}
