<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;
    public $status;
    /**
     * Create a new notification instance.
     */
    public function __construct($order, $status)
    {
        $this->order = $order;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $statusText = match ($this->status) {
            'paid' => 'پرداخت شده',
            'shipped' => 'در حال ارسال',
            default => 'بروزرسانی شده'
        };

        return (new MailMessage)
            ->subject('تغییر وضعیت سفارش')
            ->greeting('سلام ' . $notifiable->name)
            ->line("وضعیت سفارش #{$this->order->id} به '{$statusText}' تغییر کرد.")
            ->line('از خرید شما سپاسگزاریم.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
