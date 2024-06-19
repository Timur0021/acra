<?php

namespace App\Filament\Resources\Vacation;

use App\Filament\Resources\Vacation\VacationResource\Pages;
use App\Filament\Resources\Vacation\VacationResource\RelationManagers;
use App\Models\Vacation;
use App\Models\Workers;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;

class VacationResource extends Resource
{
    protected static ?string $model = Vacation::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-europe-africa';

    protected static ?string $navigationLabel = 'Vacation';

    protected static ?string $modelLabel = 'Vacation list';

    protected static ?string $navigationGroup = 'Action';

    protected static ?string $slug = 'vacations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Vacation list')
                    ->description('Information about the schedule list')
                    ->schema([
                        Select::make('worker_id')
                            ->label('Worker')
                            ->relationship('worker', 'name')
                            ->options(function () {
                                return Workers::where('is_active', true)->pluck('name', 'id');
                            }),
                        DateTimePicker::make('vacation_day_from')
                            ->label('Vacation Day Start')
                            ->native(false)
                            ->required()
                            ->placeholder('Enter Vacation Day From'),
                        DateTimePicker::make('vacation_day_to')
                            ->label('Vacation Day Finish')
                            ->native(false)
                            ->required()
                            ->placeholder('Enter Vacation Day Finish'),
                    ])->columnSpan(2)
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('worker.name')
                    ->label('Worker'),
                TextColumn::make('vacation_day_from')
                    ->label('Start Date'),
                TextColumn::make('vacation_day_to')
                    ->label('End Date'),
                TextColumn::make('status')
                    ->label('Status')
                    ->getStateUsing(function ($record) {
                        $today = Carbon::now()->toDateString();
                        $start_date = Carbon::parse($record->vacation_day_from)->toDateString();
                        $end_date = Carbon::parse($record->vacation_day_to)->toDateString();

                        if ($today >= $start_date && $today <= $end_date) {
                            return 'Ongoing';
                        } elseif ($today > $end_date) {
                            return 'Ended';
                        }  else {
                            // Handle cases where today matches start or end date
                            if ($today == $start_date) {
                                return 'Ongoing'; // Vacation starts today
                            } else {
                                return 'Ended'; // Vacation ends today
                            }
                        }
                    }),
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
            'index' => Pages\ListVacations::route('/'),
            'create' => Pages\CreateVacation::route('/create'),
            'edit' => Pages\EditVacation::route('/{record}/edit'),
        ];
    }
}
