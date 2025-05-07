<?php

namespace App\Filament\Resources;

use App\Enums\Status;
use App\Filament\Resources\NavigationLinkResource\Pages;
use App\Filament\Resources\NavigationLinkResource\RelationManagers;
use App\Models\NavigationLink;
use App\Services\CMS\CMSConfigrationService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NavigationLinkResource extends Resource
{
    protected static ?string $model = NavigationLink::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('filament.navigation_links');
    }

    public static function getModelLabel(): string
    {
        return __('filament.navigation_link');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.navigation_links');
    }

    public static function form(Form $form): Form
    {
        $modelId = null;
        // if it is not a string that means that we in the edit page not create page
        if (!is_string($form?->model)) {
            $modelId = $form->model->id;
        }

        $pageTypeOptions = CMSConfigrationService::getCMSPagesOptions($modelId);

        return $form
            ->schema([
                Forms\Components\TextInput::make('en.label')
                    ->label(__('filament.label_en'))
                    ->formatStateUsing(function ($state, $record) {
                        return $record ? $record->{'label:en'} : $state;
                    })
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('ar.label')
                    ->label(__('filament.label_ar'))
                    ->formatStateUsing(function ($state, $record) {
                        return $record ? $record->{'label:ar'} : $state;
                    })
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('slug')
                    ->label(__('filament.slug'))
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Forms\Components\Select::make('page_type')
                    ->label(__('filament.page_type'))
                    ->options([
                        'content' => __('filament.content'),
                        'cms_page' => __('filament.cms_page'),
                    ])
                    ->disabled(function (callable $get, string $operation) {
                        return $operation == 'edit';
                    })
                    ->reactive(),

                Forms\Components\Select::make('cms_page')
                    ->label(__('filament.cms_page'))
                    ->options($pageTypeOptions)
                    ->reactive()
                    ->disabled(function (callable $get, string $operation) {
                        return $operation == 'edit';
                    })
                    ->visible(function (callable $get, string $operation) {
                        return $get('page_type') === 'cms_page';
                    })
                    ->required(function (callable $get) {
                        return $get('page_type') === 'cms_page';
                    }),

                Forms\Components\TextInput::make('controller')
                    ->visible(function (callable $get) {
                        return $get('page_type') === 'cms_page' && $get('cms_page') !== null;
                    })
                    ->required(function (callable $get) {
                        return $get('page_type') === 'cms_page' && $get('cms_page') !== null;
                    })
                    ->disabled(function (callable $get, string $operation) {
                        return $operation == 'edit';
                    })
                    ->maxLength(255),

                Forms\Components\TextInput::make('action')
                    ->visible(function (callable $get) {
                        return $get('page_type') === 'cms_page' && $get('cms_page') !== null;
                    })
                    ->required(function (callable $get) {
                        return $get('page_type') === 'cms_page' && $get('cms_page') !== null;
                    })
                    ->disabled(function (callable $get, string $operation) {
                        return $operation == 'edit';
                    })
                    ->maxLength(255),

                Forms\Components\TextInput::make('order')
                    ->label(__('filament.ordering'))
                    ->required()
                    ->numeric()
                    ->default(0),

                Forms\Components\Select::make('parent_id')
                    ->label(__('filament.parent'))
                    ->relationship(
                        name: 'parent',
                        titleAttribute: 'label',
                        modifyQueryUsing: function (Builder $query, $record) {
                            // Join the translations table and select the label column from translations
                            $query->join('navigation_link_translations', function ($join) {
                                $join->on('navigation_links.id', '=', 'navigation_link_translations.navigation_link_id')
                                    ->where('navigation_link_translations.locale', app()->getLocale());
                            })
                                ->selectRaw('navigation_links.*, navigation_link_translations.label as label');
                            // Apply your existing conditions
                            $query->when($record?->id, function (Builder $query) use ($record) {
                                $query->whereNot('navigation_links.id', $record->id);
                            })
                                ->whereDoesntHave('page')
                                ->whereNull('cms_page')
                                // Explicitly set the ORDER BY clause
                                ->orderBy('navigation_links.id', 'desc');
                        }
                    )
                    ->searchable()
                    ->preload(),

                Forms\Components\Select::make('status')
                    ->label(__('filament.status'))
                    ->options(Status::class)
                    ->default('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->label(__('filament.label'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('order')
                    ->label(__('filament.ordering'))
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('translation.label')
                    ->label(__('filament.parent'))
                    ->badge()
                    ->url(function (NavigationLink $record) {
                        return NavigationLinkResource::getUrl('edit', [
                            'record' => $record->parent_id ?? $record->id
                        ]);
                    })
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label(__('filament.status'))
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
                $query->leftJoin('navigation_link_translations', function ($join) {
                    $join->on('navigation_links.id', '=', 'navigation_link_translations.navigation_link_id')
                        ->where('navigation_link_translations.locale', app()->getLocale());
                })
                    // Select the translated label to avoid ambiguity
                    ->select('navigation_links.*', 'navigation_link_translations.label as label');
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
            'index' => Pages\ListNavigationLinks::route('/'),
            'create' => Pages\CreateNavigationLink::route('/create'),
            'edit' => Pages\EditNavigationLink::route('/{record}/edit'),
        ];
    }
}
