<?php

namespace Tests\Unit\Support;

use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    /** @test */
    public function it_formats_truthy_values_correctly()
    {
        $this->assertEquals('yes', format_truthy_value(true));
        $this->assertEquals('yes', format_truthy_value(1));
        $this->assertEquals('yes', format_truthy_value('true'));
        $this->assertEquals('yes', format_truthy_value('1'));

        $this->assertEquals('no', format_truthy_value(false));
        $this->assertEquals('no', format_truthy_value(0));
        $this->assertEquals('no', format_truthy_value('false'));
        $this->assertEquals('no', format_truthy_value('0'));

        $this->assertEquals('maybe', format_truthy_value('maybe'));
        $this->assertEquals('custom-yes', format_truthy_value(true, 'custom-yes', 'custom-no'));
        $this->assertEquals('custom-no', format_truthy_value(false, 'custom-yes', 'custom-no'));
    }

    /** @test */
    public function it_parses_valid_domains_correctly()
    {
        $this->assertEquals('example.com', parse_domain('https://example.com'));
        $this->assertEquals('example.com', parse_domain('http://example.com'));
        $this->assertEquals('example.com', parse_domain('www.example.com'));
        $this->assertEquals('example.com', parse_domain('https://www.example.com/path?query=123'));
        $this->assertEquals('example.com', parse_domain('example.com'));
        $this->assertEquals('subdomain.example.com', parse_domain('https://subdomain.example.com'));
    }

    /** @test */
    public function it_returns_null_for_invalid_domains()
    {
        $this->assertNull(parse_domain('not a url'));
        $this->assertNull(parse_domain('https:///badurl'));
        $this->assertNull(parse_domain(''));
        $this->assertNull(parse_domain('http://'));
        $this->assertNull(parse_domain('http://?'));
    }
}
