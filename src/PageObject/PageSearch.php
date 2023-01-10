<?php

namespace src\PageObject;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class PageSearch
{
    private WebDriver $driver;

    public function __construct(WebDriver $driver)
    {
        $this->driver = $driver;
    }

    public function lookingForDesiredProduct(string $search)
    {
        $inputSearch = WebDriverBy::id("twotabsearchtextbox");
        $this->driver->findElement($inputSearch)->sendKeys($search)->submit();

        
        $options = WebDriverBy::cssSelector("#search > div.s-desktop-width-max.s-desktop-content.s-opposite-dir.sg-row > div.s-matching-dir.sg-col-16-of-20.sg-col.sg-col-8-of-12.sg-col-12-of-16 > div > span.rush-component.s-latency-cf-section > div.s-main-slot.s-result-list.s-search-results.sg-row > div:nth-child(2) > div > div > div > div > div.a-section.a-spacing-small.puis-padding-left-small.puis-padding-right-small > div.a-section.a-spacing-none.a-spacing-top-small.s-title-instructions-style > h2 > a > span");

        $this->driver->wait(10)->
        until(WebDriverExpectedCondition::visibilityOfElementLocated($options));

        $this->driver->findElement($options)->click();
    }

    public function buyingProduct()
    {
        $buttonBuy = WebDriverBy::id("buy-now-button");
        $this->driver->findElement($buttonBuy)->click();
    }
}