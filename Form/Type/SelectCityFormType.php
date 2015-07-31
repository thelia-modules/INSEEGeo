<?php
/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace INSEEGeo\Form\Type;

use INSEEGeo\INSEEGeo;
use INSEEGeo\Model\InseeGeoMunicipalityI18nQuery;
use INSEEGeo\Model\InseeGeoMunicipalityQuery;
use INSEEGeo\Model\Map\InseeGeoMunicipalityI18nTableMap;
use INSEEGeo\Model\Map\InseeGeoMunicipalityTableMap;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Blank;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ExecutionContextInterface;
use Thelia\Core\Translation\Translator;
use Thelia\Model\LangQuery;

/**
 * Class SelectCityFormType
 * @package INSEEGeo\Form\Type
 * @author David Gros <dgros@openstudio.fr>
 */
class SelectCityFormType extends AbstractType
{
    protected $city;
    protected $locale;
    protected $translator;
    const ZIP_CODE_REGEX = "#^[0-9]{5}$#";

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->translator = $translator = Translator::getInstance();
        $this->locale = $translator->getLocale();

        $zip_label = (isset($options['label']['zip']))
            ? $options['label']['zip']
            : $translator->trans('zip_code',[], INSEEGeo::DOMAIN_NAME);
        $zip_label_attr_for = (isset($options['label_attr']['for']['zip']))
            ? $options['label_attr']['for']['zip']
            : 'city_zip_code';
        $city_label = (isset($options['label']['city']))
            ? $options['label']['city']
            : $translator->trans('city_code',[], INSEEGeo::DOMAIN_NAME);
        $city_label_attr_for = (isset($options['label_attr']['for']['city']))
            ? $options['label_attr']['for']['zip']
            : 'city_zip_code';

        $builder
            ->add('city_zip_code', 'text', array(
                'label' => $zip_label,
                'label_attr' => ['for' => $zip_label_attr_for],
                'required' => true,
                'constraints' => array(
                    new NotBlank(array("groups" => ['create', 'update'])),
                    new Callback([
                        "groups" => ['create', 'update'],
                        "methods" => array(
                            [$this, 'checkZipCode']
                        )
                    ])
                )
            ))
            ->add('city_name', 'text', array(
                'label' => $city_label,
                'label_attr' => ['for' => $city_label_attr_for],
                'required' => true,
                'constraints' => array(
                    new NotBlank(array("groups" => ['create', 'update'])),
                    new Callback([
                        "groups" => ['create', 'update'],
                        "methods" => array(
                            [$this, 'checkCityName']
                        )
                    ])
                ),
            ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "insee_geo_select_city";
    }

    public function getParent()
    {
        return 'form';
    }

    // Protected methods

    protected function getCity()
    {
        $query = InseeGeoMunicipalityQuery::create();
        $query->useI18nQuery($this->locale)->endUse();
        $query
            ->addAsColumn('id', 'CONCAT('.InseeGeoMunicipalityTableMap::ZIP_CODE.',\'-\','.InseeGeoMunicipalityTableMap::ID.')')
            ->addAsColumn('name', InseeGeoMunicipalityI18nTableMap::NAME);
        $query->select(array(
            'id',
            'name'
        ));
        $result = $query->find()->toArray('id');

        $response =array();
        foreach($result as $key => $val){
            $response[$key] = $val['name'];
        }

        return $response;
    }

    // Check methods

    public function checkZipCode($value, ExecutionContextInterface $context)
    {
        $isValid = preg_match(self::ZIP_CODE_REGEX, $value);
        if(!$isValid){
            $context->addViolation(
                Translator::getInstance()->trans(
                    'zip_code.error',
                    [],
                    INSEEGeo::DOMAIN_NAME
                )
            );
        }
    }

    public function checkCityName($value, ExecutionContextInterface $context)
    {
        $isValid = InseeGeoMunicipalityQuery::create()->findOneById($value);
        if( !isset($isValid) ){
            $context->addViolation(
                Translator::getInstance()->trans(
                    'city.error',
                    [],
                    INSEEGeo::DOMAIN_NAME
                )
            );
        }

    }

}
