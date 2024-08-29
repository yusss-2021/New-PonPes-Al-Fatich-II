<?php

namespace Modules\Admin\Filament\Resources\UserResource\Pages;

use App\Models\User;
use Modules\Admin\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    protected function getCreateFormAction(): Actions\Action
    {
        return Actions\Action::make('create')
            ->label('Submit')
            ->icon('fas-paper-plane')
            ->action('create')
            ->color('success');
    }

    protected function getCreateAnotherFormAction(): Actions\Action
    {
        return Actions\Action::make('createAnother')
            ->label('Submit & Buat Baru')
            ->color('gray')
            ->icon('heroicon-o-squares-plus')
            ->action('createAnother');
    }

    protected function getCancelFormAction(): Actions\Action
    {
        return Actions\Action::make('cancel')
            ->label('Kembali')
            ->color('danger')
            ->icon('zondicon-arrow-left')
            ->url(UserResource::getUrl());
    }
}
