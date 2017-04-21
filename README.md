# Yii2-captcha

增加验证码类型：字母、字符、数字

# 安装
基于composer安装

`php composer.phar require choate/yii-captcha`


# 使用

```php
class DemoController {
    public function actions() {
        return [
            'captcha' => [
                'class' => '\choate\yii\captcha\CaptchaAction',
                'style' => \choate\yii\captcha\CaptchaAction::STYLE_ALPHA
                //'style' => \choate\yii\captcha\CaptchaAction::STYLE_DIGIT
                //'style' => \choate\yii\captcha\CaptchaAction::STYLE_ALNUM
            ],
        ];
    }
}
```