<?php

declare(strict_types=1);

namespace App\Jobs\Post;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IncreaseUserPointsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function __construct(
        readonly public array $attributes,
    ) {
    }

    public function handle(): void
    {
        $user = User::query()
            ->where('id', $this->attributes['user_id'])
            ->firstOrFail();

        $user
            ->increment(
                column: 'total_points',
                amount: 100,
            );
    }
}
