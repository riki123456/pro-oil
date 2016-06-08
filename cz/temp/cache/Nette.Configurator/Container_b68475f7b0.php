<?php
// source: /home/riki/work/www/pro-oil/App/Config/config.neon 
// source: /home/riki/work/www/pro-oil/App/Config/config.local.neon 

class Container_b68475f7b0 extends Nette\DI\Container
{

	protected $meta = array(
		'types' => array(
			'Nette\Object' => array(
				array(
					'application.application',
					'application.linkGenerator',
					'cache.storage',
					'database.default.connection',
					'database.default.structure',
					'database.default.context',
					'http.requestFactory',
					'http.request',
					'http.response',
					'http.context',
					'security.user',
					'session.session',
					'55_App_Model_UserManager',
					'repository',
					'imageStorage',
					'authorizator',
					'application.1',
					'application.2',
					'application.3',
					'application.4',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
					'application.14',
					'application.15',
					'application.16',
					'application.17',
					'application.18',
					'application.19',
					'application.20',
					'container',
				),
			),
			'Nette\Application\Application' => array(1 => array('application.application')),
			'Nette\Application\IPresenterFactory' => array(
				1 => array('application.presenterFactory'),
			),
			'Nette\Application\LinkGenerator' => array(1 => array('application.linkGenerator')),
			'Nette\Caching\Storages\IJournal' => array(1 => array('cache.journal')),
			'Nette\Caching\IStorage' => array(1 => array('cache.storage')),
			'Nette\Caching\Storages\DevNullStorage' => array(1 => array('cache.storage')),
			'Nette\Database\Connection' => array(
				1 => array('database.default.connection'),
			),
			'Nette\Database\IStructure' => array(
				1 => array('database.default.structure'),
			),
			'Nette\Database\Structure' => array(
				1 => array('database.default.structure'),
			),
			'Nette\Database\IConventions' => array(
				1 => array('database.default.conventions'),
			),
			'Nette\Database\Conventions\DiscoveredConventions' => array(
				1 => array('database.default.conventions'),
			),
			'Nette\Database\Context' => array(1 => array('database.default.context')),
			'Nette\Http\RequestFactory' => array(1 => array('http.requestFactory')),
			'Nette\Http\IRequest' => array(1 => array('http.request')),
			'Nette\Http\Request' => array(1 => array('http.request')),
			'Nette\Http\IResponse' => array(1 => array('http.response')),
			'Nette\Http\Response' => array(1 => array('http.response')),
			'Nette\Http\Context' => array(1 => array('http.context')),
			'Nette\Bridges\ApplicationLatte\ILatteFactory' => array(1 => array('latte.latteFactory')),
			'Nette\Application\UI\ITemplateFactory' => array(1 => array('latte.templateFactory')),
			'Latte\Object' => array(array('nette.latte')),
			'Latte\Engine' => array(array('nette.latte')),
			'Nette\Mail\IMailer' => array(1 => array('mail.mailer')),
			'Nette\Application\IRouter' => array(1 => array('routing.router')),
			'Nette\Security\IUserStorage' => array(1 => array('security.userStorage')),
			'Nette\Security\User' => array(1 => array('security.user')),
			'Nette\Http\Session' => array(1 => array('session.session')),
			'Tracy\ILogger' => array(1 => array('tracy.logger')),
			'Tracy\BlueScreen' => array(1 => array('tracy.blueScreen')),
			'Tracy\Bar' => array(1 => array('tracy.bar')),
			'WebLoader\IOutputNamingConvention' => array(
				1 => array(
					'webloader.cssNamingConvention',
					'webloader.jsNamingConvention',
				),
			),
			'WebLoader\DefaultOutputNamingConvention' => array(
				1 => array(
					'webloader.cssNamingConvention',
					'webloader.jsNamingConvention',
				),
			),
			'WebLoader\IFileCollection' => array(
				1 => array(
					'webloader.cssAdminFiles',
					'webloader.cssFrontFiles',
					'webloader.cssDynamicFiles',
					'webloader.jsAdminFiles',
					'webloader.jsFrontFiles',
					'webloader.jsDynamicFiles',
				),
			),
			'WebLoader\FileCollection' => array(
				1 => array(
					'webloader.cssAdminFiles',
					'webloader.cssFrontFiles',
					'webloader.cssDynamicFiles',
					'webloader.jsAdminFiles',
					'webloader.jsFrontFiles',
					'webloader.jsDynamicFiles',
				),
			),
			'WebLoader\Compiler' => array(
				1 => array(
					'webloader.cssAdminCompiler',
					'webloader.cssFrontCompiler',
					'webloader.cssDynamicCompiler',
					'webloader.jsAdminCompiler',
					'webloader.jsFrontCompiler',
					'webloader.jsDynamicCompiler',
				),
			),
			'WebLoader\Nette\LoaderFactory' => array(1 => array('webloader.factory')),
			'App\Components\Controls\CartControl\ICartControlFactory' => array(
				1 => array(
					'40_App_Components_Controls_CartControl_ICartControlFactory',
				),
			),
			'App\Components\Controls\Crud\AvailabilityControl\IAvailabilityControlFactory' => array(
				1 => array(
					'41_App_Components_Controls_Crud_AvailabilityControl_IAvailabilityControlFactory',
				),
			),
			'App\Components\Controls\Crud\CategoriesControl\ICategoriesControlFactory' => array(
				1 => array(
					'42_App_Components_Controls_Crud_CategoriesControl_ICategoriesControlFactory',
				),
			),
			'App\Components\Controls\Crud\ContactsControl\IContactsControlFactory' => array(
				1 => array(
					'43_App_Components_Controls_Crud_ContactsControl_IContactsControlFactory',
				),
			),
			'App\Components\Controls\Crud\ItemsControl\IItemsControlFactory' => array(
				1 => array(
					'44_App_Components_Controls_Crud_ItemsControl_IItemsControlFactory',
				),
			),
			'App\Components\Controls\Crud\ManufacturersControl\IManufacturersControlFactory' => array(
				1 => array(
					'45_App_Components_Controls_Crud_ManufacturersControl_IManufacturersControlFactory',
				),
			),
			'App\Components\Controls\Crud\OrdersControl\IOrdersControlFactory' => array(
				1 => array(
					'46_App_Components_Controls_Crud_OrdersControl_IOrdersControlFactory',
				),
			),
			'App\Components\Controls\Crud\PagesControl\IPagesControlFactory' => array(
				1 => array(
					'47_App_Components_Controls_Crud_PagesControl_IPagesControlFactory',
				),
			),
			'App\Components\Controls\Crud\PaymentsControl\IPaymentsControlFactory' => array(
				1 => array(
					'48_App_Components_Controls_Crud_PaymentsControl_IPaymentsControlFactory',
				),
			),
			'App\Components\Controls\Crud\SlideshowControl\ISlideshowControlFactory' => array(
				1 => array(
					'49_App_Components_Controls_Crud_SlideshowControl_ISlideshowControlFactory',
				),
			),
			'App\Components\Controls\Crud\TransportsControl\ITransportsControlFactory' => array(
				1 => array(
					'50_App_Components_Controls_Crud_TransportsControl_ITransportsControlFactory',
				),
			),
			'App\Components\Controls\Crud\UomControl\IUomControlFactory' => array(
				1 => array(
					'51_App_Components_Controls_Crud_UomControl_IUomControlFactory',
				),
			),
			'App\Components\Controls\Crud\UsersControl\IUsersControlFactory' => array(
				1 => array(
					'52_App_Components_Controls_Crud_UsersControl_IUsersControlFactory',
				),
			),
			'App\Components\Controls\LogoutControl\ILogoutControlFactory' => array(
				1 => array(
					'53_App_Components_Controls_LogoutControl_ILogoutControlFactory',
				),
			),
			'App\Components\Forms\LoginForm\ILoginFormFactory' => array(
				1 => array(
					'54_App_Components_Forms_LoginForm_ILoginFormFactory',
				),
			),
			'Nette\Security\IAuthenticator' => array(1 => array('55_App_Model_UserManager')),
			'App\Model\UserManager' => array(1 => array('55_App_Model_UserManager')),
			'App\Model\Heureka\Overeno\Requester' => array(1 => array('heurekaRequester')),
			'App\Model\Repositories\Repository' => array(1 => array('repository')),
			'App\Model\ImageStorage' => array(1 => array('imageStorage')),
			'Nette\Security\IAuthorizator' => array(1 => array('authorizator')),
			'Nette\Security\Permission' => array(1 => array('authorizator')),
			'App\Model\Breadcrumb' => array(1 => array('60_App_Model_Breadcrumb')),
			'App\Model\Heureka\Overeno' => array(
				1 => array('61_App_Model_Heureka_Overeno'),
			),
			'App\Model\Payment' => array(1 => array('62_App_Model_Payment')),
			'App\Model\Repositories\RepositoryOrders' => array(
				1 => array(
					'63_App_Model_Repositories_RepositoryOrders',
				),
			),
			'WebLoader\Filter\CssUrlsFilter' => array(1 => array('wlCssFilter')),
			'App\Modules\Base\Presenters\BasePresenter' => array(
				array(
					'application.1',
					'application.2',
					'application.3',
					'application.4',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
					'application.14',
					'application.15',
					'application.16',
					'application.17',
					'application.18',
				),
			),
			'Nette\Application\UI\Presenter' => array(
				array(
					'application.1',
					'application.2',
					'application.3',
					'application.4',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
					'application.14',
					'application.15',
					'application.16',
					'application.17',
					'application.18',
				),
			),
			'Nette\Application\UI\Control' => array(
				array(
					'application.1',
					'application.2',
					'application.3',
					'application.4',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
					'application.14',
					'application.15',
					'application.16',
					'application.17',
					'application.18',
				),
			),
			'Nette\Application\UI\PresenterComponent' => array(
				array(
					'application.1',
					'application.2',
					'application.3',
					'application.4',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
					'application.14',
					'application.15',
					'application.16',
					'application.17',
					'application.18',
				),
			),
			'Nette\ComponentModel\Container' => array(
				array(
					'application.1',
					'application.2',
					'application.3',
					'application.4',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
					'application.14',
					'application.15',
					'application.16',
					'application.17',
					'application.18',
				),
			),
			'Nette\ComponentModel\Component' => array(
				array(
					'application.1',
					'application.2',
					'application.3',
					'application.4',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
					'application.14',
					'application.15',
					'application.16',
					'application.17',
					'application.18',
				),
			),
			'Nette\Application\UI\IRenderable' => array(
				array(
					'application.1',
					'application.2',
					'application.3',
					'application.4',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
					'application.14',
					'application.15',
					'application.16',
					'application.17',
					'application.18',
				),
			),
			'Nette\ComponentModel\IContainer' => array(
				array(
					'application.1',
					'application.2',
					'application.3',
					'application.4',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
					'application.14',
					'application.15',
					'application.16',
					'application.17',
					'application.18',
				),
			),
			'Nette\ComponentModel\IComponent' => array(
				array(
					'application.1',
					'application.2',
					'application.3',
					'application.4',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
					'application.14',
					'application.15',
					'application.16',
					'application.17',
					'application.18',
				),
			),
			'Nette\Application\UI\ISignalReceiver' => array(
				array(
					'application.1',
					'application.2',
					'application.3',
					'application.4',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
					'application.14',
					'application.15',
					'application.16',
					'application.17',
					'application.18',
				),
			),
			'Nette\Application\UI\IStatePersistent' => array(
				array(
					'application.1',
					'application.2',
					'application.3',
					'application.4',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
					'application.14',
					'application.15',
					'application.16',
					'application.17',
					'application.18',
				),
			),
			'ArrayAccess' => array(
				array(
					'application.1',
					'application.2',
					'application.3',
					'application.4',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
					'application.14',
					'application.15',
					'application.16',
					'application.17',
					'application.18',
				),
			),
			'Nette\Application\IPresenter' => array(
				array(
					'application.1',
					'application.2',
					'application.3',
					'application.4',
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
					'application.14',
					'application.15',
					'application.16',
					'application.17',
					'application.18',
					'application.19',
					'application.20',
				),
			),
			'App\Modules\Front\Export\Presenters\DefaultPresenter' => array(array('application.1')),
			'App\Modules\Front\Presenters\DefaultPresenter' => array(array('application.2')),
			'App\Modules\Front\Presenters\CronPresenter' => array(array('application.3')),
			'App\Modules\Front\Presenters\ErrorPresenter' => array(array('application.4')),
			'App\Modules\Admin\Presenters\AdminPresenter' => array(
				array(
					'application.5',
					'application.6',
					'application.7',
					'application.8',
					'application.9',
					'application.10',
					'application.11',
					'application.12',
					'application.13',
					'application.14',
					'application.15',
					'application.16',
					'application.17',
					'application.18',
				),
			),
			'App\Modules\Admin\Presenters\ManufacturersPresenter' => array(array('application.5')),
			'App\Modules\Admin\Presenters\ItemsPresenter' => array(array('application.6')),
			'App\Modules\Admin\Presenters\TransportsPresenter' => array(array('application.7')),
			'App\Modules\Admin\Presenters\UsersPresenter' => array(array('application.8')),
			'App\Modules\Admin\Presenters\PaymentsPresenter' => array(array('application.9')),
			'App\Modules\Admin\Presenters\AvailabilityPresenter' => array(array('application.10')),
			'App\Modules\Admin\Presenters\DefaultPresenter' => array(array('application.11')),
			'App\Modules\Admin\Presenters\CronPresenter' => array(array('application.12')),
			'App\Modules\Admin\Presenters\CategoriesPresenter' => array(array('application.13')),
			'App\Modules\Admin\Presenters\SlideshowPresenter' => array(array('application.14')),
			'App\Modules\Admin\Presenters\PagesPresenter' => array(array('application.15')),
			'App\Modules\Admin\Presenters\ContactsPresenter' => array(array('application.16')),
			'App\Modules\Admin\Presenters\OrdersPresenter' => array(array('application.17')),
			'App\Modules\Admin\Presenters\UomPresenter' => array(array('application.18')),
			'NetteModule\ErrorPresenter' => array(array('application.19')),
			'NetteModule\MicroPresenter' => array(array('application.20')),
			'Nette\DI\Container' => array(1 => array('container')),
			'WebLoader\LoaderFactory' => array(1 => array('webloader.factory')),
		),
		'services' => array(
			'40_App_Components_Controls_CartControl_ICartControlFactory' => 'App\Components\Controls\CartControl\CartControl',
			'41_App_Components_Controls_Crud_AvailabilityControl_IAvailabilityControlFactory' => 'App\Components\Controls\Crud\AvailabilityControl\AvailabilityControl',
			'42_App_Components_Controls_Crud_CategoriesControl_ICategoriesControlFactory' => 'App\Components\Controls\Crud\CategoriesControl\CategoriesControl',
			'43_App_Components_Controls_Crud_ContactsControl_IContactsControlFactory' => 'App\Components\Controls\Crud\ContactsControl\ContactsControl',
			'44_App_Components_Controls_Crud_ItemsControl_IItemsControlFactory' => 'App\Components\Controls\Crud\ItemsControl\ItemsControl',
			'45_App_Components_Controls_Crud_ManufacturersControl_IManufacturersControlFactory' => 'App\Components\Controls\Crud\ManufacturersControl\ManufacturersControl',
			'46_App_Components_Controls_Crud_OrdersControl_IOrdersControlFactory' => 'App\Components\Controls\Crud\OrdersControl\OrdersControl',
			'47_App_Components_Controls_Crud_PagesControl_IPagesControlFactory' => 'App\Components\Controls\Crud\PagesControl\PagesControl',
			'48_App_Components_Controls_Crud_PaymentsControl_IPaymentsControlFactory' => 'App\Components\Controls\Crud\PaymentsControl\PaymentsControl',
			'49_App_Components_Controls_Crud_SlideshowControl_ISlideshowControlFactory' => 'App\Components\Controls\Crud\SlideshowControl\SlideshowControl',
			'50_App_Components_Controls_Crud_TransportsControl_ITransportsControlFactory' => 'App\Components\Controls\Crud\TransportsControl\TransportsControl',
			'51_App_Components_Controls_Crud_UomControl_IUomControlFactory' => 'App\Components\Controls\Crud\UomControl\UomControl',
			'52_App_Components_Controls_Crud_UsersControl_IUsersControlFactory' => 'App\Components\Controls\Crud\UsersControl\UsersControl',
			'53_App_Components_Controls_LogoutControl_ILogoutControlFactory' => 'App\Components\Controls\LogoutControl\LogoutControl',
			'54_App_Components_Forms_LoginForm_ILoginFormFactory' => 'App\Components\Forms\LoginForm\LoginForm',
			'55_App_Model_UserManager' => 'App\Model\UserManager',
			'60_App_Model_Breadcrumb' => 'App\Model\Breadcrumb',
			'61_App_Model_Heureka_Overeno' => 'App\Model\Heureka\Overeno',
			'62_App_Model_Payment' => 'App\Model\Payment',
			'63_App_Model_Repositories_RepositoryOrders' => 'App\Model\Repositories\RepositoryOrders',
			'application.1' => 'App\Modules\Front\Export\Presenters\DefaultPresenter',
			'application.10' => 'App\Modules\Admin\Presenters\AvailabilityPresenter',
			'application.11' => 'App\Modules\Admin\Presenters\DefaultPresenter',
			'application.12' => 'App\Modules\Admin\Presenters\CronPresenter',
			'application.13' => 'App\Modules\Admin\Presenters\CategoriesPresenter',
			'application.14' => 'App\Modules\Admin\Presenters\SlideshowPresenter',
			'application.15' => 'App\Modules\Admin\Presenters\PagesPresenter',
			'application.16' => 'App\Modules\Admin\Presenters\ContactsPresenter',
			'application.17' => 'App\Modules\Admin\Presenters\OrdersPresenter',
			'application.18' => 'App\Modules\Admin\Presenters\UomPresenter',
			'application.19' => 'NetteModule\ErrorPresenter',
			'application.2' => 'App\Modules\Front\Presenters\DefaultPresenter',
			'application.20' => 'NetteModule\MicroPresenter',
			'application.3' => 'App\Modules\Front\Presenters\CronPresenter',
			'application.4' => 'App\Modules\Front\Presenters\ErrorPresenter',
			'application.5' => 'App\Modules\Admin\Presenters\ManufacturersPresenter',
			'application.6' => 'App\Modules\Admin\Presenters\ItemsPresenter',
			'application.7' => 'App\Modules\Admin\Presenters\TransportsPresenter',
			'application.8' => 'App\Modules\Admin\Presenters\UsersPresenter',
			'application.9' => 'App\Modules\Admin\Presenters\PaymentsPresenter',
			'application.application' => 'Nette\Application\Application',
			'application.linkGenerator' => 'Nette\Application\LinkGenerator',
			'application.presenterFactory' => 'Nette\Application\IPresenterFactory',
			'authorizator' => 'Nette\Security\Permission',
			'cache.journal' => 'Nette\Caching\Storages\IJournal',
			'cache.storage' => 'Nette\Caching\Storages\DevNullStorage',
			'container' => 'Nette\DI\Container',
			'database.default.connection' => 'Nette\Database\Connection',
			'database.default.context' => 'Nette\Database\Context',
			'database.default.conventions' => 'Nette\Database\Conventions\DiscoveredConventions',
			'database.default.structure' => 'Nette\Database\Structure',
			'heurekaRequester' => 'App\Model\Heureka\Overeno\Requester',
			'http.context' => 'Nette\Http\Context',
			'http.request' => 'Nette\Http\Request',
			'http.requestFactory' => 'Nette\Http\RequestFactory',
			'http.response' => 'Nette\Http\Response',
			'imageStorage' => 'App\Model\ImageStorage',
			'latte.latteFactory' => 'Latte\Engine',
			'latte.templateFactory' => 'Nette\Application\UI\ITemplateFactory',
			'mail.mailer' => 'Nette\Mail\IMailer',
			'nette.latte' => 'Latte\Engine',
			'repository' => 'App\Model\Repositories\Repository',
			'routing.router' => 'Nette\Application\IRouter',
			'security.user' => 'Nette\Security\User',
			'security.userStorage' => 'Nette\Security\IUserStorage',
			'session.session' => 'Nette\Http\Session',
			'tracy.bar' => 'Tracy\Bar',
			'tracy.blueScreen' => 'Tracy\BlueScreen',
			'tracy.logger' => 'Tracy\ILogger',
			'webloader.cssAdminCompiler' => 'WebLoader\Compiler',
			'webloader.cssAdminFiles' => 'WebLoader\FileCollection',
			'webloader.cssDynamicCompiler' => 'WebLoader\Compiler',
			'webloader.cssDynamicFiles' => 'WebLoader\FileCollection',
			'webloader.cssFrontCompiler' => 'WebLoader\Compiler',
			'webloader.cssFrontFiles' => 'WebLoader\FileCollection',
			'webloader.cssNamingConvention' => 'WebLoader\DefaultOutputNamingConvention',
			'webloader.factory' => 'WebLoader\Nette\LoaderFactory',
			'webloader.jsAdminCompiler' => 'WebLoader\Compiler',
			'webloader.jsAdminFiles' => 'WebLoader\FileCollection',
			'webloader.jsDynamicCompiler' => 'WebLoader\Compiler',
			'webloader.jsDynamicFiles' => 'WebLoader\FileCollection',
			'webloader.jsFrontCompiler' => 'WebLoader\Compiler',
			'webloader.jsFrontFiles' => 'WebLoader\FileCollection',
			'webloader.jsNamingConvention' => 'WebLoader\DefaultOutputNamingConvention',
			'wlCssFilter' => 'WebLoader\Filter\CssUrlsFilter',
		),
		'tags' => array(
			'inject' => array(
				'application.1' => TRUE,
				'application.10' => TRUE,
				'application.11' => TRUE,
				'application.12' => TRUE,
				'application.13' => TRUE,
				'application.14' => TRUE,
				'application.15' => TRUE,
				'application.16' => TRUE,
				'application.17' => TRUE,
				'application.18' => TRUE,
				'application.19' => TRUE,
				'application.2' => TRUE,
				'application.20' => TRUE,
				'application.3' => TRUE,
				'application.4' => TRUE,
				'application.5' => TRUE,
				'application.6' => TRUE,
				'application.7' => TRUE,
				'application.8' => TRUE,
				'application.9' => TRUE,
			),
			'nette.presenter' => array(
				'application.1' => 'App\Modules\Front\Export\Presenters\DefaultPresenter',
				'application.10' => 'App\Modules\Admin\Presenters\AvailabilityPresenter',
				'application.11' => 'App\Modules\Admin\Presenters\DefaultPresenter',
				'application.12' => 'App\Modules\Admin\Presenters\CronPresenter',
				'application.13' => 'App\Modules\Admin\Presenters\CategoriesPresenter',
				'application.14' => 'App\Modules\Admin\Presenters\SlideshowPresenter',
				'application.15' => 'App\Modules\Admin\Presenters\PagesPresenter',
				'application.16' => 'App\Modules\Admin\Presenters\ContactsPresenter',
				'application.17' => 'App\Modules\Admin\Presenters\OrdersPresenter',
				'application.18' => 'App\Modules\Admin\Presenters\UomPresenter',
				'application.19' => 'NetteModule\ErrorPresenter',
				'application.2' => 'App\Modules\Front\Presenters\DefaultPresenter',
				'application.20' => 'NetteModule\MicroPresenter',
				'application.3' => 'App\Modules\Front\Presenters\CronPresenter',
				'application.4' => 'App\Modules\Front\Presenters\ErrorPresenter',
				'application.5' => 'App\Modules\Admin\Presenters\ManufacturersPresenter',
				'application.6' => 'App\Modules\Admin\Presenters\ItemsPresenter',
				'application.7' => 'App\Modules\Admin\Presenters\TransportsPresenter',
				'application.8' => 'App\Modules\Admin\Presenters\UsersPresenter',
				'application.9' => 'App\Modules\Admin\Presenters\PaymentsPresenter',
			),
		),
		'aliases' => array(
			'application' => 'application.application',
			'cacheStorage' => 'cache.storage',
			'database.default' => 'database.default.connection',
			'httpRequest' => 'http.request',
			'httpResponse' => 'http.response',
			'nette.cacheJournal' => 'cache.journal',
			'nette.database.default' => 'database.default',
			'nette.database.default.context' => 'database.default.context',
			'nette.httpContext' => 'http.context',
			'nette.httpRequestFactory' => 'http.requestFactory',
			'nette.latteFactory' => 'latte.latteFactory',
			'nette.mailer' => 'mail.mailer',
			'nette.presenterFactory' => 'application.presenterFactory',
			'nette.templateFactory' => 'latte.templateFactory',
			'nette.userStorage' => 'security.userStorage',
			'router' => 'routing.router',
			'session' => 'session.session',
			'user' => 'security.user',
		),
	);


