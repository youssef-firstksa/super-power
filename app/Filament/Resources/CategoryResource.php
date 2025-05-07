<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use App\Services\CMS\NavigationService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return __('filament.categories');
    }

    public static function getModelLabel(): string
    {
        return __('filament.category');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.categories');
    }

    public static function canAccess(): bool
    {
        return NavigationService::getCMSPageNavigationLink('products') ? true : false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('en.name')
                    ->label(__('filament.name_en'))
                    ->formatStateUsing(function ($state, $record) {
                        return $record ? $record->{'name:en'} : $state;
                    })
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('ar.name')
                    ->label(__('filament.name_ar'))
                    ->formatStateUsing(function ($state, $record) {
                        return $record ? $record->{'name:ar'} : $state;
                    })
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('parent_id')
                    ->label(__('filament.category'))
                    ->relationship('parent', 'name', function (Builder $query, $record) {
                        // Join the translations table and select the name column from translations
                        $query->join('category_translations', function ($join) {
                            $join->on('categories.id', '=', 'category_translations.category_id')
                                ->where('category_translations.locale', app()->getLocale());
                        })
                            ->selectRaw('categories.*, category_translations.name as name');

                        $query->orderBy('name');
                    }),

                Forms\Components\FileUpload::make('image_path')
                    ->label(__('filament.image'))
                    ->columnSpanFull()
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.name'))
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_path')
                    ->label(__('filament.image')),
                Tables\Columns\TextColumn::make('parent.name')
                    ->label(__('filament.category'))
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->modifyQueryUsing(function (Builder $query) {
                // Join the translations table for the current locale
                $query->leftJoin('category_translations', function ($join) {
                    $join->on('categories.id', '=', 'category_translations.category_id')
                        ->where('category_translations.locale', app()->getLocale());
                })
                    // Select the translated name to avoid ambiguity
                    ->select('categories.*', 'category_translations.name as name');
            });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCategories::route('/'),
        ];
    }
}
