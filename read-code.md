






1. web/index.php


require vendor/yiisoft/yii2/Yii.php


Yii::$classMap 
Yii::$container 



$app = new yii\web\Application($config);
$app->run();




2 vendor/yiisoft/yii2/web/Application.php


	yii2/web/Application.php
	继承

		vendor/yiisoft/yii2/base/Application.php


	vendor/yiisoft/yii2/base/Application.php
	继承

		vendor/yiisoft/yii2/base/Module.php


	vendor/yiisoft/yii2/base/Module.php
	继承

		vendor/yiisoft/yii2/di/ServiceLocator.php


	vendor/yiisoft/yii2/di/ServiceLocator.php
	继承

		vendor/yiisoft/yii2/base/Component.php

	vendor/yiisoft/yii2/base/Component.php
	继承

		vendor/yiisoft/yii2/base/Object.php
	
	vendor/yiisoft/yii2/base/Object.php
	继承接口

		vendor/yiisoft/yii2/base/Configurable.php
	



	yii2/web/Application.php

	new 对象：

		调用父类构造方法

		base/Application
		```
		public function __construct($config = [])
	    {
	        Yii::$app = $this;
	        static::setInstance($this);

	        $this->state = self::STATE_BEGIN;

	        $this->preInit($config);

	        $this->registerErrorHandler($config);

	        Component::__construct($config);
	    }
		```

		往上一级调用构造方法
		Component::__construct($config);

		实际调用：
			Object::__construct($config);
	
				```
				public function __construct($config = [])
				{
    				if (!empty($config)) {
        				Yii::configure($this, $config);
   					}

    				$this->init();
				}
					```


2 Request

	vendor/yiisoft/yii2/web/Request.php

	继承:

		vendor/yiisoft/yii2/base/Request.php

	vendor/yiisoft/yii2/base/Request.php
	继承

		vendor/yiisoft/yii2/base/Component.php

	vendor/yiisoft/yii2/base/Component.php
	继承

		vendor/yiisoft/yii2/base/Object.php
	
	vendor/yiisoft/yii2/base/Object.php
	继承接口

		vendor/yiisoft/yii2/base/Configurable.php



	web/Application.php

	handleRequest
		Yii::$app->getUrlManager();
		list ($route, $params) = $request->resolve();
		$result = $this->runAction($route, $params);


	web/Request.php

	resolve
	$result = Yii::$app->getUrlManager()->parseRequest($this);



3. yii\web\UrlManager


	vendor/yiisoft/yii2/web/UrlManager.php
	继承
		vendor/yiisoft/yii2/base/Component.php