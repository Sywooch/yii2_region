<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $phone;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [[/*'name',*/ 'email', 'subject', 'body', 'phone'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => Yii::t('app','Verification Code'),
            /*'name' => Yii::t('app','Name'),*/
            'subject' => Yii::t('app','Subject'),
            'body' => Yii::t('app','Body'),
            'phone' => Yii::t('app', 'Phone'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string  $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail($email)
    {
        $phone_text = Yii::t('app','My phone number is: ') . $this->phone;
        $this->subject = Yii::t('app','Mail from site турлайф.рф. ') . $this->subject;
        $this->body .= "<br />".$phone_text;
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom($this->email)
            ->setSubject($this->subject)
            ->setHtmlBody($this->body)
            ->send();
    }
}
