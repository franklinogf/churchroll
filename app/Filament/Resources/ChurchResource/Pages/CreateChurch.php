<?php

declare(strict_types=1);

namespace App\Filament\Resources\ChurchResource\Pages;

use App\Filament\Resources\ChurchResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateChurch extends CreateRecord
{
    protected static string $resource = ChurchResource::class;
}