	public function __construct()
	{
		parent::__construct(array(
			'appDir' => '/home/riki/work/www/pro-oil/App',
			'wwwDir' => '/home/riki/work/www/pro-oil/www',
			'debugMode' => TRUE,
			'productionMode' => FALSE,
			'environment' => 'development',
			'consoleMode' => FALSE,
			'container' => array('class' => NULL, 'parent' => NULL),
			'tempDir' => '/home/riki/work/www/pro-oil/App/../temp',
			'modules' => array(
				'App\Modules\Admin',
				'App\Modules\Front',
			),
			'webloader' => array(
				'jsDefaults' => array(
					'debug' => FALSE,
					'sourceDir' => '/home/riki/work/www/pro-oil/www/js',
					'tempDir' => '/home/riki/work/www/pro-oil/www/webtemp',
					'tempPath' => 'webtemp',
					'files' => array(),
					'remoteFiles' => array(),
					'filters' => array(),
					'fileFilters' => array(),
					'joinFiles' => TRUE,
					'namingConvention' => '@webloader.jsNamingConvention',
				),
				'cssDefaults' => array(
					'debug' => FALSE,
					'sourceDir' => '/home/riki/work/www/pro-oil/www/css',
					'tempDir' => '/home/riki/work/www/pro-oil/www/webtemp',
					'tempPath' => 'webtemp',
					'files' => array(),
					'remoteFiles' => array(),
					'filters' => array(),
					'fileFilters' => array(),
					'joinFiles' => TRUE,
					'namingConvention' => '@webloader.cssNamingConvention',
				),
				'js' => array(
					'admin' => array(
						'files' => array(
							'/home/riki/work/www/pro-oil/www/media/jquery/jquery-1.11.1.min.js',
							'/home/riki/work/www/pro-oil/www/media/bootstrap/js/bootstrap.min.js',
							'/home/riki/work/www/pro-oil/www/media/nette/nette.ajax.js',
							'/home/riki/work/www/pro-oil/www/media/metisMenu.min.js',
							'/home/riki/work/www/pro-oil/www/media/sb-admin-2.js',
							'/home/riki/work/www/pro-oil/www/media/project.js',
						),
					),
					'front' => array(
						'files' => array(
							'/home/riki/work/www/pro-oil/www/media/jquery/jquery-1.11.1.min.js',
							'/home/riki/work/www/pro-oil/www/media/jquery/jquery.blockUI.min.js',
							'/home/riki/work/www/pro-oil/www/media/bootstrap/js/bootstrap.min.js',
							'/home/riki/work/www/pro-oil/www/media/nette/nette.ajax.js',
							'/home/riki/work/www/pro-oil/www/media/project.js',
						),
					),
					'dynamic' => array('files' => NULL),
				),
				'css' => array(
					'admin' => array(
						'files' => array(
							'/home/riki/work/www/pro-oil/www/media/fonts/font-awesome/css/font-awesome.min.css',
							'/home/riki/work/www/pro-oil/www/media/metisMenu.min.css',
							'/home/riki/work/www/pro-oil/www/media/bootstrap/css/admin.css',
						),
						'fileFilters' => array('@wlCssFilter'),
					),
					'front' => array(
						'files' => array(
							'/home/riki/work/www/pro-oil/www/media/fonts/font-awesome/css/font-awesome.min.css',
							'/home/riki/work/www/pro-oil/www/media/bootstrap/css/front.css',
						),
						'fileFilters' => array('@wlCssFilter'),
					),
					'dynamic' => array(
						'files' => NULL,
						'fileFilters' => array('@wlCssFilter'),
					),
				),
			),
		));
	}


