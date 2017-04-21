<?php
namespace choateunit\yii\captcha;

use choate\yii\captcha\CaptchaAction;
use yii\web\Application;
use yii\web\Controller;

class CaptchaTest extends \Codeception\Test\Unit
{
    /**
     * @var \choateunit\yii\captcha\UnitTester
     */
    protected $tester;

    public function testGenerateVerifyCode() {
        $captcha = new CaptchaAction('captcha', $this->getModule('Yii2')->app);
        // test letters
        $captcha->setStyle(CaptchaAction::STYLE_ALPHA);
        $this->assertEquals($captcha->getStyle(), CaptchaAction::STYLE_ALPHA);
        $this->assertRegExp('#^[[:alpha:]]+$#', $captcha->getVerifyCode(true));
        $this->assertNotRegExp('#^[[:digit:]]+$#', $captcha->getVerifyCode(true));

        // test decimal digits
        $captcha->setStyle(CaptchaAction::STYLE_DIGIT);
        $this->assertRegExp('#^[[:digit:]]+$#', $captcha->getVerifyCode(true));
        $this->assertNotRegExp('#^[[:alpha:]]+$#', $captcha->getVerifyCode(true));

        // test letters and digits
        $captcha->setStyle(CaptchaAction::STYLE_ALNUM);
        $this->assertRegExp('#^[\w]+#', $captcha->getVerifyCode(true));

        // test other style
        $captcha->setStyle('test');
        $this->assertRegExp('#^[\w]+#', $captcha->getVerifyCode(true));
        $this->assertNotRegExp('#^[[:digit:]]+$#', $captcha->getVerifyCode(true));
        $this->assertNotRegExp('#^[[:alpha:]]+$#', $captcha->getVerifyCode(true));
    }

    protected function _before() {
        /* @var $app Application */
        $app = $this->getModule('Yii2')->app;
        $controller = new Controller('fake', $app);
        $app->controller = $controller;
    }

    // tests

    protected function _after() {

    }
}