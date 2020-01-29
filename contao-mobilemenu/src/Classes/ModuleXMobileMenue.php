<?php

namespace XProjects\Mobilemenu\Classes;

class ModuleXMobileMenue extends \Module {

  protected $strTemplate = 'mod_xmobilemenue';

  protected function compile() {

    $assetsDir = 'bundles/mobilemenu';
    $GLOBALS['TL_JAVASCRIPT'][] = $assetsDir . '/js/nav_jquery.js|static';
    //$GLOBALS['TL_CSS'][] = $assetsDir . '/scss/nav_jquery.css|static';

    $imageNormal = $this->xgetImage($this->xmobilemenuemicon);
    $imageClose = $this->xgetImage($this->xmobilemenuemcloseicon);

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
    $icon = "";
    if ($imageNormal != "") {
      $icon = '<img src="' . $imageNormal . '" />';
    }
    $closeArea = '';
    if ($this->xmobilemenuemcompletesize == 1) {
      $closeArea = '<div class="xmobilemenue_maincontainer_inside_close"><a href="#" onclick="return false;"><img src="' . $imageClose . '" /></a></div><div style="clear:both;"></div>';
    }
    $returnvalue = '<div class="xmobilemenue" id="xmobilemenue_' . $this->id . '">
            <div class="xmobilemenue_btcontainer" id="xmobilemenue_btcontainer_' . $this->id . '"><span id="xmobilemenuebt_' . $this->id . '">' . $icon . '</span></div>
            <div class="xmobilemenue_maincontainer" id="xmobilemenue_maincontainer_' . $this->id . '"><div class="xmobilemenue_maincontainer_inside">' . $closeArea . $this->replaceInsertTags('{{insert_module::' . $this->xmobilemenuemid . '}}') . '</div></div>    
            </div>';
    $this->Template->xausgabe = $returnvalue;
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