	/**
	 * @return App\Components\Controls\CartControl\ICartControlFactory
	 */
	public function createService__40_App_Components_Controls_CartControl_ICartControlFactory()
	{
		return new Container_b68475f7b0_App_Components_Controls_CartControl_ICartControlFactoryImpl_40_App_Components_Controls_CartControl_ICartControlFactory($this);
	}


	/**
	 * @return App\Components\Controls\Crud\AvailabilityControl\IAvailabilityControlFactory
	 */
	public function createService__41_App_Components_Controls_Crud_AvailabilityControl_IAvailabilityControlFactory()
	{
		return new Container_b68475f7b0_App_Components_Controls_Crud_AvailabilityControl_IAvailabilityControlFactoryImpl_41_App_Components_Controls_Crud_AvailabilityControl_IAvailabilityControlFactory($this);
	}


	/**
	 * @return App\Components\Controls\Crud\CategoriesControl\ICategoriesControlFactory
	 */
	public function createService__42_App_Components_Controls_Crud_CategoriesControl_ICategoriesControlFactory()
	{
		return new Container_b68475f7b0_App_Components_Controls_Crud_CategoriesControl_ICategoriesControlFactoryImpl_42_App_Components_Controls_Crud_CategoriesControl_ICategoriesControlFactory($this);
	}


