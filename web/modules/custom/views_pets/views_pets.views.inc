<?php

/**
 * Implements hook_views_data().
 */
function views_pets_views_data() {
  $data = [];
  $data['pets_owners_storage'] = [];
  $data['pets_owners_storage']['table'] = [];
  $data['pets_owners_storage']['table']['group'] = t('Pets owners');
  $data['pets_owners_storage']['table']['provider'] = 'pets_owners_storage';
  $data['pets_owners_storage']['table']['base'] = [
    'field' => 'id',
    'title' => t('Pets owners'),
    'help' => t('Pets table contains all pets owners.'),
  ];

  $data['pets_owners_storage']['id'] = [
    'title' => t('id'),
    'help' => t('id'),
    'field' => [
      'id' => 'standard',
    ],
  ];

  $data['pets_owners_storage']['name'] = [
    'title' => t('name'),
    'help' => t('user name'),
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
    'help' => t('user gender'),
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
    'title' => t('Prefix pets'),
    'help' => t('field prefix'),
    'field' => [
      'id' => 'standard',
    ],
    'sort' => [
      'id' => 'standard',
    ],
    'filter' => [
      'title' => t('Prefix for pets'),
      'help' => t('Filter prefix pets.'),
      'field' => 'prefix',
      'id' => 'views_pets_prefix',
    ],
  ];
  $data['pets_owners_storage']['age'] = [
    'title' => t('age'),
    'help' => t('user age'),
    'field' => [
      'id' => 'numeric',
    ],
    'sort' => [
      'id' => 'standard',
    ],
  ];
  $data['pets_owners_storage']['father_name'] = [
    'title' => t('father'),
    'help' => t('father`s name'),
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
    'title' => t('mother'),
    'help' => t('mother`s name'),
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
  $data['pets_owners_storage']['pets'] = [
    'title' => t('pets'),
    'help' => t('pets'),
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
  $data['pets_owners_storage']['name_pets'] = [
    'title' => t('pets name'),
    'help' => t('pet`s name'),
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
    'help' => t('user email'),
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
