<?php

declare(strict_types=1);

namespace XProjects\Mobilemenu\Controller;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\Image\ImageFactoryInterface;
use Contao\Environment;
use Contao\File;
use Contao\FilesModel;
use Contao\Image\ResizeConfiguration;
use Contao\ModuleModel;
use Contao\StringUtil;
use Contao\Template;
use Contao\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MobileMenuController extends AbstractFrontendModuleController
{
    protected ContaoFramework $framework;
    private string $rootDir;
    private ImageFactoryInterface $imageFactory;

    public function __construct(ContaoFramework $framework, string $rootDir, ImageFactoryInterface $imageFactory)
    {
        $this->framework = $framework;
        $this->rootDir = $rootDir;
        $this->imageFactory = $imageFactory;
    }

    /**
     * @param Template $template
     * @param ModuleModel $model
     * @param Request $request
     * @return Response
     */
    public function getResponse(Template $template, ModuleModel $model, Request $request): Response
    {
        $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/mobilemenu/js/nav_jquery.js|static';

        if ($model->xmobilemenuemcloseicon === null || $model->xmobilemenuemcloseicon === '') {
            $model->xmobilemenuemcloseicon = $model->xmobilemenuemicon;
            $model->xmobilemenuemcloseicon_size = $model->xmobilemenuemicon_size;
        }

        $iconImage = $this->getImageInternal($model->xmobilemenuemicon, $model->xmobilemenuemicon_size);
        $iconCloseImage = $this->getImageInternal($model->xmobilemenuemcloseicon, $model->xmobilemenuemcloseicon_size);

        $GLOBALS['TL_HEAD'][] = '<style>
        /* <![CDATA[ */   
        .xmobilemenue {display:none;}           
        #xmobilemenue_maincontainer_' . $model->id . ' {display:none;}        
        #xmobilemenuebt_' . $model->id . ' {cursor:pointer;}
        /* ]]> */
        </style>';

        $GLOBALS['TL_JQUERY'][] = '<script>
            (function ($) {
                $(document).ready(function () {
                    new $.XMobileMenu($("#xmobilemenue_btcontainer_' . $model->id . '"), $("#xmobilemenue_maincontainer_' . $model->id . '"), ' . ((int)$model->xmobilemenuemcompletesize === 1 ? 'true' : 'false') . ',\'' . Environment::get('base') . $iconImage . '\',\'' . Environment::get('base') . $iconCloseImage . '\');
                });
            })(jQuery);
        </script>';

        $template->id = $model->id;
        $template->closearea = ((int)$model->xmobilemenuemcompletesize === 1);
        $template->modulePlaceholder = (int)$model->xmobilemenuemid;
        $template->moduleAlt = $model->xmobilemenuemalt;
        $template->iconImage = $iconImage;
        $template->iconCloseImage = $iconCloseImage;

        return $template->getResponse();

    }

    /**
     * @param string|null $uuid
     * @param string|null $size
     * @return string|null
     */
    private function getImageInternal(?string $uuid, ?string $size): ?string
    {
        $imageSrc = null;

        try {

            if (!Validator::isUuid($uuid)) {
                return null;
            }

            $objFileModel = FilesModel::findByUuid($uuid);
            if ($objFileModel === null) {
                return null;
            }

            $imageObject = new File($objFileModel->path);
            if ($imageObject->exists()) {

                $defaultConfig = [$imageObject->width, $imageObject->height, ResizeConfiguration::MODE_CROP];
                if ($size !== null && $size !== '') {

                    $sizeConfig = StringUtil::deserialize($size);
                    if (\count($sizeConfig) === 3 && $sizeConfig[2] !== '') {
                        $defaultConfig = $sizeConfig;
                    }

                }

                $imageSrc = $this->imageFactory->create($this->rootDir . '/' . \rawurldecode($imageObject->path), $defaultConfig)->getUrl($this->rootDir);

            }

        } catch (\Exception) {

        }

        return $imageSrc;
    }

}
