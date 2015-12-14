apistore
=============
[![Build Status](https://img.shields.io/travis/lichunqiang/apistore.svg?style=flat-square)](http://travis-ci.org/lichunqiang/apistore)
[![version](https://img.shields.io/packagist/v/light/apistore.svg?style=flat-square)](https://packagist.org/packages/light/apistore)
[![Download](https://img.shields.io/packagist/dt/light/apistore.svg?style=flat-square)](https://packagist.org/packages/light/apistore)
[![Issues](https://img.shields.io/github/issues/lichunqiang/apistore.svg?style=flat-square)](https://github.com/lichunqiang/apistore/issues)

百度APIStore免费接口封装

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist light/apistore "*"
```

or add

```
"light/apistore": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```
$store = new light\apistore\ApiStore('your key');
$api = $store->phone;

$result = $api->get('15292312331');

if ($result['errcode'] == 0) {
	var_dump($result['data']);
} else {
	echo 'Get error: ', $result['errmsg'];
}
```

**目前可用接口:**

* [手机号码归属地查询](http://apistore.baidu.com/apiworks/servicedetail/117.html) 	`$store->phone`
* [身份证查询](http://apistore.baidu.com/apiworks/servicedetail/113.html) 			`$store->idcard`
* [翻译接口](http://apistore.baidu.com/apiworks/servicedetail/118.html)  			`$store->translate`
* [IP地址查询](http://apistore.baidu.com/apiworks/servicedetail/114.html) 			`$sotre->ip`
* [汇率转换](http://apistore.baidu.com/apiworks/servicedetail/119.html) 			`$sotre->currency`

如何添加新接口
-------------

如果你发现需要的接口目前没有,可以发起pull request进行提交.

流程是在`src/apis`建立新的接口调用类,新的接口需要继承自`light\apistore\apis\Api`, 大概如下:

```
class Sms extends Api
{
	private $address = 'http://apiurl';

	public function get($params)
	{
		return $this->fetch($this->address . http_build_query($params));
	}
}
```

License
-------

![MIT](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)
