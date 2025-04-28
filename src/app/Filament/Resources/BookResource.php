<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Book;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Exports\ResumenExport;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers\AuthorsRelationManager;


class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título del libro')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('isbn')
                    ->label('ISBN')
                    ->required()
                    ->maxLength(20),

                Forms\Components\TextInput::make('publication_year')
                    ->label('Año de publicación')
                    ->numeric()
                    ->required(),

                Forms\Components\Select::make('authors')
                    ->label('Autores')
                    ->multiple()
                    ->relationship('authors', 'name')
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('title')->label('Título')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('isbn')->label('ISBN')->sortable(),
                Tables\Columns\TextColumn::make('publication_year')->label('Año publicación')->sortable(),
                Tables\Columns\TextColumn::make('authors.name')->label('Autores')->badge(),
                Tables\Columns\TextColumn::make('created_at')->label('Fecha de creación')->since(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->authorize(fn ($record) => Auth::check() && Auth::user()?->can('update', $record)),
                Tables\Actions\DeleteAction::make()
                    ->authorize(fn ($record) => Auth::check() && Auth::user()?->can('delete', $record)),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->authorize(fn () => Auth::check() && Auth::user()?->can('delete', Book::class)),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->authorize(fn () => Auth::check() && Auth::user()?->can('create', Book::class)),

                    Action::make('exportResumen')
                    ->label('Export Summary')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('primary')
                    ->visible(fn () => Auth::user()?->hasRole('Directivo'))
                    ->action(function () {
                        return Excel::download(new ResumenExport, 'resumen_qodex.xlsx');
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AuthorsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
