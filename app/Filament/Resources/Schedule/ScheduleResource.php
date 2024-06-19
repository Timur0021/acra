<?php

namespace App\Filament\Resources\Schedule;

use App\Filament\Resources\Schedule\ScheduleResource\Pages;
use App\Filament\Resources\Schedule\ScheduleResource\RelationManagers;
use App\Models\Schedule;
use App\Models\Workers;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Schedule';

    protected static ?string $modelLabel = 'Schedule list';

    protected static ?string $navigationGroup = 'Action';

    protected static ?string $slug = 'schedules';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Schedule list')
                    ->description('Information about the schedule list')
                    ->schema([
                        Select::make('worker_id')
                            ->label('Worker')
                            ->relationship('worker', 'name')
                            ->options(function () {
                                return Workers::where('is_active', true)->pluck('name', 'id');
                            }),
                        DateTimePicker::make('work_day_from')
                            ->label('Work Day Start')
                            ->native(false)
                            ->required()
                            ->placeholder('Enter Work Day From'),
                        DateTimePicker::make('work_day_to')
                            ->label('Work Day Finish')
                            ->native(false)
                            ->required()
                            ->placeholder('Enter Work Day Finish'),
                    ])->columnSpan(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('worker.name')
                    ->label('Name'),
                TextColumn::make('work_day_from')
                    ->label('Work Day Start'),
                TextColumn::make('work_day_to')
                    ->label('Work Day Finish'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
