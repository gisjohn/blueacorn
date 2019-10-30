<?php
 
namespace RedAlmond\Cms\Setup;
 
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
 
class InstallData implements \Magento\Framework\Setup\InstallDataInterface
{
    /**
     * @var \Magento\Cms\Model\PageFactory
     */
    private $_pageFactory;
 
    /**
     * InstallData constructor
     *
     * @param \Magento\Cms\Model\PageFactory $pageFactory
     */
    public function __construct(
        \Magento\Cms\Model\PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;
    }
 
    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Exception
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        // Load cms page by identifier
        $cmsPage = $this->_pageFactory->create()->load('test-page', 'identifier');
 
        // Create CMS Page
        if (!$cmsPage->getId()) {
            $cmsPageData = [
                'title' => 'Style Guide',
                'identifier' => 'style-guide',
                'content' => '<style>.grid {  display: grid; grid-template-columns: 1fr 1fr 1fr; grid-gap: 40px; }</style>
<h1>BUTTONS</h1>
<div class="grid">
<div class="col"><button class="button primary tocart" type="button"><span><span>Load More</span></span></button></div>
<div class="col"><button class="button btn-continue" title="Continue Shopping" type="button"><span><span>Continue Shopping</span></span></button></div>
<div class="col"><button class="action primary checkout" type="button">Checkout</button></div>
</div>',
                'is_active' => 1,
                'stores' => [0],
                'sort_order' => 0
            ];
 
            $this->_pageFactory->create()->setData($cmsPageData)->save();
        }
    }
}