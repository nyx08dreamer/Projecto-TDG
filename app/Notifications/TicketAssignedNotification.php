<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketAssignedNotification extends Notification
{
    use Queueable;

    protected $tickets;

    /**
     * Create a new notification instance.
     */
    public function __construct($tickets)
    {
        $this->tickets = $tickets; // Recibe los tickets como un array u objeto
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database']; // Envía la notificación a la base de datos (se guardará en tu tabla 'notifications')
        // Si quieres enviar por email, agrega 'mail': return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Se le ha asignado un técnico a su(s) ticket(s).',
            'tickets' => $this->tickets->pluck('id'), // Puedes incluir detalles de los tickets
        ];
    }
}
