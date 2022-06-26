<?php

namespace EasyCorp\Bundle\EasyAdminBundle\Field;

use EasyCorp\Bundle\EasyAdminBundle\Config\Asset;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Contracts\Translation\TranslatableInterface;

/**
 * @author Yoel Velasquez <yoel.velasquez.valencia@gmail.com>
 */
final class TextTinyField implements FieldInterface
{
    use FieldTrait;

    //public const OPTION_NUM_OF_ROWS = 'numOfRows';
    //public const OPTION_TRIX_EDITOR_CONFIG = 'trixEditorConfig';

    /**
     * @param TranslatableInterface|string|false|null $label
     */
    public static function new(string $propertyName, $label = null): self
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setTemplateName('admin/field/textarea')
            ->setFormType(TextareaType::class)
            ->addCssClass('field-tiny_editor')
            //
            
            //->addCssFiles(Asset::fromEasyAdminAssetPackage('field-text-editor.css')->onlyOnForms())
            //->addJsFiles(Asset::fromEasyAdminAssetPackage('field-text-editor.js')->onlyOnForms())
            ->setDefaultColumns('col-md-9 col-xxl-7')
            //->setCustomOption(self::OPTION_NUM_OF_ROWS, null)
            //->setCustomOption(self::OPTION_TRIX_EDITOR_CONFIG, null)
            ;
    }
    /*
    public function setNumOfRows(int $rows): self
    {
        if ($rows < 1) {
            throw new \InvalidArgumentException(sprintf('The argument of the "%s()" method must be 1 or higher (%d given).', __METHOD__, $rows));
        }

        $this->setCustomOption(self::OPTION_NUM_OF_ROWS, $rows);

        return $this;
    }

    public function setTrixEditorConfig(array $config): self
    {
        $this->setCustomOption(self::OPTION_TRIX_EDITOR_CONFIG, $config);

        return $this;
    }
    */
}
