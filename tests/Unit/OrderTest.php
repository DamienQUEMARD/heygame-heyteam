<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderStatusNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_mail_notification_is_sent(): void
    {
        Notification::fake();

        $user = User::factory()->create();
        $order = Order::factory()->create(
            [
                'user_id' => $user->id,
            ]
        );

        $user->notify(new OrderStatusNotification($order));

        Notification::assertSentTo($user, OrderStatusNotification::class, function ($notification) use ($user, $order) {
            $mailData = $notification->toMail($user);
            $this->assertStringContainsString("Your order #{$order->id} has been updated.", $mailData->render());
            $this->assertStringContainsString("The new status is: {$order->status}", $mailData->render());

            return true;
        });

        Notification::assertCount(1);
    }
}