	/**
	 * @return App\Components\Controls\Crud\ContactsControl\IContactsControlFactory
	 */
	public function createService__43_App_Components_Controls_Crud_ContactsControl_IContactsControlFactory()
	{
		return new Container_b68475f7b0_App_Components_Controls_Crud_ContactsControl_IContactsControlFactoryImpl_43_App_Components_Controls_Crud_ContactsControl_IContactsControlFactory($this);
	}


	/**
	 * @return App\Components\Controls\Crud\ItemsControl\IItemsControlFactory
	 */
	public function createService__44_App_Components_Controls_Crud_ItemsControl_IItemsControlFactory()
	{
		return new Container_b68475f7b0_App_Components_Controls_Crud_ItemsControl_IItemsControlFactoryImpl_44_App_Components_Controls_Crud_ItemsControl_IItemsControlFactory($this);
	}


	/**
	 * @return App\Components\Controls\Crud\ManufacturersControl\IManufacturersControlFactory
	 */
	public function createService__45_App_Components_Controls_Crud_ManufacturersControl_IManufacturersControlFactory()
	{
		return new Container_b68475f7b0_App_Components_Controls_Crud_ManufacturersControl_IManufacturersControlFactoryImpl_45_App_Components_Controls_Crud_ManufacturersControl_IManufacturersControlFactory($this);
	}


	/**
	 * @return App\Components\Controls\Crud\OrdersControl\IOrdersControlFactory
	 */
	public function createService__46_App_Components_Controls_Crud_OrdersControl_IOrdersControlFactory()
	{
		return new Container_b68475f7b0_App_Components_Controls_Crud_OrdersControl_IOrdersControlFactoryImpl_46_App_Components_Controls_Crud_OrdersControl_IOrdersControlFactory($this);
	}


	/**
	 * @return App\Components\Controls\Crud\PagesControl\IPagesControlFactory
	 */
	public function createService__47_App_Components_Controls_Crud_PagesControl_IPagesControlFactory()
	{
		return new Container_b68475f7b0_App_Components_Controls_Crud_PagesControl_IPagesControlFactoryImpl_47_App_Components_Controls_Crud_PagesControl_IPagesControlFactory($this);
	}


	/**
	 * @return App\Components\Controls\Crud\PaymentsControl\IPaymentsControlFactory
	 */
	public function createService__48_App_Components_Controls_Crud_PaymentsControl_IPaymentsControlFactory()
	{
		return new Container_b68475f7b0_App_Components_Controls_Crud_PaymentsControl_IPaymentsControlFactoryImpl_48_App_Components_Controls_Crud_PaymentsControl_IPaymentsControlFactory($this);
	}


	/**
	 * @return App\Components\Controls\Crud\SlideshowControl\ISlideshowControlFactory
	 */
	public function createService__49_App_Components_Controls_Crud_SlideshowControl_ISlideshowControlFactory()
	{
		return new Container_b68475f7b0_App_Components_Controls_Crud_SlideshowControl_ISlideshowControlFactoryImpl_49_App_Components_Controls_Crud_SlideshowControl_ISlideshowControlFactory($this);
	}


	/**
	 * @return App\Components\Controls\Crud\TransportsControl\ITransportsControlFactory
	 */
	public function createService__50_App_Components_Controls_Crud_TransportsControl_ITransportsControlFactory()
	{
		return new Container_b68475f7b0_App_Components_Controls_Crud_TransportsControl_ITransportsControlFactoryImpl_50_App_Components_Controls_Crud_TransportsControl_ITransportsControlFactory($this);
	}


	/**
	 * @return App\Components\Controls\Crud\UomControl\IUomControlFactory
	 */
	public function createService__51_App_Components_Controls_Crud_UomControl_IUomControlFactory()
	{
		return new Container_b68475f7b0_App_Components_Controls_Crud_UomControl_IUomControlFactoryImpl_51_App_Components_Controls_Crud_UomControl_IUomControlFactory($this);
	}


	/**
	 * @return App\Components\Controls\Crud\UsersControl\IUsersControlFactory
	 */
	public function createService__52_App_Components_Controls_Crud_UsersControl_IUsersControlFactory()
	{
		return new Container_b68475f7b0_App_Components_Controls_Crud_UsersControl_IUsersControlFactoryImpl_52_App_Components_Controls_Crud_UsersControl_IUsersControlFactory($this);
	}


	/**
	 * @return App\Components\Controls\LogoutControl\ILogoutControlFactory
	 */
	public function createService__53_App_Components_Controls_LogoutControl_ILogoutControlFactory()
	{
		return new Container_b68475f7b0_App_Components_Controls_LogoutControl_ILogoutControlFactoryImpl_53_App_Components_Controls_LogoutControl_ILogoutControlFactory($this);
	}


	/**
	 * @return App\Components\Forms\LoginForm\ILoginFormFactory
	 */
	public function createService__54_App_Components_Forms_LoginForm_ILoginFormFactory()
	{
		return new Container_b68475f7b0_App_Components_Forms_LoginForm_ILoginFormFactoryImpl_54_App_Components_Forms_LoginForm_ILoginFormFactory($this);
	}


	/**
	 * @return App\Model\UserManager
	 */
	public function createService__55_App_Model_UserManager()
	{
		$service = new App\Model\UserManager($this->getService('repository'));
		return $service;
	}


	/**
	 * @return App\Model\Breadcrumb
	 */
	public function createService__60_App_Model_Breadcrumb()
	{
		$service = new App\Model\Breadcrumb('main', '/', 'Hlavní strana');
		return $service;
	}


	/**
	 * @return App\Model\Heureka\Overeno
	 */
	public function createService__61_App_Model_Heureka_Overeno()
	{
		$service = new App\Model\Heureka\Overeno(constant('HEUREKA_API'), constant('HEUREKA_SECRET_CODE'), $this->getService('heurekaRequester'));
		return $service;
	}


	/**
	 * @return App\Model\Payment
	 */
	public function createService__62_App_Model_Payment()
	{
		$service = new App\Model\Payment($this->getService('repository'));
		return $service;
	}


	/**
	 * @return App\Model\Repositories\RepositoryOrders
	 */
	public function createService__63_App_Model_Repositories_RepositoryOrders()
	{
		$service = new App\Model\Repositories\RepositoryOrders($this->getService('repository'));
		return $service;
	}


