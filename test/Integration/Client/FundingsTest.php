<?php

declare(strict_types = 1);

namespace Rentpost\ForteApi\Test\Integration\Client;

use Rentpost\ForteApi\Filter\FundingFilter;
use Rentpost\ForteApi\Test\Integration\AbstractIntegrationTest;
use Rentpost\ForteApi\Test\UserSettings;
use Rentpost\ForteApi\Model;
use Rentpost\ForteApi\Attribute;

class FundingsTest extends AbstractIntegrationTest
{
    
    public function testFindAll()
    {
        $client = $this->getForteClient();

        $filter = new FundingFilter();
        $filter
            ->setStartEffectiveDate(new Attribute\Date('2017-09-01'))
            ->setEndEffectiveDate(new Attribute\Date('2018-01-01'));

        $fundingsCollection = $client->useFundings()->find(UserSettings::getLivetestMerchantOrganizationId(), $filter);

        $this->assertInstanceOf(Model\FundingCollection::class, $fundingsCollection);
        $this->assertInstanceOf(Model\Response::class, $fundingsCollection->getResponse());
    }
}