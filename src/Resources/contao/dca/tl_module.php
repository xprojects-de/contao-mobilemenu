<?php

use Contao\System;

$GLOBALS['TL_DCA']['tl_module']['palettes']['mobile_menu'] = '{title_legend},name,type;{template_legend},xmobilemenuemid,xmobilemenuemicon,xmobilemenuemicon_size,xmobilemenuemcloseicon,xmobilemenuemcloseicon_size,xmobilemenuemcompletesize,xmobilemenuemalt,{expert_legend:hide},cssID';

$GLOBALS['TL_DCA']['tl_module']['fields']['xmobilemenuemid'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['xmobilemenuemid'],
    'exclude' => true,
    'inputType' => 'select',
    'foreignKey' => 'tl_module.name',
    'eval' => array('mandatory' => true),
    'sql' => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['xmobilemenuemicon'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['xmobilemenuemicon'],
    'exclude' => true,
    'inputType' => 'fileTree',
    'eval' => array('filesOnly' => true, 'files' => true, 'fieldType' => 'radio', 'mandatory' => true, 'tl_class' => 'clr'),
    'sql' => "binary(16) NULL",
);

$GLOBALS['TL_DCA']['tl_module']['fields']['xmobilemenuemicon_size'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['xmobilemenuemicon_size'],
    'exclude' => true,
    'inputType' => 'imageSize',
    'reference' => &$GLOBALS['TL_LANG']['MSC'],
    'eval' => [
        'rgxp' => 'natural',
        'includeBlankOption' => true,
        'nospace' => true,
        'helpwizard' => true,
        'tl_class' => 'clr w50',
    ],
    'options_callback' => static function () {
        return System::getContainer()->get('contao.image.sizes')?->getAllOptions();
    },
    'sql' => "varchar(64) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['xmobilemenuemcloseicon'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['xmobilemenuemcloseicon'],
    'exclude' => true,
    'inputType' => 'fileTree',
    'eval' => array('filesOnly' => true, 'files' => true, 'fieldType' => 'radio', 'mandatory' => false, 'tl_class' => 'clr'),
    'sql' => "binary(16) NULL",
);

$GLOBALS['TL_DCA']['tl_module']['fields']['xmobilemenuemcloseicon_size'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['xmobilemenuemcloseicon_size'],
    'exclude' => true,
    'inputType' => 'imageSize',
    'reference' => &$GLOBALS['TL_LANG']['MSC'],
    'eval' => [
        'rgxp' => 'natural',
        'includeBlankOption' => true,
        'nospace' => true,
        'helpwizard' => true,
        'tl_class' => 'clr w50',
    ],
    'options_callback' => static function () {
        return System::getContainer()->get('contao.image.sizes')?->getAllOptions();
    },
    'sql' => "varchar(64) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['xmobilemenuemcompletesize'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['xmobilemenuemcompletesize'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array('mandatory' => false, 'tl_class' => 'clr'),
    'sql' => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['xmobilemenuemalt'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['xmobilemenuemalt'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => false, 'tl_class' => 'clr'),
    'sql' => "varchar(64) NOT NULL default ''"
);
