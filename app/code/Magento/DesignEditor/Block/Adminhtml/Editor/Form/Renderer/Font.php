<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Magento_DesignEditor
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Composite 'font' element renderer
 */
namespace Magento\DesignEditor\Block\Adminhtml\Editor\Form\Renderer;

class Font
    extends \Magento\DesignEditor\Block\Adminhtml\Editor\Form\Renderer
{
    /**
     * Path to template file in theme.
     *
     * @var string
     */
    protected $_template = 'Magento_DesignEditor::editor/form/renderer/font.phtml';

    /**
     * Get element CSS classes
     *
     * @return array
     */
    public function getClasses()
    {
        /** @var $element \Magento\DesignEditor\Block\Adminhtml\Editor\Form\Element\Font */
        $element = $this->getElement();

        $classes = array();
        $classes[] = 'fieldset';
        if ($element->getClass()) {
            $classes[] = $element->getClass();
        }

        return $classes;
    }
}
