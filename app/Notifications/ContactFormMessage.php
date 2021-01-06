<?php

namespace App\Notifications;

use App\Http\Requests\ContactFormRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactFormMessage extends Notification implements ShouldQueue
{
    use Queueable;

    protected $poruka;
    protected $prezime;
    protected $ime;
    protected $telefon;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ContactFormRequest $request)
    {
        $this->ime = $request->ime;
        $this->prezime = $request->prezime;
        $this->telefon = $request->telefon;
        $this->poruka = $request->poruka;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Nova poruka od korisnika - MSTORE")
            ->greeting("Pozdrav, ovu poruku vam šalje " . $this->ime . " " . $this->prezime)
            ->salutation("Broj telefona korisnika: " . $this->telefon)
            ->line($this->poruka);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
