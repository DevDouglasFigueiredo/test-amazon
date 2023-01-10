<?php

namespace src\tests;

use src\PageObject\PageLogin;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class Login extends TestCase
{
    private static WebDriver $driver;
    private PageLogin $pageLogin;
    public static function setUpBeforeClass(): void
    {
        $host = 'http://localhost:4444/wd/hub';
        $capabilities = DesiredCapabilities::chrome();
        // $options = new ChromeOptions(); 
        // $options->addArguments( [ 'headless' ] ); 
        // $capabilities->setCapability( ChromeOptions::CAPABILITY, $options ); 
        self::$driver = RemoteWebDriver::create($host, $capabilities);
    }

    protected function setup():void
    {
        self::$driver->get("https://www.amazon.com.br/ref=ap_frn_logo");

        $this->pageLogin = new PageLogin(self::$driver);
       
    }

    public function testLogingWithMyAccount()
    {
        $this->pageLogin->logingWithMyAccount("your email", "your pass");

        $this->assertSame("https://www.amazon.com.br/ap/signin",
        self::$driver->getCurrentURL());
        $this->assertStringContainsString("Olá, Douglas", self::$driver->getPageSource());
        $this->assertStringNotContainsString("Olá, Faça seu login", self::$driver->getPageSource());
    }

    public static function tearDownAfterClass(): void
    {
        self::$driver->close();
    }

}