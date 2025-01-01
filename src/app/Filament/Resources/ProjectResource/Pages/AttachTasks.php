<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Models\Project;
use App\Models\Task;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Collection;

class AttachTasks extends Page
{
    protected static string $resource = ProjectResource::class;

    protected static string $view = 'filament.resources.project-resource.pages.attach-tasks';

    public Project $record;

    public Collection $tasksWithoutProjects;
    public array $tasksToAttach = [];

    public function mount($record): void
    {
        $this->record = $record;
        $this->tasksWithoutProjects = $this->searchForTasks();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('tasksToAttach')
                    ->options($this->tasksWithoutProjects)
                    ->label('Tasks without projects')
                    ->searchable()
                    ->multiple()
                    ->reactive()
                    ->disabled($this->tasksWithoutProjects->isEmpty())
                    ->hint(fn() => $this->tasksWithoutProjects->isEmpty() ? 'There are no tasks without project' : '')
                    ->preload(),
            ]);
    }

    public function attachTasks(): void
    {
        if (empty($this->tasksToAttach)) {
            Notification::make()
                ->title('No tasks attached')
                ->danger()
                ->send();

            return;
        }

        Task::whereIn('id', $this->tasksToAttach)->update(['project_id' => $this->record->getAttributes()['id']]);

        Notification::make()
            ->title(sprintf('Tasks attached (%d)', count($this->tasksToAttach)))
            ->success()
            ->send();

        $this->redirect(ProjectResource::getUrl('attach-tasks', ['record' => $this->record]));
    }

    protected function getActions(): array
    {
        return [
            Action::make('attachTasks')
            ->action('attachTasks')
        ];
    }

    private function searchForTasks(): Collection
    {
        return Task::whereNull('project_id')->pluck('name', 'id');
    }
}
