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
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\GroupedProduct\Block\Adminhtml\Order\Create;

class SidebarTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Magento\GroupedProduct\Block\Adminhtml\Order\Create\Sidebar
     */
    protected $sidebarMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $invocationChainMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $itemMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $productMock;

    protected function setUp()
    {
        $this->invocationChainMock = $this->getMock('Magento\Code\Plugin\InvocationChain', array(), array(), '', false);
        $this->itemMock = $this->getMock('Magento\Catalog\Model\Product\Configuration\Item\ItemInterface');
        $this->productMock = $this->getMock('Magento\Catalog\Model\Product', array(), array(), '', false);
        $this->sidebarMock = new \Magento\GroupedProduct\Block\Adminhtml\Order\Create\Sidebar();
    }

    public function testAroundGetItemQtyWhenProductGrouped()
    {
        $this->itemMock->expects($this->once())->method('getProduct')->will($this->returnValue($this->productMock));
        $this->productMock
            ->expects($this->once())
            ->method('getTypeId')
            ->will($this->returnValue(\Magento\GroupedProduct\Model\Product\Type\Grouped::TYPE_CODE));
        $this->invocationChainMock->expects($this->never())->method('proceed');
        $this->assertEquals('',
            $this->sidebarMock->aroundGetItemQty(array($this->itemMock), $this->invocationChainMock));
    }

    public function testAroundGetItemQtyWhenProductNotGrouped()
    {
        $arguments = array($this->itemMock);
        $this->itemMock->expects($this->once())->method('getProduct')->will($this->returnValue($this->productMock));
        $this->productMock
            ->expects($this->once())
            ->method('getTypeId')
            ->will($this->returnValue('one'));
        $this->invocationChainMock->expects($this->once())->method('proceed')->with($arguments);
        $this->sidebarMock->aroundGetItemQty($arguments, $this->invocationChainMock);
    }

    public function testAroundIsConfigurationRequiredWhenProductGrouped()
    {
        $this->invocationChainMock->expects($this->never())->method('proceed');
        $this->assertEquals(true,
            $this->sidebarMock->aroundIsConfigurationRequired(
                array(\Magento\GroupedProduct\Model\Product\Type\Grouped::TYPE_CODE),
                $this->invocationChainMock)
        );
    }

    public function testAroundIsConfigurationRequiredWhenProductNotGrouped()
    {
        $arguments = array('someValue');
        $this->invocationChainMock->expects($this->once())->method('proceed')->with($arguments);
        $this->sidebarMock->aroundIsConfigurationRequired($arguments, $this->invocationChainMock);
    }
}

