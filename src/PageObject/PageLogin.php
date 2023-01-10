<?php

namespace src\PageObject;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;


class PageLogin
{
    private WebDriver $driver;

    public function __construct(WebDriver $driver)
    {
        $this->driver = $driver;
    }

    public function logingWithMyAccount(string $email, string $pass)
    {   

        $doLogin = WebDriverBy::cssSelector("#nav-link-accountList > span");
        $this->driver->findElement($doLogin)->click();
        
        $this->driver->manage()->timeouts()->implicitlyWait(10);

        $inputEmail = WebDriverBy::id("ap_email");
        $this->driver->findElement($inputEmail)->sendKeys($email);

        $button = WebDriverBy::id(("continue"));
        $this->driver->findElement($button)->click();

        $inputPassword = WebDriverBy::id("ap_password");
        $this->driver->findElement($inputPassword)->sendKeys($pass);

        $buttonToLogin = WebDriverBy::id(("signInSubmit"));
        $this->driver->findElement($buttonToLogin)->click();

    }
}