<?php
namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Уведомление о создании нового продукта
 */
class ProductCreated extends Notification
{
    use Queueable;

    /**
     * @param Product $product Созданный продукт
     */
    public function __construct(protected Product $product) {}

    /**
     * Получение каналов доставки уведомления
     *
     * @param mixed $notifiable
     * @return array<string>
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Формирование почтового сообщения
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Product Created')
            ->line("New product '{$this->product->name}' has been created.")
            ->line("Article: {$this->product->article}")
            ->line("Status: {$this->product->status}")
            ->line("Color: {$this->product->data['color']}")
            ->line("Size: {$this->product->data['size']}");
    }
}
