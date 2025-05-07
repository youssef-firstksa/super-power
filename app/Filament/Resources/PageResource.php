<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-window';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('filament.pages');
    }

    public static function getModelLabel(): string
    {
        return __('filament.page');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.pages');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('en.title')
                    ->label(__('filament.title_en'))
                    ->formatStateUsing(function ($state, $record) {
                        return $record ? $record->{'title:en'} : $state;
                    })
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('ar.title')
                    ->label(__('filament.title_ar'))
                    ->formatStateUsing(function ($state, $record) {
                        return $record ? $record->{'title:ar'} : $state;
                    })
                    ->required()
                    ->maxLength(255),

                Forms\Components\RichEditor::make('en.content')
                    ->label(__('filament.content_en'))
                    ->formatStateUsing(function ($state, $record) {
                        return $record ? $record->{'content:en'} : $state;
                    })
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('ar.content')
                    ->label(__('filament.content_ar'))
                    ->formatStateUsing(function ($state, $record) {
                        return $record ? $record->{'content:ar'} : $state;
                    })
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\Select::make('navigation_link_id')
                    ->label(__('filament.navigation_link'))
                    ->relationship('navigationLink', 'slug', function (Builder $query, $record) {

                        $query->whereNot('page_type', 'cms_page');

                        $query->whereDoesntHave('children');

                        $query->whereDoesntHave('page', function (Builder $query) use ($record) {
                            $query->when($record, fn(Builder $query) => $query->where('id', '!=', $record->id));
                        });
                    }),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament.title'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('navigationLink.slug')
                    ->label(__('filament.navigation_link'))
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->url(function (Page $record) {
                        return NavigationLinkResource::getUrl('edit', [
                            'record' => $record->navigation_link_id,
                        ]);
                    }),

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
                $query->leftJoin('page_translations', function ($join) {
                    $join->on('pages.id', '=', 'page_translations.page_id')
                        ->where('page_translations.locale', app()->getLocale());
                })
                    // Select the translated title to avoid ambiguity
                    ->select('pages.*', 'page_translations.title as title');
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
