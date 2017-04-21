<?php
namespace choate\yii\captcha;

use yii\captcha\CaptchaAction as YiiCaptchaAction;

class CaptchaAction extends YiiCaptchaAction
{
    const STYLE_ALNUM = 'alnum';
    const STYLE_DIGIT = 'digit';
    const STYLE_ALPHA   = 'alpha';

    private $style;

    /**
     * @return string
     */
    public function getStyle() {
        return $this->style;
    }

    /**
     * @param string $style
     */
    public function setStyle($style) {
        $this->style = $style;
    }

    /**
     * @return string
     */
    protected function generateVerifyCode() {
        switch ($this->getStyle()) {
            case self::STYLE_DIGIT:
                $code = $this->generateDigitCode();
                break;
            case self::STYLE_ALPHA:
                $code = $this->generateAlphaCode();
                break;
            default:
                $code = $this->generateStringCode();
        }

        return $code;
    }

    /**
     * Generates a number code.
     *
     * @return string the generated verification code
     */
    protected function generateDigitCode() {
        $letters = '24680';
        $vowels = '13579';

        return $this->generateAlgorithm($letters, $vowels);
    }

    /**
     * Generates a chat code.
     *
     * @return string the generated verification code
     */
    protected function generateAlphaCode() {
        $letters = 'bcdfghjklmnpqrstvwxyz';
        $vowels = 'aeiou';

        return $this->generateAlgorithm($letters, $vowels);
    }

    /**
     * Generates a algorithm.
     *
     * @return string the generated verification code
     */
    protected function generateAlgorithm($letters, $vowels) {
        $vowelsLength = strlen($vowels) - 1;
        $lettersLength = strlen($letters) - 1;
        if ($this->minLength < 3) {
            $this->minLength = 3;
        }
        if ($this->maxLength > 20) {
            $this->maxLength = 20;
        }
        if ($this->minLength > $this->maxLength) {
            $this->maxLength = $this->minLength;
        }
        $length = mt_rand($this->minLength, $this->maxLength);
        $code = '';
        for ($i = 0; $i < $length; ++$i) {
            if ($i % 2 && mt_rand(0, 10) > 2 || !($i % 2) && mt_rand(0, 10) > 9) {
                $code .= $vowels[mt_rand(0, $vowelsLength)];
            } else {
                $code .= $letters[mt_rand(0, $lettersLength)];
            }
        }

        return $code;
    }

    /**
     * Generates a string code.
     *
     * @return string the generated verification code
     */
    protected function generateStringCode() {
        $letters = 'abcdefghijklmnopqrstuvwxyz';
        $vowels = '1234567890';

        return $this->generateAlgorithm($letters, $vowels);
    }
}