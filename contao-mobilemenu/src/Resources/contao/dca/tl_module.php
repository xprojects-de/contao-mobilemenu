<?php

$GLOBALS['TL_DCA']['tl_module']['palettes']['xmobilemenue'] = '{title_legend},name,type;{template_legend},xmobilemenuemid,xmobilemenuemicon,xmobilemenuemcloseicon,xmobilemenuemcompletesize;{expert_legend:hide},cssID';

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
$GLOBALS['TL_DCA']['tl_module']['fields']['xmobilemenuemcloseicon'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['xmobilemenuemcloseicon'],
    'exclude' => true,
    'inputType' => 'fileTree',
    'eval' => array('filesOnly' => true, 'files' => true, 'fieldType' => 'radio', 'mandatory' => true, 'tl_class' => 'clr'),
    'sql' => "binary(16) NULL",
);
$GLOBALS['TL_DCA']['tl_module']['fields']['xmobilemenuemcompletesize'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['xmobilemenuemcompletesize'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array('mandatory' => false),
    'sql' => "int(10) unsigned NOT NULL default '0'"
);
