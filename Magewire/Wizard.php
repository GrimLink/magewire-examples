<?php declare(strict_types=1);

namespace Magewirephp\MagewireExamples\Magewire;

use Magewirephp\Magewire\Component;

// TODO create function for currentStep and lastStep
class Wizard extends Component
{
    public $activeStep = 0;
    public $stepAmount = 0;
    public $stepHtml = '';

    public function mount()
    {
        /** @var $block Magento\Framework\View\Element\Template $block */
        $block = $this->getParent();
        $children = $block->getChildNames();
        $this->stepAmount = count($children) - 1;

        $this->getCurrentStep();
    }

    public function getCurrentStep()
    {
        /** @var $block Magento\Framework\View\Element\Template $block */
        $block = $this->getParent();
        $children = $block->getChildNames();
        $this->stepHtml = $block->getChildHtml($children[$this->activeStep]);
    }

    public function nextStep()
    {
        if ($this->activeStep === ($this->stepAmount - 1)) {
            $this->dispatchNoticeMessage("at the last step");
        }
        if ($this->activeStep === $this->stepAmount) {
            return;
        }
        $this->activeStep++;
        $this->getCurrentStep();
    }

    public function prevStep()
    {
        if ($this->activeStep === 0) {
            return;
        }
        $this->activeStep--;
        $this->getCurrentStep();
    }
}
