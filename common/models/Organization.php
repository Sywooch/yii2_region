<?php

namespace common\models;

use common\models\base\Organization as BaseOrganization;

/**
 * This is the model class for table "organization".
 */
class Organization extends BaseOrganization
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name'], 'required'],
            [['fullname', 'phone2'], 'string'],
            [['inn', 'kpp', 'ogrn', 'bik', 'created_by', 'updated_by',
                'lock', 'active', 'early_day'], 'integer'],
            [['date_add', 'date_edit'], 'safe'],
            [['name', 'direktor_fio', 'direktor_dolgnost', 'glbuh_fio', 'glbuh_dolgnost'], 'string', 'max' => 100],
            [['bankname'], 'string', 'max' => 150],
            [['rs', 'ks'], 'string', 'max' => 20],
            [['phone'], 'string', 'max' => 25],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
    /**
     * @inheritdoc
     */
    /*public function attributeHints()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Название организации'),
            'fullname' => Yii::t('app', 'Полное юридическое наименование'),
            'inn' => Yii::t('app', 'ИНН организации'),
            'kpp' => Yii::t('app', 'КПП Организации'),
            'ogrn' => Yii::t('app', 'ОГРН организации'),
            'bik' => Yii::t('app', 'БИК банка'),
            'bankname' => Yii::t('app', 'Наименование банка'),
            'rs' => Yii::t('app', 'Расчетный счет'),
            'ks' => Yii::t('app', 'Корреспондентский счет'),
            'direktor_fio' => Yii::t('app', 'Фамилия Имя Отчество руководителя'),
            'direktor_dolgnost' => Yii::t('app', 'Должность руководителя'),
            'glbuh_fio' => Yii::t('app', 'Фамилия Имя Отчество ответственного бухгалтера'),
            'glbuh_dolgnost' => Yii::t('app', 'Должность ответственного бухгалтера'),
            'date_add' => Yii::t('app', 'Дата добавления записи'),
            'date_edit' => Yii::t('app', 'Дата изменения записи'),
            'lock' => Yii::t('app', 'Lock'),
            'active' => Yii::t('app', 'Активность'),
        ];
    }*/
}
