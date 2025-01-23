<?php
namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ProductCreated extends Notification
{
    use Queueable;

    public function __construct(protected Product $product) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Product Created')
            ->line("New product '{$this->product->name}' has been created.")
            ->line("Article: {$this->product->article}")
            ->line("Status: {$this->product->status}");
    }
}
