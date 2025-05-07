<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Services\CMS\NavigationService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canAccess(): bool
    {
        return NavigationService::getCMSPageNavigationLink('products') ? true : false;
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.products');
    }

    public static function getModelLabel(): string
    {
        return __('filament.product');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.products');
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

                Forms\Components\RichEditor::make('en.description')
                    ->columnSpanFull()
                    ->label(__('filament.description_en'))
                    ->formatStateUsing(function ($state, $record) {
                        return $record ? $record->{'description:en'} : $state;
                    })
                    ->required()
                    ->maxLength(255),

                Forms\Components\RichEditor::make('ar.description')
                    ->columnSpanFull()
                    ->label(__('filament.description_ar'))
                    ->formatStateUsing(function ($state, $record) {
                        return $record ? $record->{'description:ar'} : $state;
                    })
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('price')
                    ->label(__('filament.price'))
                    ->required()
                    ->numeric()
                    ->minValue(5),

                Forms\Components\Select::make('category_id')
                    ->label(__('filament.category'))
                    ->relationship('category', 'name', function (Builder $query, $record) {
                        // Join the translations table for the current locale
                        $query->leftJoin('category_translations', function ($join) {
                            $join->on('categories.id', '=', 'category_translations.category_id')
                                ->where('category_translations.locale', app()->getLocale());
                        })
                            // Select the translated label to avoid ambiguity
                            ->select(
                                'categories.*',
                                'category_translations.name as name'
                            );

                        $query->orderBy('id');
                    })
                    ->required(),

                Forms\Components\SpatieMediaLibraryFileUpload::make('images')
                    ->label(__('filament.images'))
                    ->multiple()
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
                Tables\Columns\SpatieMediaLibraryImageColumn::make('images')
                    ->label(__('filament.images'))->limit(1),
                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('filament.category'))
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label(__('filament.price'))
                    ->numeric()
                    ->searchable(),
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->modifyQueryUsing(function (Builder $query) {
                // Join the translations table for the current locale
                $query->leftJoin('product_translations', function ($join) {
                    $join->on('products.id', '=', 'product_translations.product_id')
                        ->where('product_translations.locale', app()->getLocale());
                })
                    // Select the translated label to avoid ambiguity
                    ->select(
                        'products.*',
                        'product_translations.name as name',
                        'product_translations.description as description',
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
