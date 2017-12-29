<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase
{
    protected $string, $key, $encryptedString, $decryptedString;

    protected function setUp()
    {
        $string = 'thisisateststring';
        $key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';

        $encryptedString = Encryption::encrypt($this->string, $this->key);
        $decryptedString = Encryption::decrypt($encryptedString, $this->key);
    }

    public function testDecryptedStringMatchesOriginal()
    {
        $this->assertEquals(
            $this->string,
            $this->decryptedString
        );
    }

    public function testDecryptionIsFalse()
    {
        $this->assertNotEquals(
            'badteststring',
            $this->decryptedString
        );
    }
}
