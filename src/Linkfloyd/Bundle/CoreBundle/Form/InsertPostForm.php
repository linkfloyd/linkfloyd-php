<?php
/**
 * @author Guven Atbakan <guven@atbakan.com>
 */
namespace Linkfloyd\Bundle\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;

class InsertPostForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', UrlType::class, [
                'label_format' => 'form.insert_post.labels.url',
            ])
            ->add('title', TextareaType::class, [
                'label_format' => 'form.insert_post.labels.title',
                'attr' => ['rows' => 3],
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function getName()
    {
        return 'login';
    }
}
