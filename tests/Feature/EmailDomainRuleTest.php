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
        AllowedDomain::factory()->create([
            'name' => "theovier.de"
        ]);
        AllowedDomain::factory()->create([
            'name' => "example.com"
        ]);
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
            ["example@example.com"],
        ];
    }

    public function invalidEmailAddresses(): array {
        return [
            ["invalid@theovier2.de"],
            ["invalid@theo.vier.de"],
            ["invalid@theo.theovier.de"],
            ["invalid@gmx.de"],
            ["notEvenAnEmailAddress"]
        ];
    }
}
