<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuthorResource\Pages;
use App\Models\Author;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Table;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre del autor')
                    ->required()
                    ->maxLength(255),

                Forms\Components\DatePicker::make('birthdate')
                    ->label('Fecha de nacimiento')
                    ->required(),

                Forms\Components\TextInput::make('nationality')
                    ->label('Nacionalidad')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Autor')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('birthdate')->label('Fecha nacimiento')->date(),
                Tables\Columns\TextColumn::make('nationality')->label('Nacionalidad')->searchable(),
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
                    ->authorize(fn () => Auth::check() && Auth::user()?->can('delete', Author::class)),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->authorize(fn () => Auth::user()?->can('create', Author::class) ?? false),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }
}
