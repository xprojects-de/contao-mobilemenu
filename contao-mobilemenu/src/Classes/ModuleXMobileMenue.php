<?php

namespace XProjects\Mobilemenu\Classes;

class ModuleXMobileMenue extends \Module {

  protected $strTemplate = 'mod_xmobilemenue';

  protected function compile() {

    $assetsDir = 'bundles/mobilemenu';
    $GLOBALS['TL_JAVASCRIPT'][] = $assetsDir . '/js/nav_jquery.js|static';
    //$GLOBALS['TL_CSS'][] = $assetsDir . '/scss/nav_jquery.css|static';

    $js_query = '<script src="system/modules/xmobilemenu/assets/nav_jquery.js"></script>
        <script>
            (function ($) {
                $(document).ready(function () {
                    new $.XMobileMenu($("#xmobilemenuebt_' . $this->id . '"), $("#xmobilemenue_maincontainer_' . $this->id . '"), true, ' . ($this->xmobilemenuemcompletesize == 1 ? 'true' : 'false') . ');
                });
            })(jQuery);
        </script>';

    $css = '<style type="text/css" media="all">
        /* <![CDATA[ */   
        .xmobilemenue {display:none;}           
        #xmobilemenue_maincontainer_' . $this->id . ' {display:none;width:100%;z-index:5000;left:0;top:0;position: absolute;margin:0;}        
        #xmobilemenuebt_' . $this->id . ' {cursor:pointer;}
        /* ]]> */
        </style>            
        ';

    $GLOBALS['TL_HEAD'][] = $css;
    $GLOBALS['TL_JQUERY'][] = $js_query;

    $imageNormal = $this->xgetImage($this->xmobilemenuemicon);
    $icon = "";
    if ($imageNormal != "") {
      $icon = '<img src="' . $imageNormal . '" />';
    }

    $imageClose = $this->xgetImage($this->xmobilemenuemcloseicon);
    $iconClose = "";
    if ($imageClose != "") {
      $iconClose = '<img src="' . $imageClose . '" />';
    }

    $this->Template->id = $this->id;
    $this->Template->closearea = ($this->xmobilemenuemcompletesize == 1);
    $this->Template->modulePlaceholder = $this->replaceInsertTags('{{insert_module::' . $this->xmobilemenuemid . '}}');
    $this->Template->icon = $icon;
    $this->Template->iconClose = $iconClose;
  }

  private function xgetImage($uuid) {
    $returnvalue = "";
    $objFile = \FilesModel::findByUuid($uuid);
    if ($objFile === null) {
      if (!\Validator::isUuid($this->singleSRC)) {
        return '';
      }
      return '';
    }
    if (is_file(TL_ROOT . '/' . $objFile->path)) {
      $file1 = new \File($objFile->path, true);
      if ($file1->exists()) {
        $img = $this->getImage($objFile->path, $file1->width, $file1->height);
        $returnvalue = $img;
      }
    }
    return $returnvalue;
  }

}
