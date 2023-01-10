<?php

namespace src\tests;

use src\PageObject\PageLogin;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use src\PageObject\PageSearch;

class Search extends TestCase
{
    private static WebDriver $driver;

    public static function setUpBeforeClass(): void
    {
        $host = 'http://localhost:4444/wd/hub';
        $capabilities = DesiredCapabilities::chrome();
        // $options = new ChromeOptions(); 
        // $options->addArguments( [ 'headless' ] ); 
        // $capabilities->setCapability( ChromeOptions::CAPABILITY, $options ); 
        self::$driver = RemoteWebDriver::create($host, $capabilities);
    }

    protected function setup(): void
    {
        self::$driver->get("https://www.amazon.com.br/ref=ap_frn_logo");

        $pageLogin = new PageLogin(self::$driver);
        $pageLogin->logingWithMyAccount("your email", "your pass");
    }

    public function testLookingForDesiredProductAndBuying()
    {
        $pageSearch = new PageSearch(self::$driver);
        $pageSearch->lookingForDesiredProduct('capacete Senna');
        $pageSearch->buyingProduct();
        $this->assertStringContainsString(
            "Selecione um método de pagamento",
            self::$driver->getTitle()
        );
        $this->assertSame(
            "https://www.amazon.com.br/gp/buy/payselect/handlers/display.html?_from=cheetah", self::$driver->getCurrentURL());
    }
}
