<?php

namespace Tests\Feature;

use App\Models\AllowedDomain;
use App\Rules\EmailDomain;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

//should be a unit test but since the rule queries against the DB we consider it a feature test
class EmailDomainRuleTest extends TestCase {
    use RefreshDatabase;

    protected EmailDomain $rule;

    public function setUp(): void {
        parent::setUp();
        $this->rule = new EmailDomain();
    }

    /**
     * @dataProvider validEmailAddresses
     */
    public function testValidEmailAddressesPass($email) {
        $this->assertTrue($this->rule->passes('email', $email));
    }

    /**
     * @dataProvider invalidEmailAddresses
     */
    public function testInvalidEmailAddressesFail($email) {
        $this->assertFalse($this->rule->passes('email', $email));
    }

    public function validEmailAddresses(): array {
        return [
            ["valid@theovier.de"],
            ["first.last@theovier.de"],
            ["first@miele.de"],
            ["first.last@miele.de"],
            ["first@uni-paderborn.de"],
            ["first.last@uni-paderborn.de"],
            ["first@upb.de"],
            ["first.last@upb.de"],
            ["first@sn-invent.de"],
            ["first.last@sn-invent.de"],
            ["first@weidmueller.com"],
            ["first.last@weidmueller.com"],
        ];
    }

    public function invalidEmailAddresses(): array {
        return [
            ["invalid@theovier2.de"],
            ["invalid@theo.vier.de"],
            ["invalid@theo.theovier.de"],
            ["invalid@gmx.de"],
            ["invalid@mail.upb.de"],
            ["notEvenAnEmailAddress"]
        ];
    }
}
