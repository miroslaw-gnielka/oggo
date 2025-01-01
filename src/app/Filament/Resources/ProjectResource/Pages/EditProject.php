<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFormActions(): array
    {
        $actions = [
            Actions\Action::make('attach-tasks')
                ->color('info')
                ->action(function() {
                    $this->redirect(ProjectResource::getUrl('attach-tasks', ['record' => $this->record]));
                })
        ];

        return array_merge(
            parent::getFormActions(),
            $actions
        );
    }
}
