<?php

/**
 * Ecomteck
 * Copyright (C) 2018 Ecomteck
 *
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://opensource.org/licenses/gpl-3.0.html
 *
 * @category Ecomteck
 * @package Ecomteck_ProductAttachment
 * @copyright Copyright (c) 2018 Ecomteck
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author Ecomteck
 */

namespace Ecomteck\ProductAttachment\Block\Adminhtml\ProductAttachment\Renderer;
 
use Magento\Framework\DataObject;

/**
 * Class FileIcon
 * @package Ecomteck\ProductAttachment\Block\Adminhtml\ProductAttachment\Renderer
 */
class FileIcon extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{

    /**
     * @var \Magento\Framework\View\Asset\Repository
     */
    private $assetRepo;
    
    /**
     * @var \Ecomteck\ProductAttachment\Helper\Data
     */
    private $dataHelper;

    /**
     * @param \Magento\Framework\View\Asset\Repository $assetRepo
     * @param \Ecomteck\ProductAttachment\Helper\Data $dataHelper
     */
    public function __construct(
        \Magento\Framework\View\Asset\Repository $assetRepo,
        \Ecomteck\ProductAttachment\Helper\Data $dataHelper
    ) {
        $this->dataHelper = $dataHelper;
        $this->assetRepo = $assetRepo;
    }

    /**
     * get customer group name
     * @param  DataObject $row
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function render(DataObject $row)
    {
        $file = $row->getFile();
        $fileExt = pathinfo($file, PATHINFO_EXTENSION);
        if ($fileExt) {
            $iconImage = $this->assetRepo->getUrl('Ecomteck_ProductAttachment::images/'.$fileExt.'.png');
            $fileIcon = "<a href=".$this->dataHelper->getBaseUrl().'/'.$file." target='_blank'>
            <img src='".$iconImage."' /></a>";
        } else {
            $iconImage = $this->assetRepo->getUrl('Ecomteck_ProductAttachment::images/unknown.png');
            $fileIcon = "<img src='".$iconImage."' />";
        }
        
        return $fileIcon;
    }
}
