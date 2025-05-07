<?php

namespace App\Filament\Resources;

use App\Enums\Status;
use App\Filament\Resources\AppSettingResource\Pages;
use App\Filament\Resources\AppSettingResource\RelationManagers;
use App\Models\AppSetting;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppSettingResource extends Resource
{
    protected static ?string $model = AppSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        return __('filament.app_settings');
    }

    public static function getModelLabel(): string
    {
        return __('filament.app_setting');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.app_settings');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('key')
                    ->label(__('filament.key'))
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Select::make('status')
                    ->label(__('filament.status'))
                    ->required()
                    ->options(Status::basicOptions()),

                TextInput::make('en.label')
                    ->label(__('filament.label_en'))
                    ->formatStateUsing(function ($state, $record) {
                        return $record ? $record->{'label:en'} : $state;
                    })
                    ->required()
                    ->maxLength(255),

                TextInput::make('ar.label')
                    ->label(__('filament.label_ar'))
                    ->formatStateUsing(function ($state, $record) {
                        return $record ? $record->{'label:ar'} : $state;
                    })
                    ->required()
                    ->maxLength(255),

                TextInput::make('en.value')
                    ->label(__('filament.value_en'))
                    ->formatStateUsing(function ($state, $record) {
                        return $record ? $record->{'value:en'} : $state;
                    })
                    ->maxLength(255),

                TextInput::make('ar.value')
                    ->label(__('filament.value_ar'))
                    ->formatStateUsing(function ($state, $record) {
                        return $record ? $record->{'value:ar'} : $state;
                    })
                    ->maxLength(255),

                Forms\Components\FileUpload::make('image_path')
                    ->label(__('filament.image'))
                    ->columnSpanFull()
                    ->nullable()
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label(__('filament.image')),

                Tables\Columns\TextColumn::make('label')
                    ->label(__('filament.label'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('key')
                    ->label(__('filament.key'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('value')
                    ->label(__('filament.value'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->label(__('filament.status'))
                    ->sortable()
                    ->searchable()
                    ->badge(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
            ])->filters([
                //
            ])->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])->actions([
                //
            ])->bulkActions([
                //
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('filament.status'))
                    ->options(Status::class),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->modifyQueryUsing(function (Builder $query) {
                // Join the translations table for the current locale
                $query->leftJoin('app_setting_translations', function ($join) {
                    $join->on('app_settings.id', '=', 'app_setting_translations.app_setting_id')
                        ->where('app_setting_translations.locale', app()->getLocale());
                })
                    // Select the translated label to avoid ambiguity
                    ->select(
                        'app_settings.*',
                        'app_setting_translations.label as label',
                        'app_setting_translations.value as value'
                    );
            });
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
            'index' => Pages\ListAppSettings::route('/'),
            'create' => Pages\CreateAppSetting::route('/create'),
            'edit' => Pages\EditAppSetting::route('/{record}/edit'),
        ];
    }
}
