<?php

namespace App\Filament\Resources\Worker;

use App\Filament\Resources\Worker\WorkerResource\Pages;
use App\Filament\Resources\Contact\ContactResource\RelationManagers;
use App\Models\Service;
use App\Models\Workers;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Pelmered\FilamentMoneyField\Forms\Components\MoneyInput;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class WorkerResource extends Resource
{
    protected static ?string $model = Workers::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Workers';

    protected static ?string $modelLabel = 'Workers list';

    protected static ?string $navigationGroup = 'State';

    protected static ?string $slug = 'workers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Worker Information')
                    ->description('Information about the worker')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->maxLength(255)
                            ->required()
                            ->placeholder('Enter Name'),
                        TextInput::make('last_name')
                            ->label('Last Name')
                            ->maxLength(255)
                            ->required()
                            ->placeholder('Enter Last Name'),
                        PhoneInput::make('phone')
                            ->label('Phone')
                            ->defaultCountry('UA')
                            ->required(),
                        MoneyInput::make('salary')
                            ->label('Monthly salary')
                            ->currency('UAH')
                            ->locale('ua_UA')
                            ->required()
                            ->placeholder('Enter Monthly salary'),
                        Select::make('service_id')
                            ->label('Service')
                            ->relationship('service', 'title')
                            ->options(function () {
                                return Service::where('is_active', true)->pluck('title', 'id');
                            }),
                        DatePicker::make('birthday')
                            ->label('Birthday')
                            ->native(false)
                            ->format('Y/m/d')
                            ->placeholder('Enter Birthday'),
                        Checkbox::make('is_active')
                            ->label('Active')
                            ->default(false),
                    ])->columnSpan(2)->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID'),
                TextColumn::make('name')
                    ->label('Name'),
                TextColumn::make('last_name')
                    ->label('Last Name'),
                TextColumn::make('service.title')
                    ->label('Service'),
                TextColumn::make('salary')
                    ->label('Salary'),
                TextColumn::make('birthday')
                    ->label('Birthday'),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Created at'),
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
            'index' => Pages\ListWorkers::route('/'),
            'create' => Pages\CreateWorker::route('/create'),
            'edit' => Pages\EditWorker::route('/{record}/edit'),
        ];
    }
}