	/**
	 * @return App\Modules\Front\Export\Presenters\DefaultPresenter
	 */
	public function createServiceApplication__1()
	{
		$service = new App\Modules\Front\Export\Presenters\DefaultPresenter;
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return App\Modules\Admin\Presenters\AvailabilityPresenter
	 */
	public function createServiceApplication__10()
	{
		$service = new App\Modules\Admin\Presenters\AvailabilityPresenter;
		$service->injectAvailabilityControlFactory($this->getService('41_App_Components_Controls_Crud_AvailabilityControl_IAvailabilityControlFactory'));
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return App\Modules\Admin\Presenters\DefaultPresenter
	 */
	public function createServiceApplication__11()
	{
		$service = new App\Modules\Admin\Presenters\DefaultPresenter;
		$service->injectOrdersControlFactory($this->getService('46_App_Components_Controls_Crud_OrdersControl_IOrdersControlFactory'));
		$service->injectUsersControlFactory($this->getService('52_App_Components_Controls_Crud_UsersControl_IUsersControlFactory'));
		$service->injectItemsControlFactory($this->getService('44_App_Components_Controls_Crud_ItemsControl_IItemsControlFactory'));
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return App\Modules\Admin\Presenters\CronPresenter
	 */
	public function createServiceApplication__12()
	{
		$service = new App\Modules\Admin\Presenters\CronPresenter;
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return App\Modules\Admin\Presenters\CategoriesPresenter
	 */
	public function createServiceApplication__13()
	{
		$service = new App\Modules\Admin\Presenters\CategoriesPresenter;
		$service->injectCategoriesControlFactory($this->getService('42_App_Components_Controls_Crud_CategoriesControl_ICategoriesControlFactory'));
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return App\Modules\Admin\Presenters\SlideshowPresenter
	 */
	public function createServiceApplication__14()
	{
		$service = new App\Modules\Admin\Presenters\SlideshowPresenter;
		$service->injectSlideshowControlFactory($this->getService('49_App_Components_Controls_Crud_SlideshowControl_ISlideshowControlFactory'));
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return App\Modules\Admin\Presenters\PagesPresenter
	 */
	public function createServiceApplication__15()
	{
		$service = new App\Modules\Admin\Presenters\PagesPresenter;
		$service->injectPagesControlFactory($this->getService('47_App_Components_Controls_Crud_PagesControl_IPagesControlFactory'));
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return App\Modules\Admin\Presenters\ContactsPresenter
	 */
	public function createServiceApplication__16()
	{
		$service = new App\Modules\Admin\Presenters\ContactsPresenter;
		$service->injectContactsControlFactory($this->getService('43_App_Components_Controls_Crud_ContactsControl_IContactsControlFactory'));
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return App\Modules\Admin\Presenters\OrdersPresenter
	 */
	public function createServiceApplication__17()
	{
		$service = new App\Modules\Admin\Presenters\OrdersPresenter;
		$service->injectOrdersControlFactory($this->getService('46_App_Components_Controls_Crud_OrdersControl_IOrdersControlFactory'));
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return App\Modules\Admin\Presenters\UomPresenter
	 */
	public function createServiceApplication__18()
	{
		$service = new App\Modules\Admin\Presenters\UomPresenter;
		$service->injectUomControlFactory($this->getService('51_App_Components_Controls_Crud_UomControl_IUomControlFactory'));
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return NetteModule\ErrorPresenter
	 */
	public function createServiceApplication__19()
	{
		$service = new NetteModule\ErrorPresenter($this->getService('tracy.logger'));
		return $service;
	}


	/**
	 * @return App\Modules\Front\Presenters\DefaultPresenter
	 */
	public function createServiceApplication__2()
	{
		$service = new App\Modules\Front\Presenters\DefaultPresenter;
		$service->injectSlideshowControlFactory($this->getService('49_App_Components_Controls_Crud_SlideshowControl_ISlideshowControlFactory'));
		$service->injectCartControlFactory($this->getService('40_App_Components_Controls_CartControl_ICartControlFactory'));
		$service->injectItemsControlFactory($this->getService('44_App_Components_Controls_Crud_ItemsControl_IItemsControlFactory'));
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return NetteModule\MicroPresenter
	 */
	public function createServiceApplication__20()
	{
		$service = new NetteModule\MicroPresenter($this, $this->getService('http.request'), $this->getService('routing.router'));
		return $service;
	}


	/**
	 * @return App\Modules\Front\Presenters\CronPresenter
	 */
	public function createServiceApplication__3()
	{
		$service = new App\Modules\Front\Presenters\CronPresenter;
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->mailer = $this->getService('mail.mailer');
		$service->imageStorage = $this->getService('imageStorage');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return App\Modules\Front\Presenters\ErrorPresenter
	 */
	public function createServiceApplication__4()
	{
		$service = new App\Modules\Front\Presenters\ErrorPresenter;
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return App\Modules\Admin\Presenters\ManufacturersPresenter
	 */
	public function createServiceApplication__5()
	{
		$service = new App\Modules\Admin\Presenters\ManufacturersPresenter;
		$service->injectManufacturersControlFactory($this->getService('45_App_Components_Controls_Crud_ManufacturersControl_IManufacturersControlFactory'));
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return App\Modules\Admin\Presenters\ItemsPresenter
	 */
	public function createServiceApplication__6()
	{
		$service = new App\Modules\Admin\Presenters\ItemsPresenter;
		$service->injectItemsControlFactory($this->getService('44_App_Components_Controls_Crud_ItemsControl_IItemsControlFactory'));
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return App\Modules\Admin\Presenters\TransportsPresenter
	 */
	public function createServiceApplication__7()
	{
		$service = new App\Modules\Admin\Presenters\TransportsPresenter;
		$service->injectTransportsControlFactory($this->getService('50_App_Components_Controls_Crud_TransportsControl_ITransportsControlFactory'));
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return App\Modules\Admin\Presenters\UsersPresenter
	 */
	public function createServiceApplication__8()
	{
		$service = new App\Modules\Admin\Presenters\UsersPresenter;
		$service->injectUsersControlFactory($this->getService('52_App_Components_Controls_Crud_UsersControl_IUsersControlFactory'));
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return App\Modules\Admin\Presenters\PaymentsPresenter
	 */
	public function createServiceApplication__9()
	{
		$service = new App\Modules\Admin\Presenters\PaymentsPresenter;
		$service->injectPaymentsControlFactory($this->getService('48_App_Components_Controls_Crud_PaymentsControl_IPaymentsControlFactory'));
		$service->injectLoginFormFactory($this->getService('54_App_Components_Forms_LoginForm_ILoginFormFactory'));
		$service->injectLogoutControlFactory($this->getService('53_App_Components_Controls_LogoutControl_ILogoutControlFactory'));
		$service->injectPrimary($this, $this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'), $this->getService('session.session'),
			$this->getService('security.user'), $this->getService('latte.templateFactory'));
		$service->webLoader = $this->getService('webloader.factory');
		$service->repository = $this->getService('repository');
		$service->breadcrumb = $this->getService('60_App_Model_Breadcrumb');
		$service->invalidLinkMode = 5;
		return $service;
	}


	/**
	 * @return Nette\Application\Application
	 */
	public function createServiceApplication__application()
	{
		$service = new Nette\Application\Application($this->getService('application.presenterFactory'), $this->getService('routing.router'),
			$this->getService('http.request'), $this->getService('http.response'));
		$service->catchExceptions = FALSE;
		$service->errorPresenter = 'Front:Error';
		Nette\Bridges\ApplicationTracy\RoutingPanel::initializePanel($service);
		$this->getService('tracy.bar')->addPanel(new Nette\Bridges\ApplicationTracy\RoutingPanel($this->getService('routing.router'), $this->getService('http.request'),
			$this->getService('application.presenterFactory')));
		return $service;
	}


	/**
	 * @return Nette\Application\LinkGenerator
	 */
	public function createServiceApplication__linkGenerator()
	{
		$service = new Nette\Application\LinkGenerator($this->getService('routing.router'), $this->getService('http.request')->getUrl(),
			$this->getService('application.presenterFactory'));
		return $service;
	}


	/**
	 * @return Nette\Application\IPresenterFactory
	 */
	public function createServiceApplication__presenterFactory()
	{
		$service = new Nette\Application\PresenterFactory(new Nette\Bridges\ApplicationDI\PresenterFactoryCallback($this, 5, '/home/riki/work/www/pro-oil/App/../temp/cache/Nette%5CBridges%5CApplicationDI%5CApplicationExtension'));
		$service->setMapping(array(
			'*' => 'App\Modules\*\Presenters\*Presenter',
		));
		return $service;
	}


	/**
	 * @return Nette\Security\Permission
	 */
	public function createServiceAuthorizator()
	{
		$service = new Nette\Security\Permission;
		$service->addRole(constant('ROLE_GUEST'));
		$service->addRole(constant('ROLE_REGISTERED'), constant('ROLE_GUEST'));
		$service->addRole(constant('ROLE_PARTNER'), constant('ROLE_REGISTERED'));
		$service->addRole(constant('ROLE_EDITOR'), constant('ROLE_PARTNER'));
		$service->addRole(constant('ROLE_ADMIN'), constant('ROLE_EDITOR'));
		$service->addRole(constant('ROLE_ROOT'), constant('ROLE_ADMIN'));
		$service->addResource('Front:Default');
		$service->addResource('Front:Error');
		$service->addResource('Front:Cron');
		$service->addResource('Admin:Default');
		$service->addResource('Admin:Orders');
		$service->addResource('Admin:Items');
		$service->addResource('Admin:Users');
		$service->addResource('Admin:Categories');
		$service->addResource('Admin:Pages');
		$service->addResource('Admin:Contacts');
		$service->addResource('Admin:Slideshow');
		$service->addResource('Admin:Transports');
		$service->addResource('Admin:Manufacturers');
		$service->addResource('Admin:Payments');
		$service->addResource('Admin:Availability');
		$service->addResource('Admin:Cron');
		$service->addResource('Admin:Uom');
		$service->allow(constant('ROLE_GUEST'), 'Front:Default', NULL);
		$service->allow(constant('ROLE_GUEST'), 'Front:Error', NULL);
		$service->allow(constant('ROLE_GUEST'), 'Front:Cron', NULL);
		$service->allow(constant('ROLE_EDITOR'), 'Admin:Default', NULL);
		$service->allow(constant('ROLE_EDITOR'), 'Admin:Orders', NULL);
		$service->allow(constant('ROLE_EDITOR'), 'Admin:Items', NULL);
		$service->allow(constant('ROLE_EDITOR'), 'Admin:Categories', NULL);
		$service->allow(constant('ROLE_EDITOR'), 'Admin:Pages', NULL);
		$service->allow(constant('ROLE_EDITOR'), 'Admin:Contacts', NULL);
		$service->allow(constant('ROLE_EDITOR'), 'Admin:Slideshow', NULL);
		$service->allow(constant('ROLE_EDITOR'), 'Admin:Transports', NULL);
		$service->allow(constant('ROLE_EDITOR'), 'Admin:Manufacturers', NULL);
		$service->allow(constant('ROLE_EDITOR'), 'Admin:Payments', NULL);
		$service->allow(constant('ROLE_EDITOR'), 'Admin:Availability', NULL);
		$service->allow(constant('ROLE_EDITOR'), 'Admin:Cron', NULL);
		$service->allow(constant('ROLE_EDITOR'), 'Admin:Uom', NULL);
		$service->allow(constant('ROLE_ADMIN'), 'Admin:Users', NULL);
		$service->allow('root', NULL);
		return $service;
	}


	/**
	 * @return Nette\Caching\Storages\IJournal
	 */
	public function createServiceCache__journal()
	{
		$service = new Nette\Caching\Storages\FileJournal('/home/riki/work/www/pro-oil/App/../temp');
		return $service;
	}


	/**
	 * @return Nette\Caching\Storages\DevNullStorage
	 */
	public function createServiceCache__storage()
	{
		$service = new Nette\Caching\Storages\DevNullStorage;
		return $service;
	}


	/**
	 * @return Nette\DI\Container
	 */
	public function createServiceContainer()
	{
		return $this;
	}


	/**
	 * @return Nette\Database\Connection
	 */
	public function createServiceDatabase__default__connection()
	{
		$service = new Nette\Database\Connection('mysql:host=127.0.0.1;dbname=pro-oil', 'pro-oil', 'pro-oil', array('lazy' => TRUE));
		$this->getService('tracy.blueScreen')->addPanel('Nette\Bridges\DatabaseTracy\ConnectionPanel::renderException');
		Nette\Database\Helpers::createDebugPanel($service, TRUE, 'default');
		return $service;
	}


	/**
	 * @return Nette\Database\Context
	 */
	public function createServiceDatabase__default__context()
	{
		$service = new Nette\Database\Context($this->getService('database.default.connection'), $this->getService('database.default.structure'),
			$this->getService('database.default.conventions'), $this->getService('cache.storage'));
		return $service;
	}


	/**
	 * @return Nette\Database\Conventions\DiscoveredConventions
	 */
	public function createServiceDatabase__default__conventions()
	{
		$service = new Nette\Database\Conventions\DiscoveredConventions($this->getService('database.default.structure'));
		return $service;
	}


	/**
	 * @return Nette\Database\Structure
	 */
	public function createServiceDatabase__default__structure()
	{
		$service = new Nette\Database\Structure($this->getService('database.default.connection'), $this->getService('cache.storage'));
		return $service;
	}


	/**
	 * @return App\Model\Heureka\Overeno\Requester
	 */
	public function createServiceHeurekaRequester()
	{
		$service = new App\Model\Heureka\Overeno\Requester;
		return $service;
	}


	/**
	 * @return Nette\Http\Context
	 */
	public function createServiceHttp__context()
	{
		$service = new Nette\Http\Context($this->getService('http.request'), $this->getService('http.response'));
		return $service;
	}


	/**
	 * @return Nette\Http\Request
	 */
	public function createServiceHttp__request()
	{
		$service = $this->getService('http.requestFactory')->createHttpRequest();
		if (!$service instanceof Nette\Http\Request) {
			throw new Nette\UnexpectedValueException('Unable to create service \'http.request\', value returned by factory is not Nette\Http\Request type.');
		}
		return $service;
	}


	/**
	 * @return Nette\Http\RequestFactory
	 */
	public function createServiceHttp__requestFactory()
	{
		$service = new Nette\Http\RequestFactory;
		$service->setProxy(array());
		return $service;
	}


	/**
	 * @return Nette\Http\Response
	 */
	public function createServiceHttp__response()
	{
		$service = new Nette\Http\Response;
		return $service;
	}


	/**
	 * @return App\Model\ImageStorage
	 */
	public function createServiceImageStorage()
	{
		$service = new App\Model\ImageStorage(constant('ROOT_FS_WWW'), constant('ROOT_WEB_WWW'), '/images');
		return $service;
	}


	/**
	 * @return Nette\Bridges\ApplicationLatte\ILatteFactory
	 */
	public function createServiceLatte__latteFactory()
	{
		return new Container_b68475f7b0_Nette_Bridges_ApplicationLatte_ILatteFactoryImpl_latte_latteFactory($this);
	}


	/**
	 * @return Nette\Application\UI\ITemplateFactory
	 */
	public function createServiceLatte__templateFactory()
	{
		$service = new Nette\Bridges\ApplicationLatte\TemplateFactory($this->getService('latte.latteFactory'), $this->getService('http.request'),
			$this->getService('http.response'), $this->getService('security.user'), $this->getService('cache.storage'));
		return $service;
	}


	/**
	 * @return Nette\Mail\IMailer
	 */
	public function createServiceMail__mailer()
	{
		$service = new Nette\Mail\SendmailMailer;
		return $service;
	}


	/**
	 * @return Latte\Engine
	 */
	public function createServiceNette__latte()
	{
		$service = new Latte\Engine;
		trigger_error('Service nette.latte is deprecated, implement Nette\Bridges\ApplicationLatte\ILatteFactory.',
			16384);
		$service->setTempDirectory('/home/riki/work/www/pro-oil/App/../temp/cache/latte');
		$service->setAutoRefresh(TRUE);
		$service->setContentType('html');
		Nette\Utils\Html::$xhtml = FALSE;
		return $service;
	}


	/**
	 * @return App\Model\Repositories\Repository
	 */
	public function createServiceRepository()
	{
		$service = new App\Model\Repositories\Repository($this->getService('database.default.context'));
		return $service;
	}


	/**
	 * @return Nette\Application\IRouter
	 */
	public function createServiceRouting__router()
	{
		$service = new Nette\Application\Routers\RouteList;
		return $service;
	}


	/**
	 * @return Nette\Security\User
	 */
	public function createServiceSecurity__user()
	{
		$service = new Nette\Security\User($this->getService('security.userStorage'), $this->getService('55_App_Model_UserManager'),
			$this->getService('authorizator'));
		$this->getService('tracy.bar')->addPanel(new Nette\Bridges\SecurityTracy\UserPanel($service));
		return $service;
	}


	/**
	 * @return Nette\Security\IUserStorage
	 */
	public function createServiceSecurity__userStorage()
	{
		$service = new Nette\Http\UserStorage($this->getService('session.session'));
		return $service;
	}


	/**
	 * @return Nette\Http\Session
	 */
	public function createServiceSession__session()
	{
		$service = new Nette\Http\Session($this->getService('http.request'), $this->getService('http.response'));
		$service->setExpiration('14 days');
		return $service;
	}


	/**
	 * @return Tracy\Bar
	 */
	public function createServiceTracy__bar()
	{
		$service = Tracy\Debugger::getBar();
		if (!$service instanceof Tracy\Bar) {
			throw new Nette\UnexpectedValueException('Unable to create service \'tracy.bar\', value returned by factory is not Tracy\Bar type.');
		}
		return $service;
	}


	/**
	 * @return Tracy\BlueScreen
	 */
	public function createServiceTracy__blueScreen()
	{
		$service = Tracy\Debugger::getBlueScreen();
		if (!$service instanceof Tracy\BlueScreen) {
			throw new Nette\UnexpectedValueException('Unable to create service \'tracy.blueScreen\', value returned by factory is not Tracy\BlueScreen type.');
		}
		return $service;
	}


	/**
	 * @return Tracy\ILogger
	 */
	public function createServiceTracy__logger()
	{
		$service = Tracy\Debugger::getLogger();
		if (!$service instanceof Tracy\ILogger) {
			throw new Nette\UnexpectedValueException('Unable to create service \'tracy.logger\', value returned by factory is not Tracy\ILogger type.');
		}
		return $service;
	}


	/**
	 * @return WebLoader\Compiler
	 */
	public function createServiceWebloader__cssAdminCompiler()
	{
		$service = new WebLoader\Compiler($this->getService('webloader.cssAdminFiles'), $this->getService('webloader.cssNamingConvention'),
			'/home/riki/work/www/pro-oil/www/webtemp');
		$service->setJoinFiles(TRUE);
		$service->addFileFilter($this->getService('wlCssFilter'));
		return $service;
	}


	/**
	 * @return WebLoader\FileCollection
	 */
	public function createServiceWebloader__cssAdminFiles()
	{
		$service = new WebLoader\FileCollection('/home/riki/work/www/pro-oil/www/css');
		$service->addFile('/home/riki/work/www/pro-oil/www/media/fonts/font-awesome/css/font-awesome.min.css');
		$service->addFile('/home/riki/work/www/pro-oil/www/media/metisMenu.min.css');
		$service->addFile('/home/riki/work/www/pro-oil/www/media/bootstrap/css/admin.css');
		$service->addRemoteFiles(array());
		return $service;
	}


	/**
	 * @return WebLoader\Compiler
	 */
	public function createServiceWebloader__cssDynamicCompiler()
	{
		$service = new WebLoader\Compiler($this->getService('webloader.cssDynamicFiles'), $this->getService('webloader.cssNamingConvention'),
			'/home/riki/work/www/pro-oil/www/webtemp');
		$service->setJoinFiles(TRUE);
		$service->addFileFilter($this->getService('wlCssFilter'));
		return $service;
	}


	/**
	 * @return WebLoader\FileCollection
	 */
	public function createServiceWebloader__cssDynamicFiles()
	{
		$service = new WebLoader\FileCollection('/home/riki/work/www/pro-oil/www/css');
		$service->addRemoteFiles(array());
		return $service;
	}


	/**
	 * @return WebLoader\Compiler
	 */
	public function createServiceWebloader__cssFrontCompiler()
	{
		$service = new WebLoader\Compiler($this->getService('webloader.cssFrontFiles'), $this->getService('webloader.cssNamingConvention'),
			'/home/riki/work/www/pro-oil/www/webtemp');
		$service->setJoinFiles(TRUE);
		$service->addFileFilter($this->getService('wlCssFilter'));
		return $service;
	}


	/**
	 * @return WebLoader\FileCollection
	 */
	public function createServiceWebloader__cssFrontFiles()
	{
		$service = new WebLoader\FileCollection('/home/riki/work/www/pro-oil/www/css');
		$service->addFile('/home/riki/work/www/pro-oil/www/media/fonts/font-awesome/css/font-awesome.min.css');
		$service->addFile('/home/riki/work/www/pro-oil/www/media/bootstrap/css/front.css');
		$service->addRemoteFiles(array());
		return $service;
	}


	/**
	 * @return WebLoader\DefaultOutputNamingConvention
	 */
	public function createServiceWebloader__cssNamingConvention()
	{
		$service = WebLoader\DefaultOutputNamingConvention::createCssConvention();
		if (!$service instanceof WebLoader\DefaultOutputNamingConvention) {
			throw new Nette\UnexpectedValueException('Unable to create service \'webloader.cssNamingConvention\', value returned by factory is not WebLoader\DefaultOutputNamingConvention type.');
		}
		return $service;
	}


	/**
	 * @return WebLoader\Nette\LoaderFactory
	 */
	public function createServiceWebloader__factory()
	{
		$service = new WebLoader\Nette\LoaderFactory(array(
			'admin' => 'webtemp',
			'front' => 'webtemp',
			'dynamic' => 'webtemp',
		), $this->getService('http.request'), $this);
		return $service;
	}


	/**
	 * @return WebLoader\Compiler
	 */
	public function createServiceWebloader__jsAdminCompiler()
	{
		$service = new WebLoader\Compiler($this->getService('webloader.jsAdminFiles'), $this->getService('webloader.jsNamingConvention'),
			'/home/riki/work/www/pro-oil/www/webtemp');
		$service->setJoinFiles(TRUE);
		return $service;
	}


	/**
	 * @return WebLoader\FileCollection
	 */
	public function createServiceWebloader__jsAdminFiles()
	{
		$service = new WebLoader\FileCollection('/home/riki/work/www/pro-oil/www/js');
		$service->addFile('/home/riki/work/www/pro-oil/www/media/jquery/jquery-1.11.1.min.js');
		$service->addFile('/home/riki/work/www/pro-oil/www/media/bootstrap/js/bootstrap.min.js');
		$service->addFile('/home/riki/work/www/pro-oil/www/media/nette/nette.ajax.js');
		$service->addFile('/home/riki/work/www/pro-oil/www/media/metisMenu.min.js');
		$service->addFile('/home/riki/work/www/pro-oil/www/media/sb-admin-2.js');
		$service->addFile('/home/riki/work/www/pro-oil/www/media/project.js');
		$service->addRemoteFiles(array());
		return $service;
	}


	/**
	 * @return WebLoader\Compiler
	 */
	public function createServiceWebloader__jsDynamicCompiler()
	{
		$service = new WebLoader\Compiler($this->getService('webloader.jsDynamicFiles'), $this->getService('webloader.jsNamingConvention'),
			'/home/riki/work/www/pro-oil/www/webtemp');
		$service->setJoinFiles(TRUE);
		return $service;
	}


	/**
	 * @return WebLoader\FileCollection
	 */
	public function createServiceWebloader__jsDynamicFiles()
	{
		$service = new WebLoader\FileCollection('/home/riki/work/www/pro-oil/www/js');
		$service->addRemoteFiles(array());
		return $service;
	}


	/**
	 * @return WebLoader\Compiler
	 */
	public function createServiceWebloader__jsFrontCompiler()
	{
		$service = new WebLoader\Compiler($this->getService('webloader.jsFrontFiles'), $this->getService('webloader.jsNamingConvention'),
			'/home/riki/work/www/pro-oil/www/webtemp');
		$service->setJoinFiles(TRUE);
		return $service;
	}


	/**
	 * @return WebLoader\FileCollection
	 */
	public function createServiceWebloader__jsFrontFiles()
	{
		$service = new WebLoader\FileCollection('/home/riki/work/www/pro-oil/www/js');
		$service->addFile('/home/riki/work/www/pro-oil/www/media/jquery/jquery-1.11.1.min.js');
		$service->addFile('/home/riki/work/www/pro-oil/www/media/jquery/jquery.blockUI.min.js');
		$service->addFile('/home/riki/work/www/pro-oil/www/media/bootstrap/js/bootstrap.min.js');
		$service->addFile('/home/riki/work/www/pro-oil/www/media/nette/nette.ajax.js');
		$service->addFile('/home/riki/work/www/pro-oil/www/media/project.js');
		$service->addRemoteFiles(array());
		return $service;
	}


	/**
	 * @return WebLoader\DefaultOutputNamingConvention
	 */
	public function createServiceWebloader__jsNamingConvention()
	{
		$service = WebLoader\DefaultOutputNamingConvention::createJsConvention();
		if (!$service instanceof WebLoader\DefaultOutputNamingConvention) {
			throw new Nette\UnexpectedValueException('Unable to create service \'webloader.jsNamingConvention\', value returned by factory is not WebLoader\DefaultOutputNamingConvention type.');
		}
		return $service;
	}


	/**
	 * @return WebLoader\Filter\CssUrlsFilter
	 */
	public function createServiceWlCssFilter()
	{
		$service = new WebLoader\Filter\CssUrlsFilter('/home/riki/work/www/pro-oil/www', '/www');
		return $service;
	}


	public function initialize()
	{
		date_default_timezone_set('Europe/Prague');
		ini_set('zlib.output_compression', TRUE);
		define('LANG', 'cs');
		define('GOOGLE_ANALYTICS', FALSE);
		define('ZBOZI_ANALYTICS', FALSE);
		define('HEUREKA_ANALYTICS', FALSE);
		define('HEUREKA_OVERENO_ZAKAZNIKY', FALSE);
		define('HEUREKA_API', 'http://www.heureka.cz/direct/dotaznik/objednavka.php');
		define('HEUREKA_SECRET_CODE', '44fe6f1705efab4023718dbef121cd78');
		define('DPH', 1.21);
		define('DPH_PROCENTO', 21);
		define('DOMAIN', 'pro-oil.cz');
		define('DB_PREFIX', 'rk_');
		define('ROOT_FS_WWW', '/home/riki/work/www/pro-oil/www');
		define('ROOT_WEB_WWW', '/www');
		define('TINY_MCE_CLASS', 'tinyMCE');
		define('TINY_MCE_BASEURL', '/www/media/tinymce');
		define('IMAGE_SIZE_LARGE_WIDTH', 600);
		define('IMAGE_SIZE_LARGE_HEIGHT', 800);
		define('IMAGE_SIZE_NORMAL_WIDTH', 300);
		define('IMAGE_SIZE_NORMAL_HEIGHT', 400);
		define('IMAGE_SIZE_SMALL_WIDTH', 100);
		define('IMAGE_SIZE_SMALL_HEIGHT', 200);
		define('SLIDESHOW_SIZE_WIDTH', 700);
		define('SLIDESHOW_SIZE_HEIGHT', 200);
		define('FLASH_OK', 'success');
		define('FLASH_INFO', 'info');
		define('FLASH_WARN', 'warning');
		define('FLASH_ERR', 'danger');
		define('ROLE_ROOT', 'root');
		define('ROLE_ADMIN', 'admin');
		define('ROLE_EDITOR', 'editor');
		define('ROLE_PARTNER', 'partner');
		define('ROLE_REGISTERED', 'registered');
		define('ROLE_GUEST', 'guest');
		define('MAIL_TELEFON', '+420 737 283 982');
		define('MAIL_OBJEDNAVKY', 'objednavky@pro-oil.cz');
		define('MAIL_OBJEDNAVKY_NAME', 'Objednávky - Pro-Oil Morava s.r.o.');
		define('MAIL_ESHOP', 'eshop@pro-oil.cz');
		define('MAIL_KANCELAR', 'kancelar@pro-oil.cz');
		define('MAIL_REGISTRACE', 'registrace@pro-iol.cz');
		define('MAIL_PRODEJCE', 'fojtik@pro-oil.cz');
		define('MAIL_ADMIN', 'admin@pro-oil.cz');
		define('MAIL_NOREPLY', 'noreply@pro-oil.cz');
		define('MAIL_NOREPLY_NAME', 'Pro-Oil Morava s.r.o.');
		define('MAIL_HEUREKA_DOTAZNIKY', 'dotaznik@pro-oil.cz');
		$this->getService('tracy.bar')->addPanel(new Nette\Bridges\DITracy\ContainerPanel($this));
		header('X-Frame-Options: SAMEORIGIN');
		header('X-Powered-By: Nette Framework');
		header('Content-Type: text/html; charset=utf-8');
		Nette\Reflection\AnnotationsParser::setCacheStorage($this->getByType("Nette\Caching\IStorage"));
		Nette\Reflection\AnnotationsParser::$autoRefresh = TRUE;
		$this->getService('session.session')->start();
		Tracy\Debugger::$email = constant('MAIL_ADMIN');
		if (!class_exists('WebLoader\LoaderFactory', FALSE)) class_alias('WebLoader\Nette\LoaderFactory', 'WebLoader\LoaderFactory');
	}

}



final class Container_b68475f7b0_App_Components_Controls_CartControl_ICartControlFactoryImpl_40_App_Components_Controls_CartControl_ICartControlFactory implements App\Components\Controls\CartControl\ICartControlFactory
{

	private $container;


	public function __construct(Container_b68475f7b0 $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new App\Components\Controls\CartControl\CartControl($this->container->getService('repository'), $this->container->getService('mail.mailer'),
			$this->container->getService('63_App_Model_Repositories_RepositoryOrders'), $this->container->getService('62_App_Model_Payment'),
			$this->container->getService('61_App_Model_Heureka_Overeno'));
		return $service;
	}

}



final class Container_b68475f7b0_App_Components_Controls_Crud_AvailabilityControl_IAvailabilityControlFactoryImpl_41_App_Components_Controls_Crud_AvailabilityControl_IAvailabilityControlFactory implements App\Components\Controls\Crud\AvailabilityControl\IAvailabilityControlFactory
{

	private $container;


	public function __construct(Container_b68475f7b0 $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new App\Components\Controls\Crud\AvailabilityControl\AvailabilityControl($this->container->getService('repository'));
		return $service;
	}

}



final class Container_b68475f7b0_App_Components_Controls_Crud_CategoriesControl_ICategoriesControlFactoryImpl_42_App_Components_Controls_Crud_CategoriesControl_ICategoriesControlFactory implements App\Components\Controls\Crud\CategoriesControl\ICategoriesControlFactory
{

	private $container;


	public function __construct(Container_b68475f7b0 $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new App\Components\Controls\Crud\CategoriesControl\CategoriesControl($this->container->getService('repository'));
		return $service;
	}

}



final class Container_b68475f7b0_App_Components_Controls_Crud_ContactsControl_IContactsControlFactoryImpl_43_App_Components_Controls_Crud_ContactsControl_IContactsControlFactory implements App\Components\Controls\Crud\ContactsControl\IContactsControlFactory
{

	private $container;


	public function __construct(Container_b68475f7b0 $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new App\Components\Controls\Crud\ContactsControl\ContactsControl($this->container->getService('repository'));
		return $service;
	}

}



final class Container_b68475f7b0_App_Components_Controls_Crud_ItemsControl_IItemsControlFactoryImpl_44_App_Components_Controls_Crud_ItemsControl_IItemsControlFactory implements App\Components\Controls\Crud\ItemsControl\IItemsControlFactory
{

	private $container;


	public function __construct(Container_b68475f7b0 $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new App\Components\Controls\Crud\ItemsControl\ItemsControl($this->container->getService('repository'), $this->container->getService('imageStorage'),
			$this->container->getService('http.request'), $this->container->getService('mail.mailer'));
		return $service;
	}

}



final class Container_b68475f7b0_App_Components_Controls_Crud_ManufacturersControl_IManufacturersControlFactoryImpl_45_App_Components_Controls_Crud_ManufacturersControl_IManufacturersControlFactory implements App\Components\Controls\Crud\ManufacturersControl\IManufacturersControlFactory
{

	private $container;


	public function __construct(Container_b68475f7b0 $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new App\Components\Controls\Crud\ManufacturersControl\ManufacturersControl($this->container->getService('repository'));
		return $service;
	}

}



final class Container_b68475f7b0_App_Components_Controls_Crud_OrdersControl_IOrdersControlFactoryImpl_46_App_Components_Controls_Crud_OrdersControl_IOrdersControlFactory implements App\Components\Controls\Crud\OrdersControl\IOrdersControlFactory
{

	private $container;


	public function __construct(Container_b68475f7b0 $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new App\Components\Controls\Crud\OrdersControl\OrdersControl($this->container->getService('63_App_Model_Repositories_RepositoryOrders'));
		return $service;
	}

}



final class Container_b68475f7b0_App_Components_Controls_Crud_PagesControl_IPagesControlFactoryImpl_47_App_Components_Controls_Crud_PagesControl_IPagesControlFactory implements App\Components\Controls\Crud\PagesControl\IPagesControlFactory
{

	private $container;


	public function __construct(Container_b68475f7b0 $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new App\Components\Controls\Crud\PagesControl\PagesControl($this->container->getService('repository'));
		return $service;
	}

}



final class Container_b68475f7b0_App_Components_Controls_Crud_PaymentsControl_IPaymentsControlFactoryImpl_48_App_Components_Controls_Crud_PaymentsControl_IPaymentsControlFactory implements App\Components\Controls\Crud\PaymentsControl\IPaymentsControlFactory
{

	private $container;


	public function __construct(Container_b68475f7b0 $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new App\Components\Controls\Crud\PaymentsControl\PaymentsControl($this->container->getService('repository'));
		return $service;
	}

}



final class Container_b68475f7b0_App_Components_Controls_Crud_SlideshowControl_ISlideshowControlFactoryImpl_49_App_Components_Controls_Crud_SlideshowControl_ISlideshowControlFactory implements App\Components\Controls\Crud\SlideshowControl\ISlideshowControlFactory
{

	private $container;


	public function __construct(Container_b68475f7b0 $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new App\Components\Controls\Crud\SlideshowControl\SlideshowControl($this->container->getService('repository'), $this->container->getService('imageStorage'));
		return $service;
	}

}



final class Container_b68475f7b0_App_Components_Controls_Crud_TransportsControl_ITransportsControlFactoryImpl_50_App_Components_Controls_Crud_TransportsControl_ITransportsControlFactory implements App\Components\Controls\Crud\TransportsControl\ITransportsControlFactory
{

	private $container;


	public function __construct(Container_b68475f7b0 $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new App\Components\Controls\Crud\TransportsControl\TransportsControl($this->container->getService('repository'));
		return $service;
	}

}



final class Container_b68475f7b0_App_Components_Controls_Crud_UomControl_IUomControlFactoryImpl_51_App_Components_Controls_Crud_UomControl_IUomControlFactory implements App\Components\Controls\Crud\UomControl\IUomControlFactory
{

	private $container;


	public function __construct(Container_b68475f7b0 $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new App\Components\Controls\Crud\UomControl\UomControl($this->container->getService('repository'));
		return $service;
	}

}



final class Container_b68475f7b0_App_Components_Controls_Crud_UsersControl_IUsersControlFactoryImpl_52_App_Components_Controls_Crud_UsersControl_IUsersControlFactory implements App\Components\Controls\Crud\UsersControl\IUsersControlFactory
{

	private $container;


	public function __construct(Container_b68475f7b0 $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new App\Components\Controls\Crud\UsersControl\UsersControl($this->container->getService('repository'));
		return $service;
	}

}



final class Container_b68475f7b0_App_Components_Controls_LogoutControl_ILogoutControlFactoryImpl_53_App_Components_Controls_LogoutControl_ILogoutControlFactory implements App\Components\Controls\LogoutControl\ILogoutControlFactory
{

	private $container;


	public function __construct(Container_b68475f7b0 $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new App\Components\Controls\LogoutControl\LogoutControl;
		return $service;
	}

}



final class Container_b68475f7b0_App_Components_Forms_LoginForm_ILoginFormFactoryImpl_54_App_Components_Forms_LoginForm_ILoginFormFactory implements App\Components\Forms\LoginForm\ILoginFormFactory
{

	private $container;


	public function __construct(Container_b68475f7b0 $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new App\Components\Forms\LoginForm\LoginForm;
		return $service;
	}

}



final class Container_b68475f7b0_Nette_Bridges_ApplicationLatte_ILatteFactoryImpl_latte_latteFactory implements Nette\Bridges\ApplicationLatte\ILatteFactory
{

	private $container;


	public function __construct(Container_b68475f7b0 $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new Latte\Engine;
		$service->setTempDirectory('/home/riki/work/www/pro-oil/App/../temp/cache/latte');
		$service->setAutoRefresh(TRUE);
		$service->setContentType('html');
		Nette\Utils\Html::$xhtml = FALSE;
		return $service;
	}

}
