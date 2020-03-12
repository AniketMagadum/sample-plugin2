<?php

namespace AniketMagadum\Helpdesk\Tests\Feature\Models;


use AniketMagadum\Helpdesk\Tests\BaseTestCase;
use Backend\Models\User as BackendUser;
use October\Tests\Concerns\InteractsWithAuthentication;
use RainLab\User\Facades\Auth;
use RainLab\User\Models\User;
use AniketMagadum\Helpdesk\Models\Ticket;

class TicketTest extends BaseTestCase
{
    use InteractsWithAuthentication;

    public function testAFrontEndUserCanCreateATicket()
    {
        $user = factory(User::class)->states('activated')->create();
        Auth::login($user);
        $ticket = factory(Ticket::class)->create();
        $this->assertInstanceOf(User::class, $ticket->createable);
    }

    public function testABackendUserCanCreateATicket()
    {
        $backendUser = factory(BackendUser::class)->create();
        $this->actingAs($backendUser);
        $ticket = factory(Ticket::class)->create();
        $this->assertInstanceOf(BackendUser::class, $ticket->createable);
    }
}
