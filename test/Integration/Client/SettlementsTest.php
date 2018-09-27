<?php

declare(strict_types = 1);

namespace Rentpost\ForteApi\Test\Integration\Client;

use Rentpost\ForteApi\Filter\SettlementFilter;
use Rentpost\ForteApi\Model;
use Rentpost\ForteApi\Attribute;
use Rentpost\ForteApi\Test\Integration\AbstractIntegrationTest;

/**
 * @group skip
 */
class SettlementsTest extends AbstractIntegrationTest
{
    public function testFindListNoFilter()
    {
        $client = $this->getForteClient();

        $filter = new SettlementFilter();
        $filter
            ->setStartSettleDate(new Attribute\Date('2010-01-01'))
            ->setEndSettleDate(new Attribute\Date('2018-02-01'));

        $settlementCollection = $client->useSettlements()->findForEntireOrganization($filter);

        $this->assertInstanceOf(Model\SettlementCollection::class, $settlementCollection);
    }
}