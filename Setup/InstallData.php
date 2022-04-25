<?php
namespace RG\CategoryImage\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Category::ENTITY,'category_image_desktop');
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'category_image_desktop',
            [
                'type'         => 'varchar',
                'label'        => 'Category Desktop Image',
                'input'        => 'image',
                'sort_order'   => 100,
                'backend'      => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                'global'       => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'visible'      => true,
                'required'     => false,
                'group'        => 'General Information',
            ]
        );

        $eavSetup->removeAttribute(\Magento\Catalog\Model\Category::ENTITY,'category_image_mobile');
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'category_image_mobile',
            [
                'type'         => 'varchar',
                'label'        => 'Category Mobile Image',
                'input'        => 'image',
                'sort_order'   => 200,
                'backend'      => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                'global'       => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'visible'      => true,
                'required'     => false,
                'group'        => 'General Information',
            ]
        );

        $setup->endSetup();
    }
}