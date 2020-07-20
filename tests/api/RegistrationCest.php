<?php 

declare(strict_types=1);

namespace App\Tests;

use App\Entity\Registration;
use App\Tests\ApiTester;
use Codeception\Util\HttpCode;

class RegistrationCest
{
    private const URL = '/registrations';

    public function _before(ApiTester $I)
    {
        $I->haveHttpHeader('accept', 'application/json');
        $I->haveHttpHeader('content-type', 'application/json');
    }

    // POST
    public function createRegistration(ApiTester $I)
    {
        $I->sendPOST(self::URL, ['name' => 'John Doe', 'email_address' => 'john@doe.com']);

        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['name' => 'John Doe', 'email_address' => 'john@doe.com']);
    }

    // GET
    public function retrieveAllRegistrations(ApiTester $I)
    {
        $I->haveInRepository(Registration::class, ['name' => 'John Doe', 'emailAddress' => 'john@doe.com']);
        $I->haveInRepository(Registration::class, ['name' => 'Jane Doe', 'emailAddress' => 'jane@doe.com']);

        $I->sendGET(self::URL);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['name' => 'John Doe', 'email_address' => 'john@doe.com']);
        $I->seeResponseContainsJson(['name' => 'Jane Doe', 'email_address' => 'jane@doe.com']);
    }

    // GET
    public function retrieveRegistrationById(ApiTester $I)
    {
        $id = $I->haveInRepository(Registration::class, ['name' => 'John Doe', 'emailAddress' => 'john@doe.com']);

        $I->sendGET(self::URL.'/'.$id);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['name' => 'John Doe', 'email_address' => 'john@doe.com']);
    }

    // DELETE
    public function removeRegistrationById(ApiTester $I)
    {
        $id = $I->haveInRepository(Registration::class, ['name' => 'John Doe', 'emailAddress' => 'john@doe.com']);

        $I->sendDELETE(self::URL.'/'.$id);

        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }

    // PUT
    public function replaceRegistrationById(ApiTester $I)
    {
        $id = $I->haveInRepository(Registration::class, ['name' => 'John Doe', 'emailAddress' => 'john@doe.com']);

        $I->sendPUT(self::URL.'/'.$id, ['name' => 'Jane Doe', 'email_address' => 'jane@doe.com']);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['name' => 'Jane Doe', 'email_address' => 'jane@doe.com']);
    }

    // PATCH
    public function updateRegistrationById(ApiTester $I)
    {        
        $id = $I->haveInRepository(Registration::class, ['name' => 'John Doe', 'emailAddress' => 'john@doe.com']);

        $I->haveHttpHeader('content-type', 'application/merge-patch+json');
        $I->sendPATCH(self::URL.'/'.$id, ['email_address' => 'test@test.com']);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['name' => 'John Doe', 'email_address' => 'test@test.com']);
    }
}
