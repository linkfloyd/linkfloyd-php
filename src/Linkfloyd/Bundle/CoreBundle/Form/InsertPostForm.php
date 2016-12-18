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
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

class InsertPostForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', UrlType::class, [
                'label_format' => 'form.insert_post.labels.url',
                'constraints' => [
                    new NotBlank(['message' => 'form.insert_post.validation.url_not_blank']),
                    new Url(['message' => 'form.insert_post.validation.url_valid_url']),
                ],
            ])
            ->add('title', TextareaType::class, [
                'label_format' => 'form.insert_post.labels.title',
                'attr' => ['rows' => 3, 'maxlength' => 350],
                'constraints' => [
                    new NotBlank(['message' => 'form.insert_post.validation.title_not_blank']),
                    new Assert\Length([
                        'max' => 350,
                        'maxMessage' => 'form.insert_post.validation.title_too_long',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class);
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }

    public function getName()
    {
        return 'login';
    }
}
